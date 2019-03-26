<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use App\Models\Freelancer;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class FreelancerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */
    public function view(User $user, Freelancer $freelancer)
    {
        //
    }

    public function browse(User $user, Freelancer $freelancer)
    {

        return $user->hasPermission('browse_freelancers');
    }


    public function read(User $user,  Freelancer $freelancer)
    {
        return $user->hasPermission('read_freelancers');
    }

    /**
     * Determine whether the user can create freelancers.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('add_freelancers');
    }


    /**
     * Determine whether the user can create freelancer.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function add(User $user)
    {
        return $user->hasPermission('add_freelancers');
    }

    /**
     * Determine whether the user can update the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Job $job
     * @return mixed
     */
    public function edit(User $user, Freelancer $freelancer)
    {
        return $user->hasPermission('edit_freelancers');
    }

    /**
     * Determine whether the user can update the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */


    public function update(User $user, Freelancer $freelancer)
    {
        //
    }

    /**
     * Determine whether the user can delete the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */
    public function delete(User $user, Freelancer $freelancer)
    {
        return $user->hasPermission('delete_freelancers');
    }

    /**
     * Determine whether the user can restore the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */
    public function restore(User $user, Freelancer $freelancer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */
    public function forceDelete(User $user, Freelancer $freelancer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the freelancer.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Freelancer $freelancer
     * @return mixed
     */
    public function hireFreelancer(User $user, Freelancer $freelancer)
    {
        return isset($user->employer);
    }

}
