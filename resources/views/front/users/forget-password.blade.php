@section('title',__('front.forget_password_page'))
<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')>

<body style="@if (app()->getLocale() == 'ar') direction:rtl; @endif">

    @include('front.layouts.header')
    <div style="
        margin: 0;
        padding: 0;
        background-image: url('{{ asset('front-assets/images/homepage-one/login-bg.webp') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100vw;">

        <form class="login footer-padding d-flex justify-content-center align-items-center" method="post"
            action="{{ route('password.email') }}">
            @csrf
            <div class="container ">
                <div class="row d-flex justify-content-center my-5">
                    <div class="col-lg-6 col-md-6 col-12 h-100">
                        <div class="card py-5 container "style="height:300px;">
                            <div class="card-title">
                                <h4> {{__('front.fogot_password')}}</h4>
                            </div>
                            <div class="mt-5">
                                <label for="">{{__('front.email')}} *</label>
                                <input type="text" class="form-control" style="height: 40px"
                                    placeholder="{{__('front.email')}}" name="email" :value="old('email')">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                            <div class="login-btn text-center">
                                <button class="shop-btn">{{__('admin.submit')}}</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>


    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
