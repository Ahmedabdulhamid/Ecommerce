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

    <div class="app-content content mt-5">
        <div class="breadcrumb-wrapper col-12 my-5">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="#">Home</a>
                </li>

                <li class="breadcrumb-item active"><a href="#">Pages Tables</a></li>

            </ol>
        </div>
        <form class="my-5 w-75 container" id="coupon_form" method="POST" action="{{route('pages.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-body">
                <div class="form-group">
                    <label for="title_ar">{{ __('sliders.titel_ar') }}</label>
                    <input type="text" id="title_ar" class="form-control"name="title[ar]">

                </div>
                @error('title.ar')
                 <span class="text-danger">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <label for="title_en">{{ __('sliders.titel_en') }} </label>
                    <input type="text" id="title_en" class="form-control" name="title[en]">

                </div>
                @error('title.en')
                <span class="text-danger">{{$message}}</span>
               @enderror
                <div class="form-group">
                    <label>{{ __('sliders.contect_ar') }}</label>
                    <textarea id="summernote_ar" class="container"name="content[ar]">{{ old('content.ar') }}</textarea>
                </div>
                @error('content.ar')
                <span class="text-danger">{{$message}}</span>
               @enderror
                <div class="form-group">
                    <label>{{ __('sliders.content_en') }}</label>
                    <textarea id="summernote_en" class="container" style="direction: ltr;"name="content[en]">{{ old('content.en') }}</textarea>
                </div>
                @error('content.en')
                <span class="text-danger">{{$message}}</span>
               @enderror

                <div class="form-group">
                    <label>{{ __('sliders.Images') }}</label>
                    <div class="input-group">


                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="file" class="dropify" data-height="200"name="image" />
                        </div>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                       @enderror

                    </div>

                </div>

            </div>
            <div class="form-actions center">

                <button type="submit" class="btn btn-primary">
                    Create
                </button>
                <button type="button" class="btn btn-warning mr-1 text-white">
                    <i class="la la-remove"></i> Cancel
                </button>
            </div>

        </form>



    </div>

    <script>
        $('#summernote_ar').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#summernote_en').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    @include('dashboard.categories.partials.scribts')

</body>

</html>
