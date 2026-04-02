<?php

namespace App\Livewire\Admin\Products;

use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateData extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $successMessage = '';
    public $categories;
    public $brands;
    public $images;
    public $tags;
    public $discount;
    public $start_discount;
    public $end_discount;
    public $quantity;
    public $price;
    public $sku;
    public $name_ar;
    public $name_en;
    public $desc_en;
    public $desc_ar;
    public $small_desc_en;
    public $small_desc_ar;
    public $category_id;
    public $brand_id;
    public $has_variants = 0;
    public $manage_stock = 0;
    public $has_discount = 0;
    public $available_for;
    public $prices = [];
    public $quantities = [];
    public $attributeValues = [];
    public $valueRowCount = 1;
    public $fullscreenImage = '';

    public function mount($brands, $categories)
    {
        $this->brands = $brands;
        $this->categories = $categories;
    }

    public function addNewVariant()
    {
        $this->prices[] = '';
        $this->quantities[] = '';
        $this->attributeValues[] = [];
        $this->valueRowCount = count($this->prices);
        $this->resetValidation();
    }

    public function removeVariant()
    {
        $this->valueRowCount--;
        array_pop($this->prices);
        array_pop($this->quantities);
        array_pop($this->attributeValues);
    }

    public function secondStep()
    {
        $this->validate($this->basicInfoRules());
        $this->currentStep = 2;
    }

    public function thirdStep()
    {
        $this->validate($this->inventoryRules());

        if ((int) $this->has_variants === 1) {
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

    public function deleteImage($key)
    {
        unset($this->images[$key]);
        $this->resetValidation();
    }

    public function back($key)
    {
        $this->currentStep = $key;
    }

    public function submit(ProductService $productService)
    {
        $productService->create([
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
            'has_variants' => $this->has_variants,
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
            'images' => $this->images ?? [],
        ]);

        $this->currentStep = 1;
        session()->flash('success', 'The Product create Successfully');
        $this->resetExcept(['brands', 'categories']);
        $this->dispatch('refreshData')->to('side-bar');
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
            'has_variants' => ['required', 'in:0,1'],
            'sku' => ['required', 'string', 'max:30'],
            'tags' => ['required', 'string'],
        ];

        if ((int) $this->has_variants === 0) {
            $rules['price'] = ['required', 'numeric', 'min:1'];
        }

        if ((int) $this->has_variants === 1) {
            $rules['prices'] = ['required', 'array', 'min:1'];
            $rules['prices.*'] = ['required', 'numeric'];
            $rules['quantities'] = ['required', 'array', 'min:1'];
            $rules['quantities.*'] = ['required', 'numeric'];
            $rules['attributeValues'] = ['required', 'array', 'min:1'];
            $rules['attributeValues.*'] = ['required', 'array', 'min:1'];
            $rules['attributeValues.*.*'] = ['required', 'numeric', 'exists:attribute_values,id'];
        }

        if ((int) $this->manage_stock === 1 && (int) $this->has_variants === 0) {
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
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:png,jpg,webp'],
        ];
    }

    public function render(ProductService $productService)
    {
        return view('livewire.admin.products.create-data', [
            'attributes' => $productService->getAttributesWithValues(),
        ]);
    }
}
