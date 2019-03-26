@foreach($jobs as $job)
    <div class="job-item">
        <div class="row">
            {{--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-sp-12">--}}
            {{--<div class="job-avatar"><img class="img-responsive"--}}
            {{--src="img/default/logo-company/logo1.png"--}}
            {{--alt=""></div>--}}
            {{--</div>--}}
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-name">
                    <a href="{{route('my.jobs', $job->slug)}}"
                       title="{{$job->category->name}}">
                        {{$job->category->name}}
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-company">
                    {{$job->title}}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-location">
                    <i class="fa fa-map-marker"></i>
                    {{$job->rCountry->name??''}} , {{$job->fCity->name??''}}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-posted">
                    <i class="fa fa-clock-o"></i>
                    {{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-salary">
                    <i class="fa fa-paperclip"></i>
                    ${{$job->budget}}
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-salary">
                    <i class="fa fa-handshake-o"></i>
                    {{--@if($job->expired == 1)--}}
                    {{--<a href="{{route('freelancers.show', $job->freelancer->user->slug)}}"> Is Done</a>--}}
                    {{--@else--}}

                    {{$job->proposals()->count()}} Proposal

                    {{--@endif--}}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">
                <div class="extra-info job-salary">
                    <i class="fa fa-handshake-o"></i>
                    {{$job->offers()->count()}} Offers
                </div>
            </div>
        </div>
    </div>
@endforeach
