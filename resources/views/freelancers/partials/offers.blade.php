@foreach($jobs as $job)
    {{--<div class="job-item">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-sp-12">--}}
            {{--<div class="job-avatar"><img class="img-responsive"--}}
            {{--src="img/default/logo-company/logo1.png"--}}
            {{--alt=""></div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
                {{----}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
                {{--<div class="extra-info job-company">--}}
                    {{--{{$job->title}}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
                {{--<div class="extra-info job-location">--}}
                    {{--<i class="fa fa-map-marker"></i>--}}
                    {{--{{$job->rCountry->name??''}} , {{$job->fCity->name??''}}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
                {{--<div class="extra-info job-posted">--}}
                    {{--<i class="fa fa-clock-o"></i>--}}
                    {{--{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
                {{--<div class="extra-info job-salary">--}}
                    {{--<i class="fa fa-paperclip"></i>--}}
                    {{--${{$job->budget}}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}


    <div class=" col-sp-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="extra-info job-name">
                   View job :  <div data-url="{{route('job.show', $job->slug)}}"
                                    class="single-item single-job-show"
                       title="{{$job->category->name}}">
                        {{$job->category->name}}
                    </div>
                </div>
                <div>
                    <span>
                        {{optional($job->pivot->created_at)->diffForHumans()}}
                    </span>
                </div>
                @if($job->workers->contains(auth()->user()->freelancer->id) && $job->pivot->status == 'accepted')
                    <i class="fa fa-chevron-circle-down fa-2x" aria-hidden="true"></i>
                    You have confirmed this offer.
                @else
                    @if($job->pivot->status == 'canceled')
                        <i class="fa fa-ban fa-2x"></i>
                        Offer is canceled.
                    @else
                        @if (auth()->user()->can('accept-offer', $job->pivot) and auth()->user()->can('toHireJob', $job))
                            <a href="{{route('offer.accept', ['freelancerJobOffer' => $job->pivot->id])}}"
                               type="button"
                               data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."
                               data-target="{{$job->id}}" class="own-btn offer-btn">Accept</a>
                            <a href="{{route('offer.cancel', ['freelancerJobOffer' => $job->pivot->id])}}"
                               type="button"
                               data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."
                               data-target="{{$job->id}}" class="own-btn offer-btn">Cancel</a>
                        @else
                            <p> <i class="fa fa-ban fa-2x"></i> This job was done or done to another freelancer.</p>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>

@endforeach
