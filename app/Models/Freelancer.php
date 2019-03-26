<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Freelancer extends Model
{
    protected $fillable = [
        'full_name', 'country', 'city', 'title', 'overview', 'hourly_rate', 'total_earned','jobs','hours_worked', 'employments', 'educations', 'availability', 'languages', 'email', 'user_id', 'avatar', 'birthday', 'freelancer_id', 'work_history',
    ];

    public function fCountry(){
        return $this->belongsTo(Country::class, 'country', 'id');
    }


    public function fCity(){
        return $this->belongsTo(City::class, 'id', 'city');
    }

    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'freelancer_skills', 'freelancer_id','skill_id', 'id', 'id')
            ->withPivot('percent');
    }

    public function category(){
        return $this->belongsTo(FreelanceTitle::class, 'freelancer_id', 'id');
    }

    public function portfolios(){
        return $this->belongsToMany(Portfolio::class, 'freelancer_portfolio', 'freelancer_id', 'portfolio_id', 'id', 'id');
    }

    public function proposals(){
        return $this->belongsToMany(Job::class, 'freelancer_job', 'freelancer_id', 'job_id', 'id', 'id')->withPivot('message', 'budget', 'data', 'count_day','start_date','end_date')->withTimestamps();
    }

    public function offers(){
        return $this->belongsToMany(Job::class, 'freelancer_job_offers', 'freelancer_id', 'job_id', 'id', 'id')->withPivot('budget', 'status', 'id')->withTimestamps();
    }

    public function hiredJobs(){
        return $this->belongsToMany(Job::class, 'freelancer_job_workers', 'freelancer_id', 'job_id', 'id', 'id')
            ->using('App\Models\FreelancerJobWorker')
            ->withPivot('id','budget', 'status', 'data')
            ->withTimestamps()/*->limit($this->freelancer_count)*/;
    }


    public function workHistories()
    {
        return $this->hasMany(FreelancerWorkHistory::class, 'freelancer_id', 'id');
    }

    public function getContractByJob($job_id)
    {
        return $this->workHistories->where('job_id', $job_id)->first();
    }

    public function jobSuccessfullyPercent(){

            return DB::table('freelancer_work_histories')->select( DB::raw('(SUM(star)  / (select count(*) as count from freelancer_work_histories where `freelancer_id` = '.$this->id.' and `star` > 0)) / 5 * 100 as percent'))->where('freelancer_id', $this->id)->first();
    }

}
