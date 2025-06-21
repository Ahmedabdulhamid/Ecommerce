<?php

namespace App\Livewire\Admin\Products;


use App\Models\Attribute;
use App\Models\Product;
use App\Models\productAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateData extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $successMessage = '';
    public $categories, $brands;
    public $images, $tags, $discount, $start_discount, $end_discount, $quantity, $price, $sku;
    public $name_ar, $name_en, $desc_en, $desc_ar, $small_desc_en, $small_desc_ar, $category_id;
    public $brand_id, $has_variants = 0, $manage_stock = 0, $has_discount = 0, $available_for;
    public $prices = [], $quantities = [], $attributeValues = [];
    public $valueRowCount = 1;
    public $fullscreenImage = '';

    public function mount($brands, $categories)
    {
        $this->brands = $brands;
        $this->categories = $categories;

    }
    public function addNewVariant()
    {
     $this->prices[]='';
     $this->quantities[]='';
     $this->attributeValues[]=[];
     $this->valueRowCount=count($this->prices);
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
        $this->validate([
            'name_en' => ['required', 'string', 'max:80'],
            'name_ar' => ['required', 'string', 'max:80'],
            'desc_ar' => ['required', 'string', 'max:1000'],
            'desc_en' => ['required', 'string', 'max:1000'],
            'small_desc_en' => ['required', 'string', 'max:600'],
            'small_desc_ar' => ['required', 'string', 'max:600'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id']
        ]);
        $this->currentStep = 2;
    }
    public function thirdStep()
    {
        $data = [
            'has_variants' => ['required', 'in:0,1'],
            'sku' => ['required', 'string', 'max:30'],
            'tags' => ['required', 'string']
        ];
        if ($this->has_variants == 0) {
            $data['price'] = ['required', 'numeric', 'min:1'];
        }
        if ($this->has_variants == 1) {
            $data['prices'] = ['required', 'array', 'min:1'];
            $data['prices.*'] = ['required', 'numeric'];
            $data['quantities'] = ['required', 'array', 'min:1'];
            $data['quantities.*'] = ['required', 'numeric'];
            $data['attributeValues'] = ['required', 'array', 'min:1'];
            $data['attributeValues.*'] = ['required', 'array', 'min:1'];
            $data['attributeValues.*.*'] = ['required', 'numeric', 'exists:attribute_values,id'];
            $this->manage_stock=0;
        }
        if ($this->manage_stock == 1 && $this->has_variants==0) {
            $data['quantity'] = ['required', 'numeric', 'min:1'];
            $this->has_variants=0;
        }
        $this->validate($data);
        $this->currentStep = 3;
    }
    public function fourthStep()
    {
        $data = [
            'available_for' => ['required', 'date']

        ];
        if ($this->has_discount == 1) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['required_if:has_discount,1', 'date', 'before:end_discount'];
            $data['end_discount'] = ['required_if:has_discount,1', 'date', 'after:start_discount'];

        }

        $this->validate($data);

        $this->currentStep = 4;
    }
    public function fivthStep()
    {
      $data['images']=['required','array','min:1'];
       $data['images.*']=['required','image','mimes:png,jpg,webp'];
       $this->validate($data);


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

    public function submit()
    {
        $product = Product::create([
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en
            ],
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'small_desc' => [
                'ar' => $this->small_desc_ar,
                'en' => $this->small_desc_en
            ],
            'desc' => [
                'ar' => $this->desc_ar,
                'en' => $this->desc_en
            ],
            'sku' => $this->sku,
            'available_for' => $this->available_for,
            'has_variants' => $this->has_variants,
            'price' => $this->has_variants == 1 ? null : $this->price,
            'has_discount' => $this->has_discount,
            'discount' => $this->has_discount == 0 ? null : $this->discount,
            'start_discount_date' => $this->has_discount == 0 ? null : $this->start_discount,
            'end_discount_date' => $this->has_discount == 0 ? null : $this->end_discount,
            'manage_stock' => $this->manage_stock,
            'quantity' => $this->manage_stock == 0 ? null : $this->quantity,

        ]);
        Tag::create([
            'tag_name' => $this->tags,
            'product_id' => $product->id
        ]);
        if ($this->has_variants == 1) {

            foreach ($this->prices as $index => $price) {

                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'price' => $price,
                   'stock'=>$this->quantities[$index]
                ]);
                foreach ($this->attributeValues[$index] as $attr) {
                    productAttribute::create([
                        'product_variant_id' => $variant->id,
                        'attribute_value_id' => $attr
                    ]);
                }
            }
        }
        foreach ($this->images as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('products', $imageName, 'public');


            ProductImage::create([
                'product_id' => $product->id,
                'file_name' => $imageName,
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType()
            ]);
        }
        $this->currentStep = 1;
        session()->flash('success', 'The Product create Successfully');
        $this->resetExcept(['brands', 'categories']);
        $this->dispatch('refreshData')->to('side-bar');
    }
    public function render()
    {
        $attributes = Attribute::with('attr_values')->get();

        return view('livewire.admin.products.create-data', ['attributes' => $attributes]);
    }

}
