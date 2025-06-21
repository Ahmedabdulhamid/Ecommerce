<div class="modal fade" id="exampleModal_{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="permission_update_form"id="{{ $permission->id }}">

                    <div class="mb-3">
                        <label for="name_ar" class="col-form-label">Name In Arabic:</label>
                        <input type="text" name="name[ar]" class="form-control"
                            id="name_ar"value='{{ $permission->getTranslation('name', 'ar') }}'>
                    </div>
                    <div class="mb-3">
                        <label for="name_en" class="col-form-label">Name In English:</label>
                        <input type="text" name="name[en]" class="form-control"
                            id="name_en"value='{{ $permission->getTranslation('name', 'en') }}'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<script>
    $(document).off('submit', '.permission_update_form').on('submit', '.permission_update_form', function(e) {
        e.preventDefault();

        let id = $(this).attr('id');
        let url = "{{ route('permissions.update', ':id') }}";
        url = url.replace(':id', id);

        let formData = new FormData(this);
        formData.append('_method', 'PUT');
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success(data) {


               $('#Permission_table').DataTable().ajax.reload(null, false)
                    toastr.success('Permission Updated Successfully')


                let modalEl = document.getElementById(`exampleModal_${id}`);
                let modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();

                    modalEl.addEventListener('hidden.bs.modal', function() {
                        console.log('Modal is fully hidden.');

                        // تأكد إنه مفيش backdrop فاضل
                        document.querySelectorAll('.modal-backdrop').forEach(el => el
                            .remove());

                        // تأكد من مسح كلاس modal-open لو لسه موجود
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow =
                            ''; // ترجع الـ overflow للوضع الطبيعي
                    }, {
                        once: true
                    });
                }
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

                document.body.classList.remove('modal-open');
                document.body.style.overflow = 'auto';

            },
            error: function(reject) {
                let response = JSON.parse(reject.responseText);
                $.each(response.errors, function(key, value) {
                    toastr.error(value);
                });

            }
        })



    });
</script>
