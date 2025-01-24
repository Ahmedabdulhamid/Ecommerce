<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.partials.head')
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  @include('dashboard.partials.nav')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('dashboard.partials.sideBar')
  
  <!-- ////////////////////////////////////////////////////////////////////////////-->
   @include('dashboard.partials.footer')
  <!-- BEGIN VENDOR JS-->
 @include('dashboard.partials.scripts')
  <!-- END PAGE LEVEL JS-->
</body>
</html>