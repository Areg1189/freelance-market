@extends('layouts.app')

@section('content')
    <div id="columns" class="columns-container">
        <div class="bg-top">
            <div class="col-lg-8 col-md-8 col-sm-1 col-xs-1 col-sp-1">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="warpper">
            <!-- container -->
            <div class="container">
                <div class="job-detail">
                    <div class="job-detailtop clearfix">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-sp-3">
                                <div class="job-avatarprofile">
                                    {{--<img class="img-responsive" src="img/default/avatar/avatar-profile.jpg" alt="">--}}
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-sp-9">
                                <div class="job-meta">
                                    <div class="panel-group">
                                        @if(count($offers) == 0)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    You don't have a any offer
                                                </div>
                                            </div>
                                        @endif
                                        @foreach($offers as $offer)
                                            @if($offer->job->expired == 0)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <ul class="list-inline">
                                                        <li><i class="fa fa-briefcase"></i>Job:  <a href="{{route('job.show', $offer->job->slug)}}">{{$offer->job->title}}</a></li>
                                                        {{--<li><i class="fa fa-clock-o"></i>Count Day: {{$offer->pivot->count_day}}</li>--}}
                                                        <li><i class="fa fa-paperclip"></i>Budget: <span class="salary">${{$offer->job->budget}}</span></li>
                                                        <li>
                                                            <a class="mssg-btn" href="{{route('messenger',['slug' =>  $offer->job->user->slug])}}">
                                                                <i class="fa fa-comments  fa-2x"></i>
                                                            </a>
                                                        </li>
                                                        <li class="pull-right" ><a class="btn btn-default" data-toggle="collapse" href="#collapse{{$offer->id}}">More...</a></li>
                                                    </ul>
                                                </div>
                                                <div id="collapse{{$offer->id}}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <h5>Your offer to Employer</h5>
                                                        <p> Your offer budget :   <b>${{$offer->offer_budget}}</b> </p>
                                                        <p> Your offer message:   <b>{{$offer->message}}</b> </p>

                                                    </div>
                                                    <div class="panel-body">
                                                        <h5>Employer's offer for you</h5>
                                                        <p>You want to start job for <b>${{$offer->employer_budget}}</b> budget?</p>
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="list-inline">
                                                            <li>
                                                                <form method="post" action="{{route('freelancer.accept')}}">
                                                                    @csrf
                                                                    <input hidden name="id" value="{{$offer->job_id}}">
                                                                    <input hidden name="freelancer_id" value="{{$offer->freelancer_id}}">
                                                                    <button type="submit" class="text-center btn btn-default">Accept</button>
                                                                </form>
                                                            </li>
                                                            <li>Or</li>
                                                            <li>
                                                                <form method="post" action="{{route('freelancer.cancel')}}">
                                                                    @csrf
                                                                    <input hidden name="id" value="{{$offer->job_id}}">
                                                                    <input hidden name="freelancer_id" value="{{$offer->freelancer_id}}">

                                                                    <button type="submit" class="text-center btn btn-default">Cancel</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end job-detailtop -->
                </div><!-- end job-detail -->
            </div> <!-- end container -->
        </div><!-- end warpper -->
        <div class="bg-bottom"></div>
    </div><!--end columns-->

@stop
@section('script')
    @parent
@stop
