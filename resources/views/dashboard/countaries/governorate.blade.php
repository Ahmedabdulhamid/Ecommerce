@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.partials.head')
<style>
    /* إخفاء الـ checkbox */
    .switch {
        display: none;
    }

    /* تصميم الـ switch container */
    .switch-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        width: 120px;
        height: 30px;
        background: #dc3545;

        border-radius: 50px;
        position: relative;
        transition: background 0.3s ease;
        padding: 2px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }

    /* نص الـ YES / NO */
    .switch-label span {
        position: absolute;
        width: 100%;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .switch-label .yes {
        opacity: 0;
    }

    .switch-label .no {
        opacity: 1;
    }

    /* تصميم النقطة المتحركة */
    .switch-label::before {
        content: "";
        position: absolute;
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        top: 50%;
        left: 2px;
        transform: translateY(-50%);
        transition: 0.3s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* عند تفعيل الـ switch */
    .switch:checked+.switch-label {
        background: #28a745;
        /* اللون الأخضر (YES) */
    }

    .switch:checked+.switch-label::before {
        left: calc(100% - 28px);
    }

    .switch:checked+.switch-label .yes {
        opacity: 1;
    }

    .switch:checked+.switch-label .no {
        opacity: 0;
    }
</style>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">governorate Table</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('countaries.index') }}">Countries</a>
                                </li>
                                <li class="breadcrumb-item active">Governorates Table
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="dropdown float-md-right">
                        <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
                            type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Actions</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item"
                                href="#"><i class="la la-calendar-check-o"></i> Calender</a>
                            <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
                            <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                    class="la la-cog"></i> Settings</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body container">
                <!-- Table row borders end-->
                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Governorate Table</h4>{{--  <form action="{{ route('governorates.searchByGovernorates') }}" method="post">
                                    <input type="hidden"name="id" value="{{ $country->id }}">
                                    @csrf
                                    <input type="search" name="search" placeholder="{{ __('countaries.search') }}"
                                        style="width: 50%;height:40px" name="search" class="search">
                                    <button class="btn btn-primary" type="submit">ابحث</button>

                                </form> --}}

                                {{-- Start Search input --}}
                                <input type="search" name="search" placeholder="{{ __('countaries.search') }}"
                                    style="width: 50%;height:40px" name="search" class="search">
                                <button class="btn btn-primary" type="submit">ابحث</button>
                                {{-- end Search input --}}

                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('countaries.index') }}</th>
                                                <th>{{ __('countaries.governorate') }}</th>
                                                <th>{{ __('countaries.flag') }}</th>
                                                <th>{{ __('countaries.status') }}</th>
                                                <th>{{ __('countaries.price') }}</th>
                                                <th>{{ __('countaries.edit_charge') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($lang == 'en')
                                                @foreach ($country->governorates as $governorate => $value)
                                                    <tr>
                                                        <td>{{ ++$governorate }}</td>
                                                        <td><a href=""
                                                                class="text-dark">{{ $value->getTranslation('name', 'en') }}</a>
                                                        </td>

                                                        <td><i
                                                                class="flag-icon flag-icon-{{ $country->flag_icon }}"></i>
                                                        </td>
                                                        <td>
                                                            <div class="card-body">
                                                                <input type="checkbox" class="switch"
                                                                    value="{{ $value->id }}"
                                                                    name="{{ $value->id }}"
                                                                    id="switch-{{ $value->id }}"
                                                                    data-group-cls="btn-group-sm"
                                                                    @if ($value->status == 'active') checked @endif />
                                                                <label for="switch-{{ $value->id }}"
                                                                    class="switch-label">
                                                                    <span
                                                                        class="yes">{{ __('countaries.active') }}</span>
                                                                    <span
                                                                        class="no">{{ __('countaries.inactive') }}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="td_price-{{ $value->id }}">
                                                            {{ $value->price }}
                                                        </td>
                                                        <td><!-- Button trigger modal -->
                                                            @include('dashboard.partials.modal')
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($country->governorates as $governorate => $value)
                                                    <tr>
                                                        <td>{{ ++$governorate }}</td>
                                                        <td><a href=""
                                                                class="text-dark">{{ $value->getTranslation('name', 'ar') }}</a>
                                                        </td>
                                                        <td><i
                                                                class="flag-icon flag-icon-{{ $country->flag_icon }}"></i>
                                                        </td>

                                                        <td>
                                                            <div class="card-body">
                                                                <input type="checkbox" class="switch"
                                                                    value="{{ $value->id }}"
                                                                    id="switch-{{ $value->id }}"
                                                                    name="{{ $value->id }}"
                                                                    data-group-cls="btn-group-sm"
                                                                    @if ($value->status == 'active') checked @endif>
                                                                <label for="switch-{{ $value->id }}"
                                                                    class="switch-label">
                                                                    <span
                                                                        class="yes">{{ __('countaries.active') }}</span>
                                                                    <span
                                                                        class="no">{{ __('countaries.inactive') }}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="td_price-{{ $value->id }}">
                                                            {{ $value->price }}
                                                        </td>

                                                        <td><!-- Button trigger modal -->
                                                            @include('dashboard.partials.modal')
                                                        </td>


                                                    </tr>
                                                @endforeach
                                            @endif



                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
    @include('dashboard.partials.footer')

    @include('dashboard.partials.scripts')
    {{--

    <script>
        let locale = '{{ app()->getLocale() }}';
        $(document).on("input", '.search', function() {

            console.log($(this).val());


            let locale = '{{ app()->getLocale() }}'; // الحصول على اللغة الحالية من Laravel

            $.ajax({
                url: `/${locale}/admin/countaries/governorates/${$(this).val()}`, // استخدم اللغة الحالية
                type: "GET",
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });


        })
    </script>
   --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        $(document).on('change', '.switch', function(e) {
            var id = $(this).attr('name');
            console.log(id);

            $.ajax({
                url: "{{ route('governorates.edit') }}",
                type: "POST",
                data: {
                    id: id,

                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(data) {
                    toastr.success("تم تحديث الحالة بنجاح ✅", "نجاح");

                    console.log(data);


                },
                error: function(xhr) {
                    toastr.error("حدث خطأ أثناء التحديث ❌", "خطأ");

                }
            });
        });
        toastr.options = {
            "closeButton": true, // زر الإغلاق
            "progressBar": true, // شريط التقدم
            "positionClass": "toast-top-right", // موقع الإشعار
            "timeOut": "5000", // مدة الإشعار قبل الإغلاق
            "extendedTimeOut": "2000"
        };
    </script>
    <script>
       $(document).on('input', '.search', function () {
    let search = $(this).val();
    console.log(search);

    $.ajax({
        url: "{{ route('governorates.search') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            key: search,
        },
        success: function (data) {


            $('.table-responsive').html(data);
        },
        error: function (error) { // هنا كان الخطأ
            console.log(error);
        }
    });
});

    </script>
    <script>
        let price = $('.myForm .price')

        $(document).on('submit', ".myForm", function(e) {
            e.preventDefault()
            let data = new FormData($(this)[0]);
            let id = $(this).attr('data_id');


            $.ajax({
                url: "{{ route('governoratesPrice.edit') }}",
                type: "POST",
                data: {
                    id: id,
                    price: data.get("price")
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(data) {
                    toastr.success(data.msgPriceShipping);
                    console.log(data.data);

                    $(`.td_price-${data.data.id}`).html(data.data.price)

                }
            })



        })
    </script>





</body>

</html>
