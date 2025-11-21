<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='submit'>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{__('admin.email')}}:</label>
                        <input type="text"wire:model='email' class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">{{__('admin.subject')}}:</label>
                        <input class="form-control" id="message-text"wire:model='subject'>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">{{__('admin.reply')}}:</label>
                        <input class="form-control" id="message-text"wire:model='reply'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
