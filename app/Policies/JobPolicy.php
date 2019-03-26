<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Facades\Voyager;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function view(User $user, Job $job)
    {
        dd('JobPolicy');
    }


    public function browse(User $user, Job $job)
    {
        return $user->hasPermission('browse_jobs');
    }

    public function read(User $user, Job $job)
    {
        return $user->hasPermission('read_jobs');
    }

    /**
     * Determine whether the user can create jobs.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('add_jobs');
    }

    /**
     * Determine whether the user can create jobs.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function add(User $user)
    {
        return $user->hasPermission('add_jobs');
    }

    /**
     * Determine whether the user can update the job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function edit(User $user, Job $job)
    {
        return $user->hasPermission('edit_jobs');
    }

    /**
     * Determine whether the user can delete the job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function delete(User $user, Job $job)
    {
        return $user->hasPermission('delete_jobs');
    }

    /**
     * Determine whether the user can restore the job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function restore(User $user, Job $job)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function forceDelete(User $user, Job $job)
    {
        //
    }


    /**
     * Determine whether the user can do this job.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */

    public function makeOffer(User $user, Job $job)
    {
        return $user->freelancer->offers->where('pivot.status', 'in_processing')->where('pivot.job_id', $job->id)->first() ? false : true;
    }


    /**
     * Determine whether the user can send a proposal.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */

    public function sendProposal(User $user, Job $job)
    {

        return !$user->freelancer->offers->where('pivot.status', 'in_processing')->where('pivot.job_id', $job->id)->first() && $this->toHireJob($user, $job);
    }

    /**
     * Determine whether the user can send a proposal.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */

    public function toHireJob(User $user, Job $job)
    {

        return $job->workers->count() < $job->freelancer_count;

    }



}
