<?php

namespace App\Http\Controllers;

use App\Models\Countary;
use Illuminate\Http\Request;

class CountaryController extends Controller
{
    public function index(){
        $countaries=Countary::with("governorates")->paginate(10);


      return view('dashboard.countaries.countary',['countaries'=>$countaries]);
    }
    public function edit(Request $request){
          $countary=Countary::findOrFail($request->id);
          $countary->update([
            'status'=>$countary->status=="active"?"inactive":"active"
          ]);
          return response()->json(['message'=>"Your Status Edited "]);
    }
}
