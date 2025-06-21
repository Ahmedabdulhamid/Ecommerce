@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')

    <div class="app-content content mt-5">
        <div class="breadcrumb-wrapper col-12 my-5">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="#">Home</a>
                </li>

                <li class="breadcrumb-item active"><a href="#">Pages Tables</a></li>

            </ol>
        </div>
        <h1 class="text-center mt-5">{{ $page->getTranslation('title', app()->getLocale()) }}</h1>
       <div class="container ">
        {!!$page->getTranslation('content',app()->getLocale())!!}
       </div>



    </div>
    @include('dashboard.categories.partials.scribts')
</body>

</html>
