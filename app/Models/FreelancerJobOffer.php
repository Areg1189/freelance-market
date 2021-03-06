<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerJobOffer extends Model
{
    protected $fillable = [
        'job_id', 'freelancer_id', 'budget', 'status',
    ];

    public function job(){
        return $this->belongsTo(Job::class,'job_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id');
    }
}
