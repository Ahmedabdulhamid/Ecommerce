<div>
    <section class="product-cart product footer-padding">
        <div class="container">
            @if (count($orders) > 0)
                @forelse ($orders as $order)
                    <div class="cart-section container my-5 border-bottom pb-4">
                        <div class="my-3">
                            <p class="my-1"><strong>{{ __('front.order_numb') }}:</strong>
                                {{ $order->order_number }}</p>
                            <p class="my-1"><strong>{{ __('admin.status') }}:</strong> {{ $order->status }}</p>
                            <p class="my-1"><strong>{{ __('front.name') }}:</strong> {{ $order->f_name }}
                                {{ $order->l_name }}</p>
                            <p class="my-1"><strong>{{ __('admin.email') }}:</strong>
                                {{ $order->email_hidden ?? Str::mask($order->email, '*', 3) }}</p>
                            <p class="my-1"><strong>{{ __('front.phone') }}:</strong> {{ $order->phone }}</p>
                            <p class="my-1"><strong>{{ __('front.shipping_address') }}:</strong>
                                {{ $order->country }},
                                {{ $order->governorate }}, {{ $order->city }},
                                {{ $order->street }}
                            </p>
                        </div>

                        <table>
                            <tbody>
                                <tr class="table-row table-top-row">
                                    <td class="table-wrapper wrapper-product">
                                        <h5 class="table-heading">{{ __('front.product') }}</h5>
                                    </td>
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <h5 class="table-heading">{{ __('front.price') }}</h5>
                                        </div>
                                    </td>
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <h5 class="table-heading">{{ __('front.quantity') }}</h5>
                                        </div>
                                    </td>
                                    <td class="table-wrapper wrapper-total">
                                        <div class="table-wrapper-center">
                                            <h5 class="table-heading">{{ __('front.total') }}</h5>
                                        </div>
                                    </td>

                                </tr>

                                @foreach ($order->items as $item)
                                    <tr class="table-row ticket-row">
                                        <td class="table-wrapper wrapper-product">
                                            <div class="wrapper">
                                                <div class="wrapper-img">
                                                    <img src="{{ asset('storage/products/' . $item->product->images->first()->file_name) }}"
                                                        alt="{{ $item->product->getTranslation('name', app()->getLocale()) }}">
                                                </div>
                                                <div class="wrapper-content">
                                                    <h5 class="heading">
                                                        {{ $item->product->getTranslation('name', app()->getLocale()) }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="table-wrapper">
                                            <div class="table-wrapper-center">
                                                <h5 class="heading">
                                                    {{ number_format($item->price, 2) }} EGP</h5>
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
                                                <h5 class="heading">
                                                    {{ number_format($item->price * $item->quantity, 2) }}
                                                    EGP</h5>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="wishlist-btn cart-btn mt-3">
                            <form action="{{ route('myfatoorah.refund', $order) }}" method='post'>
                                @csrf
                                <button class="clean-btn">{{ __('front.cancel_order') }}</button>
                            </form>


                        </div>

                    </div>
                @empty
                @endforelse
                {{ $orders->links() }}
            @else
                <p>{{__('front.no_orders')}}.</p>
            @endif



        </div>
    </section>
</div>
