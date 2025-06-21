<?php

namespace App\Livewire\Admin\Attributes;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Attribute;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class GetData extends Component
{


    public function getData()
    {

        $attributes = Attribute::query();
        return DataTables::of($attributes)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty('search.value')) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('name->en', 'like', '%' . $search . '%')->orWhere('name->ar', 'like', '%' . $search . '%');

                });
            }
        })->addColumn('name', function ($attribute) {
            return $attribute->getTranslation('name', app()->getLocale());
        })->addColumn('actions', function ($attribute) {
            return view('dashboard.attributes.actions', ['attribute' => $attribute]);
        })->make(true);

    }
    public function render()
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
        return view('livewire.admin.attributes.get-data');
    }

}
