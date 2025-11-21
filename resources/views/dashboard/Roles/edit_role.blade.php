@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();
    use Flasher\Prime\FlasherInterface;
@endphp
@section('title', __('admin.edit_roles_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    @include('dashboard.partials.nav')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('dashboard.partials.sideBar')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('admin.edit_role') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a>
                                </li>

                                <li class="breadcrumb-item active"><a
                                        href="{{ route('roles.index') }}">{{ __('admin.roles_table') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ __('admin.edit_role') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        {!! Flasher::render() !!}
                                        <form class="form w-100" action="{{ route('roles.update', $role->id) }}"
                                            method="POST">
                                            @method('PUT')

                                            @csrf
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    {!! Flasher::render() !!}
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-body w-100">



                                                        <div class="form-group w-100"style="width:100%">
                                                            <label for="userinput5">{{ __('admin.name_in_ar') }}
                                                            </label>
                                                            <input class="form-control border-primary w-100"
                                                                type="text"
                                                                value=" {{ $role->getTranslation('name', 'en') }}"
                                                                id="userinput5" name='role[en]' style="width:100%">
                                                        </div>
                                                        <div class="form-group px-3">
                                                            @if ($lang == 'en')
                                                                @foreach ($permissions as $permission)
                                                                    <input type="checkbox" class="checkbox  px-3"
                                                                        @checked($role->hasPermissionTo($permission->getTranslation('name', 'en')))
                                                                        name="permissions[]"value="{{ $permission->id }}">
                                                                    <label
                                                                        for="">{{ $permission->getTranslation('name', 'en') }}</label>
                                                                @endforeach
                                                            @else
                                                                @foreach ($permissions as $permission)
                                                                    <input type="checkbox" class="checkbox px-3"
                                                                        @checked($role->hasPermissionTo($permission->getTranslation('name', 'ar')))
                                                                        name="permissions[]"value="{{ $permission->id }}">
                                                                    <label
                                                                        for="">{{ $permission->getTranslation('name', 'ar') }}</label>
                                                                @endforeach
                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-body w-100">



                                                        <div class="form-group w-100"style="width:100%">
                                                            <label
                                                                for="userinput5">{{ __('admin.name_in_ar') }}</label>
                                                            <input class="form-control border-primary w-100"
                                                                type="text"
                                                                value=" {{ $role->getTranslation('name', 'ar') }}"
                                                                id="userinput5" style="width:100%"name='role[ar]'>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="form-actions right text-center">

                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i>
                                                        {{ __('admin.save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
            </div>



            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
    </div>

    @include('dashboard.partials.footer')

    < @include('dashboard.partials.scripts') </body>

</html>
