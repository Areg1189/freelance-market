<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $repo;

    public function __construct(SearchRepository $repository)
    {
        $this->repo = $repository;
    }

    public function save(SearchRequest $request){
        $freelancer = auth()->user()->freelancer;
        return $this->repo->save($request, $freelancer);
    }
}
