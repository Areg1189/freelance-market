@extends('layouts.app')

@section('content')
    @if(Auth::guest() || auth()->user()->hasRole('admin'))
        <!--SLIDER-->
        <section class="slider">
            <img src="{{asset('storage/img/slider/slider.jpg')}}" alt="Hire a Prof" class="img-fluid">
        </section>

        <!--INFO-->
        <section class="info-block my-5 py-5">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="col-12 mb-sm-4 mb-2">
                        <h2>Join to our <span class="orange">PROFESSIONALS</span> or post your jobs</h2>
                    </div>
                    <div class="col-md-8">
                        <h4 class="orange">A new way of working is born</h4>
                        <p>

                            The Hire Profs story begins in 2016, when a group of talented web developers from Armenia
                            created a new web-based platform that brought visibility and trust to remote work. It was
                            successful as other businesses would also benefit from reliable access to a larger pool of
                            quality talent, while workers would enjoy freedom and flexibility to find jobs online.
                            Together we decided to start a company called Hire Profs — one of the best global
                            freelancing website for web developers. With hundreds of jobs posted on Hire Profs annually,
                            freelancers are earning money by providing companies with all the necessary skills related
                            to IT technology.
                        </p>
                        <h4 class="orange"> A world of opportunities</h4>
                        <p>Through Hire Profs businesses get more done, connecting with freelancers to work on IT
                            projects related to web and mobile app development. Hire Profs makes it fast, simple, and
                            cost-effective to find, hire, work with, and pay the best professionals anywhere, any
                            time.</p>
                        <h4 class="orange">Our vision</h4>
                        <p>To connect businesses with great talent to work without limits.</p>
                        <h4 class="orange">Our mission</h4>
                        <p>To create economic opportunities so people have better lives.</p>
                        <h4 class="orange">Our values</h4>
                        <ul class="list-style-none">
                            <li>Put our community first.</li>
                            <li>Inspire a boundless future of work.</li>
                            <li>Build amazing teams.</li>
                            <li>Have a bias towards action.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </section>
    @endif
    @auth
        @if( auth()->user()->hasRole('employer'))
            <!--DASHBOARD-->
            <section class="client-block mt-3 pt-3">
                <div class="container ">
                    <h1 class="fw-800 text-center mb-5">Dashboard</h1>
                    <div class="row justify-content-center mb-2">
                        <!--CREATE A JOB-->
                        <div class="col-md-3">
                            <a href="{{route('job.create')}}" class="dash">
                                <div class="create text-center py-3 px-3 bg-orange">
                                    <h6 class="m-0 p-0 white  fw-700">Post a new job</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="{{route('employer.job', ['status' => 'open'])}}" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Active Posts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Expire Posts</h6>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <!--CREATE A JOB-->
                        <div class="col-md-3">
                            <a href="{{route('employer.contracts', ['status' => 'active'])}}" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Active Contracts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="{{route('employer.contracts', ['status' => 'close'])}}" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Close Contracts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">All Reports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--FIND SKILLS-->
                    @forelse($titles->chunk(3) as $chunk)
                        <div class="row justify-content-center ">
                            @foreach($chunk as $title)
                                <div class="col-md-3">

                                    <a href="{{route('freelancers.index',['category'=>$title->slug])}}">
                                        <div class="single-fp bg-white">
                                            <div>
                                                <img src="{{Voyager::image($title->image)}}" alt="{{$title->name}}"
                                                     class="img-fluid">
                                            </div>
                                            <div>
                                                <h5 class="text-center fw-600 py-2">{{$title->name}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <p>No have a Categories</p>
                    @endforelse
                </div>

            </section>
        @endif
        @if( auth()->user()->hasRole('freelancer'))
            <!--JOBS-->
            <section class="freelancer-jobs">
                <div class="container mt-3">
                    <div class="bg-shad">
                        <div class="row justify-content-center">
                            <div class="col-12 ">
                                <div class="fl-job-header py-3 ">
                                    <h1 class="orange fw-800 text-center m-0 ">Posted Jobs</h1>
                                </div>
                            </div>
                            <!--Jobs-->
                            @foreach($jobs as $job)
                                @include('jobs.job-item')
                            @endforeach

                            @if($jobs->hasMorePages())
                                <div class="col-12">
                                    <div class="row align-items-center justify-content-center py-4">
                                        <a href="{{$jobs->nextPageUrl()}}" class="num active" title="Load more job">Load
                                            more job</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

        @endif
    @endauth
@endsection
