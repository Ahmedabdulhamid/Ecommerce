<div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='submit'>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{__('admin.name')}}:</label>
                        <input type="text" class="form-control" id="recipient-name" wire:model='name'>
                        @error('name')
                            <span class="text-danger fs-4">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">{{__('admin.email')}}:</label>
                        <input type="text" class="form-control" id="email" wire:model='email'>
                        @error('email')
                            <span class="text-danger fs-4">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">{{__('admin.password')}}:</label>
                        <input type="password" class="form-control" id="password" wire:model='password'>
                        @error('password')
                            <span class="text-danger fs-4">{{ $message }}</span>
                        @enderror
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

<script>
    window.addEventListener('AdminCreatedSuccessfully', function() {
        toastr.success('Admin Created Sucessfully')
        let modalEl = document.getElementById('exampleModal');
        let modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();

            modalEl.addEventListener('hidden.bs.modal', function() {
                console.log('Modal is fully hidden.');
                document.querySelectorAll('.modal-backdrop').forEach(el => el
                    .remove());

                document.body.classList.remove('modal-open');
                document.body.style.overflow =
                    ''; // ترجع الـ overflow للوضع الطبيعي
            }, {
                once: true
            });
        }
        $('#admins_table').DataTable().ajax.reload(null, false);
    })
</script>
