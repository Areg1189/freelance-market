<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class Skill extends Model
{
    protected $primaryKey = 'slug';

    protected $keyType = 'string';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Request::is('admin/*')) {
            $this->primaryKey = 'id';
        }
    }


    public function freelancers()
    {
        return $this->belongsToMany(Freelancer::class, 'freelancer_skills', 'skill_id', 'freelancer_id', 'id', 'id');
    }
}
