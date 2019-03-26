<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Employer extends Model
{

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'birthday', 'address', 'country_id', 'city_id', 'state_id', 'postal_code', 'email', 'payer_email', 'avatar',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getPayerEmail()
    {
        return $this->payer_email;
    }

    public function feedbacks()
    {
        return $this->hasMany(EmployerJobFeedbacke::class);
    }

    public function getContractByJob($job_id)
    {
        return $this->feedbacks->where('job_id', $job_id)->first();
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function contracts($status)
    {
        return  $data = $this->user->jobs()->whereHas('workers', function ($q) use ($status){
            $q->where('freelancer_job_workers.status', $status);
        })->with('workers')->orderBy('updated_at', 'desc');
    }


}
