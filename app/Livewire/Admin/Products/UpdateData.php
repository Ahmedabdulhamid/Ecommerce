<?php

namespace App\Livewire\Admin\Products;

use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateData extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $product;
    public $images2 = [];
    public $price;
    public $categories;
    public $brands;
    public $images;
    public $tags;
    public $discount;
    public $start_discount;
    public $end_discount;
    public $available_for;
    public $sku;
    public $quantity;
    public $productAttributes;
    public $name_ar;
    public $name_en;
    public $desc_en;
    public $desc_ar;
    public $small_desc_en;
    public $small_desc_ar;
    public $category_id;
    public $brand_id;
    public $hasVar = 0;
    public $manage_stock = 0;
    public $has_discount = 0;
    public $prices = [];
    public $quantities = [];
    public $attributeValues = [];
    public $valueRowCount = 0;

    public function mount($product, $brands, $categories, $attributes)
    {
        $this->product = $product;
        $this->productAttributes = $attributes;
        $this->categories = $categories;
        $this->brands = $brands;

        if ($this->product->has_variants == 0) {
            $this->price = $this->product->price;
        }

        $this->name_ar = $this->product->getTranslation('name', 'ar');
        $this->name_en = $this->product->getTranslation('name', 'en');
        $this->desc_ar = $this->product->getTranslation('desc', 'ar');
        $this->desc_en = $this->product->getTranslation('desc', 'en');
        $this->small_desc_en = $this->product->getTranslation('small_desc', 'en');
        $this->small_desc_ar = $this->product->getTranslation('small_desc', 'ar');
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->hasVar = $this->product->has_variants;
        $this->manage_stock = $this->product->manage_stock;
        $this->valueRowCount = count($this->product->product_variants);

        if ($this->product->manage_stock) {
            $this->quantity = $this->product->quantity;
        }

        $this->available_for = $this->product->available_for;

        if ($this->product->has_variants) {
            foreach ($this->product->product_variants as $index => $variant) {
                $this->prices[$index] = $variant->price;
                $this->quantities[$index] = $variant->stock;

                foreach ($variant->product_attributes as $index2 => $attr) {
                    $this->attributeValues[$index][$this->productAttributes[$index2]->id] = $attr->attribute_value_id;
                }
            }
        }

        if ($this->product->has_discount) {
            $this->has_discount = $this->product->has_discount;
            $this->discount = $this->product->discount;
            $this->start_discount = $this->product->start_discount_date;
            $this->end_discount = $this->product->end_discount_date;
        }

        $this->sku = $this->product->sku;

        foreach ($this->product->tags as $tag) {
            $this->tags = $tag->tag_name;
        }

        $this->images = $this->product->productImages;
    }

    public function updatedHasVar()
    {
        $this->prices = [];
    }

    public function secondStep()
    {
        $this->validate($this->basicInfoRules());
        $this->currentStep = 2;
    }

    public function thirdStep()
    {
        $this->validate($this->inventoryRules());

        if ((int) $this->hasVar === 1) {
            $this->manage_stock = 0;
        }

        $this->currentStep = 3;
    }

    public function fourthStep()
    {
        $this->validate($this->availabilityRules());
        $this->currentStep = 4;
    }

    public function fivthStep()
    {
        $this->validate($this->imagesRules());
        $this->currentStep = 5;
    }

    public function deleteImage($key, $id, ProductService $productService)
    {
        $productService->deleteProductImage($id);
        unset($this->images[$key]);
        $this->resetValidation();
    }

    public function deleteImage2($key)
    {
        unset($this->images2[$key]);
        $this->resetValidation();
    }

    public function back($key)
    {
        $this->currentStep = $key;
    }

    public function addNewVariant()
    {
        $this->prices[] = '';
        $this->quantities[] = '';
        $this->attributeValues[] = [];
        $this->valueRowCount = count($this->prices);
        $this->resetValidation();
    }

    public function removeVariant(ProductService $productService)
    {
        if ($this->product->has_variants) {
            $productService->removeLastVariant($this->product->id);
        }

        $this->valueRowCount--;
        array_pop($this->prices);
        array_pop($this->quantities);
        array_pop($this->attributeValues);
    }

    public function submit(ProductService $productService)
    {
        $this->product = $productService->update($this->product, [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en,
            'small_desc_ar' => $this->small_desc_ar,
            'small_desc_en' => $this->small_desc_en,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'available_for' => $this->available_for,
            'has_variants' => $this->hasVar,
            'price' => $this->price,
            'has_discount' => $this->has_discount,
            'discount' => $this->discount,
            'start_discount' => $this->start_discount,
            'end_discount' => $this->end_discount,
            'manage_stock' => $this->manage_stock,
            'quantity' => $this->quantity,
            'tags' => $this->tags,
            'prices' => $this->prices,
            'quantities' => $this->quantities,
            'attributeValues' => $this->attributeValues,
            'images' => $this->images2 ?? [],
        ]);

        $this->currentStep = 1;
        session()->flash('success', 'The Product updated Successfully');
    }

    private function basicInfoRules(): array
    {
        return [
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'desc_ar' => ['required', 'string'],
            'desc_en' => ['required', 'string'],
            'small_desc_en' => ['required', 'string', 'max:600'],
            'small_desc_ar' => ['required', 'string', 'max:600'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
        ];
    }

    private function inventoryRules(): array
    {
        $rules = [
            'hasVar' => ['required', 'in:0,1'],
            'sku' => ['required', 'string', 'max:30'],
            'tags' => ['required', 'string'],
        ];

        if ((int) $this->hasVar === 0) {
            $rules['price'] = ['required', 'numeric', 'min:1'];
        }

        if ((int) $this->hasVar === 1) {
            $rules['prices'] = ['required', 'array', 'min:1'];
            $rules['prices.*'] = ['required', 'numeric'];
            $rules['quantities'] = ['required', 'array', 'min:1'];
            $rules['quantities.*'] = ['required', 'numeric'];
            $rules['attributeValues'] = ['required', 'array', 'min:1'];
            $rules['attributeValues.*'] = ['required', 'array', 'min:1'];
            $rules['attributeValues.*.*'] = ['required', 'numeric', 'exists:attribute_values,id'];
        }

        if ((int) $this->manage_stock === 1 && (int) $this->hasVar === 0) {
            $rules['quantity'] = ['required', 'numeric', 'min:1'];
        }

        return $rules;
    }

    private function availabilityRules(): array
    {
        $rules = [
            'available_for' => ['required', 'date'],
        ];

        if ((int) $this->has_discount === 1) {
            $rules['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $rules['start_discount'] = ['required_if:has_discount,1', 'date', 'before:end_discount'];
            $rules['end_discount'] = ['required_if:has_discount,1', 'date', 'after:start_discount'];
        }

        return $rules;
    }

    private function imagesRules(): array
    {
        return [
            'images2' => ['nullable', 'array'],
            'images2.*' => ['nullable', 'image', 'mimes:png,jpg,webp,svg'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.products.update-data');
    }
}
