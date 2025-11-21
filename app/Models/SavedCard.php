<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'token',
        'brand',
        'last_four',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
