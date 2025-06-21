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
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center">Update Brand</h4>
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

                        <form class="form"method="POST" action="{{route('brands.update',$brand->slug)}}" enctype="multipart/form-data">
                            @method('PUT')

                            @csrf

                            <div class="form-body">
                                <div class="form-group">
                                    <label for="eventRegInput1">{{__("brand.name_en")}}</label>
                                    <input type="text"
                                    id="eventRegInput1"value="{{ $brand->getTranslation('name', 'en') }}"
                                    class="form-control"name="name[en]">

                                </div>

                                <div class="form-group">
                                    <label for="eventRegInput2">{{__("brand.name_ar")}}</label>
                                    <input type="text" id="eventRegInput2"
                                        value="{{ $brand->getTranslation('name', 'ar') }}" class="form-control"
                                        name="name[ar]">

                                </div>
                                <div class="form-group">
                                    <label for="eventRegInput2">{{__('brand.upload_logo')}}</label>
                                    <input type="file" id="eventRegInput2"
                                         class="form-control"
                                        name="logo">

                                </div>




                            </div>
                            <div class="form-actions center">

                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Edit
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
