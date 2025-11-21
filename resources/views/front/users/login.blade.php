@section('title',__('admin.login_page'))
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

<body @if (app()->getLocale() == 'ar') dir="rtl" @endif>

    @include('front.layouts.header')
    <div
        style="
        margin: 0;
        padding: 0;
        background-image: url('{{ asset('front-assets/images/homepage-one/login-bg.webp') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 150vh;
        width: 100vw;
    ">
        <form class="login footer-padding " method="post" action="{{ route('login') }}">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            @csrf
            <div class="container ">
                <div class="login-section ">
                    <div class="review-form">
                        <h5 class="text-center">{{__('front.login')}}</h5>
                        <div class="review-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">{{__('front.email')}}*</label>
                                <input type="email" id="email" class="form-control" placeholder="{{__('front.email')}}"
                                    :value="old('email')" name="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">{{__('front.password')}}*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{__('front.password')}}" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>
                            <div class="g-recaptcha " data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
                            @error('g-recaptcha-response')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="review-form-name checkbox" style="direction: ltr;">
                                <div class="checkbox-item">
                                    <input type="checkbox" name="remember" />
                                    <span class="address"> {{__('front.remember_me')}}?</span>
                                </div>
                                <a href='{{ route('password.request') }}' class="forget-pass">
                                    <p>{{__('front.fogot_password')}}</p>
                                </a >
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button class="shop-btn">{{__('front.login')}}</button>
                            <span class="shop-account">{{__('front.dont_have_accout')}}<a href="{{ route('register') }}">{{__('front.sing_up_free')}}</a></span>
                        </div>

                        <div class="my-3">
                            <p class="fs-4 text-center">{{__('front.or')}}</p>
                        </div>

                        <div class="mb-5 ">
                            <a href="{{ route('google.auth') }}"
                                class="btn d-flex align-items-center shadow-lg p-3 mb-5 bg-body-tertiary rounded"
                                style="background-color: white;">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                    width="24" height="24" class="me-2">
                                <span class="text-dark">{{__('front.login_with_google')}}</span>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </form>

    @include('front.layouts.footer')

    @include('front.layouts.script')
    </div>



</body>

</html>
