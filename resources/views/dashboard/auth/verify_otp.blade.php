@section('title',__('admin.email_verification_page'))
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
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>We will send you a link to reset password.</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.verify_otp.post')}}"  method="POST">
                    @csrf
                    @method('post')
                      <input type="hidden" name="email" value="">


                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control form-control-lg input-lg" name="otp" id="user-email"
                        placeholder="Your OTP" >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                     @error('otp')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </fieldset>
                      <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i>Submit22</button>
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
