@extends('layouts.app')

@section('content')
    {{--<div id="columns" class="columns-container">--}}
    {{--<div class="bg-top"></div>--}}
    {{--<div class="warpper">--}}
    {{--<!-- container -->--}}
    {{--<div class="container">--}}
    {{--<div class="freelance-detail">--}}
    {{--<div class="freelance-detail-tab box">--}}
    {{--<!-- Nav tabs -->--}}
    {{--<ul class="nav nav-tabs" role="tablist">--}}
    {{--<li role="presentation" class="active"><a href="#about-me" aria-controls="about-me"--}}
    {{--role="tab" data-toggle="tab">About me</a></li>--}}
    {{--<li role="presentation"><a href="#protfolio" aria-controls="protfolio" role="tab"--}}
    {{--data-toggle="tab">Protfolio</a></li>--}}
    {{--<li role="presentation"><a href="#my-skills" aria-controls="my-skills" role="tab"--}}
    {{--data-toggle="tab">My skills</a></li>--}}
    {{--@can('hire-freelancer', $freelancer)--}}
    {{--<li role="presentation"><a href="#hire-me" aria-controls="hire-me" role="tab"--}}
    {{--data-toggle="tab">Hire me</a></li>--}}
    {{--@endcan--}}
    {{--</ul>--}}

    {{--<!-- Tab panes -->--}}
    {{--<div class="tab-content">--}}
    {{--<div role="tabpanel" class="tab-pane active" id="about-me">--}}
    {{--<div class="tabbox-content">--}}
    {{--<div class="media clearfix">--}}
    {{--<div class="pull-left">--}}
    {{--<span class="avatar-profile">--}}
    {{--<img class="img-responsive"--}}
    {{--src="{{Voyager::image($freelancer->avatar)}}" alt="">--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--<div class="media-body">--}}
    {{--<h2>{{$freelancer->title}}</h2>--}}
    {{--<h4 class="position-profile">{{$freelancer->category->name}}</h4>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="des">--}}
    {{--<p class="pdropcap">--}}
    {{--{{$freelancer->overview}}--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<a class="btn btn-default btn-shadown" href="#" title="Download my resume">Download--}}
    {{--my resume</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div role="tabpanel" class="tab-pane" id="protfolio">--}}

    {{--<div class="tabbox-content">--}}
    {{--<div class="des">--}}
    {{--<div class="row">--}}
    {{--@foreach ($freelancer->portfolios as $portfolio)--}}
    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">--}}
    {{--<div class="protfolio-image">--}}
    {{--<img class="img-responsive"--}}
    {{--src="{{Voyager::image($portfolio->image)}}" alt="">--}}
    {{--<a href="{{$portfolio->link??'#'}}"--}}
    {{--target="{{$portfolio->link?'_blank':'_self'}}"--}}
    {{--title="{{$portfolio->name}}">{{$portfolio->name}}</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div role="tabpanel" class="tab-pane" id="my-skills">--}}
    {{--<div class="tabbox-content">--}}
    {{--<div class="des">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">--}}
    {{--<div class="my-progress">--}}
    {{--<h4>My skills</h4>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@foreach ($freelancer->skills->chunk(4) as $skills)--}}
    {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-sp-12">--}}
    {{--<div class="my-progress">--}}
    {{--<div class="my-progresscontent">--}}
    {{--@foreach ($skills as $skill)--}}
    {{--<div class="progress-item">--}}
    {{--<div class="progress-title">--}}
    {{--<a href="#" title="UI/UX">{{$skill->name}}</a>--}}
    {{--<span class="pull-right">{{$skill->pivot->percent ?? rand(75, 100)}}--}}
    {{--%</span>--}}
    {{--</div>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar progress-bar-black-bg progress-bar-striped"--}}
    {{--role="progressbar" aria-valuenow="40"--}}
    {{--aria-valuemin="0" aria-valuemax="100"--}}
    {{--style="width: {{$skill->pivot->percent ?? rand(75, 100)}}%">--}}
    {{--<span class="sr-only">{{$skill->pivot->percent ?? rand(75, 100)}}--}}
    {{--% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@can('hire-freelancer', $freelancer)--}}
    {{--<div role="tabpanel" class="tab-pane" id="hire-me">--}}
    {{--<div class="tabbox-content">--}}
    {{--<div class="des">--}}
    {{--@php($jobs = auth()->user()->jobs->whereIn('status',['open', 'on_development']))--}}

    {{--@foreach($jobs as $job)--}}
    {{--@can('to-hire-job', $job)--}}
    {{--@if(!$freelancer->user->can('makeOffer',$job))--}}
    {{--<p>{{$job->title}} </p>--}}
    {{--@endif--}}
    {{--@endcan--}}
    {{--@endforeach--}}

    {{--<form method="post" action="" id="hireForm">--}}
    {{--<input hidden id="user_slug" value="{{$freelancer->user->slug}}">--}}
    {{--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
    {{--<select id="sel_job" name="job" class="form-control">--}}
    {{--<option>Select Job...</option>--}}
    {{--@foreach($jobs as $job)--}}
    {{--@can('to-hire-job', $job)--}}
    {{--@if($freelancer->user->can('makeOffer',$job))--}}
    {{--<option value="{{$job->slug}}"--}}
    {{--data-budget="{{$job->id}}">{{$job->title}}</option>--}}
    {{--@endif--}}
    {{--@endcan--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
    {{--<input id="amount" name="amount" autocapitalize="off"--}}
    {{--class="form-control" placeholder="123..." type="number"--}}
    {{--style="display: flex;">--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<button type="submit" class="btn button btn-default btn-shadown">--}}
    {{--Submit--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endcan--}}
    {{--</div>--}}
    {{--</div><!-- end freelance-detail-tab -->--}}
    {{--@if($freelancer->workHistories->count())--}}
    {{--<div class="detail-other clearfix">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sp-12">--}}
    {{--<div class="tab-info">--}}
    {{--<div class="row tab-info-title">--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">--}}
    {{--<span>Freelancer bidding ({{$freelancer->workHistories->count()}}--}}
    {{--)</span></div>--}}
    {{--<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><span class="short-pre">Short preview</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="tab-info-content box">--}}
    {{--<div class="bidding-list">--}}
    {{--@foreach ($freelancer->workHistories as $item)--}}
    {{--<div class="bidding-item">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-sp-12">--}}
    {{--<div class="media">--}}
    {{--<div class="pull-left">--}}
    {{--<img src="img/default/avatar/avatar1.jpg"--}}
    {{--alt="">--}}
    {{--</div>--}}
    {{--<div class="media-body">--}}
    {{--<span class="name-profile">{{$item->work_history}}</span><br>--}}
    {{--<span class="position-profile">{{$item->work_date}}</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-sp-12">--}}
    {{--<div class="bidding-des">--}}
    {{--<p>--}}
    {{--{{$item->feedback != "" ?$item->feedback :'No Feedback'}}--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--@if ($item->star && $item->star != "")--}}
    {{--@include('freelancers.star', ['star' => $freelancer->workHistories()->avg('star')])--}}
    {{--@endif--}}
    {{--<div class="pull-right">--}}
    {{--$ {{(int)$item->earned}} <br>--}}
    {{--{{$item->hour_rate}} <br>--}}
    {{--{{$item->work_hours}} <br>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div><!-- end tab-info -->--}}
    {{--</div>--}}
    {{--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">--}}
    {{--<div class="tab-info">--}}
    {{--<div class="row tab-info-title">--}}
    {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
    {{--<span>Information</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="tab-info-content last box">--}}
    {{--<div class="tab-info-company">--}}
    {{--<ul class="bullet">--}}
    {{--<li>--}}
    {{--<div class="spent"><i class="fa fa-diamond"></i>--}}
    {{--Total Spent <span--}}
    {{--class="info">{{number_format_short($freelancer->total_earned)}}</span>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<div class="spent"><i class="fa fa-clock-o"></i>--}}
    {{--Hours worked <span--}}
    {{--class="info">{{$freelancer->hours_worked}}</span>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<div class="spent"><i class="fa fa-user-secret"></i>--}}
    {{--Hires <span class="info">{{$freelancer->jobs}}</span>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<div class="spent"><i class="fa fa-star"></i>--}}
    {{--Rating--}}
    {{--@include('freelancers.star', ['star' => $freelancer->workHistories()->avg('star'), 'class' => 'info'])--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div><!-- end detail-other -->--}}
    {{--@endif--}}
    {{--</div><!-- end freelance-detail -->--}}
    {{--</div> <!-- end container -->--}}
    {{--</div><!-- end warpper -->--}}
    {{--<div class="bg-bottom"></div>--}}
    {{--</div><!--end columns-->--}}

@section('content')

    <section class="client-block mt-5 pt-3">
        <div class="container inner-fl">
            <div class="row  m-0 p-3 align-items-center justify-content-between">
                <div class="info-block align-items-center justify-content-between row m-0">
                    <div class="img-block-2">
                        <img src="{{Voyager::image($freelancer->user->avatar)}}" alt="{{$freelancer->full_name}}"
                             class="img-fluid">
                    </div>
                    <div class="fl-name ml-3">
                        <h6 class="fw-600">{{$freelancer->full_name}}</h6>
                        <div class="location d-flex align-items-center">
                            <img src="{{asset('storage/img/icons/picer.png')}}" alt="" class="" width="20">
                            <span class="ml-1 fs-14">{{getCountries($freelancer->country)->code}}
                                , {{getCities($freelancer->city)->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="fl-name">
                    <ul class="verification">
                        <li class="d-flex align-items-center mb-1"><img src="{{asset('storage/img/icons/check.png')}}"
                                                                        alt="" width="25"/> <span
                                    class="ml-2 fs-14">Verified user</span></li>
                        <li class="d-flex align-items-center mb-1"><img
                                    src="{{asset('storage/img/icons/availible.png')}}" alt="" width="25"/>
                            <span class="ml-2 fs-14">As needed - open to offers</span></li>
                    </ul>
                </div>
                <div class="fl-name">
                    <ul class="verification">
                        <li class="d-flex align-items-center mb-1"><img src="{{asset('storage/img/icons/end-job.png')}}"
                                                                        alt="" width="25"/>
                            <span class="ml-2 fs-14">{{count($freelancer->hiredJobs) }} jobs</span></li>
                        <li class="d-flex align-items-center mb-1"><img src="{{asset('storage/img/icons/price.png')}}"
                                                                        alt="" width="25"/> <span
                                    class="ml-2 fs-14">Total earned $ 20K</span></li>
                        {{--{{number_format_short($freelancer->total_earned)}}--}}
                    </ul>
                </div>
                @if(auth()->user()->hasRole('freelancer'))
                <div class="fl-name">
                    <ul class="verification">
                        <li class="d-flex align-items-center mb-1">
                            <a href="{{route('profile.edit')}}"><i class="fa fa-edit"></i> Edit profile</a>
                        </li>
                    </ul>
                </div>
                    @endif
            </div>

            <div class="row m-0 p-3 align-items-center justify-content-between">
                <h5 class="fw-600 mt-3">{{$freelancer->category->name}} </h5>
                <div class="job-tags mb-2">
                    <div class="client-info pr-4 ">
                        <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag" class="mr-2" width="22px">
                        @foreach($freelancer->skills as $skill)
                            <a href="{{route('freelancers.index', ['skill' => $skill->slug])}}" class="tag fs-12"><span
                                        class="white">{{$skill->name}}</span></a>
                        @endforeach
                    </div>
                </div>
                <p class="desc-fl">
                    {{$freelancer->overview}}
                </p>
            </div>
            <div class="job-divider my-3 mb-0 row"></div>
            <div class="">
                <h3 class="fw-600 text-center">Hire me</h3>
                @can('hire-freelancer', $freelancer)
                    @php($jobs = auth()->user()->jobs->whereIn('status',['open', 'on_development']))

                    
                    <form method="post" action="" id="hireForm" class="row">
                        <input hidden id="user_slug" value="{{$freelancer->user->slug}}">
                        <div class="form-group col-md-8">
                            <select id="sel_job" name="job" class="form-control">
                                <option>Select Job...</option>
                                @foreach($jobs as $job)
                                    @can('to-hire-job', $job)
                                        @if($freelancer->user->can('makeOffer',$job))
                                            <option value="{{$job->slug}}"
                                                    data-budget="{{$job->budget}}">{{$job->title}}</option>
                                        @endif
                                    @endcan
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <input id="amount" name="amount" autocapitalize="off"
                                   class="form-control" placeholder="123..." type="number"
                                   style="display: flex;">
                        </div>
                        <div class="form-group col-12 text-center">
                            <button type="submit" class="own-btn">
                                Submit
                            </button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
        <div class="container p-0 mt-4">
            <!--FEEDBACK-->
            <div class="row m-0">
                <div class="col-md-12 p-md-0">
                    <div class="fl-job-header py-3 ">
                        <h4 class="orange fw-800 text-center m-0">Feedback</h4>
                    </div>
                    <div class="row mt-2">
                        @if(isset($freelancer->workHistories))
                            @forelse($freelancer->workHistories as $feedback )
                                <div class="col-12">
                                    <div class="bg-white p-3">
                                        <h6 class="fw-600">{{$feedback->work_history}}</h6>
                                        <div class="start-end fs-13"><span
                                                    class="gray fw-300">{{$feedback->work_date}}</span></div>
                                        <div class="d-flex align-items-center">
                                            <div class="stars stars--large">
                                                <span style="width: {{($feedback->star * 100)/5 }}%"/>
                                            </div>
                                            <span>{{$feedback->star}}</span>
                                        </div>
                                        <p class="fs-13 fw-300 mt-2 mb-0 gray">
                                            {{$feedback->feedback}}
                                        </p>
                                    </div>

                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="bg-white p-1">
                                        <p class="p-0 m-0"> No Feedback given</p>
                                    </div>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
            <!--EMPLOYMENT EDUCTION-->
            <div class="row mt-3">
                <!--EDUCTION-->
                <div class="col-md-6">
                    <div class="fl-job-header py-3 ">
                        <h4 class="orange fw-800 text-center m-0">Eduction</h4>
                    </div>
                    <div class="row mt-2">
                        @if(isset($freelancer->educations))
                            @php($educations = json_decode($freelancer->educations))
                            @forelse($educations as $education )
                                <div class="col-12">
                                    <div class="bg-white p-3 bt-1 border-orange">
                                        <h5 class="fw-600 text-capitalise">{{$education->education}}</h5>
                                        <h6 class="fw-600 text-capitalise">{{$education->staff}}</h6>
                                        <div class="start-end fs-13"><span
                                                    class="gray fw-300">{{$education->date}}</span></div>
                                        <p class="fs-13 fw-300 mt-2 mb-0 gray">
                                            {{$education->description}}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p>No have a Eduction</p>
                            @endforelse
                        @endif
                    </div>

                </div>
                <!--EMPLOYMENT-->
                <div class="col-md-6">
                    <div class="fl-job-header py-3 ">
                        <h4 class="orange fw-800 text-center m-0">Employment </h4>
                    </div>
                    <div class="row mt-2">
                        @if(isset($freelancer->employments))
                            @php($employments = json_decode($freelancer->employments))
                            @forelse($employments as $employment )
                                <div class="col-12">
                                    <div class="bg-white p-3 bt-1 border-orange">
                                        <h5 class="fw-600 text-capitalize">{{$employment->employment}}</h5>
                                        <h6 class="fw-600 text-capitalize">{{$employment->staff}}</h6>
                                        <div class="start-end fs-13"><span
                                                    class="gray fw-300">{{$employment->date}}</span></div>
                                        <p class="fs-13 fw-300 mt-2 mb-0 gray">
                                            {{$employment->description}}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p>No have a Employment</p>
                            @endforelse
                        @endif
                    </div>

                </div>
            </div>
            <!--PORTFOLIO-->
            <div class="row mt-3">
                <div class="col-md-12 mt-3">
                    <div class="fl-job-header py-3 ">
                        <h4 class="orange fw-800 text-center m-0">Portfolio</h4>
                    </div>
                    <div class="row mt-2">
                        <!--FOREACH-->
                        @forelse($freelancer->portfolios as $portfolio)
                            <div class="col-md-4">
                                <div class="single-fp bg-white">
                                    <div><img src="{{Voyager::image($portfolio->image)}}" alt="{{$portfolio->name}}"
                                              class="img-fluid"></div>
                                    <div><h5 class="text-center fw-600 py-2">{{$portfolio->name}}</h5></div>
                                </div>
                            </div>
                        @empty
                            <p>No have a Portfolio</p>
                    @endforelse
                    <!--end-->
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @parent
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        $('#sel_job').change(function () {
            var amount = $(this).find(':selected').data('budget');
            $('#amount').val(amount);
        });


        $('#hireForm').on('submit', function (form) {
            form.preventDefault();
            var price = $('#amount').val();
            var slug = $('#user_slug').val();
            var job = $('#sel_job').val();

            $.ajax({
                type: 'POST',
                url: '{{route('offer.send')}}/' + slug,
                data: {_token: token, price: price, slug: slug, job: job},
                success: function (data) {
                    if (data.ok) {
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                    $('#hireForm')[0].reset();
                },
                error: function (reject) {
                    var errors = $.parseJSON(reject.responseText);
                    if (errors.errors) {

                        $.each(errors.errors, function (key, val) {
                            toastr.warning(val[0]);
                        });
                    }
                }
            });

        });


    </script>


@endsection