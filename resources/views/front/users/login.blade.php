<!DOCTYPE html>
<html lang="en">
<style>
    /* تصميم الزر الأساسي */
    .google-btn {
        display: inline-flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #dcdcdc;
        border-radius: 4px;
        padding: 8px 16px;
        text-decoration: none;
        transition: box-shadow 0.3s ease;
        font-family: Roboto, Arial, sans-serif;
    }

    /* تأثير hover عشان يظهر للمستخدم إن في تفاعل */
    .google-btn:hover {
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
    }

    /* لف المحيط اللي فيه أيقونة جوجل */
    .google-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border-radius: 50%;
        margin-right: 12px;
    }

    /* خصائص أيقونة جوجل */
    .google-icon {
        width: 18px;
        height: 18px;
    }

    /* نص الزر */
    .btn-text {
        font-size: 14px;
        color: #757575;
        font-weight: 500;
    }
</style>

@include('front.layouts.head')>

<body style=" @if(app()->getLocale()=='ar')
direction:rtl;
@endif">
    @include('front.layouts.header')

    <form class="login footer-padding " method="post" action="{{route('login')}}"style="direction: ltr;">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif

        @csrf
        <div class="container ">
          <div class="login-section ">
            <div class="review-form">
              <h5 class="text-center">Log In</h5>
              <div class="review-inner-form">
                <div class="review-form-name">
                  <label for="email" class="form-label">Email Address*</label>
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    placeholder="Email"
                    :value="old('email')"
                    name="email"
                  />
                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
                <div class="review-form-name">
                  <label for="password" class="form-label">Password*</label>
                  <input
                    type="password"
                            name="password"
                    id="password"
                    class="form-control"
                    placeholder="password"
                  />
                  <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>
                <div class="review-form-name checkbox" style="direction: ltr;">
                  <div class="checkbox-item">
                    <input type="checkbox" name="remember"/>
                    <span class="address"> Remember Me</span>
                  </div>
                  <a href='{{route("password.request")}}' class="forget-pass">
                    <p>Forgot password?</p>
                  </a href=''>
                </div>
              </div>
              <div class="login-btn text-center">
                <button class="shop-btn">Log In</button>
                <span class="shop-account"
                  >Dont't have an account ?<a href="{{route('register')}}"
                    >Sign Up Free</a
                  ></span
                >
              </div>
              <div class="my-3">
               <p class="fs-4 text-center">or</p>
              </div>
              <div class="mb-5 "style="direction:ltr;">
                <a href="{{ route('google.auth') }}" class="btn d-flex align-items-center shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="background-color: white;">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" width="24" height="24" class="me-2">
                    <span class="text-dark">Login with Google</span>
                </a>

              </div>

            </div>
          </div>
        </div>
    </form>

    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
