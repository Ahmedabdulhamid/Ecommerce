<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{trans('admin.attributes_table')}}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                        </li>

                        <li class="breadcrumb-item active">{{trans('admin.attributes_table')}}
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
                        <h4 class="card-title">{{ __('admin.attributes_table') }}</h4>

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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">{{trans('admin.create_attr')}}</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                             @livewire('admin.attributes.create-data')

                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 "id="attribute_table">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.actions')}}</th>

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
