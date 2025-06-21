<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ForgotPasswordWebNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgotPasswordWebNotification($token));
    }
    public function sendEmailVerificationNotification()
    {
        $url = URL::temporarySignedRoute(
            'custom.verification.verify',
            now()->addMinutes(5),
            [
                'id' => $this->id,
                'hash' => $this->token
            ]

        );
        $this->notify(new VerifyEmailNotification($url));
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function country()
    {
        return $this->belongsTo(Countary::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
