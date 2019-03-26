<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Freelancer;
use App\Models\FreelanceTitle;
use App\Models\Job;
use App\Models\User;
use App\Repositories\FreelancerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new FreelancerRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) $this->authorize('show-freelancers');
        $countries = Country::all();
        $titles = FreelanceTitle::where('active', 1)->get();
        $category = FreelanceTitle::where('slug', $request->category)->first();
//        $freelancers = Freelancer::orderBy('id', 'desc')->where('country', '>', 0)->paginate(1);
        $freelancers = Freelancer::where('title', 'like', '%' . $request->keywords . '%')
            ->orderBy('id', 'desc')
//            ->orWhere('description', 'like', '%' . $request->keywords . '%')
            ->where(function ($query) use ($request) {
                if ($request->category) {
                    $query->whereHas('category', function ($q) use ($request) {
                        $q->where('slug', $request->category);
                    });
                }
                if ($request->location) {

                    $query->whereHas('user', function ($query) use ($request) {
                        $query->whereHas('freelancer', function ($query) use ($request) {
                            $query->where('country', $request->location);
                        });

                    });
                }
                if ($request->skill) {
                    $query->whereHas('skills', function ($query) use ($request) {
                        $query->where('slug', $request->skill);
                    });
                }
            })->paginate(10);
        $freelancers->appends([
            'keywords' => $request->keywords,
            'category' => $request->category,
            'location' => $request->location,
            'skill' => $request->skill,
        ]);

        if ($request->ajax()) {
            $data['html'] = view('freelancers.frellance-item', compact('freelancers'))->render();
            $data['nextUrl'] = $freelancers->nextPageUrl() ?? false;
            $data['success'] = true;
            return response()->json($data);

        } else {
            return view('freelancers.index', compact('freelancers', 'titles', 'countries', 'category'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $freelancer = User::where('slug', $slug)->firstOrFail()->freelancer;
        return view('freelancers.show', compact('freelancer'));
    }


//    public function offers(Request $request)
//    {
//        if (auth()->user()->hasRole('freelancer')) {
//            $page = 'offers';
//            $jobs = auth()->user()->freelancer->offers()->orderBy('pivot_id', 'desc')->paginate(10);
//            if ($request->ajax()) {
//                return response()->json($this->repository->ajaxLoad($jobs, $page));
//            } else {
//                return view('freelancers.my', compact('jobs', 'page'));
//            }
//        }
//
//
//    }

    public function proposal(Request $request)
    {

        if (auth()->user()->hasRole('freelancer')) {
            $page = 'proposal';
            $jobs = auth()->user()->freelancer->proposals()->orderBy('pivot_created_at', 'desc')->paginate(4);
            if ($request->ajax()) {
                return response()->json($this->repository->ajaxLoad($jobs, $page));
            } else {
                return view('freelancers.my', compact('jobs', 'page'));

            }
        }
        return abort(403);
    }

    public function favorite(Request $request)
    {

        if (auth()->user()->hasRole('freelancer')) {
            $page = 'favorite';
            $jobs = auth()->user()->favorites()->orderBy('created_at', 'desc')->paginate(10);
            if ($request->ajax()) {
                return response()->json($this->repository($jobs, $page));
            } else {

                return view('freelancers.my', compact('jobs', 'page'));

            }
        }
        return abort(403);
    }

    public function contracts(Request $request)
    {

        if (auth()->user()->hasRole('freelancer')) {
            $status = $request->status;
            if ($status == 'offers'){
                $jobs = auth()->user()->freelancer->offers()->orderBy('pivot_id', 'desc')->paginate(10);
            }else{
                $jobs = auth()->user()->freelancer->hiredJobs()->wherePivot('status', ($status == 'active' ? 'on_development' : 'canceled'))->orderBy('pivot_created_at', 'desc')->paginate(10);
            }
            $page = 'contracts';
            if ($request->ajax()) {
                return response()->json($this->repository($jobs, $page));
            } else {
                return view('freelancers.my', compact('jobs', 'page', 'status'));
            }
        }
        return abort(403);
    }


    public function reports()
    {
        return view('freelancers.reports');
    }

    public function showProposal(Request $request)
    {
        $proposal = auth()->user()->freelancer->proposals()->where(function ($query) use ($request) {
            $query->where('slug', $request->job_slug);
        })->firstOrFail();
        return view('freelancers.show-proposal', compact('proposal'));
    }

}
