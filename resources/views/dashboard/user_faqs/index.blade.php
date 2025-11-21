@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;
@endphp
@section('title',__('admin.user_ques_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">


    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('admin.user_question_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a>
                                </li>


                            </ol>
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
                                <h4 class="card-title">{{ __('admin.user_question_table') }}</h4>
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
                                        <table class="table mb-0 "id="UserFaq_table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('admin.name') }}</th>
                                                    <th>{{ __('admin.email') }}</th>

                                                    <th>{{ __('admin.subject') }}</th>
                                                    <th>{{ __('admin.created_at') }}</th>






                                                </tr>

                                            </thead>
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
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
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

        <!-- Bootstrap & Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- JSZip (Excel export dependency) -->
        <script src="{{ asset('vendor/excel/jszip.js') }}"></script>
        <script src="{{ asset('vendor/excel/jszip.min.js') }}"></script>
        <script>
            $('#UserFaq_table').DataTable({
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
                ajax: "{{ route('user-faqs.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        defaultContent: '<i class="la la-plus-circle"></i>',
                        className: 'dt-control',
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
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },



                ],
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: ['colvis', 'print', 'copyHtml5', 'excelHtml5', 'pdfHtml5'],
                language: {
                    url: "{{ app()->getLocale() == 'ar' ? '//cdn.datatables.net/plug-ins/1.11.5/i18n/Arabic.json' : '' }}"
                }
            });

            $('#UserFaq_table tbody').on('click', 'td.dt-control', function() {
                var table = $('#UserFaq_table').DataTable();
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
        <table class="table table-bordered">

             <tr><td><strong>{{ __('admin.message') }}:</strong></td><td>${data.message}</td></tr>
            <tr><td><strong>{{ __('categories.actions') }}:</strong></td><td>${data.actions}</td></tr>

        </table>
    `;
            }
        </script>
</body>

</html>
