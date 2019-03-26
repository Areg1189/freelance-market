<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class FreelanceTitle extends Model
{
    protected $primaryKey = 'slug';

    protected $keyType = 'string';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Request::is('admin/*')){
            $this->primaryKey = 'id';
        }
    }


    public function jobs(){
        return $this->hasMany(Job::class, 'freelance_title_id', 'id');
    }
}
