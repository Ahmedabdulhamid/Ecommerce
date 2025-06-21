<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-slider" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="note-ar" class="col-form-label">{{ __('sliders.notes') }} {{ __('sliders.ar') }}:</label>
                        <input type="text" class="form-control" id="note-ar" name="note[ar]">
                    </div>
                    <div class="mb-3">
                        <label for="note-en" class="col-form-label">{{ __('sliders.notes') }} {{ __('sliders.en') }}:</label>
                        <input type="text" class="form-control" id="note-en" name="note[en]">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image" class="dropify" data-height="200" />
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


<script>
    $(document).on('submit', '.form-slider', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
           console.log('click');

        $.ajax({
            url: "{{ route('sliders.store') }}",
            type: "post",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                toastr.success(response.message);
                console.log(response);

                // تحديث الجدول بدون الرجوع لأول صفحة
                $('#Slider_table').DataTable().ajax.reload(null, false);

                // تفضية الفورم
                $('.form-slider')[0].reset();

                // إغلاق المودال بشكل صحيح
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
            },
            error: function(reject) {
                let response = JSON.parse(reject.responseText);
                $.each(response.errors, function(key, value) {
                    toastr.error(value);
                });
            }
        });
    });
</script>

