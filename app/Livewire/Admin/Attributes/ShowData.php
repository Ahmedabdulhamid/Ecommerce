<?php

namespace App\Livewire\Admin\Attributes;

use App\Models\Attribute;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Livewire\Component;

class ShowData extends Component
{
    public $attribute;
    public $values=[];
    protected $listeners=['show'];
    public function show($id){
      $this->attribute=Attribute::where('id',$id)->with('attr_values')->first();
      $this->values=$this->attribute->attr_values->pluck('value')->toArray();


    }
    public function render()
    {
         if (!FacadesGate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
        return view('livewire.admin.attributes.show-data');
    }
}
