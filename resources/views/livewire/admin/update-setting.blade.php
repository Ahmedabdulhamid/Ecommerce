@foreach ($setting as $value)
<form action="">
    <div class="row container">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label for="site_name">Site Name</label>
            <input class="form-control input" readonly id="site_name"
                value={{ $value->getTranslation('site_name', app()->getLocale()) }}>
            <label for="site_desc" readonly>Site Description</label>
            <input class="form-control input" readonly id="site_desc"
                value=" {{ $value->getTranslation('site_desc', app()->getLocale()) }}">
            <label for="site_email">Site Email</label>
            <input class="form-control input" readonly value="{{ $value->site_email }}">

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label for="meta_desc">Meta Description</label>
            <input class="form-control input"readonly id="meta_desc"
                value={{ $value->getTranslation('meta_description', app()->getLocale()) }}>
            <label for="site_address">Site Adderss</label>
            <input class="form-control input" readonly id="site_address"
                value=" {{ $value->getTranslation('site_address', app()->getLocale()) }}">
            <label for="site_email">Email Support</label>
            <input class="form-control input" readonly value="{{ $value->email_support }}">


        </div>
    </div>
    <div class="my-3 me-3">
        <button hidden class="btn btn-primary save">Save</button>
        <button hidden class="btn btn-danger cancel">Cancel</button>

        <button type="submit" class="btn btn-primary update">Edit</button>
    </div>
</form>

    <img src="{{ $value->logo }}" alt="" srcset="">
@endforeach
</div>
