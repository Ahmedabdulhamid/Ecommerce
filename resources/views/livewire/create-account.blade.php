<form wire:submit.prevent='submit' style="direction: ltr;">
    <section class="login account footer-padding">
        <div class="container">
            <div class="login-section account-section">
                <div class="review-form">
                    <h5 class="text-center">Create Account</h5>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">User Name*</label>
                            <input type="text" id="fname" class="form-control" placeholder="User Name"
                                wire:model='name'>
                        </div>
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                    </div>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" id="email" class="form-control" placeholder="user@gmail.com"
                                wire:model='email'>
                            @error('email')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="tel" id="phone" class="form-control" placeholder="+880388**0899"
                                wire:model='phone'>
                        </div>
                        @error('email')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="country" class="form-label">Country*</label>
                        <select id="country" class="form-select"wire:model.live='countryId' wire:ignore>
                            <option value="0">Choose Your Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('countryId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="country" class="form-label">Governorates*</label>
                        <select class="custom-select form-control" wire:model.live='governorateId'>

                            <option value="0">Choose Your Governorate</option>
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
                            <label for="number" class="form-label">Password*</label>
                            <input type="password" id="number" class="form-control" wire:model='password'>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="review-form-name checkbox">
                        <div class="checkbox-item">
                            <input type="checkbox">
                            <p class="remember">
                                I agree all terms and condition in <span class="inner-text">ShopUs.</span></p>
                        </div>
                    </div>
                    <div class="login-btn text-center">
                        <button type="submit" class="shop-btn">Create an Account</button>
                        <span class="shop-account">Already have an account ?<a href="{{ route('login') }}">Log
                                In</a></span>
                        <div class="my-3">
                            <p class="fs-4 text-center">or</p>
                        </div>
                        <div class="my-5">
                            <a href="{{ route('google.auth') }}"
                                class="btn d-flex align-items-center shadow-lg p-3 mb-5 bg-body-tertiary rounded"
                                style="background-color: white;">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                    width="24" height="24" class="me-2">
                                <span class="text-dark">Sign Up with Google</span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>
