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

    <div class="app-content content">

       @livewire('admin.attributes.get-data')


    </div>


    @include('dashboard.partials.footer')
    @include('dashboard.partials.scripts')
    @include('dashboard.attributes.scripts')


</body>

</html>
