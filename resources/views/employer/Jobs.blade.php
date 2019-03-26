@extends('layouts.app')

@section('content')
    <!--DASHBOARD-->
    <section class="client-block mt-5 pt-3">
        <div class="container ">
            <ul class="nav nav-tabs align-items-center justify-content-center text-center" id="myTab" role="tablist">
                <!--OPEN JOBS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{$status == 'open' ? 'active active-tab' : ''}}  ow-tb" id="open-job-tab"
                       href="{{route('employer.job', ['status' => 'open'])}}" role="tab"
                       aria-controls="home" aria-selected="true">Open ({{auth()->user()->jobs->where('status', 'open')->count()}})</a>
                </li>
                <!--JOBS IN PROGRESS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{$status == 'on_development' ? 'active active-tab' : ''}} ow-tb"
                       id="in-progress-tab" href="{{route('employer.job', ['status' => 'in-processing'])}}" role="tab"
                       aria-controls="profile" aria-selected="false">In progress
                        ({{auth()->user()->jobs->where('status', 'on_development')->count()}})</a>
                </li>
                <!--COMPLETED JOBS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{$status == 'completed' ? 'active active-tab' : ''}} ow-tb" id="completed-tab"
                       href="{{route('employer.job', ['status' => 'completed'])}}" role="tab" aria-controls="profile"
                       aria-selected="false">Completed ({{auth()->user()->jobs->where('status', 'completed')->count()}})</a>
                </li>
                <!--CANCELED JOBS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{$status == 'canceled' ? 'active active-tab' : ''}} ow-tb" id="canceled-tab"
                       href="{{route('employer.job', ['status' => 'canceled'])}}" role="tab" aria-controls="profile"
                       aria-selected="false">Canceled ({{auth()->user()->jobs->where('status', 'canceled')->count()}})</a>
                </li>
                <a class="own-btn  d-flex align-items-center" href="{{route('job.create')}}">Create new job post</a>
            </ul>
            <div class="tab-content" id="myTabContent">
            @if($status == 'open')
                <!--OPEN JOBS-->
                    <div class="tab-pane fade {{$status == 'open' ? 'show active' : ''}}" id="open-job" role="tabpanel"
                         aria-labelledby="open-job-tab">
                        @forelse($jobs->sortByDesc('id') as $job)
                            <a href="{{route('employer.job.show', $job->slug)}}" class="single-item"
                               title="{{$job->title}}">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center ">{{$job->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}"
                                                 alt="{{$job->category->name}}" class="img-quadro">
                                            <span class="before-pos">{{$job->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ {{$job->budget}}</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/handshake.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Proposals ({{$job->proposals()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/invite.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Invites ({{$job->offers()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/hire.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Hire (2)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            O result
                        @endforelse
                    </div>
            @elseif($status == 'on_development')
                <!--JOBS IN PROGRESS-->
                    <div class="tab-pane fade {{$status == 'on_development' ? 'show active' : ''}}" id="in-progress"
                         role="tabpanel" aria-labelledby="in-progress-tab">
                        @forelse($jobs->sortByDesc('id') as $job)
                            <a href="{{route('employer.job.show', $job->slug)}}" class="single-item"
                               title="{{$job->title}}">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center ">{{$job->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}"
                                                 alt="{{$job->category->name}}" class="img-quadro">
                                            <span class="before-pos">{{$job->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ {{$job->budget}}</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/handshake.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Proposals ({{$job->proposals()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/invite.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Invites ({{$job->offers()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/hire.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Hire (2)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            O result
                        @endforelse
                    </div>
            @elseif($status == 'completed')
                <!--COMPLETED JOBS-->
                    <div class="tab-pane fade {{$status == 'completed' ? 'show active' : ''}}" id="completed"
                         role="tabpanel" aria-labelledby="completed-tab">
                        @forelse($jobs->sortByDesc('id') as $job)
                            <a href="{{route('employer.job.show', $job->slug)}}" class="single-item"
                               title="{{$job->title}}">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center ">{{$job->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}"
                                                 alt="{{$job->category->name}}" class="img-quadro">
                                            <span class="before-pos">{{$job->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ {{$job->budget}}</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/handshake.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Proposals ({{$job->proposals()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/invite.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Invites ({{$job->offers()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/hire.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Hire (2)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            O result
                        @endforelse
                    </div>
            @elseif($status == 'canceled')
                <!--CANCELED JOBS-->
                    <div class="tab-pane fade {{$status == 'canceled' ? 'show active' : ''}}" id="canceled"
                         role="tabpanel" aria-labelledby="canceled-tab">
                        @forelse($jobs->sortByDesc('id') as $job)
                            <a href="{{route('employer.job.show', $job->slug)}}" class="single-item"
                               title="{{$job->title}}">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center ">{{$job->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}"
                                                 alt="{{$job->category->name}}" class="img-quadro">
                                            <span class="before-pos">{{$job->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ {{$job->budget}}</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/handshake.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Proposals ({{$job->proposals()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/invite.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Invites ({{$job->offers()->count()}})</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/hire.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">Hire (2)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            O result
                        @endforelse
                    </div>
            @endif
            </div>
        </div>

    </section>
@stop