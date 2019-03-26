<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\FreelanceTitle;
use App\Models\Job;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole('freelancer')) return redirect()->route('job.index');
            if (auth()->user()->hasRole('employer')) $titles = FreelanceTitle::where('active', 1)->get();
        }
        return view('dashboard.home', compact('titles'));
    }

    public function page(Request $request){
        $page = Page::where('slug',$request->slug)->first();
        if($page){
            return view('pages.page', compact('page'));
        }else{
            return abort(404);
        }
    }


}
