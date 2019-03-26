@extends('layouts.app')



@section('content')
    {{--{{dd($proposal->pivot)}}--}}
    <div class="container mt-3">
        <div class="row">
            <div class=" bg-white py-3 w-100">
                <h1 class="text-center pb-3">{{$proposal->title}}</h1>
                <!--INFO-->
                <div class="row text-center mt-3">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/category.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">{{$proposal->category->name}}</span>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">{{$proposal->exp_date ? date('F j, Y', strtotime($proposal->exp_date)) : 'Unlimitted'}}</span>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">$ {{$proposal->budget}}</span>
                    </div>
                </div>

                <!--DESCRIPTION-->
                <div class="row m-0 mt-3 job-description-posting">
                    <div class="col-md-12 font-family-gothic">
                        {!! $proposal->description !!}
                    </div>
                </div>

                <!--TAGS-->
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="job-tags">
                            <div class="client-info pr-4 ">
                                <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag" class="mr-2">
                                @foreach($proposal->skills as $skill)
                                    <a href="{{route('job.index',['skill' => $skill->slug])}}" class="tag"><span class="white">{{$skill->name}}</span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <!--ATTACHED FILES-->

                @if(!empty($proposal->attachments) && $proposal->attachments->first())
                    <div class="row mt-3">
                        <div class="col-md-10 offset-md-1">
                            <h6 class="fw-600">Attached Files</h6>
                            <div class="d-flex align-items-center  flex-wrap">
                                @foreach ($proposal->attachments as $file)
                                    <a href="{{$file->getTemporaryUrl(now()->addDay(1))}}" target="_blank">
                                        <div class="atached-files">
                                            <img src="{{asset('images/icon/file.png')}}" width="100%">
                                            <span data-dz-name="">{{$file->group??$file->filename}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif


            </div>

            <div class="col-12 bg-white mt-3">
                <h2 class="text-center py-3 fw-600">Your Proposal</h2>
                <!--INFO-->
                <div class="row text-center mt-3">
                    @if($proposal->pivot->count_day != null)
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <span class="before-pos">Count of days: </span>
                            <span class="before-pos">{{$proposal->pivot->count_day}}</span>
                        </div>
                    @endif
                    @if($proposal->pivot->start_date != null || $proposal->pivot->end_date)
                        <div class="col-md-4 d-flex align-items-center justify-content-center flex-wrap">
                            <div class="w-100">
                                <span class="before-pos">Start date: </span>
                                <span class="before-pos">{{$proposal->pivot->start_date}}</span>
                            </div>
                            <div class="w-100">
                                <span class="before-pos">End date: </span>
                                <span class="before-pos">{{$proposal->pivot->end_date}}</span>
                            </div>
                        </div>
                    @endif
                    @if($proposal->pivot->budget != null)
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                            <span class="before-pos">$ {{$proposal->pivot->budget}}</span>
                        </div>
                    @endif
                </div>


                <!--DESCRIPTION-->
                <h5  class="text-center py-3 fw-600">Proposal message</h5>
                <div class="row m-0 mt-3 pb-3">
                    <div class="col-md-12 font-family-gothic">
                        {!! $proposal->pivot->message !!}
                    </div>
                </div>


            </div>
        </div>
    </div>



@stop