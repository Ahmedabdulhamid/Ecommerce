<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')
    <div class="my-5">
        <h1 class="text-center">{{ $page->getTranslation('title', app()->getLocale()) }}</h1>
        <div class="row container my-5 mb-5">
            @if ($page->image !== null)
                <div class="col-lg-6 col-md-d-col-sm-12">
                    <img src="{{ asset('storage/pages/' . $page->image) }}" alt="{{ $page->title }}" srcset=""
                        class="w-75">
                </div>
                <div class="col-lg-6 col-md-d-col-sm-12">
                    {!! $page->getTranslation('content', app()->getLocale()) !!}
                </div>
            @else
                <div class="col-12 container">
                    <div class="w-100 me-3">
                        {!! $page->getTranslation('content', app()->getLocale()) !!}
                    </div>
                </div>
            @endif
        </div>

    </div>


    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
