<?php

namespace App\Livewire\Admin\Products;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\productAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateData extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $product;
    public  $images2 = [];
    public $price;
    public $categories;
    public $brands;
    public $images, $tags, $discount, $start_discount, $end_discount, $available_for, $sku, $quantity;
    public $productAttributes;
    public $name_ar, $name_en, $desc_en, $desc_ar, $small_desc_en, $small_desc_ar, $category_id, $brand_id;

    public $hasVar = 0, $manage_stock = 0, $has_discount = 0, $prices=[], $quantities, $attributeValues = [];
    public $valueRowCount = 0;

    public function mount($product, $brands, $categories, $attributes)
    {

        $this->product = $product;
        //dd($this->product);
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
                    //dd($this->productAttributes[$index]);
                    $this->attributeValues[$index][$this->productAttributes[$index2]->id] = $attr->attribute_value_id;
                }
            }
        }

        if ($this->product->has_discount) {
            $this->has_discount = $this->product->has_discount;
            $this->discount = $this->product->discount;
            $this->start_discount = $this->product->start_discount_date;
            $this->end_discount = $this->product->end_discount_date;
            $this->available_for = $this->product->available_for;
        }
        $this->manage_stock = $this->product->manage_stock;
        $this->sku = $this->product->sku;
        foreach ($this->product->tags as $tag) {
            $this->tags = $tag->tag_name;
        }
        $this->images = $this->product->productImages;
    }
    public function updatedHasVar()
    {
        //dd($this->hasVar);
        $this->prices = [];
    }
    public function secondStep()
    {
        $this->validate([
            'name_en' => ['required', 'string', 'max:80'],
            'name_ar' => ['required', 'string', 'max:80'],
            'desc_ar' => ['required', 'string'],
            'desc_en' => ['required', 'string'],
            'small_desc_en' => ['required', 'string', 'max:600'],
            'small_desc_ar' => ['required', 'string', 'max:600'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id']
        ]);
        $this->currentStep = 2;
    }
    public function thirdStep()
    {


        $data = [
            'hasVar' => ['required', 'in:0,1'],
            'sku' => ['required', 'string', 'max:30'],
            'tags' => ['required', 'string']
        ];
        if ($this->hasVar == 0) {
            $data['price'] = ['required', 'numeric', 'min:1'];
        }
        if ($this->hasVar == 1) {

            $data['prices'] = ['required', 'array', 'min:1'];
            $data['prices.*'] = ['required', 'numeric'];
            $data['quantities'] = ['required', 'array', 'min:1'];
            $data['quantities.*'] = ['required', 'numeric'];
            $data['attributeValues'] = ['required', 'array', 'min:1'];
            $data['attributeValues.*'] = ['required', 'array', 'min:1'];
            $data['attributeValues.*.*'] = ['required', 'numeric', 'exists:attribute_values,id'];
            $this->manage_stock = 0;

        }
        if ($this->manage_stock == 1) {
            $this->hasVar == 0;
            $this->prices = [];
            $data['quantity'] = ['required', 'numeric', 'min:1'];
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
        /*
        if ($this->manage_stock == 1) {
            $data['quantity'] = ['required', 'numeric', 'min:1'];
        }*/
        $this->validate($data);

        $this->currentStep = 4;
    }
    public function fivthStep()
    {
        $this->validate([
            'images2' => ['nullable', 'array'],
            'images2.*' => ['nullable', 'image', 'mimes:png,jpg,webp,svg']
        ]);
        $this->currentStep = 5;
    }
    public function deleteImage($key, $id)
    {
        $image = ProductImage::where('id', $id)->first();
        Storage::delete('public/products/' . $image->file_name);
        $image->delete();
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
    public function removeVariant()
    {
        if ($this->product->has_variants) {
            $productvariant = ProductVariant::where('product_id', $this->product->id)->get();
            $productvariant->last()->delete();
        }
        $this->valueRowCount--;
        array_pop($this->prices);
        array_pop($this->quantities);
        array_pop($this->attributeValues);
    }
    public function submit()
    {
        $productsVar = ProductVariant::where('product_id', $this->product->id)->get();
        $tage = Tag::where('product_id', $this->product->id)->first();
        $images = ProductImage::where('product_id', $this->product->id)->get();
        $this->product->update([
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
            'has_variants' => $this->hasVar,
            'price' => $this->hasVar == 1 ? null : $this->price,
            'has_discount' => $this->has_discount,
            'discount' => $this->has_discount == 0 ? null : $this->discount,
            'start_discount_date' => $this->has_discount == 0 ? null : $this->start_discount,
            'end_discount_date' => $this->has_discount == 0 ? null : $this->end_discount,
            'manage_stock' => $this->manage_stock,
            'quantity' => $this->manage_stock == 0 ? null : $this->quantity,

        ]);
        if ($this->product->has_variants == 1) {
            foreach ($this->prices as $index => $price) {
                $variant = $productsVar->skip($index)->first(); // جلب المتغير الحالي إذا كان موجودًا

                if ($variant) {
                    // ✅ تحديث بيانات المتغير إذا كان موجودًا
                    $variant->update([
                        'price' => $price,
                        'stock' => $this->quantities[$index] ?? 0,
                    ]);
                } else {
                    // ✅ إنشاء متغير جديد إذا لم يكن موجودًا
                    $variant = ProductVariant::create([
                        'product_id' => $this->product->id,
                        'price' => $price,
                        'stock' => $this->quantities[$index] ?? 0,
                    ]);
                }

                // ✅ الحصول على جميع القيم القديمة لهذا المتغير
                $oldAttributes = ProductAttribute::where('product_variant_id', $variant->id)->pluck('attribute_value_id')->toArray();

                // ✅ القيم الجديدة التي يجب أن تكون في القاعدة
                $newAttributes = $this->attributeValues[$index] ?? [];

                // ✅ حذف القيم القديمة غير الموجودة في القيم الجديدة
                ProductAttribute::where('product_variant_id', $variant->id)
                    ->whereNotIn('attribute_value_id', $newAttributes)
                    ->delete();

                // ✅ تحديث أو إنشاء القيم الجديدة فقط
                foreach ($newAttributes as $attr) {
                    ProductAttribute::updateOrCreate(
                        [
                            'product_variant_id' => $variant->id,
                            'attribute_value_id' => $attr,
                        ],
                        []
                        // يمكنك إضافة أي تحديثات أخرى هنا

                    );
                }
            }
        }
        $tage->update([
            'tag_name' => $this->tags,
        ]);
        foreach ($this->images2 as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('products', $imageName, 'public');


            ProductImage::create([
                'product_id' => $this->product->id,
                'file_name' => $imageName,
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType()
            ]);
        }
        $this->currentStep = 1;
        session()->flash('success', 'The Product updated Successfully');
    }
    public function render()
    {
        return view('livewire.admin.products.update-data');
    }
}
