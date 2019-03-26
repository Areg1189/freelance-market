<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $table = 'user_messages';

    protected $fillable = ['user_name','email','phone','message'];
}
