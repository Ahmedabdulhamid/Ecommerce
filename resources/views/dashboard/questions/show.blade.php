
<div class="modal fade" id="exampleModal_{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">{{__('front.subject')}}:</label>
                  <input type="text" class="form-control" id="recipient-name"disabled  value="{{$question->subject}}"">
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">{{__('front.message')}}:</label>
                  <textarea class="form-control" id="message-text" disabled>
                    {{$question->message}}
                  </textarea>
                </div>

        </div>

      </div>
    </div>
  </div>
