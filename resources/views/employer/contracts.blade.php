@extends('layouts.app')

@section('content')
    <section class="client-block mt-3 pt-3">
        <div class="container ">
            <ul class="nav nav-tabs align-items-center justify-content-center text-center" id="myTab" role="tablist">
                <!--OPEN JOBS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{isset($status) && $status == 'active' ? 'active active-tab' : ''}} ow-tb"
                       id="active-job-tab"
                       href="{{route('employer.contracts', ['status' => 'active'])}}"
                       aria-controls="home" aria-selected="true">Active
                        Contracts({{auth()->user()->employer->contracts('on_development')->count()}})</a>
                </li>
                <!--JOBS IN PROGRESS-->
                <li class="nav-item ow-tabs">
                    <a class="nav-link {{isset($status) && $status == 'close' ? 'active active-tab' : ''}} ow-tb"
                       id="close-contract-tab"
                       href="{{route('employer.contracts', ['status' => 'close'])}}"
                       aria-controls="profile" aria-selected="false">Close Contracts
                        ({{auth()->user()->employer->contracts('canceled')->count()}})</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!--OPEN JOBS-->
                @if(isset($status) && $status == 'active')
                    <div class="tab-pane fade show active" id="active-job"
                         role="tabpanel" aria-labelledby="active-job-tab">
                        @forelse($jobs as $contract)
                            <a href="#0" data-url="{{route('job.show',$contract->slug)}}"
                               class="single-item single-job-show">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center fw-600">{{$contract->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->exp_date  && strtotime($contract->exp_date)? \Carbon\Carbon::parse($contract->exp_date)->format('M. j, Y') : 'Without date'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ 500</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/freelancers/job/info.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->user->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/freelancers/job/picer.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->user->employer->country->code}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/start-time.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{\Carbon\Carbon::parse($contract->updated_at)->format('M. j, Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @foreach($contract->workers->where('pivot.status', 'on_development') as $freelancer)
                                <div class="card">
                                    <div class="card-header py-1" id="heading-{{$freelancer->id}}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link w-100 d-flex align-items-center justify-content-around"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapse-{{$freelancer->id}}" aria-expanded="true"
                                                    aria-controls="collapse-{{$freelancer->id}}">
                                                    <span class="mv-40">
                                                        <img src="{{asset('storage/'.($freelancer->user->avatar??'img/default.png'))}}"
                                                             alt="{{$freelancer->full_name}}" class="img-fluid"/>
                                                    </span>

                                                <a class="mssg-btn fw-600"
                                                   href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    {{$freelancer->full_name}}
                                                </a>
                                                <a class="mssg-btn"
                                                   href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    <img src="{{asset('storage/img/message.png')}}" alt="message"
                                                         class="mv-30"/>
                                                </a>
                                                <button data-url="{{route('contract.show_contract_cancel_modal', ['from' => 'employer', 'contracts' => $freelancer->pivot->id])}}"
                                                        type="button"
                                                        class="own-btn cancel-contract">
                                                    cancel contract
                                                </button>
                                            </button>
                                        </h2>
                                    </div>
                                </div>
                            @endforeach
                    </div>

                    @empty
                        <p>And you have no active contracts.</p>
                    @endforelse

                @elseif(isset($status) && $status == 'close')
                <!--JOBS IN PROGRESS-->
                    <div class="tab-pane fade show active"
                         id="close-contract"
                         role="tabpanel" aria-labelledby="close-contract-tab">
                        @forelse($jobs as $contract)
                            <a href="#0" data-url="{{route('job.show',$contract->slug)}}"
                               class="single-item single-job-show">
                                <div class="to-single mt-3 py-3">
                                    <h5 class="text-center fw-600">{{$contract->title}}</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/category.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->category->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/clock.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->exp_date && strtotime($contract->exp_date) ? \Carbon\Carbon::parse($contract->exp_date)->format('M. j, Y') : 'Without date'}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">$ 500</span>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/freelancers/job/info.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->user->name}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/freelancers/job/picer.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{$contract->user->employer->country->code}}</span>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img src="{{asset('storage/img/icons/start-time.png')}}" alt=""
                                                 class="img-quadro">
                                            <span class="before-pos">{{\Carbon\Carbon::parse($contract->updated_at)->format('M. j, Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @foreach($contract->workers->where('pivot.status', 'canceled') as $freelancer)
                                <div class="card">
                                    <div class="card-header py-1" id="heading-{{$freelancer->id}}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link w-100 d-flex align-items-center justify-content-around"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapse-{{$freelancer->id}}" aria-expanded="true"
                                                    aria-controls="collapse-{{$freelancer->id}}">
                                                    <span class="mv-40">
                                                        <img src="{{asset('storage/'.($freelancer->user->avatar??'img/default.png'))}}"
                                                             alt="{{$freelancer->full_name}}" class="img-fluid"/>
                                                    </span>

                                                <a class="mssg-btn fw-600"
                                                   href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    {{$freelancer->full_name}}
                                                </a>
                                                <a class="mssg-btn"
                                                   href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    <img src="{{asset('storage/img/message.png')}}" alt="message"
                                                         class="mv-30"/>
                                                </a>
                                            </button>
                                        </h2>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <p>And you have no active contracts.</p>
                        @endforelse
                    </div>
                @endif
            </div>
        </div>

    </section>
@stop


