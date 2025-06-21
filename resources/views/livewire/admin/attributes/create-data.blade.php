<form class="form" wire:submit.prevent='submit'>
    <div class="row">
        <div class="form-group col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Name in Arabic" wire:model='name.ar'>
            @error('name.ar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6 mb-2">

            <input type="text" class="form-control" placeholder="Name in English" wire:model='name.en'>
            @error('name.en')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

    <button type="button" data-repeater-create class="btn btn-success my-3" style='color:white;' wire:click="addField">

      Add Attribute Value  <i class="ft-plus"></i>
    </button>
    <br>

    @foreach ($value as $index => $val)
        <div class="form-group col-12 mb-2 contact-repeater">
            <div data-repeater-list="repeater-group">
                <div class="input-group mb-1" data-repeater-item>
                    <input type="text" placeholder="Attribute Value" class="form-control" id="example-tel-input"
                        wire:model='value.{{ $index }}'>

                    <span class="input-group-append" id="button-addon2">
                        <button class="btn btn-danger" type="button" data-repeater-delete
                            wire:click="removeField({{ $index }})"><i class="ft-x"></i></button>
                    </span>

                </div>
            </div>

            @error('value.'.$index)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" >Save</button>

</form>

<script >
    window.addEventListener("createModalHide",function(){
        let modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        if (modal) {
            modal.hide();
        }

        // إزالة الخلفية المظللة
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

        // استعادة التحكم في التمرير
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = '';
    })
    $(document).on('submit','.form',function (e) {
        console.log('hello');

        e.preventDefault();
        $('.form')[0].reset();
    })
</script>

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('assets') }}/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
