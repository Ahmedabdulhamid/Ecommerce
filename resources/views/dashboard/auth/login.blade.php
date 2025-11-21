@section('title',__('admin.login_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

@include("dashboard.auth.partials.head")
<body class="vertical-layout vertical-menu-modern 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <!-- fixed-top-->
  @include("dashboard.auth.partials.nav")

  <div class="app-content content my-5">
    <div class="content-wrapper my-5">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="{{asset('assets')}}/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>{{__('auth.login')}}</span>
                  </h6>
                </div>
                <div class="card-content py-3">
                  <div class="card-body">
                    @if (session()->has("err_cre"))
                     <div class="alert alert-danger">
                      {{session()->get("err_cre")}}
                     </div>
                    @endif
                    <form class="form-horizontal" action="{{route('admin.login')}}"method="POST">
                        @csrf
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" name="email" id="user-name" placeholder="{{__('auth.your_email')}}"
                       >
                       @error('email')
                       <span class="text-danger">{{$message}}</span>
                       @enderror
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="{{__('auth.your_password')}}"
                        >
                        @error('password')
                       <span class="text-danger">{{$message}}</span>
                       @enderror
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" name="remember" class="chk-remember">
                            <label for="remember-me"> {{__('auth.remember me')}}</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="{{route('admin.recover-password')}}" class="card-link">{{__('auth.forget_password')}}?</a></div>
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                      </div>
                      @error('g-recaptcha-response')
                       <span class="text-danger">{{$message}}</span>
                       @enderror
                      <button type="submit" class="btn btn-danger btn-block btn-lg"><i class="ft-unlock"></i>{{__('auth.login')}}</button>
                    </form>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                  </div>
                </div>
                <div class="card-dashboard border-0">


                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
   <div class="mt-5">
     @include("dashboard.auth.partials.footer")
   </div>

  <!-- BEGIN VENDOR JS-->

  @include("dashboard.auth.partials.scripts")
</body>
</html>
