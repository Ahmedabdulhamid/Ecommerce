@php
    use Flasher\Prime\FlasherInterface;
@endphp

<!DOCTYPE html>
<html lang="en">

@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="row d-flex justify-content-end container mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Brand Table</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                    </li>

                                    <li class="breadcrumb-item active"><a href="{{route('brands.index')}}">Brand Table</a>
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
                <div class="card-header">

                    <h4 class="card-title" id="basic-layout-card-center">Create Breand</h4>
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
                <div class="card-content collapse show">
                    <div class="card-body">

                        <form class="form"method="POST" action="{{route('brands.store')}}" enctype="multipart/form-data">

                            @csrf

                            <div class="form-body">
                                <div class="form-group">
                                    <label for="eventRegInput1">{{__("brand.name_en")}}</label>
                                    <input type="text" id="eventRegInput1" class="form-control"name="name[en]">

                                </div>

                                <div class="form-group">
                                    <label for="eventRegInput2">{{__("brand.name_ar")}} </label>
                                    <input type="text" id="eventRegInput2" class="form-control" name="name[ar]">

                                </div>
                                <div class="form-group">
                                    <label >{{__("brand.upload_logo")}}</label>
                                    <input type="file"  class="form-control" name="logo">

                                </div>


                                <div class="form-group">
                                    <label>{{ __('categories.status') }}</label>
                                    <div class="input-group">
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" name="status" value="active"
                                                class="custom-control-input" id="yes1">
                                            <label class="custom-control-label"
                                                for="yes1">{{ __('countaries.active') }}</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio">
                                            <input type="radio" name="status"value="Inactive"
                                                class="custom-control-input" id="no1">
                                            <label class="custom-control-label"
                                                for="no1">{{ __('countaries.inactive') }}</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-actions center">

                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.partials.footer')
    @include('dashboard.categories.partials.scribts')
</body>

</html>
