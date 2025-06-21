<div class="modal fade" id="slider_{{ $slider->id }}" tabindex="-1" aria-labelledby="slider_{{ $slider->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-slider-update "id="{{ $slider->id }}" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{ __('sliders.notes') }}
                            {{ __('sliders.ar') }}:</label>
                        <input type="text" class="form-control" id="recipient-name" name="note[ar]"
                            value="{{ $slider->getTranslation('note', 'ar') }}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{ __('sliders.notes') }}
                            {{ __('sliders.en') }}:</label>
                        <input type="text" class="form-control" id="recipient-name"
                            name="note[en]"value="{{ $slider->getTranslation('note', 'en') }}">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image" class="dropify" data-height="200" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).on('submit', '.form-slider-update', function(e) {
        e.preventDefault();
        console.log('click');

        let id = $(this).attr('id')
        let url = "{{ route('sliders.update', ':id') }}"
        url = url.replace(':id', id);
        let formData = new FormData($(this)[0])
        formData.append('_method', 'PUT'); // تحديد الطريقة الصحيحة
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success(data) {
                toastr.success(data.message)

                $('#Slider_table').DataTable().ajax.reload(null, false);
                $('.form-slider')[0].reset()

                let modalEl = document.getElementById(`slider_${id}`);
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


        });


    })
</script>
