<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 01.02.2019
 * Time: 13:53
 */

namespace App\Repositories;

use App\Models\Freelancer;
use App\Models\FreelancerJob;
use App\Models\Job;
use App\Notifications\ProposalAccepted;
use Illuminate\Support\Facades\Notification;

class AcceptRepository
{

    public function setAcceptEmployer($request){
        $job = Job::where('id',$request->id)->first();

        $proposal = FreelancerJob::where('job_id', $request->id)->where('freelancer_id', $request->freelancer_id)->first();
        $proposal->employer_budget = $request->budget;
        $proposal->last_budget = $request->budget;
        $proposal->expired = 1;
        $proposal->save();

        $freelancer = Freelancer::find($request->freelancer_id);

        $from = 'EMPLOYER';
        Notification::send($freelancer->user, new ProposalAccepted($job->slug, $proposal, $from));

        return $job;
    }

    public function setAcceptFreelancer($request){

        $job = Job::where('id',$request->id)->first();
        $job->expired = 1;
        $job->freelancer_id = $request->freelancer_id;
        $job->save();

        $proposal = FreelancerJob::where('job_id', $request->id)->where('freelancer_id', $request->freelancer_id)->first();

        $from = 'FREELANCER';
        Notification::send($job->user, new ProposalAccepted($job->slug, $proposal, $from));

        return $job;
    }

    public function cancelFreelancer($request){
        $proposal = FreelancerJob::where('job_id', $request->id)
            ->where('freelancer_id',$request->freelancer_id)
            ->delete();

        return $proposal;
    }
}