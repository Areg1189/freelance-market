<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 01.02.2019
 * Time: 13:53
 */

namespace App\Repositories;


use App\Models\FreelancerJob;
use App\Models\Job;
use App\Notifications\JobApply;
use Illuminate\Support\Facades\Notification;

class JobRepository
{

//    public function getJob($slug)
//    {
//
//        $job = Job::where('slug', $slug)->where('expired', 0)->firstOrFail();
//        if ($job) {
//            $proposal = FreelancerJob::where('freelancer_id', Auth::id())
//                ->where('job_id', $job->id)->first();
//            if ($proposal) {
//                $job->apply = 1;
//            }
//        }
//        return $job;
//
//    }

    public function storeProposal($job, $data, $freelancer_id)
    {
        $proposal = FreelancerJob::create([
            'job_id' => $job->id,
            'freelancer_id' => $freelancer_id,
            'message' => $data['message'],
            'budget' => $data['budget']??null,
            'data' => $data['data']??null,
            'start_date' => strtotime($data['start_date']) ? date('Y-m-d', strtotime($data['start_date'])) : null,
            'end_date' => strtotime($data['end_date']) ? date('Y-m-d', strtotime($data['end_date'])) : null,
        ]);
        Notification::send($job->user, new JobApply($proposal, $job->slug));

        return $proposal;
    }
}