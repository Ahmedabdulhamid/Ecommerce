<?php

namespace App\Livewire\Admin\Attributes;

use App\Livewire\SideBar;
use App\Models\Attribute;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DeleteData extends Component
{
   public $attr;
    protected $listeners=['deleteAttr'];
    public function deleteAttr($id){
        $this->attr = Attribute::find($id); // استرجاع السجل مباشرةً


    }
    public function submit(){
        $this->attr->delete();
        $this->dispatch('deleteModalHide');
        $this->dispatch('refreshDatatable');
        $this->dispatch('refreshData')->to(SideBar::class);
    }
    public function render()
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
        return view('livewire.admin.attributes.delete-data');
    }
}
