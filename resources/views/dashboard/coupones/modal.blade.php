<div class="modal fade" id="coupon_{{ $coupon->id }}" tabindex="-1" aria-labelledby="coupon_{{ $coupon->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="my-5 w-75 container coupon_update_form" data-coupon-id="{{ $coupon->id }}" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="code_{{$coupon->id}}">{{ __('coupons.code') }}</label>
                            <input type="text" id="code_{{$coupon->id}}" class="form-control" value="{{$coupon->code}}">
                        </div>

                        <div class="form-group">
                            <label for="discount_precentage_{{$coupon->id}}">{{ __('coupons.discount_precentage') }}</label>
                            <input type="number" id="discount_precentage_{{$coupon->id}}" class="form-control" value="{{$coupon->discount_precentage}}">
                        </div>

                        <div class="form-group">
                            <label for="start_at_{{$coupon->id}}">{{ __('coupons.start_at') }}</label>
                            <input type="date" class="form-control" id="start_at_{{$coupon->id}}" value="{{$coupon->start_at}}">
                        </div>

                        <div class="form-group">
                            <label for="end_at_{{$coupon->id}}">{{ __('coupons.end_at') }}</label>
                            <input type="date" class="form-control" id="end_at_{{$coupon->id}}" value="{{$coupon->end_at}}">
                        </div>

                        <div class="form-group">
                            <label for="limit_{{$coupon->id}}">{{ __('coupons.limit') }}</label>
                            <input type="number" class="form-control" id="limit_{{$coupon->id}}" value="{{$coupon->limit}}">

                        </div>

                        <div class="form-group">
                            <label>{{ __('categories.status') }}</label>
                            <div class="input-group">
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" name="status_{{$coupon->id}}" value="active" class="custom-control-input" id="yes_{{$coupon->id}}"
                                        {{ $coupon->status == 'active' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="yes_{{$coupon->id}}">{{ __('countaries.active') }}</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio" name="status_{{$coupon->id}}" value="inactive" class="custom-control-input" id="no_{{$coupon->id}}"
                                        {{ $coupon->status == 'inactive' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="no_{{$coupon->id}}">{{ __('countaries.inactive') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
