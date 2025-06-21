<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')
<style>
    input:focus {
        box-shadow: none !important;
        border-color: transparent !important;
    }
</style>

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')


    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <form class="w-75" action="{{ route('orders.track') }}"method='POST'>
            @csrf
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name='email' style='height:40px;'>
                @error('email')
                    <span class="fw-bold text-danger fs-4">{{ $message }}</span>
                @enderror

            </div>
            <div class="mb-3">
                <label class="form-label">Order Number</label>
                <input type="text" class="form-control" name='order_number' style='height:40px;'>
                @error('order_number')
                    <span class="fw-bold text-danger fs-4">{{ $message }}</span>
                @enderror
            </div>

            <button class="shop-btn apply-coupon-btn mt-3"type='submit'>Track Order</button>
        </form>
    </div>

    @include('front.layouts.footer')
    @include('front.layouts.script')
</body>

</html>
