<?php

namespace App\Livewire;
use App\Models\Coupon;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Yajra\DataTables\Facades\DataTables;
class CouponGetData extends Component
{

    public function render()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
        return view('livewire.coupon-get-data');
    }
    public function getData()
    {
        $coupones = Coupon::query();
        return DataTables::of($coupones)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', '%' . $search . "%")->orWhere('start_at', 'like', '%' . $search . "%");
                });
            }
        })->addColumn('code', function ($coupon) {
            return $coupon->code;
        })->addColumn('discount_precentage', function ($coupon) {
            return $coupon->discount_precentage;
        })->addColumn('start_at', function ($coupon) {
            return $coupon->start_at;

        })->addColumn('end_at', function ($coupon) {
            return $coupon->end_at;
        })->addColumn('limit', function ($coupon) {
            return $coupon->limit;

        })->addColumn('status',function($coupon){
             return $coupon->status;
        })->addColumn('time_used', function ($coupon) {
            return $coupon->time_used;
        })->addColumn('actions',function($coupon){
            return view('dashboard.coupones.actions', ['coupon' => $coupon]);
        })->make(true);
    }
}
