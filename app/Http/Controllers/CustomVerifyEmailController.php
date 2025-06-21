<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomVerifyEmailController extends Controller
{
  public function verifyEmail(){
    $user=User::findOrFail(request('id'));
    $user->update(['email_verified_at'=>now()]);
    return to_route('login')->with('message', 'You Verified Email Successfully');


  }
}
