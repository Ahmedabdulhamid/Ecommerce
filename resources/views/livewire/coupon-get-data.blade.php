<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Coupon Table</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Tables</a>
                        </li>
                        <li class="breadcrumb-item active">Coupon Table
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="dropdown float-md-right">
                <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
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
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('categories.Coupon_table') }}</h4>

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
                            <a href="{{ route('coupons.create') }}"class="btn btn-primary ">Create Coupon</a>

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

