<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FreelancerWorkHistory extends Model
{
    protected $fillable = [
        'job_id', 'work_history', 'work_date', 'feedback', 'star', 'earned', 'hour_rate', 'work_hours', 'freelancer_id'
    ];
}
