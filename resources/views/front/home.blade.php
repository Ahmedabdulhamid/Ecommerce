@section('title',__('admin.home'))
<!doctype html>
<html lang="en">

<!-- Mirrored from quomodothemes.website/html/shopus/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Nov 2023 07:47:25 GMT -->
@include('front.layouts.head')

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @php
        $locale = app()->getLocale();
        $fallbackLocale = config('app.fallback_locale');
        $translateValue = function ($value) use ($locale, $fallbackLocale) {
            if (is_array($value)) {
                return $value[$locale] ?? $value[$fallbackLocale] ?? reset($value) ?? '';
            }

            if (is_string($value)) {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return $decoded[$locale] ?? $decoded[$fallbackLocale] ?? reset($decoded) ?? '';
                }
            }

            return $value ?? '';
        };
        $productImage = fn($product) => data_get($product, 'image_file_name')
            ?? optional(data_get($product, 'images')?->first())->file_name;
        $productBrandName = function ($product) use ($translateValue, $locale) {
            $brandName = data_get($product, 'brand_name');
            if ($brandName) {
                return $translateValue($brandName);
            }

            $brand = data_get($product, 'brand');

            return $brand ? $brand->getTranslation('name', $locale) : null;
        };
        $productCategoryName = function ($product) use ($translateValue, $locale) {
            $categoryName = data_get($product, 'category_name');
            if ($categoryName) {
                return $translateValue($categoryName);
            }

            $category = data_get($product, 'category');

            return $category ? $category->getTranslation('name', $locale) : null;
        };
        $productCategorySlug = fn($product) => data_get($product, 'category_slug') ?? data_get($product, 'category.slug');
        $productName = fn($product) => $translateValue(data_get($product, 'name'));
    @endphp

    @include('front.layouts.header')

    @include('front.layouts.hero')

    {{-- Slider Section --}}
    <section class="product fashion-style">
        <div class="container">
            <div class="style-section">
                <div class="row gy-4 gx-5 gy-lg-0">
                    <div class="col-lg-6">
                        <div class="product-wrapper wrapper-one" data-aos="fade-right"style="background-image:url({{asset('front-assets/images/homepage-one/syle-bg-one.webp')}});direction:ltr ">
                            <div class="wrapper-info">
                                <span class="wrapper-subtitle">{{__('front.new_style')}}</span>
                                <h4 class="wrapper-details">{{__('front.offer')}}
                                    <span class="wrapper-inner-title">& {{__('front.fusion')}}.</span>
                                </h4>
                                <a href="{{route('shop.index')}}" class="shop-btn">{{__('front.shop_now')}}
                                    <span>
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1.45312" y="0.914062" width="9.25346" height="2.05632"
                                                transform="rotate(45 1.45312 0.914062)" />
                                            <rect x="8" y="7.45703" width="9.25346" height="2.05632"
                                                transform="rotate(135 8 7.45703)" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-wrapper wrapper-two" data-aos="fade-up" style="background-image:url({{asset('front-assets/images/homepage-one/style-bg-two.webp')}});direction:ltr ">
                            <div class="wrapper-info">
                                <span class="wrapper-subtitle">{{__('front.mega_offer')}}</span>
                                <h4 class="wrapper-details">
                                    {{__('front.sentence')}}
                                </h4>
                                <a href="{{route('shop.index')}}" class="shop-btn">{{__('front.shop_now')}}
                                    <span>
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1.45312" y="0.914062" width="9.25346" height="2.05632"
                                                transform="rotate(45 1.45312 0.914062)" />
                                            <rect x="8" y="7.45703" width="9.25346" height="2.05632"
                                                transform="rotate(135 8 7.45703)" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Slider Section End --}}

    {{-- Categories --}}
    <section class="product-category">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.our_categories') }}</h5>
                <a href="{{ route('allcategories') }}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="category-section">
                @if ($categories && count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">

                            <div class="wrapper-info">
                                <a href="{{ route('getProductsByCategories', $category->slug) }}"
                                    class="wrapper-details">{{ $translateValue($category->name ?? null) }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <strong class="text-center fw-bold">No Categories Found</strong>
                @endif


            </div>
        </div>
    </section>
    {{-- Categories End --}}

    <section class="product-category">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.our_brands') }}</h5>
                <a href="{{ route('allBrands') }}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="category-section">
                @if ($brands && count($brands) > 0)
                    @foreach ($brands as $brand)
                        <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                            <div class="wrapper-img">
                                @if (filter_var($brand->logo, FILTER_VALIDATE_URL))
                                    <img src="{{ $brand->logo }}"
                                        alt="{{ $translateValue($brand->name ?? null) }}"class="w-25">
                                @else
                                    <img src="{{ asset('storage/logo/' . $brand->logo) }}"
                                        alt="{{ $translateValue($brand->name ?? null) }}"class="w-25">
                                @endif
                            </div>

                            <div class="wrapper-info">
                                <a href="{{ route('getProductsByBrand', $brand->slug) }}"
                                    class="wrapper-details">{{ $translateValue($brand->name ?? null) }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <strong class="text-center fw-bold">No brands Found</strong>
                @endif


            </div>
        </div>
    </section>


    <section class="product arrival">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.new_arrival') }}</h5>
                <a href="{{ route('arrival') }}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="arrival-section">
                <div class="row g-5">
                    @forelse ($products as $product)
                        <div class="col-lg-3 col-sm-6">
                            <div class="product-wrapper position-relative" data-aos="fade-up">
                                <div class="product-img">
                                    <img src="{{ asset('storage/products/' . $productImage($product)) }}"
                                        alt="product-img">
                                    <div
                                        class="span position-absolute top-0 start-0 bg-danger  text-white fw-bold my-2 p-3">
                                        {{ $productBrandName($product) }}
                                    </div>

                                    <div class="product-cart-items">
                                        <a href="{{ route('getProductDetails', $product->slug) }}"
                                            class="cart cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="white" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button id={{ $product->id }} class="favourite cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="#AE1C9A" />
                                                    <path
                                                        d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                        fill="#000" />
                                                </svg>
                                            </span>
                                        </button>

                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="ratings">
                                        <span>
                                            <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                    fill="#FFA800" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="product-description">
                                        <a href="{{ route('getProductDetails', $product->slug)}}"
                                            class="product-details">{{ $productName($product) }}
                                        </a>
                                        <div class="price">
                                            @if (!$product->has_variants)
                                                @if ($product->has_discount)
                                                    <span
                                                        class="price-cut">{{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                        EGP</span>
                                                @else
                                                    <span class="new-price">{{ number_format($product->price, 2) }}
                                                        EGP</span>
                                                @endif
                                            @else
                                                <span class="new-price">{{ __('products.has_variant') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="{{ route('getProductsByCategories', $productCategorySlug($product)) }}"
                                        class="product-btn">{{ $productCategoryName($product) }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                      <p>{{__('front.no_products_found')}}</p>
                    @endforelse


                </div>
            </div>
        </div>
    </section>

    @if (count($flasSaleProducts) > 0)
        <section class="product flash-sale">
            <div class="container">
                <div class="section-title">
                    <h5>{{ __('front.flash_sale') }}</h5>
                    <div class="countdown-section">
                        <div class="countdown-items">
                            <span id="day" class="number" style="color: red;">0</span>
                            <span class="text">Days</span>
                        </div>
                        <div class="countdown-items">
                            <span id="hour" class="number" style="color: skyblue;">0</span>
                            <span class="text">Hours</span>
                        </div>
                        <div class="countdown-items">
                            <span id="minute" class="number" style="color: green;">0</span>
                            <span class="text">Minutes</span>
                        </div>
                        <div class="countdown-items">
                            <span id="second" class="number" style="color: red;">0</span>
                            <span class="text">seconds</span>
                        </div>
                    </div>
                    <a href="{{ route('flash', 'flash_timer') }}" class="view">{{ __('front.view_all') }}</a>
                </div>
                <div class="flash-sale-section">
                    <div class="row g-5">
                        @foreach ($flasSaleProducts as $product)
                            <div class="col-lg-3 col-sm-6">
                                <div class="product-wrapper position-relative" data-aos="fade-up">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/products/' . $productImage($product)) }}"
                                            alt="{{ $productName($product) }}">
                                        <div
                                            class="span position-absolute top-0 start-0 bg-danger  text-white fw-bold my-2 p-3">
                                            {{ $productBrandName($product) ?? __('admin.not_found') }}
                                        </div>

                                        <div class="product-cart-items">
                                            <a href="{{ route('getProductDetails', $product->slug) }}"
                                                class="cart cart-item">
                                                <span>
                                                    <svg width="40" height="40" viewBox="0 0 40 40"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="40" height="40" rx="20"
                                                            fill="white" />
                                                        <path
                                                            d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                            fill="#181818" />
                                                        <path
                                                            d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                            fill="black" fill-opacity="0.2" />
                                                        <path
                                                            d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                            fill="#181818" />
                                                        <path
                                                            d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                            fill="black" fill-opacity="0.2" />
                                                        <path
                                                            d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                            fill="#181818" />
                                                        <path
                                                            d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                            fill="black" fill-opacity="0.2" />
                                                        <path
                                                            d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                            fill="#181818" />
                                                        <path
                                                            d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                            fill="black" fill-opacity="0.2" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="wishlist.html" class="favourite cart-item">
                                                <span>
                                                    <svg width="40" height="40" viewBox="0 0 40 40"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="40" height="40" rx="20"
                                                            fill="#AE1C9A" />
                                                        <path
                                                            d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                            fill="#000" />
                                                    </svg>
                                                </span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <div class="ratings">
                                            <span>
                                                <svg width="75" height="15" viewBox="0 0 75 15"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                        fill="#FFA800" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="product-description">
                                            <a href="{{ route('getProductDetails', $product->slug) }}"
                                                class="product-details">{{ $productName($product) }}
                                            </a>
                                            <div class="price">
                                                @if (!$product->has_variants)
                                                    @if ($product->has_discount)
                                                        <span
                                                            class="price-cut">{{ number_format($product->price, 2) }}</span>
                                                        <span
                                                            class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                            EGP</span>
                                                    @else
                                                        <span
                                                            class="new-price">{{ number_format($product->price, 2) }}
                                                            EGP</span>
                                                    @endif
                                                @else
                                                    <span class="new-price">{{ __('products.has_variant') }}</span>
                                                @endif



                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-cart-btn">
                                        <a href="{{ route('getProductsByCategories', $productCategorySlug($product)) }}"
                                            class="product-btn">{{ $productCategoryName($product) }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    @endif



    <section class="product top-selling">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.top_best_selling') }}</h5>
                <a href="{{route('bestSelling')}}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="top-selling-section">
                <div class="row g-5">
                    @forelse ($topSellingProducts as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-wrapper position-relative" data-aos="fade-up">
                                <div class="product-img">
                                        <img src="{{ asset('storage/products/' . $productImage($product)) }}"
                                            alt="product-img">
                                    <div
                                        class="span position-absolute top-0 start-0 bg-danger  text-white fw-bold my-2 p-3">
                                            {{ $productBrandName($product) ?? __('admin.not_found') }}
                                    </div>

                                    <div class="product-cart-items">
                                        <a href="{{ route('getProductDetails', $product->slug) }}"
                                            class="cart cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="white" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button id={{ $product->id }} class="favourite cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="#AE1C9A" />
                                                    <path
                                                        d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                        fill="#000" />
                                                </svg>
                                            </span>
                                        </button>

                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="ratings">
                                        <span>
                                            <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                    fill="#FFA800" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="product-description">
                                        <a href="{{ route('getProductDetails', $product->slug)}}"
                                            class="product-details">{{ $productName($product) }}
                                        </a>
                                        <div class="price" >
                                            @if (!$product->has_variants)
                                                @if ($product->has_discount)
                                                    <span
                                                        class="price-cut">{{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                        EGP</span>
                                                @else
                                                    <span class="new-price">{{ number_format($product->price, 2) }}
                                                        EGP</span>
                                                @endif
                                            @else
                                                <span class="new-price">{{ __('products.has_variant') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart-btn">
                                        <a href="{{ route('getProductsByCategories', $productCategorySlug($product)) }}"
                                            class="product-btn">{{ $productCategoryName($product) }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                     <p>{{__('front.no_products_found')}}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>





    <section class="product weekly-sale">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.weekly_best_selling') }}</h5>
                <a href="{{route('bestSellingWeekly')}}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="weekly-sale-section">
                <div class="row g-5">
                       @forelse ($topSellingProductsInWeek as $product)
                        <div class="col-lg-3 col-sm-6">
                            <div class="product-wrapper position-relative" data-aos="fade-up">
                                <div class="product-img">
                                    <img src="{{ asset('storage/products/' . $productImage($product)) }}"
                                        alt="product-img">
                                    <div
                                        class="span position-absolute top-0 start-0 bg-danger  text-white fw-bold my-2 p-3">
                                        {{ $productBrandName($product) ?? __('admin.not_found') }}
                                    </div>

                                    <div class="product-cart-items">
                                        <a href="{{ route('getProductDetails', $product->slug) }}"
                                            class="cart cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="white" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button id={{ $product->id }} class="favourite cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="#AE1C9A" />
                                                    <path
                                                        d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                        fill="#000" />
                                                </svg>
                                            </span>
                                        </button>

                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="ratings">
                                        <span>
                                            <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                    fill="#FFA800" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="product-description">
                                        <a href="{{ route('getProductDetails', $product->slug)}}"
                                            class="product-details">{{ $productName($product) }}
                                        </a>
                                        <div class="price">
                                            @if (!$product->has_variants)
                                                @if ($product->has_discount)
                                                    <span
                                                        class="price-cut">{{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                        EGP</span>
                                                @else
                                                    <span class="new-price">{{ number_format($product->price, 2) }}
                                                        EGP</span>
                                                @endif
                                            @else
                                                <span class="new-price">{{ __('products.has_variant') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="{{ route('getProductsByCategories', $productCategorySlug($product)) }}"
                                        class="product-btn">{{ $productCategoryName($product) }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                     <p>{{__('front.no_products_found')}}</p>

                    @endforelse
                </div>
            </div>
            <div class="style-section">
                <div class="row gy-4 gx-5 gy-lg-0">
                    <div class="col-lg-6">
                        <div class="product-wrapper wrapper-one" data-aos="fade-right" style="background-image: url({{asset('front-assets/images/homepage-one/style-bg-three.webp')}}); direction:ltr">
                            <div class="wrapper-info">
                                <span class="wrapper-subtitle">{{__('front.new_style')}}</span>
                                <h4 class="wrapper-details">{{__('front.offer')}}
                                    <span class="wrapper-inner-title">& {{__('front.fusion')}}</span> .
                                </h4>
                                <a href="{{route('shop.index')}}" class="shop-btn">{{__('front.shop_now')}}
                                    <span>
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1.45312" y="0.914062" width="9.25346" height="2.05632"
                                                transform="rotate(45 1.45312 0.914062)" />
                                            <rect x="8" y="7.45703" width="9.25346" height="2.05632"
                                                transform="rotate(135 8 7.45703)" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-wrapper wrapper-two" data-aos="fade-up"style="background-image: url({{asset('front-assets/images/homepage-one/style-bg-four.webp')}}); direction:ltr">
                            <div class="wrapper-info">
                                <span class="wrapper-subtitle">{{__('front.mega_offer')}}</span>
                                <h4 class="wrapper-details">
                                   {{__('front.sentence')}}
                                </h4>
                                <a href="{{route('shop.index')}}" class="shop-btn">{{__('front.shop_now')}}
                                    <span>
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="1.45312" y="0.914062" width="9.25346" height="2.05632"
                                                transform="rotate(45 1.45312 0.914062)" />
                                            <rect x="8" y="7.45703" width="9.25346" height="2.05632"
                                                transform="rotate(135 8 7.45703)" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product best-product">
        <div class="container">
            <div class="section-title">
                <h5>{{ __('front.flash_sale') }}</h5>
                <a href="{{ route('flash', 'flash') }}" class="view">{{ __('front.view_all') }}</a>
            </div>
            <div class="best-product-section">
                <div class="row ">
                    @forelse ($saleProducts as $product)
                        <div class="col-xl-2 col-md-4 col-sm-12 h-100">
                            <div class="product-wrapper position-relative" data-aos="fade-up">
                                <div class="product-img">
                                    <img src="{{ asset('storage/products/' . $productImage($product)) }}"
                                        alt="product-img">
                                    <div
                                        class="span position-absolute top-0 start-0 bg-danger  text-white fw-bold my-2 p-3">
                                        {{ $productBrandName($product) ?? __('admin.not_found') }}
                                    </div>

                                    <div class="product-cart-items">
                                          <a href="{{ route('getProductDetails', $product->slug) }}"
                                            class="cart cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="white" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button id={{ $product->id }} class="favourite cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20"
                                                        fill="#AE1C9A" />
                                                    <path
                                                        d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                        fill="#000" />
                                                </svg>
                                            </span>
                                        </button>

                                    </div>
                                </div>
                                <div class="product-info ">
                                    <div class="ratings">
                                        <span>
                                            <svg width="75" height="15" viewBox="0 0 75 15"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                    fill="#FFA800" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="product-description my-2">

                                        <a href="{{ route('getProductDetails', $product->slug)}}"
                                            class="product-details">{{ $productName($product) }}
                                        </a>
                                        <div class="price ">
                                            @if (!$product->has_variants)
                                                @if ($product->has_discount)
                                                    <span
                                                        class="price-cut">{{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                        EGP</span>
                                                @else
                                                    <span class="new-price">{{ number_format($product->price, 2) }}
                                                        EGP</span>
                                                @endif
                                            @else
                                                <span class="new-price">{{ __('products.has_variant') }}</span>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    @empty
                         <p>{{__('front.no_products_found')}}</p>
                    @endforelse

                </div>
            </div>
        </div>
    </section>

    @include('front.layouts.footer')

    @include('front.layouts.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function startCountdown() {
            const now = new Date()
            const endOfDate = new Date()
            endOfDate.setHours(23, 59, 59, 999)
            const diff = endOfDate - now;

            const totalSeconds = Math.floor(diff / 1000)
            const hours = Math.floor((totalSeconds % 86400) / 3600)
            const minutes = Math.floor((totalSeconds % 3600) / 60)
            const seconds = totalSeconds % 60;

            $('#day').text("0")
            $("#hour").text(String(hours).padStart(2, '0'))
            $("#minute").text(String(minutes).padStart(2, '0'))
            $("#second").text(String(seconds).padStart(2, '0'))
        }

        $(function() {
            startCountdown()
            setInterval(() => {
                startCountdown()
            }, 1000);
        })
    </script>
    <script>
        $(document).on('click', '.favourite', function() {
            let id = $(this).attr('id')
            let url = "{{ route('wichlist.store', ':id') }}"
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status === 409) {
                        toastr.warning(data.message); // Already exists
                    } else if (data.status === 201) {
                        toastr.success(data.message);
                        $(".wishlist-count").html(data.productCount);
                    } else if (data.status === 401) {
                        toastr.error(data.message); // You should login first
                    }
                }, // <-- فاصلة هنا
                error: function(xhr) {
                    // في حالة خطأ غير متوقع (500 الخ)
                    let msg = xhr.responseJSON?.message || 'Something went wrong';
                    toastr.error(msg);
                }
            })


        })
    </script>

</body>

<!-- Mirrored from quomodothemes.website/html/shopus/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Nov 2023 07:47:25 GMT -->

</html>
