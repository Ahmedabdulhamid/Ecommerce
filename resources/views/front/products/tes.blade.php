<section class="product product-description">
    <div class="container">
        <div class="product-detail-section">
            <nav>
                <div class="nav nav-tabs nav-item" >
                    <button class="nav-link @if ($step==1)
                        active
                    @endif"
                         wire:click='firstStep'>Description</button>
                    <button class="nav-link @if ($step==2)
                        active
                    @endif"
                        wire:click='secondStep'>Reviews</button>

                </div>
            </nav>
            <div class="tab-content tab-item" id="nav-tabContent">
                @if ($step == 1)
                    <div class="tab-pane fade  @if ($step == 1) show active @endif "
                        style="display:block;">
                        <div class="product-intro-section">
                            <p>{{ $product->getTranslation('desc', app()->getLocale()) }}</p>
                        </div>

                    </div>
                @endif
                @if ($step == 2)
                    <div class="tab-content tab-item" id="nav-tabContent">
                        <div class="tab-pane fade   @if ($step == 2) show active @endif ">
                            <h5 class="intro-heading">Reviews</h5>
                            <form class="login footer-padding " wire:submit.prevent='submit'
                                style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">

                                <div class="container">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="container">

                                                <div class="mt-5">
                                                    <label for="comment">{{ __('front.comment') }} *</label>
                                                    <input type="text" class="form-control" style="height: 40px"
                                                        placeholder="{{ __('front.review') }}"wire:model='comment'>
                                                    @error('comment')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="login-btn ">
                                                    <button class="shop-btn">Submit</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            @if (count($reviews) > 0)
                                @foreach ($reviews as $review)
                                    <div class="review-wrapper">
                                        <div class="wrapper">

                                            <div class="wrapper-aurthor">

                                                <div class="wrapper-info">

                                                    <div class="aurthor-img">
                                                        <img src="{{ asset('front-assets') }}/images/homepage-one/aurthor-img-1.webp"
                                                            alt="aurthor-img">

                                                    </div>
                                                    <div class="author-details">
                                                        <h5>{{ $review->user->name }}</h5>
                                                        @if ($review->user->country !== null)
                                                            <p>{{ $review->user->country->getTranslation('name', app()->getLocale()) }},
                                                                {{ $review->user->governorate->getTranslation('name', app()->getLocale()) }}
                                                            </p>
                                                        @endif

                                                    </div>
                                                </div>
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
                                                    <span>(5.0)</span>
                                                </div>
                                            </div>
                                            <div class="wrapper-description">
                                                <p class="wrapper-details">{{ $review->comment }}
                                                </p>
                                            </div>


                                        </div>
                                    </div>
                                @endforeach

                            @endif


                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
</section>
