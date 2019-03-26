<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerJob extends Model
{
    protected $table = 'freelancer_job';

    protected $fillable = [
        'job_id', 'freelancer_id', 'count_day', 'message', 'budget', 'data', 'start_date', 'end_date'
    ];

    public function job(){
        return $this->belongsTo(Job::class,'job_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id');
    }

}
