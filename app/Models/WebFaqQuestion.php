<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WebFaqQuestion extends Model
{
    use HasFactory,Notifiable;
    public $table="faqs_questions";
    protected $fillable=['name','email','subject','message'];


}
