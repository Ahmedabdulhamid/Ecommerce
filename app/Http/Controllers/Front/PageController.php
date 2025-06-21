<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function gotToPage( $page){
       $page=Page::where('slug',$page)->firstOrFail();

        return view('front.pages.page',['page'=>$page]);
    }
}
