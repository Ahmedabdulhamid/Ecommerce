<div class="col-lg-12">
    <div class="info-section">
        <div class="seller-info">
            <h5 class="heading">{{__('front.personal_info')}}</h5>
            <div class="info-list">
                <div class="info-title">
                    <p>{{__('front.name')}}:</p>
                    <p>{{__('front.email')}}:</p>
                    <p>{{__('front.phone')}}:</p>
                    <p>{{__('admin.country')}}:</p>
                    <p>{{__('admin.governorate')}}:</p>
                </div>
                <div class="info-details">
                    <p>{{ Auth::guard('web')->user()->name }}</p>
                    <p><a href="#" class="__cf_email__"
                            data-cfemail="cbafaea6a4aea6aaa2a78baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                    </p>
                    @if (Auth::guard('web')->user()->phone == null)
                        <p>{{__('admin.not_found')}}</p>
                    @else
                        <p>{{ Auth::guard('web')->user()->phone }}</p>
                    @endif

                    @if (Auth::guard('web')->user()->country_id == null)
                        <p>{{__('admin.not_found')}}</p>
                    @else
                        <p>{{ $country->getTranslation('name', app()->getLocale()) }}
                        </p>
                    @endif
                    @if (Auth::guard('web')->user()->governorate_id == null)
                        <p>{{__('admin.not_found')}}</p>
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
            <h5 class="heading">{{__('front.shop_info')}}</h5>
            <div class="info-list">
                <div class="info-title">
                    <p>{{__('front.name')}}:</p>
                    <p>{{__('front.email')}}:</p>
                    <p>{{__('front.phone')}}:</p>

                </div>
                <div class="info-details">
                    <p>ShopUs Super-Shop</p>
                    <p><a href="#" class="__cf_email__"
                            data-cfemail="2a4e4f47454f474b43466a4d474b434604494547">[email&#160;protected]</a>
                    </p>
                     @if (Auth::guard('web')->user()->phone == null)
                        <p>{{__('admin.not_found')}}</p>
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
