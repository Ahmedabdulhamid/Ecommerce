<?php
// app/Services/CouponService.php
namespace App\Services\Front;

use App\Models\Cart;
use App\Models\Coupon;

class CouponService
{
    public function apply(string $code, int $userId, string $sessionId): array
    {
        $coupon = Coupon::where('code', $code)->isActive()->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Coupon not found.'];
        }

        $cart = Cart::where('session_id', $sessionId)->where('user_id', $userId)->first();

        if (!$cart) {
            return ['success' => false, 'message' => 'Cart not found.'];
        }

        $cart->update([
            'coupon' => $coupon->code,
        ]);

        $coupon->increment('time_used');

        return [
            'success' => true,
            'coupon' => $coupon,
            'message' => 'Coupon Applied Successfully! Now you have discount percentage ' . $coupon->discount_precentage . '%',
        ];
    }
}
