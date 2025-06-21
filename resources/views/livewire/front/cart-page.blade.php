<section class="product-cart product footer-padding">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container">
        <div class="cart-section">
            @if (isset($cart->products) && count($cart->products) > 0 && isset($cart))
                <table>
                    <tbody>
                        <tr class="table-row table-top-row">
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">PRODUCT</h5>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">ATTRIBUTES</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">PRICE</h5>
                                </div>
                            </td>

                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">QUANTITY</h5>
                                </div>
                            </td>
                            <td class="table-wrapper wrapper-total">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">TOTAL</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">ACTION</h5>
                                </div>
                            </td>
                        </tr>


                        @foreach ($cart->products as $key => $product)
                            @php
                                $attributes = json_decode($cart->products[$key]->pivot->attributes, true);

                            @endphp
                            <tr class="table-row ticket-row">
                                <td class="table-wrapper wrapper-product">
                                    <div class="wrapper">
                                        <div class="wrapper-img">
                                            <img src="{{ asset('storage/products/' . $product->images->first()->file_name) }}"
                                                alt="{{ $product->getTranslation('name', app()->getLocale()) }}">
                                        </div>
                                        <div class="wrapper-content">
                                            <h5 class="heading">
                                                {{ $product->getTranslation('name', app()->getLocale()) }}</h5>
                                        </div>

                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center mx-2">
                                        @if ($product->has_variants)
                                            @foreach ($attributes as $key => $value)
                                                <p class="mx-2">{{ ucfirst($key) }} : {{ $value }}</p>
                                            @endforeach
                                        @else
                                            <p>NOT FOUND</p>
                                        @endif

                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">{{ $product->pivot->price }} EGP</h5>
                                    </div>
                                </td>

                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <div class="quantity">
                                            <a wire:click.prevent='decrementQuantity({{ $product->pivot }})'href="#"
                                                class="minus">
                                                -
                                            </a>
                                            <span class="number">{{ $product->pivot->quantity }}</span>
                                            <a wire:click.prevent='incrementQuantity({{ $product->pivot }})'href="#"
                                                class="plus">
                                                +
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-wrapper wrapper-total">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">
                                            {{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                            EGP</h5>
                                    </div>
                                </td>
                                <td class="table-wrapper ">
                                    <div class="table-wrapper-center">
                                        <span>
                                            <a href=""
                                                wire:click.prevent='deleteProductFromCart({{ $product->pivot }})'><svg
                                                    width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                        fill="#AAAAAA"></path>
                                                </svg></a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="wishlist-btn cart-btn  d-flex justify-content-between">
                    <div>
                        <p class='fw-bold'>
                            Subtotal:
                            {{number_format($totalPrice,2)  }} EGP
                        </p>
                    </div>
                    <div>
                        <a href="#" wire:click.prevent='clearCart' class="clean-btn">Clear Cart</a>

                        <a href="{{route('checkout')}}" class="shop-btn mb-2">Proceed to Checkout</a>
                    </div>


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
<script>
    window.addEventListener('error', function() {
        toastr.error('The Quantity You Want to add exceed stock')
    })
    window.addEventListener('success', function() {
        toastr.success('You Deleted this product from your cart page')
    })
    window.addEventListener('success', function() {
        toastr.success('You Deleted Cleared cart page')
    })
</script>
