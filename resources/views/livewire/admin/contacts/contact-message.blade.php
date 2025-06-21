<div class="email-app-list w-100">
    <div class="card-body chat-fixed-search">
        <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
            <input type="text" class="form-control" id="iconLeft4" placeholder="Search" wire:model.live='itemSearch'>
            <div class="form-control-position">
                <i class="ft-search"></i>
            </div>
        </fieldset>
    </div>
    <div id="users-list" class="list-group">
        <div class="users-list-padding media-list">
            @forelse ($contacts as $contact)
                <a href="#" class="media border-0" wire:click='submit({{ $contact->id }})'>
                    <div class="media-left pr-1">
                        <span class="avatar avatar-md">
                            <span class="media-object rounded-circle text-circle bg-info">T</span>
                        </span>
                    </div>
                    <div class="media-body w-100">
                        <h6 class="list-group-item-heading text-bold-500">{{ $contact->name }}
                            <span class="float-right">
                                <span class="font-small-2 primary">{{ $contact->created_at->diffForHumans() }}</span>
                            </span>
                        </h6>
                        <p class="list-group-item-text text-truncate text-bold-600 mb-0">{{ $contact->subject }}</p>
                        <p class="list-group-item-text mb-0">{{ $contact->message }}
                            <span class="float-right primary">

                                <span
                                    class="badge {{ $contact->is_replied == 1 ? ' badge-success text-white' : 'badge-danger' }} mr-1">
                                    @if ($contact->is_replied == 1)
                                        {{ __('contacts.replied') }}
                                    @else
                                        {{ __('contacts.not_replied') }}
                                    @endif


                                </span> <i class="font-medium-1 ft-star blue-grey lighten-3"></i></span>
                        </p>
                        <p class="list-group-item-text mb-0">{{ $contact->message }}
                            <span class="float-right primary">

                                <span
                                    class="badge {{ $contact->is_read == 1 ? ' badge-success text-white' : 'badge-danger' }} mr-1">
                                    @if ($contact->is_read == 1)
                                        {{ __('contacts.readed') }}
                                    @else
                                        {{ __('contacts.not_read') }}
                                    @endif


                                </span> <i class="font-medium-1 ft-star blue-grey lighten-3"></i></span>
                        </p>
                    </div>
                </a>
            @empty
                <h1 class="text-center">No Contacts Fount</h1>
            @endforelse
            <div class="container">
                {{ $contacts->links('vendor.livewire.bootstrap') }}
            </div>


        </div>
    </div>
</div>
