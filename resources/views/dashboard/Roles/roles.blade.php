@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;
@endphp
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">


    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic Tables</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Tables</a>
                                </li>
                                <li class="breadcrumb-item active "><a href="{{ route('roles.create') }}" class="btn btn-primary">Add Role</a>
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
                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Tables</h4>
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

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th>Roles</th>
                                                    <th>Permissions</th>
                                                    <th>Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        @if ($lang == 'en')
                                                            <td>{{ $role->getTranslation('name', 'en') }}</td>
                                                            @foreach ($role->permissions as $permission)
                                                                <td style="display: inline-block" class="w-25">
                                                                    {{ $permission->getTranslation('name', 'en') }}</td>
                                                            @endforeach
                                                            <td class="">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                       {{__('buttons.operation')}}
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item"
                                                                                href="{{ route('roles.show', $role->id) }}">Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <li>
                                                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                                                    @csrf @method('DELETE')
                                                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm">Delete</button>
                                                                                </form>
                                                                            </li>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td>{{ $role->getTranslation('name', 'ar') }}</td>
                                                            @foreach ($role->permissions as $permission)
                                                                <td style="display: inline-block" class="w-25"
                                                                    style="font-size: 10px">
                                                                    {{ $permission->getTranslation('name', 'ar') }}</td>
                                                            @endforeach
                                                            <td class="">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        {{__('buttons.operation')}}
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item"
                                                                                href="{{ route('roles.show', $role->id) }}">Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                                                @csrf @method('DELETE')
                                                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                                            </form>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        @endif


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





            </div>
        </div>
    </div>

    @include('dashboard.partials.footer')
    <!-- BEGIN VENDOR JS-->
    < @include('dashboard.partials.scripts') </body>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>

</body>

</html>
