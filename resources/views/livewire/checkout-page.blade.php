<section class="checkout product footer-padding">
    <div class="container">
        <div class="checkout-section">
            @if (isset($cart) && count($cart->products) > 0)
                <form wire:submit.prevent="submit">
                    <div class="row gy-5">

                        {{-- بيانات الفاتورة --}}
                        <div class="col-lg-6">
                            <div class="checkout-wrapper">
                                <div class="account-section billing-section">
                                    <h5 class="wrapper-heading">{{ __('front.billing_details') }}</h5>
                                    <div class="review-form">
                                        <div class="account-inner-form">
                                            {{-- الاسم الأول --}}
                                            <div class="review-form-name">
                                                <label for="fname" class="form-label">{{ __('front.fname') }}*</label>
                                                <input type="text" id="fname" class="form-control"
                                                    placeholder="{{ __('front.fname') }}" wire:model="fname">
                                                @error('fname')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- اسم العائلة --}}
                                            <div class="review-form-name">
                                                <label for="lname" class="form-label">{{ __('front.lname') }}*</label>
                                                <input type="text" id="lname" class="form-control"
                                                    placeholder="{{ __('front.lname') }}" wire:model="lname">
                                                @error('lname')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="account-inner-form">
                                            {{-- البريد الإلكتروني --}}
                                            <div class="review-form-name">
                                                <label for="email" class="form-label">{{ __('front.email') }}*</label>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="user@gmail.com" wire:model="email">
                                                @error('email')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- الهاتف --}}
                                            <div class="review-form-name">
                                                <label for="phone" class="form-label">{{ __('front.phone') }}*</label>
                                                <input type="tel" id="phone" class="form-control"
                                                    placeholder="+20123456789" wire:model="phone">
                                                @error('phone')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- الدولة --}}
                                        <div class="review-form-name my-2">
                                            <label for="country" class="form-label">{{ __('admin.country') }}*</label>
                                            <select id="country" class="form-select" wire:model="countryId" wire:ignore>
                                                <option>{{ __('front.choose_country') }}</option>
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

                                        {{-- المحافظة --}}
                                        <div class="review-form-name my-2">
                                            <label for="governorate" class="form-label">{{ __('admin.governorate') }}*</label>
                                            <select id="governorate" class="form-select" wire:model="governorateId">
                                                <option>{{ __('front.choose_governorate') }}</option>
                                                @forelse ($governorates as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->getTranslation('name', app()->getLocale()) }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('governorateId')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- المدينة --}}
                                        <div class="review-form-name my-2">
                                            <label for="city" class="form-label">{{ __('front.city') }}*</label>
                                            <input type="text" id="city" class="form-control"
                                                placeholder="{{ __('front.city') }}" wire:model="city">
                                            @error('city')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- وسيلة الدفع --}}
                                        <div class="review-form-name my-2">
                                            <label for="paymentMethod" class="form-label">{{ __('front.Payment_method') }}*</label>
                                            <select id="paymentMethod" class="form-select" wire:model="paymentMethodId" wire:ignore>
                                                <option>{{ __('front.choose_payment_method') }}</option>
                                                @forelse ($payment_methods as $method)
                                                    <option value="{{ $method['PaymentMethodId'] }}">
                                                        @if (app()->getLocale()=='ar')
                                                            {{ $method['PaymentMethodAr'] }}
                                                        @else
                                                            {{ $method['PaymentMethodEn'] }}
                                                        @endif
                                                    </option>
                                                @empty
                                                    <option disabled>لا توجد وسائل دفع متاحة</option>
                                                @endforelse
                                            </select>
                                            @error('paymentMethodId')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الشارع --}}
                                        <div class="review-form-name my-2">
                                            <label for="street" class="form-label">{{ __('front.street') }}*</label>
                                            <input type="text" id="street" class="form-control"
                                                placeholder="{{ __('front.street') }}" wire:model="street">
                                            @error('street')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- ملاحظات --}}
                                        <div class="review-form-name my-2">
                                            <label for="notice" class="form-label">{{ __('front.notice') }}</label>
                                            <input type="text" id="notice" class="form-control"
                                                placeholder="{{ __('front.notice') }}" wire:model="notice">
                                            @error('notice')
                                                <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الكوبون --}}
                                        @if ($cart->coupon == null)
                                            <div class="review-form-name my-2">
                                                <label for="coupon" class="form-label">{{ __('front.coupon') }}</label>
                                                <input type="text" id="coupon" class="form-control coupon_input"
                                                    placeholder="{{ __('front.coupon') }}" wire:model="code" style="height:40px;">
                                                @error('code')
                                                    <span class="text-danger fw-bold fs-4">{{ $message }}</span>
                                                @enderror

                                                <a href="#"
                                                    wire:click.prevent="applyCoupon"
                                                    class="shop-btn apply-coupon-btn mt-3">
                                                    {{ __('front.apply_coupon') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ملخص الطلب --}}
                        <div class="col-lg-6">
                            <div class="checkout-wrapper">
                                <div class="account-section billing-section">
                                    <h5 class="wrapper-heading">{{ __('front.order_summery') }}</h5>
                                    <div class="order-summery">
                                        <div class="subtotal product-total">
                                            <h5 class="wrapper-heading">{{ __('front.product') }}</h5>
                                            <h5 class="wrapper-heading">{{ __('front.total') }}</h5>
                                        </div>
                                        <hr>
                                        <div class="subtotal product-total">
                                            <ul class="product-list">
                                                @foreach ($cart->products as $key => $item)
                                                    @php
                                                        $attributes = json_decode($cart->products[$key]->pivot->attributes, true);
                                                    @endphp
                                                    <li>
                                                        <div class="product-info">
                                                            <h5 class="wrapper-heading">
                                                                {{ $item->getTranslation('name', app()->getLocale()) }}
                                                            </h5>
                                                            @if ($item->has_variants)
                                                                @foreach ($attributes as $key => $value)
                                                                    <p class="paragraph">{{ ucfirst($key) }} : {{ $value }}</p>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="price" style="direction: ltr;">
                                                            <h5 class="wrapper-heading">{{ $item->pivot->price }} EGP x {{ $item->pivot->quantity }}</h5>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="subtotal product-total">
                                            <h5 class="wrapper-heading">{{ __('front.subtotal') }}</h5>
                                            <h5 class="wrapper-heading">{{ number_format($totalPrice, 2) }} EGP</h5>
                                        </div>
                                        <div class="subtotal product-total">
                                            <ul class="product-list">
                                                <li>
                                                    <div class="product-info">
                                                        <p class="paragraph">{{ __('front.shipping') }}</p>
                                                    </div>
                                                    <div class="price">
                                                        <h5 class="wrapper-heading">+{{ $shipping_price }} EGP</h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="subtotal total">
                                            <h5 class="wrapper-heading">{{ __('front.total') }}</h5>
                                            <h5 class="wrapper-heading price">{{ number_format($totalPrice, 2) }} EGP</h5>
                                        </div>
                                        <hr>
                                        <button type="submit" class="shop-btn">{{ __('front.place_order_now') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="d-flex justify-content-center">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <img src="{{ asset('front-assets/images/homepage-one/empty-wishlist.webp') }}"
                                alt="empty cart" class="w-100">
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


        toastr.error('حدث خطأ أثناء الاتصال بـ MyFatoorah');
    })
</script>
