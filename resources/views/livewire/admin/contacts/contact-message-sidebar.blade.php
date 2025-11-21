<div class="email-app-menu col-md-6 card d-none d-lg-block">
    <div class="form-group form-group-compose text-center">
        <button type="button" class="btn btn-danger btn-block my-1"><i class="ft-mail"></i> {{__('admin.compose')}}</button>
    </div>
    <h6 class="text-muted text-bold-500 mb-1">{{__('admin.messages')}}</h6>
    <div class="list-group list-group-messages">
        <a wire:click='selectScreen("Inbox")' href="#"
            class="list-group-item @if ($screen == 'Inbox') active @endif border-0">
            <i class="ft-inbox mr-1"></i> {{__('admin.inbox')}}
            <span class="badge badge-secondary badge-pill float-right">{{ $inbox }}</span>
        </a>
        <a wire:click='selectScreen("Readed")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Readed') active @endif">
            {{__('admin.readed')}} <span class="badge badge-danger badge-pill float-right">{{ $read }}</span></a>
        <a wire:click='selectScreen("Un Readed")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Un Readed') active @endif "> {{__('admin.un_readed')}} <span class="badge badge-danger badge-pill float-right">{{ $unRead }}</span></a>
        <a wire:click='selectScreen("Answerd")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Answerd') active @endif"><i
                class="ft-file mr-1"></i> {{__('admin.answerd')}} <span
                class="badge badge-danger badge-pill float-right">{{ $answered }}</span></a>

        <a wire:click='selectScreen("un Answerd")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'un Answerd') active @endif"><i
                class="ft-file mr-1"></i> {{__('admin.un_answerd')}} <span
                class="badge badge-danger badge-pill float-right">{{ $unAnswered }}</span></a>

        <a wire:click='selectScreen("Starred")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Starred') active @endif"><i
                class="ft-star mr-1"></i>
            {{__('admin.starred')}}<span class="badge badge-danger badge-pill float-right">3</span> </a>
        <a wire:click='selectScreen("Trash")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Trash') active @endif"><i
                class="ft-trash-2 mr-1"></i> {{__('admin.trash')}} <span
                class="badge badge-danger badge-pill float-right">{{ $trash }}</span></a>

    </div>

</div>
