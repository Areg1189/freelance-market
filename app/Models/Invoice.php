<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'job_id', 'employer_id', 'freelancer_id', 'invoice_id', 'webhokk_id', 'status', 'cancelled_date', 'offer_id', 'cancel',
    ];

    public function job(){
        return $this->belongsTo(Job::class,'job_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id');
    }
    public function employer(){
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
