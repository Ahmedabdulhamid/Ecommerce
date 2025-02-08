<?php

namespace App\Models;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Permission extends SpatiePermission
{
    use HasFactory,HasTranslations;
    protected $casts = [
        'name' => 'array', // تحديد أن الحقل من نوع JSON
    ];
    protected $guard_name = 'admin';
    public $translatable = ['name'];
}
