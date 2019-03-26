<?php

namespace App\Models;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Model;

class FreelancerJobWorkerHistory extends Model
{
    use HasAttachment;
    public function contract(){
        return $this->belongsTo(FreelancerJobWorker::class, 'freelancer_job_worker_id', 'id');
    }
}
