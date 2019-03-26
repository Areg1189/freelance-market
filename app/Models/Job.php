<?php

namespace App\Models;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use ChristianKuri\LaravelFavorite\Models\Favorite;


class Job extends Model
{
    use Favoriteable, HasAttachment;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (Request::is('admin/*')) {
            $this->primaryKey = 'id';
        } elseif (Request::is('create/*') || Request::is('store/*') /*|| Request::is('job/*')*/) {
            $this->primaryKey = 'slug';
        }
    }

    public function category()
    {
        return $this->belongsTo(FreelanceTitle::class, 'freelance_title_id', 'id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill', 'job_id', 'skill_id', 'id', 'id');
    }

    public function offers()
    {
        return $this->belongsToMany(Freelancer::class, 'freelancer_job_offers', 'job_id', 'freelancer_id', 'id', 'id')
            ->withPivot('budget', 'status', 'id')->withTimestamps();
    }

    public function proposals()
    {
        return $this->belongsToMany(Freelancer::class, 'freelancer_job', 'job_id', 'freelancer_id', 'id', 'id')
            ->withPivot('message', 'budget', 'data', 'count_day', 'start_date', 'end_date')->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class, 'id', 'freelancer_id');
    }

    public function myFavorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable'/*, null, null, 'id'*/);
    }

    public function executor()
    {
        return $this->hasOne(Freelancer::class, 'id', 'freelancer_id');
    }

    public function workers()
    {
        return $this->belongsToMany(Freelancer::class, 'freelancer_job_workers', 'job_id', 'freelancer_id', 'id', 'id')
            ->using('App\Models\FreelancerJobWorker')
            ->withPivot('id','budget', 'status', 'data')
            ->withTimestamps()/*->limit($this->freelancer_count)*/;
    }

    public function workerWaiting(){
        return $this->belongsToMany(Freelancer::class, 'freelancer_job_workers', 'job_id', 'freelancer_id', 'id', 'id')
            ->using('App\Models\FreelancerJobWorker')
            ->wherePivot('status', 'on_waiting')
            ->withPivot('id','budget', 'status', 'data')
            ->withTimestamps();
    }
    public function contracts(){
        return $this->belongsToMany(Freelancer::class, 'freelancer_job_offers', 'job_id', 'freelancer_id', 'id', 'id')
            ->using('App\Models\FreelancerJobWorker')
            ->wherePivot('status', 'accepted')
            ->withPivot('id','budget', 'status')
            ->withTimestamps();
    }


}
