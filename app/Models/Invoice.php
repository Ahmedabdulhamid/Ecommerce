<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'invoice_id',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'amount',
        'currency',
        'status',
        'invoice_url'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
