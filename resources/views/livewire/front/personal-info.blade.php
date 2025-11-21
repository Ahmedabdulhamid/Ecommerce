 <div class="row ">
     <div class="col-lg-7">
         <div class=" account-section">
             <div class="review-form">
                 <form wire:submit.prevent='submit'>
                     <div class=" account-inner-form">

                         <div class="review-form-name">
                             <label for="latname" class="form-label">{{ __('front.name') }}*</label>
                             <input type="text" id="latname" class="form-control w-100" placeholder="user name"
                                 wire:model='name'>
                             @error('name')
                                 <span class="text-danger fs-4">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                     <div class=" account-inner-form">
                         <div class="review-form-name">
                             <label for="gmail" class="form-label">{{ __('front.email') }}*</label>
                             <input type="email" id="gmail" class="form-control" placeholder="user@gmail.com"
                                 wire:model='email'>
                             @error('email')
                                 <span class="text-danger fs-4">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="review-form-name">
                             <label for="telephone" class="form-label">{{ __('front.phone') }}*</label>
                             <input type="tel" id="telephone" class="form-control"
                                 placeholder="+880388**0899"wire:model='phone'>
                             @error('phone')
                                 <span class="text-danger fs-4">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                     <div class="review-form-name">
                         <label for="region" class="form-label">{{ __('admin.country') }}*</label>
                         <select id="region" class="form-select"wire:model.live="countryId">
                             <option>{{ __('front.choose_country') }}</option>
                             @foreach ($countries as $country)
                                 <option value="{{ $country->id }}">
                                     {{ $country->getTranslation('name', app()->getLocale()) }}</option>
                             @endforeach


                         </select>
                         @error('countryId')
                             <span class="text-danger fs-4">{{ $message }}</span>
                         @enderror

                     </div>

                     <div class=" account-inner-form city-inner-form">
                         <div class="review-form-name">
                             <label for="teritory" class="form-label">{{__('admin.governorate')}}*</label>
                             <select id="teritory" class="form-select"wire:model.live="governorateId">
                                 <option>{{__('front.choose_governorate')}}</option>
                                 @foreach ($governorates as $governorate)
                                     <option value="{{ $governorate->id }}">
                                         {{ $governorate->getTranslation('name', app()->getLocale()) }}</option>
                                 @endforeach

                             </select>
                             @error('governorateId')
                                 <span class="text-danger fs-4">{{ $message }}</span>
                             @enderror
                         </div>

                     </div>
                     <div class="submit-btn">
                         <button type='reset'class="shop-btn cancel-btn">{{__('front.cancel')}}</button>
                         <button type="submit" class="shop-btn update-btn">{{__('front.update_profile')}}</button>
                     </div>

                 </form>

             </div>
         </div>
     </div>

 </div>
 <script>
     window.addEventListener('UpdateUserInfo', function() {
         toastr.success('You Updated Your Profile')
     })
 </script>
