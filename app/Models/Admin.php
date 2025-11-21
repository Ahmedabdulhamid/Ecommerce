<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function generateOTP(){
      $this->otp=Str::random(100);
      $this->otp_expire_at=now()->addMinutes(10);
      $this->save();

   }
 protected string $guard_name = 'admin';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function receivesBroadcastNotificationsOn():string{
        return 'admins.'. $this->id;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
