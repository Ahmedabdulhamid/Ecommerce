@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
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
                        <h3 class="content-header-title mb-0 d-inline-block">Product Table</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Tables</a>
                                    </li>
                                    <li class="breadcrumb-item active">Product Table
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12">
                        <div class="dropdown float-md-right">
                            <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Actions</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                    class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i>
                                    Calender</a>
                                <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
                                <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                        class="la la-cog"></i> Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="mr-1 mb-1 btn btn-outline-success btn-min-width"><i
                            class="la la-truck mx-1"></i>Mark As Delivered</button>
                </form>

                <div class="content-body">
                    <!-- Table row borders end-->
                    <div class="row ">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4 class="card-title">{{ __('categories.Product_table') }}</h4>

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
                                                    <p class="my-1"><strong>User Name:</strong> {{ $order->f_name }}
                                                        {{ $order->l_name }}</p>
                                                    <p class="my-1"><strong>User Phone:</strong> {{ $order->phone }}
                                                    </p>
                                                    <p class="my-1"><strong>Shipping Address:</strong>
                                                        {{ $order->country }}, {{ $order->governorate }},
                                                        {{ $order->city }}, {{ $order->street }}</p>
                                                    @if ($order->notes)
                                                        <p class="my-1"><strong>Notes:</strong> {{ $order->notes }}
                                                        </p>
                                                    @else
                                                        <p class="my-1"><strong>Notes:</strong> Not Found</p>
                                                    @endif
                                                    <p class="my-1"><strong>Status:</strong> <span
                                                            style="background:orange; color:white;padding:3px;">{{ $order->status }}</span>
                                                    </p>

                                                </div>


                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="w-100">
                                                    <p class="my-1"><strong>Country:</strong> {{ $order->country }}
                                                    </p>
                                                    <p class="my-1"><strong>Governorate:</strong>
                                                        {{ $order->governorate }}</p>


                                                    <p class="my-1"><strong>City:</strong> {{ $order->city }}</p>

                                                    <p class="my-1"><strong>Email:</strong>{{ $order->email_hidden }}
                                                    </p>




                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="d-flex justify-content-evenly">
                                        <p class="mx-1"><strong> Price</strong>
                                            {{ number_format($order->total_price - $order->shipping_price, 2) }} EGP
                                        </p>
                                        <p class="mx-1"><strong> Shipping Price</strong>
                                            {{ number_format($order->shipping_price, 2) }} EGP
                                        </p>
                                        <p class="mx-1"><strong> Total Price</strong>
                                            {{ number_format($order->total_price, 2) }} EGP
                                        </p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr class="bg-success white">
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Price For Quantity</th>
                                                <th>Attributes</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr class="bg-success white">
                                                    <th scope="row">
                                                        {{ $item->product->getTranslation('name', app()->getLocale()) }}
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
                                                            <p>NOT FOUND</p>
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
