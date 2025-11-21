@section('title',__('front.register_page'))
<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layouts.head')

    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>

    <style>
        .google-btn {
            display: inline-flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            padding: 8px 16px;
            text-decoration: none;
            transition: box-shadow 0.3s ease;
            font-family: Roboto, Arial, sans-serif;
        }

        .google-btn:hover {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
        }

        .google-icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 50%;
            margin-right: 12px;
        }

        .google-icon {
            width: 18px;
            height: 18px;
        }

        .btn-text {
            font-size: 14px;
            color: #757575;
            font-weight: 500;
        }
    </style>
</head>

<body style="@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')

    <div
        style="
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('front-assets/images/homepage-one/login-bg.webp') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            width: 100vw;
        "
    >

        {{-- محتوى Livewire اللي فيه الفورم --}}
        @livewire('create-account')

        @include('front.layouts.footer')
        @include('front.layouts.script')
    </div>


</body>
</html>
