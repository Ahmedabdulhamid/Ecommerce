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
                    <h3 class="content-header-title mb-0 d-inline-block">Countary Table</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Tables</a>
                                </li>
                                <li class="breadcrumb-item active">Countary Table
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
            <div class="content-body">
                <!-- Table row borders end-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Countary Table</h4>
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
                                                <th>{{__('countaries.index')}}</th>
                                                <th>{{__('countaries.Countary')}}</th>
                                                <th>{{__("countaries.flag")}}</th>
                                                <th>{{__('countaries.status')}}</th>
                                                <th>{{__("countaries.Numeric Code")}}</th>
                                                <th>{{__("countaries.governorates")}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($lang == 'en')
                                                @foreach ($countaries as $countary)
                                                    <tr>
                                                        <td>{{ $countaries->firstItem() + $loop->index }}</td>
                                                        <td><a href="{{route('governorates.show',$countary->id)}}" class="text-dark">{{ $countary->getTranslation('name', 'en') }}</a></td>

                                                        <td><i
                                                                class="flag-icon flag-icon-{{ $countary->flag_icon }}"></i>
                                                        </td>
                                                        <td>
                                                            <div class="card-body">
                                                                <input type="checkbox" class="switch"
                                                                    value="{{ $countary->id }}"
                                                                    name="{{ $countary->id }}"
                                                                    id="switch-{{ $countary->id }}"
                                                                    data-group-cls="btn-group-sm"
                                                                    @if ($countary->status == 'active') checked @endif />
                                                                <label for="switch-{{ $countary->id }}"
                                                                    class="switch-label">
                                                                    <span class="yes">{{__('countaries.active')}}</span>
                                                                    <span class="no">{{__("countaries.inactive")}}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $countary->numeric_code }}</td>
                                                        <td>
                                                            @if (count($countary->governorates) > 0)
                                                                {{ count($countary->governorates) }}
                                                            @else
                                                                {{__("countaries.NotFound")}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($countaries as $countary)
                                                    <tr>
                                                        <td>{{ $countaries->firstItem() + $loop->index }}</td>
                                                        <td><a href="{{route('governorates.show',$countary->id)}}" class="text-dark">{{ $countary->getTranslation('name', 'ar') }}</a></td>

                                                        <td><i
                                                                class="flag-icon flag-icon-{{$countary->flag_icon}}"></i>
                                                        </td>
                                                        <td>
                                                            <div class="card-body">
                                                                <input type="checkbox" class="switch"
                                                                    value="{{ $countary->id }}"
                                                                    id="switch-{{ $countary->id }}"
                                                                    name="{{ $countary->id }}"
                                                                    data-group-cls="btn-group-sm"
                                                                    @if ($countary->status == 'active') checked @endif>
                                                                <label for="switch-{{ $countary->id }}"
                                                                    class="switch-label">
                                                                    <span class="yes">{{__("countaries.active")}}</span>
                                                                    <span class="no">{{__("countaries.inactive")}}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $countary->numeric_code }}</td>
                                                        <td>
                                                            @if (count($countary->governorates) > 0)
                                                                {{ count($countary->governorates) }}
                                                            @else
                                                            {{__("countaries.NotFound")}}
                                                            @endif
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
                {{ $countaries->links() }}




            </div>
        </div>
    </div>
    @include('dashboard.partials.footer')

    @include('dashboard.partials.scripts')
    <script>
        $(document).on('change', '.switch', function(e) {
            var id = $(this).attr('name');

            $.ajax({
                url: "{{ route('countaries.edit') }}",
                type: "POST",
                data: {
                    id: id
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(data) {
                    toastr.success("تم تحديث الحالة بنجاح ✅", "نجاح");



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


</body>

</body>

</html>
