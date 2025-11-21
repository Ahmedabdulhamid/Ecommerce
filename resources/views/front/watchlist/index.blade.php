@section('title',__('front.whishlist_page'))
<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">

    @include('front.layouts.header')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('home') }}">{{__('front.home')}}</a></span>
                <span class="devider">/</span>
                <span><a href="{{ url()->current() }}">{{__('front.whishlist')}}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{__('front.whishlist')}}</h1>
            </div>
        </div>
    </section>

    @livewire('front.watchlist',['products'=>$products,'watchlist'=>$watchlist])



    @include('front.layouts.footer')


    @include('front.layouts.script')

</body>

</html>
