@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;
    use App\Models\AttributeValue;

@endphp
@section('title',__('admin.show_products_page'))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{__('admin.product_table')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.home')}}</a>
                                </li>

                                <li class="breadcrumb-item active">{{__('admin.product_table')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
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

                            <div class="card-content">
                                <div class="my-5 container d-flex justify-content-between">
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="w-100">
                                                <p>{{ $product->getTranslation('name', app()->getLocale()) }}</p>
                                                <p>{{ $product->getTranslation('small_desc', app()->getLocale()) }}</p>
                                                <p>{{ $product->getTranslation('desc', app()->getLocale()) }}</p>
                                                @if (!$product->has_variants)
                                                    <p>EGP {{ number_format($product->price, 2) }}</p>
                                                @endif
                                                <p>{{__('admin.availabe_for')}}: {{ $product->available_for }}</p>
                                                @if (!$product->has_variants)
                                                    <p>{{__('admin.in_stock')}}: {{__('admin.yes')}}</p>
                                                @else
                                                    <p>{{__('admin.in_stock')}}: {{__('admin.no')}}</p>
                                                @endif
                                                <p>{{__('admin.views')}}: {{ $product->views }}</p>
                                                <p>{{__('admin.category')}}:
                                                    {{ $product->category?->getTranslation('name', app()->getLocale())??__('admin.not_found') }}
                                                </p>
                                                <p>{{__('admin.brand')}}:
                                                   {{ $product->brand?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found')}}
                                                </p>
                                            </div>
                                            @if ($product->has_variants == 0)
                                                <p>{{__('admin.pro_has_no_var')}}</p>
                                            @endif

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div id="carouselExampleControlsNoTouching" class="carousel slide"
                                                data-bs-touch="false">
                                                <div class="carousel-inner">
                                                    @forelse ($product->productImages as $index => $img)
                                                         <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/products/' . $img->file_name) }}"
                                                                class="d-block w-100" alt="...">
                                                        </div>
                                                    @empty
                                                     {{__('admin.no_images')}}

                                                    @endforelse

                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExampleControlsNoTouching"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{__('admin.previous')}}</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExampleControlsNoTouching"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{__('admin.next')}}</span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                @if ($product->has_variants)
                                    <div class="row my-3 container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">{{__('admin.price')}}</th>
                                                    <th scope="col">{{__('admin.stock')}}</th>
                                                    <th scope="col">{{__('admin.attributes')}}</th>
                                                    <th scope="col">{{__('categories.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->product_variants as $index => $variant)
                                                    <tr id="var_{{ $variant->id }}">
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>EGP{{ number_format($variant->price, 2) }}</td>
                                                        <td>{{ $variant->stock }}</td>
                                                        <td colspan="15">
                                                            @foreach ($variant->product_attributes as $attr)
                                                                <div class="mx-1">
                                                                    {{ AttributeValue::where('id', $attr->attribute_value_id)->first()->attribute->getTranslation('name', app()->getLocale()) }}:
                                                                    {{ AttributeValue::where('id', $attr->attribute_value_id)->first()->value }}

                                                                </div>
                                                            @endforeach

                                                        </td>

                                                        <td disabled>
                                                            <button class="btn btn-sm btn-danger del"
                                                                id="{{ $variant->id }}"
                                                                @if (count($product->product_variants) == 1) disabled @endif>
                                                                <i class="la la-trash"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>

                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>


                <a href="{{route('products.edit',$product->id)}}" class="btn btn-info" >{{__('admin.edit_pro')}}</a >

            </div>
        </div>
    </div>
    @include('dashboard.partials.footer')
    @include('dashboard.categories.partials.scribts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.del', function() {
            let id = $(this).attr('id');
            let url = "{{ route('variants.delete', ':id') }}"
            url = url.replace(':id', id)
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            toastr.success(data.msg)
                            $(`#var_${id}`).remove()
                            if ($('.del:enabled').length === 1) {
                                $('.del:enabled').prop('disabled', true);
                            }
                        }
                    })
                }
            });



        })
    </script>
</body>

</html>
