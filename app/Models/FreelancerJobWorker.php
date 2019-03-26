<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FreelancerJobWorker extends Pivot
{

    protected  $table = 'freelancer_job_workers';

    public function histories()
    {
        return $this->hasMany(FreelancerJobWorkerHistory::class, 'freelancer_job_worker_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id' );
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id', 'id' );
    }
}
