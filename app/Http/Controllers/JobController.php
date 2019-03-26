<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyRequest;
use App\Http\Requests\JobRequest;
use App\Models\Country;
use App\Models\FreelanceTitle;
use App\Models\Job;
use App\Models\Plan;
use App\Models\Skill;
use App\Models\User;
use App\Notifications\JobCreate;
use App\Repositories\JobRepository;
use Bnb\Laravel\Attachments\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class JobController extends Controller
{
    private $job;
    private $repository;

    public function __construct(Request $request, JobRepository $repository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('verified', ['except' => ['index', 'show']]);
        if (isset($request->slug)) {
            $this->job = Job::where('slug', $request->slug)->first();
        }
        $this->repository = $repository;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        if (Auth::check()) {
            $this->authorize('show-jobs');
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect('/email/verify');
            }
        }
        $countries = Country::all();
        $titles = FreelanceTitle::all();
        $keyword = $request->keywords;
        $location = $request->location;
        $skills = Skill::all();
        $jobs = Job::where('title', 'like', '%' . $request->keywords . '%')
            ->orderBy('id', 'desc')
            ->where(function ($query) {
                if (Auth::guest() || (isset(auth()->user()->freelancer) && auth()->user()->freelancer->my == 0)) {
                    $query->where('active', 1);
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->category) {
                    $query->whereHas('category', function ($q) use ($request) {
                        $q->where('slug', $request->category);
                    });
                }
                if ($request->location) {

                    $query->whereHas('user', function ($query) use ($request) {
                        $query->whereHas('employer', function ($query) use ($request) {
                            $query->where('country_id', $request->location);
                        });

                    });
                }
                if ($request->budget) {
                    $query->where('budget', $request->budget);
                }
                if ($request->skill) {
                    $query->whereHas('skills', function ($query) use ($request) {
                        $query->where('slug', $request->skill);
                    });
                }

            })->whereNotIn('status', ['canceled', 'completed'])->paginate(10);
        $jobs->appends([
            'keywords' => $request->keywords,
            'category' => $request->category,
            'location' => $request->location,
            'skill' => $request->skill,
        ]);

        return view('jobs.index', compact('jobs', 'titles', 'countries', 'keyword', 'location', 'skills'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job)
    {
        $this->authorize('create', $job);
        $titles = FreelanceTitle::all();
        $plans = Plan::all();
        return view('jobs.create', compact('titles', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request, Job $job)
    {
        try {
            $slug = $this->slugify($request->title);
            $job->freelance_title_id = $request->category;
            $job->title = $request->title;
            $job->description = $request->description;
            $job->budget = $request->budget;
            $job->exp_date = $request->exp_date;
            $job->user_id = auth()->id();
            $job->plan_id = $request->plan;
            $job->slug = $slug;
            $job->freelancer_count = $request->freelancer_count ?? 1;
            $job->save();
            $this->add_job_skills($request->skills, $slug);
            if (is_array($request->attachment_id)) {
                foreach ($request->attachment_id as $item) {
                    Attachment::attach($item, $job);
                }
            }

            toastr()->success('Create job successfully');
            Notification::send(User::where('role_id', 1)->get(), new JobCreate(Auth::user(), $slug));

            $pusher = new Pusher(
                config('messenger.pusher.app_key'),
                config('messenger.pusher.app_secret'),
                config('messenger.pusher.app_id'),
                [
                    'cluster' => config('messenger.pusher.options.cluster')
                ]
            );
            $pusher->trigger('admin-chanel', 'admin-event', [
                'type' => 'create-job',
                'author' => auth()->user()->name,
            ]);

        } catch (\Exception $exception) {
            dd($exception);
        }

        return redirect()->route('employer.job.show', $job->slug)->with(['modal' => true]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        if ($request->ajax()) {

            $job = Job::where('slug', $slug)->firstOrFail();
            $html = view('jobs.show', compact('job'))->render();
            return response()->json(['html' => $html], 200);
        }
        return abort(403);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function slugify($name)
    {
        $slug = str_slug($name);
        if (Job::where('slug', $slug)->first()) {
            while (true) {
                $slug = $slug . '-' . str_random(3);
                if (!Job::where('slug', $slug)->first()) {
                    break;
                }
            }
        }
        return $slug;
    }

    public function add_job_skills(array $skills, $slug)
    {
        $job = Job::where('slug', $slug)->first();
        if (isset($job->skills) && $job->skills->count() > 0) {
            $job->skills()->delete();
        }
        foreach ($skills as $skill) {
            $job->skills()->attach(Skill::where('id', $skill)->first());
        }
    }

    public function favorite(Job $job, Request $request)
    {
        if ($request->ajax()) {
            $job->toggleFavorite();
            return asset('storage/img/' . ($job->isFavorited() ? 'heart-ok.png' : 'heart-no.png'));
        }
    }

    public function newProposal()
    {
        if ($this->job) {
            return view('jobs.new-proposal', ['job' => $this->job]);
        }
    }


    public function storeProposal(ApplyRequest $request)
    {
        try {
            $proposal = $this->repository->storeProposal($this->job, $request->all(), auth()->user()->freelancer->id);
            if ($proposal) {
                toastr()->success('Your proposal successful!');
                return redirect('/');
            }
        } catch (\Exception $e) {
            toastr()->warning('An error has occurred. Try again after reloading the page.');
            return back()->withInput();
        }

    }

    public function beforeCreate(JobRequest $request)
    {
        $job = new Job();
        $slug = $this->slugify($request->title);
        $job->freelance_title_id = $request->category;
        $job->title = $request->title;
        $job->description = $request->description;
        $job->budget = $request->budget;
        $job->exp_date = $request->exp_date;
        $job->user_id = auth()->id();
        $job->plan_id = $request->plan;
        $job->slug = $slug;
        $job->freelancer_count = $request->freelancer_count ?? 1;
        $job->created_at = date("Y-m-d H:i:s");
        $skills = Skill::whereIn('id', $request->skills)->get();
        if ($request->attachment_id && is_array($request->attachment_id)) {
            $attachments = Attachment::whereIn('uuid', $request->attachment_id)->get();
        } else {
            $attachments = [];
        }
        $view = view('jobs.befor-create', compact('job', 'skills', 'attachments'))->render();
        return response()->json(['view' => $view]);
    }


}
