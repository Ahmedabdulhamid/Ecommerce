<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Support\FrontCache;

class PageController extends Controller
{
    public function gotToPage($page)
    {
        return view('front.pages.page', [
            'page' => FrontCache::pageBySlug($page),
        ]);
    }
}
