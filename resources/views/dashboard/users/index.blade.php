@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">User Table</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Tables</a>
                                </li>
                                <li class="breadcrumb-item active">User Table
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
                                <h4 class="card-title">{{ __('categories.User_table') }}</h4>

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
                                    <button class="btn btn-primary "data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Create User</button>
                                    @livewire('admin.users.create-user')

                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0 "id="User_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('users.name') }}</th>
                                                <th>{{ __('users.email') }}</th>
                                                <th>{{ __('users.email_verification') }}</th>
                                                <th>{{ __('categories.status') }}</th>

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
    </div>
    @include('dashboard.partials.footer')
    @include('dashboard.categories.partials.scribts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- JS Buttons -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/excel/jszip.js') }}"></script>
    <script src="{{ asset('vendor/excel/jszip.min.js') }}"></script>
    <script>
        $('#User_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            colReorder: true,
            rowReorder: {
                update: false,
                selector: "td:not(:first-child)"
            },
            select: true,
            scrollY: 200,
            deferRender: true,
            scroller: true,
            ajax: "{{ route('users.getData') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'dt-control',
                    orderable: false,
                    defaultContent: '<i class="la la-plus-circle"></i>',
                    responsivePriority: 1 // إجعل هذا العمود دائم الظهور
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'email_verification',
                    name: 'email_verification'
                },
                {
                    data: 'status',
                    name: 'status'
                }
            ],
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: ['colvis', 'print', 'copyHtml5', 'excelHtml5', 'pdfHtml5'],
            language: {
                url: "{{ app()->getLocale() == 'ar' ? '//cdn.datatables.net/plug-ins/1.11.5/i18n/Arabic.json' : '' }}"
            }
        });

        // دالة لإظهار التفاصيل عند الضغط على الصف
        $('#User_table tbody').on('click', 'td.dt-control', function() {
            var table = $('#User_table').DataTable();
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // إذا كانت التفاصيل ظاهرة، قم بإخفائها
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // عرض التفاصيل
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        // دالة تنسيق التفاصيل المخفية
        function format(data) {
            return `
        <table class="table d-sm-block  ">

            <tr><td><strong>{{ __('users.country') }}:</strong></td><td>${data.country}</td></tr>

            <tr><td><strong>{{ __('users.governorate') }}:</strong></td><td>${data.governorate}</td></tr>

            <tr><td><strong>{{ __('categories.actions') }}:</strong></td><td>${data.action}</td></tr>

        </table>
    `;
        }
    </script>
    <script>
        window.addEventListener('createdUser', () => {
            $('#User_table').DataTable().ajax.reload(null, false);

        })
    </script>
    <script>
        window.addEventListener('hideModal', () => {
           $('#exampleModal').modal('hide')
           let modal = bootstrap.Modal.getInstance(document.getElementById(`#exampleModal`));
        if (modal) {
            modal.hide();
        }

        // إزالة الخلفية المظللة
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto';

        })
    </script>
    <script>
        $(document).on('click','.del',function(){
           let id=$(this).attr('del_id')
           let url="{{route('users.destroy',':id')}}"
           url=url.replace(':id',id)
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
                    $.ajax({

                        url: url,
                        type: "DELETE",
                        data: {
                            '_token': "{{ csrf_token() }}",

                        },
                        success: function(data) {
                           toastr.success(data.msg)
                           $('.users-bar').html(data.count)
                          $('#User_table').DataTable().ajax.reload(null, false);

                        }

                    })

                }
            });


        })
    </script>
    <script>
         $(document).on('click', '.change_status', function() {
            let id = $(this).attr('id')
            console.log(id);

            let url = "{{ route('users.changestatus', ':id') }}"
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {

                    toastr.success(data.msg)
                    $('#User_table').DataTable().ajax.reload(null, false);
                }
            });

        })
    </script>


</body>

</html>
