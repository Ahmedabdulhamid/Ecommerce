@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
@section('title',__('admin.show_orders_page'))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        @if (isset($order))
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">{{__('admin.order_table')}}</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.home')}}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">{{__('admin.order_table')}}</a>
                                    </li>


                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
                <form action="{{ route('orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="mr-1 mb-1 btn btn-outline-success btn-min-width"><i
                            class="la la-truck mx-1"></i>{{__('admin.mark_as_delivered')}}</button>
                </form>

                <div class="content-body">
                    <!-- Table row borders end-->
                    <div class="row ">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4 class="card-title">{{ __('admin.order_table') }}</h4>

                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="my-5 container d-flex justify-content-between">

                                    <div class="card-content">



                                        <div class="row my-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="w-100">
                                                    <p class="my-1"><strong>{{__('admin.user_name')}}:</strong> {{ $order->f_name }}
                                                        {{ $order->l_name }}</p>
                                                    <p class="my-1"><strong>{{__('admin.user_phone')}}:</strong> {{ $order->phone }}
                                                    </p>
                                                    <p class="my-1"><strong>{{__('admin.shipping_address')}}:</strong>
                                                        {{ $order->country }}, {{ $order->governorate }},
                                                        {{ $order->city }}, {{ $order->street }}</p>
                                                    @if ($order->notes)
                                                        <p class="my-1"><strong>{{__('admin.notes')}}:</strong> {{ $order->notes }}
                                                        </p>
                                                    @else
                                                        <p class="my-1"><strong>{{__('admin.notes')}}:</strong> {{__('admin.not_found')}}</p>
                                                    @endif
                                                    <p class="my-1"><strong>{{__('admin.status')}}:</strong> <span
                                                            style="background:orange; color:white;padding:3px;">{{ $order->status }}</span>
                                                    </p>

                                                </div>


                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="w-100">
                                                    <p class="my-1"><strong>{{__('admin.country')}}:</strong> {{ $order->country }}
                                                    </p>
                                                    <p class="my-1"><strong>{{__('admin.governorate')}}:</strong>
                                                        {{ $order->governorate }}</p>


                                                    <p class="my-1"><strong>{{__('admin.city')}}:</strong> {{ $order->city }}</p>

                                                    <p class="my-1"><strong>{{__('admin.email')}}:</strong>{{ $order->email_hidden }}
                                                    </p>




                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="d-flex justify-content-evenly">
                                        <p class="mx-1"><strong> {{__('admin.price')}}</strong>
                                            {{ number_format($order->total_price - $order->shipping_price, 2) }} EGP
                                        </p>
                                        <p class="mx-1"><strong> {{__('admin.shipping_price')}}</strong>
                                            {{ number_format($order->shipping_price, 2) }} EGP
                                        </p>
                                        <p class="mx-1"><strong> {{__('admin.total_price')}}</strong>
                                            {{ number_format($order->total_price, 2) }} EGP
                                        </p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="bg-success white">
                                                <th>{{__('admin.product_name')}}</th>
                                                <th>{{__('admin.quantity')}}</th>
                                                <th>{{__('admin.price')}}</th>
                                                <th>{{__('admin.price_for_quantity')}}</th>
                                                <th>{{__('admin.attributes')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                @php
                                                    $orderedProduct = $item->product;
                                                @endphp
                                                <tr class="bg-success white">
                                                    <th scope="row">
                                                        {{ $orderedProduct?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found') }}
                                                    </th>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->price, 2) }} EGP</td>
                                                    <td>{{ number_format($item->price * $item->quantity, 2) }} EGP</td>
                                                    <td>
                                                        @if ($item->attributes)
                                                            @php
                                                                $attributes = json_decode($item->attributes, true);

                                                            @endphp
                                                            @foreach ($attributes as $key => $value)
                                                                <p class="mx-2">{{ ucfirst($key) }} :
                                                                    {{ $value }}</p>
                                                            @endforeach
                                                        @else
                                                            <p>{{__('admin.not_found')}}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        @else
            <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-6.col-md-6.col-sm-12">
                        <img src="{{ asset('front-assets/images/homepage-one/empty-wishlist.webp') }}" alt=""
                            srcset="" class="w-100">
                    </div>
                </div>


            </div>
        @endif

    </div>
    @include('dashboard.partials.footer')
    @include('dashboard.categories.partials.scribts')

</body>

</html>
