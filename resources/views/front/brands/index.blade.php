@section('title',__('admin.brands_page'))
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
                @if ($allBrands && count($allBrands) > 0)
                    @foreach ($allBrands as $brand)
                        <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                            <div class="wrapper-img">
                                @if (filter_var($brand->logo, FILTER_VALIDATE_URL))
                                    <img src="{{ $brand->logo }}"
                                        alt="{{ $brand->getTranslation('name', app()->getLocale()) }}"class="w-25">
                                @else
                                    <img src="{{ asset('storage/logo/' . $brand->logo) }}"
                                        alt="{{ $brand->getTranslation('name', app()->getLocale()) }}"class="w-25">
                                @endif
                            </div>

                            <div class="wrapper-info">
                                <a href="{{route('getProductsByBrand',$brand->slug)}}"
                                    class="wrapper-details">{{ $brand->getTranslation('name', app()->getLocale()) }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <strong class="text-center fw-bold">No Brands Found</strong>
                @endif


            </div>
        </div>
    </section>
    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
