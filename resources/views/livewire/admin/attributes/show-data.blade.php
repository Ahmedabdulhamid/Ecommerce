<div>
    @foreach ($this->values as $val)
        <div class="row">

            <input type="text" readonly class="form-control" placeholder="Name in Arabic" value="{{ $val }}">




        </div>
    @endforeach

</div>
