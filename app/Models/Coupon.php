<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = "coupones";
    protected $guarded = ['id'];
    public function scopeIsActive($query)
    {
        return $query->where('status', 'active')
            ->whereDate('start_at', '<=', now())
            ->whereDate('end_at', '>=', now())
            ->where(function ($q) {
                $q->whereNull('limit')  // لو مفيش حد
                    ->orWhereColumn('time_used', '<', 'limit'); // أو لسه الاستخدام أقل من الحد
            });
    }

}
