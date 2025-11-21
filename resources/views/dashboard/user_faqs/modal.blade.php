<div class="modal fade" id="exampleModal_{{ $userQuestion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form_answer" id="{{ $userQuestion->id }}">

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">{{ __('admin.reply') }}:</label>
                        <textarea class="form-control" id="message-text" name="reply"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('admin.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('admin.submit') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).on('submit', '.form_answer', function(e) {
        e.preventDefault();

        let id = $(this).attr('id'); // هنا id هو معرف الفورم

        let formData = new FormData(this); // أبسط من $(this)[0]
        formData.append("_token", "{{ csrf_token() }}");

        let url = "{{ route('user-faqs.answer', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false, // ✅ لازم مع FormData
            contentType: false, // ✅ لازم مع FormData
            success: function(data) {
                if (data.status == 200) {
                    toastr.success(data.msg)
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

                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText)
                $.each(response.errors, function(key, value) {
                    toastr.error(value)
                })
            }
        });
    });
</script>
