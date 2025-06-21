<section class="checkout product footer-padding">
    <div class="container">
        <div class="checkout-section">
            @if (isset($cart) && count($cart->products) > 0)
                <form wire:submit.prevent='submit'>
                    <div class="row gy-5">

                        <div class="col-lg-6">
                            <div class="checkout-wrapper">


                                <div class="account-section billing-section">
                                    <h5 class="wrapper-heading">Billing Details</h5>
                                    <div class="review-form">
                                        <div class=" account-inner-form">
                                            <div class="review-form-name">
                                                <label for="fname" class="form-label">First Name*</label>
                                                <input type="text" id="fname" class="form-control"
                                                    placeholder="First Name" wire:model='fname'>
                                                @error('fname')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="review-form-name">
                                                <label for="lname" class="form-label">Last Name*</label>
                                                <input type="text" id="lname"
                                                    class="form-control"wire:model='lname' placeholder="Last Name">
                                                @error('lname')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class=" account-inner-form">
                                            <div class="review-form-name">
                                                <label for="email" class="form-label">Email*</label>
                                                <input type="email" id="email"
                                                    class="form-control"wire:model='email' placeholder="user@gmail.com">
                                                @error('email')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="review-form-name">
                                                <label for="phone" class="form-label">Phone*</label>
                                                <input type="tel" id="phone"
                                                    class="form-control"wire:model='phone' placeholder="+880388**0899">
                                                @error('phone')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="review-form-name my-2">
                                            <label for="country" class="form-label">Country*</label>
                                            <select id="country" class="form-select"wire:model.live='countryId'
                                                wire:ignore>
                                                <option>Choose The Country.</option>
                                                @forelse ($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->getTranslation('name', app()->getLocale()) }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('countryId')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="review-form-name my-2">
                                            <label for="country" class="form-label">Governorate*</label>
                                            <select id="country" class="form-select"wire:model.live='governorateId'>
                                                <option>Choose The Governorate.</option>
                                                @forelse ($governorates as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->getTranslation('name', app()->getLocale()) }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('governorateId')
                                                <span class="text-danger  fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="review-form-name my-2">
                                            <label for="country" class="form-label">City*</label>
                                            <input type="text" id="fname" class="form-control"
                                                placeholder="City"wire:model='city'>
                                            @error('city')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="review-form-name my-2">
                                            <label for="street" class="form-label">Street*</label>
                                            <input type="text" id="street" class="form-control"
                                                placeholder="Street" wire:model='street'>
                                            @error('street')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="review-form-name my-2">
                                            <label for="country" class="form-label">Notice*</label>
                                            <input type="text" id="fname" class="form-control"
                                                placeholder="Notice name" wire:model='notice'>
                                            @error('notice')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        @if ($cart->coupon == null)
                                            <div class="review-form-name my-2">
                                                <label for="country" class="form-label">Coupon*</label>
                                                <input type="text" id="fname" class="form-control coupon_input"
                                                    placeholder="Coupon"style="height: 40px;" wire:model='code'>

                                                <a href="#"
                                                    wire:click.prevent='applyCoupon'class="shop-btn apply-coupon-btn mt-3">Apply
                                                    Coupon</a>


                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-wrapper">

                                <div class="account-section billing-section">
                                    <h5 class="wrapper-heading">Order Summary</h5>
                                    <div class="order-summery">
                                        <div class="subtotal product-total">
                                            <h5 class="wrapper-heading">PRODUCT</h5>
                                            <h5 class="wrapper-heading">TOTAL</h5>
                                        </div>
                                        <hr>
                                        <div class="subtotal product-total">
                                            <ul class="product-list">
                                                @foreach ($cart->products as $key => $item)
                                                    @php
                                                        $attributes = json_decode(
                                                            $cart->products[$key]->pivot->attributes,
                                                            true,
                                                        );

                                                    @endphp
                                                    <li>
                                                        <div class="product-info">
                                                            <h5 class="wrapper-heading">
                                                                {{ $item->getTranslation('name', app()->getLocale()) }}
                                                            </h5>
                                                            @if ($item->has_variants)
                                                                @foreach ($attributes as $key => $value)
                                                                    <p class="paragraph">{{ ucfirst($key) }} :
                                                                        {{ $value }}
                                                                    </p>
                                                                @endforeach
                                                            @endif

                                                        </div>
                                                        <div class="price" style="direction: ltr;">
                                                            <h5 class="wrapper-heading">{{ $item->pivot->price }} EGP
                                                                x
                                                                {{ $item->pivot->quantity }}</h5>
                                                        </div>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        <hr>

                                        <div class="subtotal product-total">
                                            <h5 class="wrapper-heading">SUBTOTAL</h5>
                                            <h5 class="wrapper-heading">{{ number_format($totalPrice, 2) }} EGP</h5>
                                        </div>
                                        <div class="subtotal product-total">
                                            <ul class="product-list">
                                                <li>
                                                    <div class="product-info">
                                                        <p class="paragraph">SHIPPING</p>
                                                        <h5 class="wrapper-heading">Free Shipping</h5>
                                                    </div>
                                                    <div class="price">
                                                        <h5 class="wrapper-heading">+{{ $shipping_price }} EGP</h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="subtotal total">
                                            <h5 class="wrapper-heading">TOTAL</h5>
                                            <h5 class="wrapper-heading price">{{ number_format($totalPrice, 2) }} EGP
                                            </h5>
                                        </div>
                                        <hr>


                                        <button type="submit" class="shop-btn">Place Order Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    window.addEventListener('CouponNotFound', function() {
        toastr.error('Coupon Not Valid');
    })
    window.addEventListener('SuccesApplyCoupon', function(data) {


        toastr.success(data.detail[0].msg);
    })
    window.addEventListener('auth', function() {


        toastr.error('You Should Login First');
    })
    window.addEventListener('orderCreated', function() {


        toastr.success('Your Order Created Successfully!');
    })
     window.addEventListener('payment', function() {


        toastr.error( 'حدث خطأ أثناء الاتصال بـ MyFatoorah');
    })
</script>
