<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')>

<body style="@if(app()->getLocale()=='ar')
direction:rtl;
@endif">
    @include('front.layouts.header')
<div class="container my-5 d-flex justify-content-center w-100">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="form-section">
                <form action="{{route('password.confirm.store')}}" method="POST">

                    @csrf
                    <div class="currentpass form-item">
                        <label for="currentpass" class="form-label">Current Password*</label>
                        <input type="password" class="form-control my-1" id="currentpass" placeholder="******" style="height:40px"name="current_password">
                        @error('current_password')
                           <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="password form-item">
                        <label for="pass" class="form-label">Password*</label>
                        <input type="password" class="form-control my-1" id="pass" placeholder="******"style="height:40px"name='new_password'>
                        @error('new_password')
                        <span class="text-danger">{{$message}}</span>
                     @enderror
                    </div>
                    <div class="re-password form-item">
                        <label for="repass" class="form-label">Re-enter Password*</label>
                        <input type="password" class="form-control my-1" id="repass" placeholder="******"style="height:40px" name='new_password_confirmation'>
                        @error('new_password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                     @enderror
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="shop-btn">Upldate Password</button>
                        <button type='reset' class="shop-btn cancel-btn">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>


    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
