<!doctype html>
<html lang="en">

<!-- Mirrored from quomodothemes.website/html/shopus/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Nov 2023 07:47:25 GMT -->
@include('front.layouts.head')

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">

    @include('front.layouts.header')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{route('home')}}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="{{url()->current()}}">Cart</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Cart</h1>
            </div>
        </div>
    </section>
    @livewire('front.cart-page',['cart'=>$cart])


    @include('front.layouts.footer')


    @include('front.layouts.script')
    @livewireScripts
</body>
