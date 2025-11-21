<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{__('admin.coupons_table')}}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.home')}}</a>
                        </li>

                        <li class="breadcrumb-item active">{{__('admin.coupons_table')}}
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
                        <h4 class="card-title">{{ __('admin.coupons_table') }}</h4>

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
                            <a href="{{ route('coupons.create') }}"class="btn btn-primary ">{{__('admin.create_coupon')}}</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 "id="Coupon_table">
                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('coupons.code') }}</th>
                                        <th>{{ __('coupons.discount_precentage') }}</th>
                                        <th>{{ __('coupons.start_at') }}</th>
                                        <th>{{ __('coupons.end_at') }}</th>
                                        <th>{{ __('coupons.limit') }}</th>
                                        <th>{{ __("countaries.status") }}</th>
                                        <th>{{ __('coupons.time_used') }}</th>
                                        <th>{{ __('categories.actions') }}</th>
                                    </tr>

                                    </tr>

                                </thead>

                                <body>

                                </body>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>

