<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="create_faq">
                    @csrf
                    <div class="mb-3">
                        <label for="ques_ar" class="col-form-label">Question With Arabic</label>
                        <input type="text" class="form-control" name="questions[ar]" id="ques_ar">
                    </div>
                    <div class="mb-3">
                        <label for="ques_en" class="col-form-label">Question With English</label>
                        <input type="text" class="form-control" name="questions[en]" id="ques_en">
                    </div>
                    <div class="mb-3">
                        <label for="ans_ar" class="col-form-label">Answer with Arabic</label>
                        <textarea class="form-control" id="ans_ar" name="answers[ar]"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ans_en" class="col-form-label">Answer with English</label>
                        <textarea class="form-control" id="ans_en"name="answers[en]"></textarea>
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
