<section class="client-block mt-3 pt-3">
    <div class="container ">
        <h1 class="fw-700 text-center">Proposals</h1>
        <!--PROPOSALS-->
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-lg-6">
                    <a href="{{route('freelancer.show_proposal', ['job_slug' => $job->slug])}}" class="single-item">
                        <div class="to-single mt-3 p-3 ">
                            <h5 class="text-center fw-600">{{$job->title}}</h5>
                            <div class="row text-center mt-3">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/category.png')}}"
                                         alt="{{$job->category->name}}" class="img-quadro">
                                    <span class="before-pos fs-13">{{$job->category->name}}</span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                                    <span class="before-pos fs-13">{{$job->exp_date ? \Carbon\Carbon::parse($job->exp_date)->format('M. j, Y') : 'Without date'}}</span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/price.png')}}" alt="{{$job->pivot->budget}}"
                                         class="img-quadro">
                                    <span class="before-pos fs-13">$ {{$job->pivot->budget}}</span>
                                </div>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/freelancers/job/info.png')}}" alt=""
                                         class="img-quadro">
                                    <span class="before-pos fs-13">
                                            {{$job->user->jobs->where('status', 'completed')->count() > 0 ? $job->user->jobs->where('status', 'completed')->count().' Job completed' : 'No jobs completed yet'}}
                                        </span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/freelancers/job/picer.png')}}"
                                         alt="{{$job->user->employer->country->code ?? ''}}" class="img-quadro">
                                    <span class="before-pos fs-13">{{$job->user->employer->country->code ?? ''}}</span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/hire.png')}}" alt="" class="img-quadro">
                                    <span class="before-pos fs-13">Hire ({{$job->workers->count()}})</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{--@if ($jobs->lastPage() > 1)--}}
        {{--<div class="row align-items-center justify-content-center py-4">--}}
        {{--<a href="{{ ($jobs->currentPage() == 1) ? '' : $jobs->url(1) }}">Previous</a>--}}
        {{--@for ($i = 1; $i <= $jobs->lastPage(); $i++)--}}
        {{--<a class="num{{ ($jobs->currentPage() == $i) ? ' active' : '' }}"--}}
        {{--href="{{ $jobs->url($i) }}">{{ $i }}</a>--}}
        {{--@endfor--}}
        {{--<a href="{{ ($jobs->currentPage() == $jobs->lastPage()) ? '' : $jobs->url($jobs->currentPage()+1) }}">Next</a>--}}
        {{--</div>--}}
        {{--@endif--}}

    </div>

</section>
{{--@foreach($jobs as $job)--}}
{{--<div class="job-item" data-toggle="collapse" data-target="#{{$job->slug}}">--}}
{{--<div class="row">--}}
{{--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-sp-12">--}}
{{--<div class="job-avatar"><img class="img-responsive"--}}
{{--src="img/default/logo-company/logo1.png"--}}
{{--alt=""></div>--}}
{{--</div>--}}
{{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-12">--}}
{{--<div class="extra-info job-name">--}}
{{--<a href="{{route('job.show', $job->slug)}}"--}}
{{--title="{{$job->category->name}}">--}}
{{--{{$job->category->name}}--}}
{{--</a>--}}
{{--</div>--}}
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
{{--<div id="{{$job->slug}}" class="collapse">--}}
{{--<p>{{$job->pivot->message}}</p>--}}
{{--<span>{{$job->pivot->budget}}</span>--}}
{{--</div>--}}
{{--@endforeach--}}