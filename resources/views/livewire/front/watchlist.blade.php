<div>
    <section class="cart product wishlist footer-padding" >
        <div class="container">
            <div class="cart-section wishlist-section">
                @if (isset($products) && count($products) > 0)
                    <table>
                        <tbody>
                            <tr class="table-row table-top-row">
                                <td class="table-wrapper wrapper-product">
                                    <h5 class="table-heading">{{__('front.product')}}</h5>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="table-heading">{{__("front.price")}}</h5>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="table-heading">{{__('front.action')}}</h5>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($products as $product)
                                @php
                                    $primaryImage = optional($product->images->first())->file_name;
                                @endphp
                                <tr class="table-row ticket-row">
                                    <td class="table-wrapper wrapper-product">
                                        <div class="wrapper">
                                            <div class="wrapper-img">
                                                <img src="{{ $primaryImage ? asset('storage/products/' . $primaryImage) : asset('front-assets/images/homepage-one/product-img-1.webp') }}"
                                                    alt="img" />
                                            </div>
                                            <div class="wrapper-content">
                                                <h5 class="heading">
                                                    {{ $product->getTranslation('name', app()->getLocale()) }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <div class="price">
                                                @if (!$product->has_variants)
                                                    @if ($product->has_discount)
                                                        <span
                                                            class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                            EGP</span>
                                                    @else
                                                        <span class="new-price">{{ number_format($product->price, 2) }}
                                                            EGP</span>
                                                    @endif
                                                @else
                                                    <span class="new-price">{{ __('products.has_variants_yes') }}</span>
                                                @endif



                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-wrapper">
                                        <button wire:click='deleteProduct({{ $product->id }},{{ $watchlist }})'
                                            class="table-wrapper-center">
                                            <span>
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                        fill="#AAAAAA"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <div class="wishlist-btn">
                        <a href="#" wire:click='deleteWishlist' class="clean-btn">{{__('front.clean_whishlist')}}</a>
                        <a href="{{route('cart.index')}}" class="shop-btn">{{__('front.view_cards')}}</a>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <div class="row">
                            <div class="col-lg-6.col-md-6.col-sm-12">
                                <img src="{{ asset('front-assets/images/homepage-one/empty-wishlist.webp') }}"
                                    alt="" srcset="" class="w-100">
                            </div>
                        </div>


                    </div>

                @endif

            </div>

        </div>
    </section>
</div>
