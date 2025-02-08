<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Models\Role as SpatieRole; // استخدام الموديل الصحيح من Spatie
use Spatie\Permission\PermissionRegistrar;

class Role extends SpatieRole // يجب أن يمتد من Spatie\Permission\Models\Role
{
    use HasFactory, HasTranslations;

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = ['name'];
    protected $guard_name='admin';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function () {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        });

        static::updated(function () {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        });

        static::deleted(function () {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        });
    }
}
