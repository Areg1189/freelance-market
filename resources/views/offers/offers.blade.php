@extends('layouts.app')

@section('content')
    <div id="columns" class="columns-container">
        <div class="bg-top">
            <div class="col-lg-8 col-md-8 col-sm-1 col-xs-1 col-sp-1">
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
                                        @if(count($job->proposal) < 1)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    You don't have a any offer
                                                </div>
                                            </div>
                                        @endif
                                        @foreach($job->proposal as $offer)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <ul class="list-inline">
                                                        <li><i class="fa fa-user"></i>Freelancer: <a
                                                                    href="{{route('freelancers.show', $offer->user->slug)}}">{{$offer->full_name}}</a>
                                                        </li>
                                                        @if($offer->pivot->count_day)
                                                            <li><i class="fa fa-clock-o"></i>
                                                                Count Day: {{$offer->pivot->count_day}}
                                                            </li>
                                                        @endif
                                                        <li><i class="fa fa-paperclip"></i>Proposed Budget: <span
                                                                    class="salary">${{$job->budget}}</span>
                                                        </li>
                                                        <li>
                                                            <a class="mssg-btn"
                                                               href="{{route('messenger',['slug' =>  $offer->user->slug])}}">
                                                                <i class="fa fa-comments  fa-2x"></i>
                                                            </a>
                                                        </li>
                                                        <li class="pull-right"><a class="btn btn-default"
                                                                                  data-toggle="collapse"
                                                                                  href="#collapse{{$offer->id}}">More...</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div id="collapse{{$offer->id}}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <h5>Freelancer offer to you</h5>
                                                        @if($offer->pivot->budget)
                                                            <p> Freelancer offer message:
                                                                <b>{{$offer->pivot->message}}</b></p>
                                                            <p> Freelancer offer budget :
                                                                <b>$ {{$offer->pivot->budget}}</b>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="panel-body">
                                                        <h5>Replay Your offer to freelancer</h5>
                                                        <p> Your last offer budget :
                                                            <b>${{$offer->pivot->employer_budget}}</b></p>
                                                    </div>
                                                    <div class="panel-body">
                                                        <h5>Replay Your offer to freelancer</h5>
                                                        <form method="post" action="{{route('employer.accept')}}">
                                                            @csrf
                                                            <input hidden name="id" value="{{$offer->pivot->job_id}}">
                                                            <input hidden name="freelancer_id"
                                                                   value="{{$offer->pivot->freelancer_id}}">
                                                            <input type="number" name="budget"
                                                                   value="{{$offer->pivot->employer_budget}}">

                                                            <button type="submit" class="text-center btn btn-default">
                                                                Accept
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    <script>
        $('.accept').click(function (e) {
            e.preventDefault();
            $('#offerModal').modal('show');
        });
    </script>
@stop
