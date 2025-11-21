@php
    use Flasher\Prime\FlasherInterface;
@endphp
@section('title',__('admin.create_categories_page'))
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
                    <h4 class="card-title" id="basic-layout-card-center">{{__('admin.create_cat')}}</h4>
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

                        <form class="form"method="POST" action="{{ route('categories.store') }}">

                            @csrf

                            <div class="form-body">
                                <div class="form-group">
                                    <label for="eventRegInput1">{{__('admin.name_in_en')}}</label>
                                    <input type="text" id="eventRegInput1" class="form-control"name="name[en]">
                                    @error('name*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="eventRegInput2">{{__('admin.name_in_ar')}} </label>
                                    <input type="text" id="eventRegInput2" class="form-control" name="name[ar]">
                                    @error('name.ar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="">{{__('admin.select_cat')}}</label>
                                <select class="form-select form-select-lg mb-3" name="parent_id"
                                    aria-label="Default select example">
                                    <option value="">we don't need main category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->getTranslation('name', app()->getLocale()) }}</option>
                                    @endforeach
                                </select>


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
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

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
