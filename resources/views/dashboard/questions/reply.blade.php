<div class="modal fade" id="reply_{{ $question->id }}" tabindex="-1" aria-labelledby="replyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="reply_question_form" id="{{ $question->id }}">

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">{{ __('front.reply') }}:</label>
                        <textarea class="form-control" id="message-text" class="answer" name="reply">

                    </textarea>
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
    $(document).on('submit', '.reply_question_form', function(e) {
        e.preventDefault();
        let url = "{{ route('question.answer', ':id') }}"
        let id = $(this).attr('id');
        let data = new FormData($(this)[0])
        console.log(data);
        data.append("_token", "{{ csrf_token() }}");



        url = url.replace(':id', id)

        $.ajax({
            url: url,
            type: "post",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                console.log(data);
                toastr.success(data.success_msg);

                let modalEl = document.getElementById(`reply_${id}`);
                if (modalEl) {
                    let modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();

                        // لما المودال يقفل بالكامل
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
                let response = JSON.parse(reject.responseText);
                $.each(response.errors, function(key, value) {
                    toastr.error(value);
                });

            }


        })



    })
</script>
