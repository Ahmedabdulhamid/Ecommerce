<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent='submit'>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{ __('users.name') }}</label>
                        <input type="text" class="form-control" id="recipient-name" wire:model='name'>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">{{ __('users.email') }}</label>
                        <input type="text" class="form-control" id="email"wire:model='email'>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="country" class="col-form-label">{{ __('users.country') }}</label>
                        <select class="custom-select form-control" wire:model.live='countryId' wire:ignore>
                            <option value="0">Choose Your Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('countryId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="country" class="col-form-label">{{ __('users.governorate') }}</label>
                        <select class="custom-select form-control" wire:model='governorateId' wire:ignore>

                            <option value="0">Choose Your Governorate</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach

                        </select>
                        @error('governorateId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('categories.status') }}</label>
                        <div class="input-group">
                            <div class="d-inline-block custom-control custom-radio mr-1">
                                <input type="radio" wire:model="status" value="active" class="custom-control-input" id="yes1">
                                <label class="custom-control-label" for="yes1">{{ __('countaries.active') }}</label>
                            </div>
                            <div class="d-inline-block custom-control custom-radio">
                                <input type="radio" wire:model="status" value="inactive" class="custom-control-input" id="no1">
                                <label class="custom-control-label" for="no1">{{ __('countaries.inactive') }}</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
