<?php

namespace App\Livewire\Admin\Attributes;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Livewire\Component;

class UpdateAttribute extends Component
{
   public $name=['en'=>'','ar'=>''];

   public $value = [];
   public $attribute;
   public $item=[];
   protected $listeners=['attrUpdate'];
   public function rules()
   {
       return [
        'name.*'=>['required','string'],
        'value.*'=>['required'],


       ];
   }
   public function addField()
   {
       $this->item[] = ''; // إضافة إدخال جديد
   }

   public function removeFieldValue($index,$id)
   {

       unset($this->value[$index]);
       $this->value = array_values($this->value);
      $attr_val= AttributeValue::where('id',$id)->first();
      $attr_val->delete();

   }
   public function removeFieldItem($index)
   {

      unset($this->item[$index]);

   }

   public function attrUpdate($id){
    $this->attribute = Attribute::with('attr_values')->findOrFail($id);

    $this->name['ar'] = $this->attribute->getTranslation('name', 'ar');
    $this->name['en'] = $this->attribute->getTranslation('name', 'en');

    // تحويل القيم إلى مصفوفة عادية
    $this->value = $this->attribute->attr_values->map(function ($attr) {
        return ['id' => $attr->id, 'value' => $attr->value];
    })->toArray();
}

public function submit(){
    $data = $this->validate();

    // تحديث الاسم في الجدول الأساسي
    $this->attribute->update(['name' => $data['name']]);



        foreach ($this->value as $index=> $val) {
                if (!empty($val['id'])) {

                    AttributeValue::where('id', $val['id'])->update(['value' => $val['value']]);

                }
        }
        foreach($this->item as $it){
            AttributeValue::create(
                [
                    'value'=>$it,
                    'attr_id'=> $this->attribute->id

                ]
                );
        }
        $this->dispatch('EditAttributeModal');
        $this->dispatch('refreshDatatable');



}

    public function render()
    {
        return view('livewire.admin.attributes.update-attribute');
    }
}
