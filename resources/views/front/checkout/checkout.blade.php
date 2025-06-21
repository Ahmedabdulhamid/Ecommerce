<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')
 <style>
     .apply-coupon-btn {
        width: 30% !important;
        border-radius: 50px !important;
    }
 </style>

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="index-2.html">Home</a></span>
                <span class="devider">/</span>
                <span><a href="#">Checkout</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Checkout</h1>
            </div>
        </div>
    </section>

    @livewire('checkout-page')



    @include('front.layouts.footer')


    @include('front.layouts.script')


</body>

</html>
