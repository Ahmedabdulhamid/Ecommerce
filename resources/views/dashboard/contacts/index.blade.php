@section('title',__('admin.contacts_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    @include('dashboard.categories.partials.head')
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application  menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
  <!-- fixed-top-->
  @include('dashboard.partials.nav')
  @include('dashboard.partials.sideBar')
  <div class="app-content content">
    <div class="sidebar-left">
      <div class="sidebar w-100">
        <div class="sidebar-content email-app-sidebar d-flex">
              @livewire('admin.contacts.contact-message-sidebar')
            <div class="email-app-list-wraper col-md-6 card p-0">
                @livewire('admin.contacts.contact-message')
            </div>
          </div>
      </div>
    </div>
    @livewire('admin.contacts.contact-show')
  </div>
  @include('dashboard.partials.footer')
  @include('dashboard.categories.partials.scribts')
</body>
</html>
