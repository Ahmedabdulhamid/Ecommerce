<div class="mt-5">
    @foreach ($setting as $value)
        <form wire:submit.prevent='submit'>
            <div class="row container">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="site_name">Site Name in Arabic</label>
                    <input class="form-control input" wire:model='site_name.ar' readonly id="site_name"
                        value="{{ $value->getTranslation('site_name', 'ar') }}">
                    @error('site_name.ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="site_desc">Site Description in Arabic</label>
                    <textarea class="form-control input" readonly id="site_desc"wire:model="site_desc.ar" rows="8">{{ $value->getTranslation('site_desc', 'ar') }}</textarea>
                    @error('site_desc.ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="meta_desc">Meta Description in Arabic</label>
                    <textarea class="form-control input" readonly id="meta_desc" rows="8" wire:model="meta_description.ar">{{ $value->getTranslation('meta_description', 'ar') }}</textarea>
                    @error('meta_description.ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="site_email">Site Email</label>
                    <input class="form-control input" readonly wire:model="site_email" value="{{ $value->site_email }}">
                    @error('site_email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="site_address">Site Address in Arabic</label>
                    <input class="form-control input" readonly id="site_address" wire:model="site_address.ar"
                        value="{{ $value->getTranslation('site_address', 'ar') }}">
                    @error('site_address.ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="site_name">Site Name in English</label>
                    <input class="form-control input" readonly id="site_name" wire:model="site_name.en"
                        value="{{ $value->getTranslation('site_name', 'en') }}">
                    @error('site_name.en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="site_desc">Site Description in English</label>
                    <textarea class="form-control input" readonly id="site_desc" rows="8" wire:model="site_desc.en">{{ $value->getTranslation('site_desc', 'en') }}</textarea>
                    @error('site_desc.en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="meta_desc">Meta Description in English</label>
                    <textarea class="form-control input" readonly id="meta_desc" rows="8" wire:model="meta_description.en">{{ $value->getTranslation('meta_description', 'en') }}</textarea>
                    @error('meta_description.en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="site_address">Site Address in English</label>
                    <input class="form-control input" readonly id="site_address" wire:model="site_address.en"
                        value="{{ $value->getTranslation('site_address', 'en') }}">
                    @error('site_address.en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="email_support">Email Support</label>
                    <input class="form-control input" readonly wire:model="email_support"
                        value="{{ $value->email_support }}">
                    @error('email_support')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="file" wire:model.live='logo' >


                    @error('logo')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                </div>
            </div>

            <div class="my-3 me-3">
                <button hidden type="submit" class="btn btn-primary save">Save <div class="spinner-border text-light"
                        wire:loading wire:target='submit' role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></button>
                <button hidden class="btn btn-danger cancel">Cancel</button>
                <button class="btn btn-primary update">Edit</button>
            </div>
        </form>
        <div class="d-flex justify-content-center">
            <img src="{{asset('storage/settings/' . $value->logo) }}"width="100px" height="100px" srcset="">

        </div>

    @endforeach
</div>
<script>
    $(document).on('click', '.update', function(e) {
        e.preventDefault()
        $('.input').removeAttr('readonly');
        $('.save').removeAttr('hidden')
        $('.cancel').removeAttr('hidden')
        $(this).attr('hidden', true)


    })
    $(document).on('click', '.cancel', function(e) {
        e.preventDefault()
        $('.input').attr('readonly', true);
        $('.save').attr('hidden', true);
        $('.cancel').attr('hidden', true);
        $('.update').attr('hidden', false)

    })
</script>
