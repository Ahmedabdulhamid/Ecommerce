<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory,HasTranslations;
    protected $translatable=['site_name','site_desc','site_address','meta_description'];
    protected $table='settings';
    protected $fillable=[
       'site_name',
       'site_desc',
       'site_email',
       'site_address',
       'email_support',
       'facebook_url',
       'twitter_url',
       'youtube_url',
       'meta_description',
       'logo',
       'favicon',
       'promotion_video_url'
    ];
    protected $casts = [
        'site_name' => 'array',
        'site_desc' => 'array',
        'site_address' => 'array',
        'meta_description' => 'array',

    ];
}
