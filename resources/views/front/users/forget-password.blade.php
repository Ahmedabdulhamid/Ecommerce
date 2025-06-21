<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')>

<body style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9));@if(app()->getLocale()=='ar')
direction:rtl;
@endif">
    @include('front.layouts.header')
    <form class="login footer-padding " method="post" action="{{route('password.email')}}"style="direction: ltr;">
        @csrf
        <div class="container ">
            <div class="row d-flex justify-content-center my-5">
                <div class="col-lg-6 col-md-6 col-12 h-100">
                    <div class="card py-5 container "style="height:300px;">
                        <div class="card-title">
                           <h4> Forgot Password</h4>
                        </div>
                        <div class="mt-5">
                            <label for="">Email *</label>
                            <input type="text"  class="form-control" style="height: 40px" placeholder="Enter Your Email" name="email" :value="old('email')">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>
                        <div class="login-btn text-center">
                            <button class="shop-btn">Submit</button>

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
