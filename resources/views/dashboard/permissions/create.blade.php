<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="permission_create_form">
                    @csrf
                    <div class="mb-3">
                        <label for="name_ar" class="col-form-label">Name In Arabic:</label>
                        <input type="text" name="name[ar]" class="form-control" id="name_ar">
                    </div>
                    <div class="mb-3">
                        <label for="name_en" class="col-form-label">Name In English:</label>
                        <input type="text" name="name[en]" class="form-control" id="name_en">
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
    $(document).on('submit', '.permission_create_form', function(e) {
        e.preventDefault();
        const data = new FormData($(this)[0])
        data.append('_token', "{{ csrf_token() }}")
        $.ajax({
            url: "{{ route('permissions.store') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                if (data.status == 201) {
                    $('#Permission_table').DataTable().ajax.reload(null, false)
                    toastr.success('Permission Created Successfully')
                    let modalEl = document.getElementById('exampleModal');

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

                }
            },
            error: function(reject) {
                let response = JSON.parse(reject.responseText)
                $.each(response.errors, function(key, value) {
                    toastr.error(value)
                })
            }
        })

    })
</script>
