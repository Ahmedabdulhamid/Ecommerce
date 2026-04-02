<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(private readonly ProductRepository $products)
    {
    }

    public function dataTableQuery(): Builder
    {
        return $this->products->dataTableQuery();
    }

    public function getCreateDependencies(): array
    {
        return [
            'categories' => $this->products->getAllCategories(),
            'brands' => $this->products->getAllBrands(),
        ];
    }

    public function getEditDependencies(int|string $productId): array
    {
        return [
            'product' => $this->products->findForEdit($productId),
            'attributes' => $this->products->getAttributesWithValues(),
            'categories' => $this->products->getAllCategories(),
            'brands' => $this->products->getAllBrands(),
        ];
    }

    public function getAttributesWithValues(): Collection
    {
        return $this->products->getAttributesWithValues();
    }

    public function findForShow(int|string $id): Product
    {
        return $this->products->findForShow($id);
    }

    public function toggleStatus(int|string $id): void
    {
        $product = $this->products->findByIdOrFail($id);
        $this->products->updateProduct($product, [
            'status' => $product->status == 1 ? 0 : 1,
        ]);
    }

    public function deleteProduct(int|string $id): int
    {
        $product = $this->products->findByIdOrFail($id);
        $this->products->deleteProduct($product);

        return $this->products->count();
    }

    public function deleteVariant(int|string $id): void
    {
        $variant = $this->products->findVariantByIdOrFail($id);
        $this->products->deleteVariant($variant);
    }

    public function deleteProductImage(int|string $id): void
    {
        $image = $this->products->findImageByIdOrFail($id);
        Storage::delete('public/products/' . $image->file_name);
        $this->products->deleteImage($image);
    }

    public function removeLastVariant(int|string $productId): void
    {
        $variant = $this->products->getProductVariants($productId)->last();

        if ($variant) {
            $this->products->deleteVariant($variant);
        }
    }

    public function create(array $payload): Product
    {
        return DB::transaction(function () use ($payload) {
            $product = $this->products->createProduct($this->mapProductData($payload, false));

            $this->products->createTag([
                'tag_name' => $payload['tags'],
                'product_id' => $product->id,
            ]);

            $this->syncVariants($product->id, $payload['has_variants'], $payload['prices'] ?? [], $payload['quantities'] ?? [], $payload['attributeValues'] ?? []);
            $this->storeImages($product->id, $payload['images'] ?? []);

            return $product;
        });
    }

    public function update(Product $product, array $payload): Product
    {
        return DB::transaction(function () use ($product, $payload) {
            $this->products->updateProduct($product, $this->mapProductData($payload, true));

            $tag = $this->products->getProductTag($product->id);
            if ($tag) {
                $tag->update(['tag_name' => $payload['tags']]);
            } else {
                $this->products->createTag([
                    'tag_name' => $payload['tags'],
                    'product_id' => $product->id,
                ]);
            }

            $this->syncVariants($product->id, $payload['has_variants'], $payload['prices'] ?? [], $payload['quantities'] ?? [], $payload['attributeValues'] ?? []);
            $this->storeImages($product->id, $payload['images'] ?? []);

            return $product->fresh(['product_variants.product_attributes', 'productImages', 'tags']);
        });
    }

    private function mapProductData(array $payload, bool $isUpdate): array
    {
        return [
            'name' => [
                'ar' => $payload['name_ar'],
                'en' => $payload['name_en'],
            ],
            'brand_id' => $payload['brand_id'] ?: null,
            'category_id' => $payload['category_id'],
            'small_desc' => [
                'ar' => $payload['small_desc_ar'],
                'en' => $payload['small_desc_en'],
            ],
            'desc' => [
                'ar' => $payload['desc_ar'],
                'en' => $payload['desc_en'],
            ],
            'sku' => $payload['sku'],
            'available_for' => $payload['available_for'],
            'has_variants' => (int) $payload['has_variants'],
            'price' => (int) $payload['has_variants'] === 1 ? null : ($payload['price'] ?? null),
            'has_discount' => (int) $payload['has_discount'],
            'discount' => (int) $payload['has_discount'] === 0 ? null : ($payload['discount'] ?? null),
            'start_discount_date' => (int) $payload['has_discount'] === 0 ? null : ($payload['start_discount'] ?? null),
            'end_discount_date' => (int) $payload['has_discount'] === 0 ? null : ($payload['end_discount'] ?? null),
            'manage_stock' => (int) $payload['manage_stock'],
            'quantity' => (int) $payload['manage_stock'] === 0 ? null : ($payload['quantity'] ?? null),
        ];
    }

    private function syncVariants(int $productId, int|string $hasVariants, array $prices, array $quantities, array $attributeValues): void
    {
        $existingVariants = $this->products->getProductVariants($productId)->values();

        if ((int) $hasVariants !== 1) {
            foreach ($existingVariants as $variant) {
                $this->products->deleteVariant($variant);
            }

            return;
        }

        foreach ($prices as $index => $price) {
            $variant = $existingVariants->get($index);

            if ($variant) {
                $variant->update([
                    'price' => $price,
                    'stock' => $quantities[$index] ?? 0,
                ]);
            } else {
                $variant = $this->products->createVariant([
                    'product_id' => $productId,
                    'price' => $price,
                    'stock' => $quantities[$index] ?? 0,
                ]);
            }

            $newAttributes = array_values($attributeValues[$index] ?? []);
            $this->products->deleteMissingVariantAttributes($variant->id, $newAttributes ?: [0]);

            foreach ($newAttributes as $attributeValueId) {
                $this->products->updateOrCreateVariantAttribute([
                    'product_variant_id' => $variant->id,
                    'attribute_value_id' => $attributeValueId,
                ]);
            }
        }

        if ($existingVariants->count() > count($prices)) {
            foreach ($existingVariants->slice(count($prices)) as $variant) {
                $this->products->deleteVariant($variant);
            }
        }
    }

    private function storeImages(int $productId, array $images): void
    {
        foreach ($images as $image) {
            if (!$image instanceof UploadedFile) {
                continue;
            }

            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('products', $imageName, 'public');

            $this->products->createImage([
                'product_id' => $productId,
                'file_name' => $imageName,
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType(),
            ]);
        }
    }
}
