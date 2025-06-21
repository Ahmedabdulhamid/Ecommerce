<section id="hero" class="hero" style="position: relative;">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper hero-wrapper">
            @if ($sliders && count($sliders) > 0)
                @foreach ($sliders as $slider)
                    <div class="swiper-slide hero-slider-one" style="position: relative;">
                        <div class="position-relative" style="width: 100%;">
                            <img src="{{ asset('storage/slider/' . $slider->file_name) }}"
                                 alt="slider image"
                                 class="img-fluid w-100"
                                 style="height: 100vh; object-fit: cover;">

                            <!-- النصوص فوق الصورة -->
                            <div class="overlay-content position-absolute top-50 start-50 translate-middle text-center text-white px-3" style="z-index: 2;">
                                <h1 class="wrapper-details">
                                    {{ $slider->getTranslation('note', app()->getLocale()) }}
                                </h1>
                                <a href="product-sidebar.html" class="shop-btn">Shop Now</a>
                            </div>

                            <!-- خلفية خفيفة للنص عشان يبان لو الصورة فاتحة -->
                            <div class="position-absolute top-0 start-0 w-100 h-100" style=" z-index: 1;"></div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
