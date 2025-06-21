<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponController extends Controller
{

    public function store(CouponRequest $request){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
      $data=$request->validated();

     $coupon= Coupon::create($data);
      if ($coupon) {
        return response()->json(['message'=>__('coupons.create_coupon_message'),'count'=>Coupon::count()]);
      }

    }
    public function edit(CouponUpdateRequest $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }

            $data = $request->validated();
            $coupon=Coupon::where('code',$request->code)->first();
           $check= $coupon->update($data);
           if ($check) {
            return response()->json(['message'=>__('coupons.update_coupon_message')]);
           }


    }
    public function destroy(){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','product-manager'])) {
            abort(403);
        }
         $data= request('id');

        $coupon=Coupon::where('id',request('id'))->first();

       $coupon->delete();

       return response()->json(['message'=>__('coupons.delete_coupon_message'),'count'=>Coupon::count()]);

    }

}
