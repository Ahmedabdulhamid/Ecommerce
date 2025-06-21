<div class="email-app-menu col-md-6 card d-none d-lg-block">
    <div class="form-group form-group-compose text-center">
        <button type="button" class="btn btn-danger btn-block my-1"><i class="ft-mail"></i> Compose</button>
    </div>
    <h6 class="text-muted text-bold-500 mb-1">Messages</h6>
    <div class="list-group list-group-messages">
        <a wire:click='selectScreen("Inbox")' href="#"
            class="list-group-item @if ($screen == 'Inbox') active @endif border-0">
            <i class="ft-inbox mr-1"></i> Inbox
            <span class="badge badge-secondary badge-pill float-right">{{ $inbox }}</span>
        </a>
        <a wire:click='selectScreen("Readed")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Readed') active @endif">
            Readed <span class="badge badge-danger badge-pill float-right">{{ $read }}</span></a>
        <a wire:click='selectScreen("Un Readed")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Un Readed') active @endif "> Un
            Readed <span class="badge badge-danger badge-pill float-right">{{ $unRead }}</span></a>
        <a wire:click='selectScreen("Answerd")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Answerd') active @endif"><i
                class="ft-file mr-1"></i> Answerd <span
                class="badge badge-danger badge-pill float-right">{{ $answered }}</span></a>

        <a wire:click='selectScreen("un Answerd")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'un Answerd') active @endif"><i
                class="ft-file mr-1"></i> Un Answerd <span
                class="badge badge-danger badge-pill float-right">{{ $unAnswered }}</span></a>

        <a wire:click='selectScreen("Starred")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Starred') active @endif"><i
                class="ft-star mr-1"></i>
            Starred<span class="badge badge-danger badge-pill float-right">3</span> </a>
        <a wire:click='selectScreen("Trash")' href="#"
            class="list-group-item list-group-item-action border-0 @if ($screen == 'Trash') active @endif"><i
                class="ft-trash-2 mr-1"></i> Trash <span
                class="badge badge-danger badge-pill float-right">{{ $trash }}</span></a>

    </div>

</div>
