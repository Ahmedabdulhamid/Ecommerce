<?php

namespace App\Livewire\Admin\Attributes;

use App\Http\Requests\AttributeRequest;
use App\Livewire\SideBar;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class CreateData extends Component
{
    public $name = ['ar' => '', 'en' => ''];
    public $value = [];
    public function rules()
    {
        return (new AttributeRequest())->rules();
    }
    public function addField()
    {
        $this->value[] = ''; // إضافة إدخال جديد
    }

    public function removeField($index)
    {
        unset($this->value[$index]); // حذف الإدخال المطلوب
        $this->value = array_values($this->value);
    }
    public function submit()
    {

        $data = $this->validate();
        $attr = Attribute::create([
            'name' => [
                'en' => $data['name']['en'],
                'ar' => $data['name']['ar']
            ]
        ]);
        foreach ($this->value as $val) {
            AttributeValue::create([
                'value' => $val,
                'attr_id' => $attr->id
            ]);
        }
        $this->reset();
        $this->resetValidation();

        $this->dispatch('createModalHide');
        $this->dispatch('refreshDatatable');
        $this->dispatch('refreshData')->to('side-bar');

    }
    public function render()
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
        return view('livewire.admin.attributes.create-data');
    }
}
