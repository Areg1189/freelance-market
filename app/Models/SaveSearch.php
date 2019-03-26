<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveSearch extends Model
{
    protected $fillable = [
        'keywords', 'category_id', 'freelancer_id', 'location_id', 'project_type', 'skill_id', 'budget'
    ];

    public function skill(){
        return $this->belongsTo(Skill::class,'skill_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class,'freelancer_id', 'id');
    }

    public function category(){
        return $this->belongsTo(FreelanceTitle::class, 'category_id', 'id');
    }

    public function location(){
        return $this->belongsTo(Country::class, 'location_id', 'id');
    }
}
