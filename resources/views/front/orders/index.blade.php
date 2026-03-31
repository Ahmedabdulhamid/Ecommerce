<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')
    <section class="product-cart product footer-padding">
        <div class="container">
            <div class="cart-section container">
                <div class="my-3">
                    <p class="my-1"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p class="my-1"><strong>Status:</strong> {{ $order->status }}</p>
                    <p class="my-1"><strong>Name:</strong> {{ $order->f_name }} {{ $order->l_name }}</p>
                    <p class="my-1"><strong>Email:</strong> {{ $order->email_hidden }}</p>
                    <p class="my-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p class="my-1"><strong>Shipping Address:</strong> {{ $order->country }}, {{ $order->governorate }}, {{ $order->city }}, {{ $order->street }}</p>
                </div>

                <table>
                    <tbody>
                        <tr class="table-row table-top-row">
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">PRODUCT</h5>
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
                                @foreach ($order->items as $item)
                                    @php
                                        $orderedProduct = $item->product;
                                        $primaryImage = optional(optional($orderedProduct)->images?->first())->file_name;
                                    @endphp
                                    <tr class="table-row ticket-row">
                                <td class="table-wrapper wrapper-product">
                                    <div class="wrapper">
                                        <div class="wrapper-img">
                                            <img src="{{ $primaryImage ? asset('storage/products/' . $primaryImage) : asset('front-assets/images/homepage-one/product-img-1.webp') }}"
                                                alt="{{ $orderedProduct?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found') }}">
                                        </div>
                                        <div class="wrapper-content">
                                            <h5 class="heading">
                                                {{ $orderedProduct?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found') }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">{{ number_format($item->price,2) }} EGP</h5>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <div class="quantity">

                                            <span class="number">{{ $item->quantity }}</span>

                                        </div>
                                    </div>
                                </td>
                                <td class="table-wrapper wrapper-total">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">$60.00</h5>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                    fill="#AAAAAA"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn cart-btn">
                <a href="empty-cart.html" class="clean-btn">Cancel Order</a>

            </div>
        </div>
    </section>

    @include('front.layouts.footer')
    @include('front.layouts.script')
</body>

</html>
