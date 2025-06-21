<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $value->id }}">
    {{ __('countaries.edit_charge') }}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal-{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Shipping
                    Price</h5>
                <button type="button" class=" btn btn-close " data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form class="myForm" data_id="{{ $value->id }}">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{ __('countaries.price') }}:</label>
                        <input type="text" class="form-control price" id="recipient-name"value="{{ $value->price }}"
                            name="price">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save
                            changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
