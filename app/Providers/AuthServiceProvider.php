<?php

namespace App\Providers;

use App\Models\Freelancer;
use App\Models\FreelancerJobOffer;
use App\Models\Job;
use App\Policies\FreelancerPolicy;
use App\Policies\JobPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Freelancer::class => FreelancerPolicy::class,
        Job::class => JobPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('accept-offer', function ($user, $offer) {
            return isset($user->freelancer) && $offer->freelancer_id == $user->freelancer->id && $offer->status == 'in_processing';
        });

        Gate::define('show-jobs', function ($user) {
            return !isset($user->employer);
        });
        Gate::define('show-freelancers', function ($user) {
            return !isset($user->freelancer);
        });

        Gate::define('create-feedback', function ($user, $contract) {
            dd($contract);
            return !isset($user->freelancer);
        });
    }
}
