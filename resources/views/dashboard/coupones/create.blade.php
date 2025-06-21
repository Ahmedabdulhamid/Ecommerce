@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
<!DOCTYPE html>
<html lang="en">
@livewireStyles

@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')

    <div class="app-content content mt-5">
        <div class="breadcrumb-wrapper col-12 my-5">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active"><a href="{{ url('admin/coupones') }}">Coupons Tables</a></li>

            </ol>
        </div>
        <form class="my-5 w-75 container" id="coupon_form" method="POST">
            @csrf
            @method('POST')
            <div class="form-body">
                <div class="form-group">
                    <label for="code">{{ __('coupons.code') }}</label>
                    <input type="number" id="code" class="form-control">

                </div>

                <div class="form-group">
                    <label for="discount_precentage">{{ __('coupons.discount_precentage') }} </label>
                    <input type="number" id="discount_precentage" class="form-control">

                </div>
                <div class="form-group">
                    <label for="start_at">{{ __('coupons.start_at') }}</label>
                    <input type="date" class="form-control" id="start_at"style="direction:rtl;">

                </div>
                <div class="form-group">
                    <label for="end_at">{{ __('coupons.end_at') }}</label>
                    <input type="date" class="form-control" id="end_at"style="direction:rtl;">
                </div>
                <div class="form-group">
                    <label for="limit">{{ __('coupons.limit') }}</label>
                    <input type="number" class="form-control"id="limit">
                </div>


                <div class="form-group">
                    <label>{{ __('categories.status') }}</label>
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" value="active" class="custom-control-input"
                                id="yes1">
                            <label class="custom-control-label" for="yes1">{{ __('countaries.active') }}</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="status" value="inactive" class="custom-control-input"
                                id="no1">
                            <label class="custom-control-label" for="no1">{{ __('countaries.inactive') }}</label>
                        </div>
                    </div>

                </div>

            </div>
            <div class="form-actions center">

                <button type="submit" class="btn btn-primary">
                    Create
                </button>
            </div>

        </form>



    </div>
    @include('dashboard.partials.footer')
    @include('dashboard.categories.partials.scribts')
    @include('dashboard.coupones.scribts')
    <script>
        $(document).on('submit', '#coupon_form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('coupons.store') }}",
                type: "post",
                data: {

                    'code': $('#code').val(),
                    'discount_precentage': $('#discount_precentage').val(),
                    'start_at': $('#start_at').val(),
                    'end_at': $('#end_at').val(),
                    'limit': $('#limit').val(),
                    'status': $('input[name="status"]:checked').val(),

                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(data) {

                    toastr.success(data.message)
                    $('#coupon_form')[0].reset();
                    $('.coupon-bar').html(data.count);

                },
                error: function(reject) {
                    var response = JSON.parse(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        toastr.error(value);
                    });
                }
            })

        })
    </script>
</body>

</html>
