
@section('title',__('admin.reset_password_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.auth.partials.head')
<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
@include("dashboard.auth.partials.nav")
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <img src="{{asset('assets')}}/images/logo/logo-dark.png" alt="branding logo">
                  </div>

                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.post.reset_password')}}" novalidate method="POST">
                      @csrf

                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="hidden"name="token" value="{{$token}}">
                        <input type="password" class="form-control form-control-lg input-lg" name="password" id="user-email"
                        placeholder="{{__('admin.enter_new_password')}}" >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                       @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg" name="password_confirmation" id="user-email"
                        placeholder="{{__('admin.confirm_password')}}" >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                        @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </fieldset>

                      <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i>{{__('admin.reset_password_page')}}</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  @include('dashboard.auth.partials.scripts')
  <!-- END PAGE LEVEL JS-->
</body>
</html>
