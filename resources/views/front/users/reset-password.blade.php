@section('title',__('admin.reset_password_page'))
@section()
<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')>

<body style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9));@if(app()->getLocale()=='ar')
direction:rtl;
@endif">
    @include('front.layouts.header')
    <form class="login footer-padding " method="post" action="{{ route('password.store') }}"action="{{route('login')}}"style="direction: ltr;">
        @csrf
        <div class="container ">
            <div class="row d-flex justify-content-center my-5">
                <div class="col-lg-6 col-md-6 col-12 h-100">
                    <div class="card py-5 container "style="height:400px;">
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="card-title">
                           <h4> {{__('front.reset_pass_msg')}}</h4>
                        </div>
                        <div class="mt-5">
                            <label for="">  {{__('admin.email')}} *</label>
                            <input type="text"  class="form-control" style="height: 40px" name="email" :value="old('email', $request->email)">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                        </div>
                        <div class="mt-5">
                            <label for="">  {{__('admin.password')}} *</label>
                            <input type="password"  class="form-control" style="height: 40px"  name="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />>

                        </div>
                        <div class="mt-5">
                            <label for="">{{__('admin.confirm_password')}} *</label>
                            <input type="password"  class="form-control" style="height: 40px"   name="password_confirmation">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />

                        </div>
                        <div class="login-btn text-center">
                            <button class="shop-btn">{{__('admin.submit')}}</button>

                          </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
