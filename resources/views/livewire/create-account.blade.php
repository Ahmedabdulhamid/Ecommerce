<form wire:submit.prevent='submit' >
    <section class="login account footer-padding">
        <div class="container">
            <div class="login-section account-section " style="vh-100">
                <div class="review-form">
                    <h5 class="text-center">{{__('front.create_account')}}</h5>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">{{__('front.user_name')}}*</label>
                            <input type="text" id="fname" class="form-control" placeholder="{{__('front.user_name')}}"
                                wire:model='name'>
                        </div>
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                    </div>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">{{__('front.email')}}*</label>
                            <input type="email" id="email" class="form-control" placeholder="{{__('front.email')}}"
                                wire:model='email'>
                            @error('email')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="phone" class="form-label">{{__('front.phone')}}*</label>
                            <input type="tel" id="phone" class="form-control" placeholder="+880388**0899"
                                wire:model='phone'>
                        </div>
                        @error('email')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="country" class="form-label">{{__('admin.country')}}*</label>
                        <select id="country" class="form-select"wire:model.live='countryId' wire:ignore>
                            <option value="0">{{__('front.choose_country')}}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('countryId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="country" class="form-label">{{__('admin.governorate')}}*</label>
                        <select class="custom-select form-control" wire:model.live='governorateId'>

                            <option value="0">{{__('front.choose_governorate')}}</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach

                        </select>
                        @error('governorateId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" account-inner-form city-inner-form">

                        <div class="review-form-name">
                            <label for="number" class="form-label">{{__('front.password')}}*</label>
                            <input type="password" id="number" class="form-control" wire:model='password'>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-callback' => 'onCallback']) !!}
                    </div>
                    @error('recaptcha')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror

                    <div class="review-form-name checkbox">
                        <div class="checkbox-item">
                            <input type="checkbox">
                            <p class="remember">
                                {{__('front.register_sentence')}} <span class="inner-text">ShopUs.</span></p>
                        </div>
                    </div>

                    <div class="login-btn text-center">
                        <button type="submit" class="shop-btn">{{__('front.create_account')}}</button>
                        <span class="shop-account">{{__('front.already_have_account')}}?<a href="{{ route('login') }}">{{__('front.login')}}</a></span>
                        <div class="my-3">
                            <p class="fs-4 text-center">{{__('front.or')}}</p>
                        </div>
                        <div class="mb-5">
                            <a href="{{ route('google.auth') }}"
                                class="btn d-flex align-items-center shadow-lg p-3 mb-5 bg-body-tertiary rounded"
                                style="background-color: white;">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                    width="24" height="24" class="me-2">
                                <span class="text-dark">{{__('front.sign_up')}}</span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>
<script>
    function onCallback(token) {

       Livewire.dispatch('recaptcha', { value: token });
    }
</script>
