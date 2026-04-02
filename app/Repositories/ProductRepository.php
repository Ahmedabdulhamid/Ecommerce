<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\productAttribute;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function dataTableQuery(): Builder
    {
        return Product::query()->with('category', 'brand', 'product_variants', 'productImages', 'tags');
    }

    public function count(): int
    {
        return Product::count();
    }

    public function getAllCategories(): Collection
    {
        return Category::get();
    }

    public function getAllBrands(): Collection
    {
        return Brand::get();
    }

    public function getAttributesWithValues(): Collection
    {
        return Attribute::with('attr_values')->get();
    }

    public function findByIdOrFail(int|string $id): Product
    {
        return Product::findOrFail($id);
    }

    public function findForShow(int|string $id): Product
    {
        return Product::where('id', $id)
            ->with('category', 'brand', 'product_variants', 'productImages', 'tags')
            ->firstOrFail();
    }

    public function findForEdit(int|string $id): Product
    {
        return Product::where('id', $id)
            ->with('category', 'brand', 'product_variants.product_attributes', 'productImages', 'tags')
            ->firstOrFail();
    }

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function deleteProduct(Product $product): ?bool
    {
        return $product->delete();
    }

    public function createTag(array $data): Tag
    {
        return Tag::create($data);
    }

    public function getProductTag(int|string $productId): ?Tag
    {
        return Tag::where('product_id', $productId)->first();
    }

    public function createVariant(array $data): ProductVariant
    {
        return ProductVariant::create($data);
    }

    public function getProductVariants(int|string $productId): Collection
    {
        return ProductVariant::where('product_id', $productId)->get();
    }

    public function findVariantByIdOrFail(int|string $id): ProductVariant
    {
        return ProductVariant::findOrFail($id);
    }

    public function deleteVariant(ProductVariant $variant): ?bool
    {
        return $variant->delete();
    }

    public function createVariantAttribute(array $data): productAttribute
    {
        return productAttribute::create($data);
    }

    public function getVariantAttributeIds(int|string $variantId): array
    {
        return productAttribute::where('product_variant_id', $variantId)
            ->pluck('attribute_value_id')
            ->toArray();
    }

    public function deleteMissingVariantAttributes(int|string $variantId, array $attributeIds): int
    {
        return productAttribute::where('product_variant_id', $variantId)
            ->whereNotIn('attribute_value_id', $attributeIds)
            ->delete();
    }

    public function updateOrCreateVariantAttribute(array $keys, array $values = []): productAttribute
    {
        return productAttribute::updateOrCreate($keys, $values);
    }

    public function createImage(array $data): ProductImage
    {
        return ProductImage::create($data);
    }

    public function findImageByIdOrFail(int|string $id): ProductImage
    {
        return ProductImage::findOrFail($id);
    }

    public function deleteImage(ProductImage $image): ?bool
    {
        return $image->delete();
    }
}
