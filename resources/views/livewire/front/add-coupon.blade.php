<style>
    .coupon_input:focus {
        outline: none;
        border-color: transparent;
        box-shadow: none;
    }

    .apply-coupon-btn {
        width: 30% !important;
        border-radius: 50px !important;
    }
</style>
<div class="review-form-name my-2">
    <label for="country" class="form-label">Coupon*</label>
    <input type="text" id="fname" class="form-control coupon_input" placeholder="Coupon"style="height: 40px;"
        wire:model='code'>

    <a href="#" wire:click.prevent="applyCoupon" class="shop-btn apply-coupon-btn mt-3">Apply Coupon</a>

   {{$code}}
</div>

