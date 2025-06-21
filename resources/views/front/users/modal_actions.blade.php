<div class="modal fade" wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='submit'>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Review:</label>
                        <textarea wire:model.defer="reviewText" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="product-btn mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="product-btn mx-2">Edit Review</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    if (!window.updateReviewListenerAdded) {
        window.addEventListener('updateReview', function () {
            let modalEl = document.getElementById(`exampleModal`);
            let modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();

                modalEl.addEventListener('hidden.bs.modal', function () {
                    console.log('Modal is fully hidden.');

                    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                }, { once: true });
            }

            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';

            toastr.success('Your Review Updated Successfully!');
        });

        window.updateReviewListenerAdded = true;
    }
</script>
