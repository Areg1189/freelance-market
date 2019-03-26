<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyRequest;
use App\Repositories\ApplyRepository;

class ApplyController extends Controller
{
    protected $repo;
    public function __construct(ApplyRepository $repository)
    {
        $this->repo = $repository;
    }

    public function newApply($slug)
    {
        $this->authorize(auth()->user()->hasPermission('apply_job'));
        $job = $this->repo->getJob($slug);
        if($job){
            return view('apply.new-apply', compact('job'));
        }else{
            return redirect('job');
        }

    }

    public function store($slug, ApplyRequest $request){
        $proposal = $this->repo->store($slug,$request);

        return redirect( '/job/'.$slug)->with('message', 'Your proposal successful!');
    }


}
