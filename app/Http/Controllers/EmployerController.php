<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class EmployerController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function jobs(Request $request)
    {
        if ($request->status == 'in-processing') $status = 'on_development';
        else $status = $request->status;
        $jobs = $this->user->jobs->where('status', $status);
        return view('employer.Jobs', compact('jobs', 'status'));
    }

    public function job($slug, $open = 'details')
    {

        $job = $this->user->jobs->where('slug', $slug)->first();

        if ($job) {
            $skills = $job->skills()->select('skill_id')->get()->map(function ($q) {
                return $q->skill_id;
            });
            $offers = $job->offers()->get()->map(function ($q) {
                return $q->id;
            });
            $proposal_freelancers = $job->proposals()->get()->map(function ($q) {
                return $q->id;
            });

            $fest_match_freelancers = Freelancer::whereHas('skills', function ($query) use ($skills) {
                $query->whereIn('skill_id', $skills->toArray());
            })->whereNotIn('id', $proposal_freelancers->toArray())->whereNotIn('id', $offers->toArray());


            if (session('modal')) {
                $job->modal = true;
                $fest_match_freelancers = $fest_match_freelancers->where('my',1)->get();
            }else{
                $fest_match_freelancers = $fest_match_freelancers->get();
            }

            return view('employer.Job', compact('job', 'fest_match_freelancers', 'open'));
        }
        return abort(403);
    }

    public function contracts($status)
    {
        $jobs = auth()->user()->employer->contracts($status == 'active' ? 'on_development' : 'canceled')->paginate(10);
        return view('employer.contracts', compact('jobs', 'status'));
    }


    public function reports()
    {

        return view('employer.reports');
    }

}
