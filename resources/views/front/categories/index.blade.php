<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')
<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')

    <section class="product-category my-5">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.our_categories') }}</h5>

            </div>
            <div class="category-section my-5">
                @if ($allCategories && count($allCategories) > 0)
                    @foreach ($allCategories as $category)
                        <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">


                            <div class="wrapper-info">
                                <a href="{{route('getProductsByCategories',$category->slug)}}"
                                    class="wrapper-details">{{ $category->getTranslation('name', app()->getLocale()) }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <strong class="text-center fw-bold">No Categories Found</strong>
                @endif


            </div>
        </div>
    </section>
    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
