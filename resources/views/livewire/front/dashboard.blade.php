<div class="col-lg-12">
    <div class="info-section">
        <div class="seller-info">
            <h5 class="heading">Personal Information</h5>
            <div class="info-list">
                <div class="info-title">
                    <p>Name:</p>
                    <p>Email:</p>
                    <p>Phone:</p>
                    <p>Country:</p>
                    <p>Governorate:</p>
                </div>
                <div class="info-details">
                    <p>{{ Auth::guard('web')->user()->name }}</p>
                    <p><a href="https://quomodothemes.website/cdn-cgi/l/email-protection" class="__cf_email__"
                            data-cfemail="cbafaea6a4aea6aaa2a78baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                    </p>
                    @if (Auth::guard('web')->user()->phone == null)
                        <p>Not Found</p>
                    @else
                        <p>{{ Auth::guard('web')->user()->phone }}</p>
                    @endif

                    @if (Auth::guard('web')->user()->country_id == null)
                        <p>Not Found</p>
                    @else
                        <p>{{ $country->getTranslation('name', app()->getLocale()) }}
                        </p>
                    @endif
                    @if (Auth::guard('web')->user()->governorate_id == null)
                        <p>Not Found</p>
                    @else
                        <p>
                            {{ $governorate->getTranslation('name', app()->getLocale()) }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="devider"></div>
        <div class="shop-info">
            <h5 class="heading">Shop Information</h5>
            <div class="info-list">
                <div class="info-title">
                    <p>Name:</p>
                    <p>Email:</p>
                    <p>Phone:</p>

                </div>
                <div class="info-details">
                    <p>ShopUs Super-Shop</p>
                    <p><a href="https://quomodothemes.website/cdn-cgi/l/email-protection" class="__cf_email__"
                            data-cfemail="2a4e4f47454f474b43466a4d474b434604494547">[email&#160;protected]</a>
                    </p>
                     @if (Auth::guard('web')->user()->phone == null)
                        <p>Not Found</p>
                    @else
                        <p>
                            {{ Auth::guard('web')->user()->phone }}
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
