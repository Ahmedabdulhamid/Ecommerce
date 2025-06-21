
<form wire:submit.prevent='submit' class="form">

    <div class="row">
        <div class="form-group col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Name in Arabic" wire:model='name.ar'
                value="{{ $name['ar'] }}">
            @error('name.ar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6 mb-2">

            <input type="text" class="form-control" placeholder="Name in English"
                wire:model='name.en'value="{{ $name['en'] }}">
            @error('name.en')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>
    <button type="button" data-repeater-create class="btn btn-primary"wire:click="addField">

        <i class="ft-plus"></i>
    </button>


    @foreach ($value as $index => $val)
        <div class="form-group col-12 mb-2 contact-repeater">
            <div data-repeater-list="repeater-group">
                <div class="input-group mb-1" data-repeater-item>
                    <input type="text" placeholder="Attribute Value" class="form-control" id="example-tel-input"
                        wire:model="value.{{ $index }}.value" value="{{$val['value']}}">

                    <span class="input-group-append" id="button-addon2">
                        <button class="btn btn-danger" type="button" wire:click="removeFieldValue({{ $index }}, {{ $val['id'] ?? 'null' }})">
                            <i class="ft-x"></i>
                        </button>
                    </span>
                </div>
            </div>
            @error("value.".$index)
            <span class="text-danger">{{ $message }}</span>
        @enderror

        </div>
    @endforeach
     @foreach ($item as $index=>$item )
     <div class="form-group col-12 mb-2 contact-repeater">
        <div data-repeater-list="repeater-group">
            <div class="input-group mb-1" data-repeater-item>
                <input type="text" placeholder="Attribute Value" class="form-control" id="example-tel-input"
                    wire:model="item.{{ $index }}">

                <span class="input-group-append" id="button-addon2">
                    <button class="btn btn-danger" type="button" wire:click="removeFieldItem({{ $index }})">
                        <i class="ft-x"></i>
                    </button>
                </span>
            </div>
        </div>
     @endforeach


    <button type="submit" class="btn btn-primary">Save</button>



</form>
