<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WatchList;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function index(){
        if (auth()->check()) {
           $watchlist=WatchList::where('user_id',auth()->user()->id)->with('products.images')->first();
           if (isset($watchlist->products) && count($watchlist->products)>0) {
              $products=$watchlist->products()->limit(4)->get();

           }else{
              $products=[];
           }


           return view('front.watchlist.index',['products'=>$products,'watchlist'=>$watchlist]);
        }else{
            return to_route('login');
        }



    }
    public function store(Product $product){
       if (auth()->check()) {
            $watchList = WatchList::firstOrCreate([
                'user_id' => auth()->id(),
            ]);

            // تحقق إذا كان المنتج موجود بالفعل
            if ($watchList->products()->where('product_id', $product->id)->exists()) {
                return response()->json(['status'=>409,'message'=>"Already Exists"]); // حدث JS يخبر أن المنتج موجود
            } else {
                $watchList->products()->syncWithoutDetaching($product->id); // أضف المنتج
                return response()->json(['status'=>201,'message'=>"Added Successfully!",'productCount'=>count($watchList->products)]); // أرسل رسالة النجاح

            }
        } else {
           return response()->json(['status'=>401,'message'=>"You Should Login First"]);
        }
    }
}
