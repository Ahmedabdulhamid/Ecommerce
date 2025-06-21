<!DOCTYPE html>
<html lang="en">
@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Brand Table</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Tables</a>
                                </li>
                                <li class="breadcrumb-item active">Brand Table
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
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <h4 class="card-title">{{ __('categories.Brand_table') }}</h4>

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
                                    <a href="{{ route('brands.create') }}"class="btn btn-primary ">Create
                                        Brand</a>
                                    <a href="{{ url()->current() }}"class="btn btn-danger ">Recycle Bin</a>

                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0 ">
                                        <thead>
                                            <tr>
                                                <th>{{ __('categories.index') }}</th>
                                                <th>{{ __('categories.name') }}</th>
                                                <th>{{ __('categories.status') }}</th>
                                                <th>{{ __('categories.actions') }}</th>

                                            </tr>

                                        </thead>

                                        <tbody>
                                            @if (!empty($brands) && count($brands) > 0)
                                                @foreach ($brands as $brand => $value)
                                                    <tr>
                                                        <td>{{ ++$brand }}</td>
                                                        <td>{{ $value->getTranslation('name', app()->getLocale()) }}
                                                        </td>
                                                        <td>
                                                            @if ($value->status == 'active')
                                                                {{ __('countaries.active') }}
                                                            @else
                                                                {{ __('countaries.inactive') }}
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <a class="btn btn-sm btn-outline-success"
                                                                href="{{ route('brands.restore', $value->id) }}">Restore</a>
                                                            <form action="{{ route('brands.delete',$value->id) }}"
                                                                id="deleteForm-{{ $value->id }}" class="d-inline">
                                                                <button class="btn btn-sm btn-outline-danger delete-btn"
                                                                data-id="{{ $value->id }}"
                                                                >Final
                                                                    Delete
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">No brands found</td>
                                                </tr>
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
    @include('dashboard.categories.partials.scribts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault()
            let brand_id = $(this).attr('data-id')
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it! ",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#deleteForm-${brand_id}`).submit()
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
        })
    </script>
</body>

</html>
