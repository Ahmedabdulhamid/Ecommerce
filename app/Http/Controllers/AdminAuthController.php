<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index(){
        return view('dashboard.auth.login');
    }
    public function login(AdminAuthRequest $request){
      $data=$request->validated();
      $credentials=Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]);
      if ($credentials) {
        return redirect()->intended('/admin');
      }
      return redirect()->back()->withErrors(['email',"Invalid credentials"]);
    }
}
