<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminAuthRequest;
use App\Http\Requests\RestRequest;
use App\Models\Admin;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\VerifyEmailRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class AdminAuthController extends Controller
{
    public function index(){
        return view('dashboard.auth.login');
    }
    public function recover_password(){
      return view('dashboard.auth.recover-password');
    }

    public function login(AdminAuthRequest $request){
      $data=$request->validated();
      $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'response' => $request->input('g-recaptcha-response'),
    ]);

    if (!$response->json()['success']) {
        return back()->withErrors(['captcha' => 'ReCAPTCHA validation failed.']);
    }
      $credentials=Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']],true);

      if ($credentials) {
        return redirect()->intended('/admin');
      }
      return var_dump($credentials);
    }

    public function post_recover_password(VerifyEmailRequest $request){
     $request->validated();
       $admin = Admin::where('email',$request->input('email'))->first();

    if ($admin) {
      $admin->generateOTP();

      $admin->notify(new ResetPasswordNotification($admin->otp));


      return redirect()->route('admin.recover-password')->with('msg','Verification code sent to your email');
  }



    }
    public function reset_password ($token){
      $admin = Admin::where('otp',$token)->first();
      if ($admin) {
        if (now()<$admin->otp_expire_at) {
          return view('dashboard.auth.reset_password',['token'=>$token]);
        }else{
         return to_route('admin.recover-password')->with('expire-message',ucfirst(' your link is expired please resend again'));
        }
      }else{
        return to_route('admin.recover-password')->with('invalid-token',ucfirst('Invalid Link'));
      }
     }
   public function update_password(Request $request){
    $request->validate([
      'password'=>'required|confirmed|min:8',
      'password_confirmation'=>"required",
      'token'=>"required"

    ]);
    $admin=Admin::where('otp',$request->token)->firstOrFail();
    if ($admin) {
     $update= $admin->update([
        'password'=>Hash::make($request->password)
     ]);
      if ($update){
        return  to_route('login.get');
      }

    }
   }
    public function logout(){

      $admin=Admin::find(1);

      Auth::guard('admin')->logout();
      return redirect()->intended('/admin/login');
    }
}
