@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
$lang=LaravelLocalization::getCurrentLocale()=='ar'?"en":"ar";

@endphp
<head>
    @livewireStyles
    @livewireScripts
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Chartist line chart - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
<meta name="admin-id" content="{{ auth('admin')->user()->id }}">
    + Bitcoin Dashboard</title>

  <link rel="apple-touch-icon" href="{{asset('assets')}}/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- jQuery (إذا لم يكن مضافًا) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/vendors/css/charts/chartist.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->

 @vite([ 'resources/js/app.js']) {{-- هنا --}}
{{-- في أسفل الصفحة قبل إغلاق الـ body --}}


  @if ($lang=='en')
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/app.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/custom-rtl.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style-rtl.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/app.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/custom-rtl.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style-rtl.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css-rtl/vendors.css">
  <!-- END Custom CSS-->
   @else
   <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/app.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/custom.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/app.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/custom.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/vendors.css">
  <!-- END Custom CSS-->
    @endif
          {{-- في قسم الـ head --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />

</head>
