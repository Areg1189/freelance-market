@foreach ($freelancers as $freelancer)
    <div class="col-lg-6">
        <a href="{{route('freelancers.show',$freelancer->user->slug)}}" class="single-item">
            <div class="single-freelancer mt-4 px-3 py-2 d-flex align-items-center justify-content-between flex-wrap">
                <div class="img-block">
                    <img src="{{Voyager::image($freelancer->user->avatar)}}" alt="{{$freelancer->full_name}}" class="img-fluid" />
                </div>
                <div class="name-block ml-3">
                    <h6 class="fw-600 m-0 p-0 pb-1  fs-14 text-capitalize">{{$freelancer->full_name}}</h6>
                    <h5 class="fw-600 m-0 p-0 fs-17 text-capitalize">{{$freelancer->category->name}}</h5>
                </div>
                <div class="name-block ml-3">
                    <h6 class="fw-600 m-0 p-0 pb-1 text-center  fs-14 text-capitalize">Rate</h6>
                    <div>

                        <div class="d-flex align-items-center">
                            <div class="stars stars--large">
                                <span style="width: {{$freelancer->workHistories()->avg('star') * 20}}%"/>
                            </div>
                            <span>({{$freelancer->workHistories()->avg('star')}})</span>
                        </div>
                        {{--@for ($i = 0; $i < $freelancer->workHistories()->avg('star'); $i++)--}}
                            {{--*--}}
                        {{--@endfor--}}
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <h6 class="fw-600 fs-17 mb-0 text-center">{!! str_limit(strip_tags( $freelancer->overview),100,'...') !!}</h6>
                </div>

                <div class="col-12 p-0">
                    <div class="job-divider border-width-1 mt-3 m_-3 mb-0"></div>
                </div>
                <div class="col-12 ">
                    <div class="row mt-2 align-items-center ">
                        <div class="col-md-4 text-center">
                            <h6 class="fs-13 fw-600 mb-1">Earned</h6>
                            <p class="p-0 m-0 orange">{{number_format_short($freelancer->total_earned)}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="fs-13 fw-600 mb-1">Contracts</h6>
                            <p class="p-0 m-0 orange">{{$freelancer->workHistories()->count()}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="fs-13 fw-600 mb-1">Job Success</h6>
                            <p class="p-0 m-0 orange">{{$freelancer->jobSuccessfullyPercent()->percent}}%</p>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>
    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
        {{--<div class="job-freelanceritem">--}}
            {{--<a class="projectjob-title" href="#" title="">--}}
                {{--<img class="img-responsive" src="{{Voyager::image( $freelancer->avatar )}}"--}}
                     {{--alt="">--}}
            {{--</a>--}}
            {{--@if (auth()->check() && auth()->user()->role_id != 3)--}}
                {{--<a href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}">--}}
                    {{--<i class="fa fa-comments  fa-2x"></i>--}}
                {{--</a>--}}
            {{--@endif--}}

            {{--<div class="project-content">--}}
                {{--<div class="author">--}}
                    {{--<a href="{{route('freelancers.show',$freelancer->user->slug)}}" title="">--}}
                        {{--{{$freelancer->category->name}}--}}
                    {{--</a> - <span>{{$freelancer->full_name}}</span></div>--}}
                {{--<div class="vote-ratting clearfix">--}}

                    {{--@include('freelancers.star', ['star' => $freelancer->workHistories()->avg('star')])--}}
                {{--</div>--}}
                {{--<div class="author">--}}
                                            {{--<span>--}}
                                            {{--{{$freelancer->title}}--}}
                                            {{--</span>--}}
                {{--</div>--}}
                {{--<div class="desc">--}}
                    {{--<p>--}}
                        {{--{{str_limit($freelancer->overview,200 , '...')}}--}}
                    {{--</p>--}}
                {{--</div>--}}
                {{--<ul class="list-inline clearfix">--}}
                    {{--@foreach ($freelancer->skills as $skill)--}}
                        {{--<li><a href="#" title="{{$skill->name}}">{{$skill->name}}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endforeach