<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EmployerJobFeedbacke extends Model
{
    protected $fillable = [
        'employer_id', 'job_id', 'freelancer_id', 'feedback', 'publish',
    ];
}
