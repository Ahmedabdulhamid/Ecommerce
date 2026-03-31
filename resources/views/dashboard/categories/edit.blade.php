@php
    use Flasher\Prime\FlasherInterface;
@endphp
@section('title',__('admin.edit_categories_page'))
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
                    <h4 class="card-title" id="basic-layout-card-center">{{__('admin.update_cat')}}</h4>
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

                        <form class="form"method="POST" action="{{route('categories.update',$category->slug)}}">
                            @method('PUT')

                            @csrf

                            <div class="form-body">
                                <div class="form-group">
                                    <label for="eventRegInput1">{{__('admin.name_in_en')}}</label>
                                    <input type="text"
                                    id="eventRegInput1"value="{{ $category->getTranslation('name', 'en') }}"
                                    class="form-control"name="name[en]">

                                </div>

                                <div class="form-group">
                                    <label for="eventRegInput2">{{__('admin.name_in_ar')}} </label>
                                    <input type="text" id="eventRegInput2"
                                        value="{{ $category->getTranslation('name', 'ar') }}" class="form-control"
                                        name="name[ar]">

                                </div>
                                <label for="">{{__('admin.select_cat')}}</label>
                                <select class="form-select form-select-lg mb-3" @selected(true) name="parent_id"
                                    aria-label="Default select example">
                                    @if (!isset($category->parent_id))
                                        <option value="">{{__('admin.main_cat')}}</option>
                                        @else
                                        <option value="{{ $category->parent_id }}" selected>{{ $category->parent?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found') }}</option>

                                    @endif
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @if ($cat->parent_id==$category->id)
                                           selected
                                        @endif>
                                            {{ $cat->getTranslation('name', app()->getLocale()) }}


                                        </option>
                                    @endforeach
                                </select>



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
