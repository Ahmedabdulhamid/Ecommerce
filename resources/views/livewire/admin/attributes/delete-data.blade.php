<div>
    <p> ?{{trans('admin.confirm_del')}} </p>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('admin.cancel')}}</button>
        <button type="button" class="btn btn-primary" wire:click='submit'>{{trans('admin.delete')}}</button>
    </div>
</div>
