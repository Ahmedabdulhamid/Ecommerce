
@include('dashboard.categories.partials.head')
<i type="button" class="la la-edit text-primary" data-bs-toggle="modal" data-bs-target="#coupon_{{ $coupon->id }}">

</i>
@include('dashboard.coupones.modal')


<i class="la la-trash del text-danger" type="button"
    id="{{ $coupon->id }}"></i>

