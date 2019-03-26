<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 31.01.2019
 * Time: 16:33
 */

namespace App\Repositories;

use App\Models\Apply;
use App\Models\FreelancerJob;
use App\Models\Job;
use App\Notifications\JobApply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ApplyRepository
{

    public function getJob($slug){

        $job = Job::where('slug', $slug)->where('expired',0)->first();
        if($job){
            $proposal = FreelancerJob::where('freelancer_id', Auth::id())
                ->where('job_id',$job->id)->first();
            if($proposal){
                $job->apply = 1;
            }
        }
        return $job;

    }

    public function store($slug, $request){
        $job = Job::where('slug', $slug)->first();
        dd($job);
        $proposal = FreelancerJob::create([
            'job_id' => $job->id,
            'freelancer_id' => Auth::user()->freelancer->id,
            'message' => $request->message,
            'employer_budget' => $job->budget,
            'offer_budget' => $request->budget,
            'last_budget' => $job->budget,
            'expired_date' => date('Y-m-d'),
        ]);
        Notification::send($job->user, new JobApply($proposal));

        return $proposal;
    }

}