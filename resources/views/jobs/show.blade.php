<div class="login-modal job-post-modal d-flex align-items-center justify-content-center" id="job-show">
    <div class="bg"></div>
    <div class="inner-modal w-50 py-0 position-relative px-3">
        <h4 class="text-center py-3 fw-600">{{$job->title}}</h4>
        <!--INFO-->
        <div class="row text-center mt-3">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <img src="{{asset('storage/img/icons/category.png')}}" alt="" class="img-quadro">
                <span class="before-pos">{{$job->category->name}}</span>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                <span class="before-pos">{{$job->exp_date ? \Carbon\Carbon::parse($job->exp_date)->format('M. j, Y') : 'Without date'}}</span>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                <span class="before-pos">$ {{$job->budget}}</span>
            </div>
        </div>
        <!--TAGS-->
        <div class="row mt-3">
            <div class="col-md-10 offset-md-1">
                <div class="job-tags">
                    <div class="client-info pr-4 ">
                        <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag" class="mr-2">
                        @foreach($job->skills as $skill)
                            <a href="{{route('job.index',['skill' => $skill->slug])}}" class="tag"><span class="white">{{$skill->name}}</span></a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <!--SHARE JOB-->
        <div class="row align-items-center justify-content-center mt-3">
            <div class="before-pos-social-icons ml-2">
                <a href=""><img src="{{asset('storage/img/icons/facebook.png')}}" alt="facebook"></a>
            </div>
            <div class="before-pos-social-icons ml-2">
                <a href=""><img src="{{asset('storage/img/icons/gmail.png')}}" alt="G+"></a>
            </div>
            <div class="before-pos-social-icons ml-2">
                <a href=""><img src="{{asset('storage/img/icons/linkedin.png')}}" alt="linkedin"></a>
            </div>
            <div class="before-pos-social-icons ml-2">
                <a href=""><img src="{{asset('storage/img/icons/twitter.png')}}" alt="Twitter"></a>
            </div>
        </div>
        <!--DESCRIPTION-->
        <div class="row mt-3 job-description-posting">
            <div class="col-md-10 offset-md-1">
                {!! $job->description !!}
            </div>
        </div>


        <!--ATTACHED FILES-->

        @if(!empty($job->attachments) && $job->attachments->first())
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <h6 class="fw-600">Attached Files</h6>
                    <div class="d-flex align-items-center  flex-wrap">
                        @foreach ($job->attachments as $file)
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
        <div class="my-2 text-center">
            @if(Auth::check() && isset(Auth::user()->freelancer))
                @if($job->proposals->contains( auth()->user()->freelancer->id))
                    <span>
                        You already apply this job!
                    </span>
                @else
                    @if(Auth::user()->can('sendProposal', $job))
                        <a href="{{route('job.new_proposal',['slug'=>$job->slug])}}" class="own-btn" id="save-post">Submit
                            a Proposal</a>
                    @else
                        <span>It is not possible to apply for this job.</span>
                    @endif

                @endif
                <button class="job-save bg-transparent border-0"  data-href="{{route('job.favorite',['job' => $job->id])}}" title="Save this job">
                    <img src="{{asset('storage/img/'.($job->myFavorites->where('user_id', auth()->id())->count() ? 'heart-ok.png' : 'heart-no.png'))}}" alt=""   class="mv-img-30"/>
                </button>
            @endif

        </div>

        <a href="" class="close-modal"><img src="{{asset('storage/img/close.png')}}" alt="close modal"
                                            class="img-fluid"></a>
    </div>
</div>


{{--<div id="columns" class="columns-container">--}}
{{--<div class="warpper bg-top">--}}

{{--<!-- container -->--}}
{{--<div class="container">--}}
{{--<div class="job-detail">--}}
{{--<div class="job-detailtop clearfix">--}}
{{--<div class="row">--}}
{{--<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-sp-3">--}}
{{--<div class="job-avatarprofile">--}}
{{--<img class="img-responsive" src="img/default/avatar/avatar-profile.jpg" alt="">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-sp-9">--}}
{{--<div class="job-meta">--}}
{{--<h1>{{$job->title}}</h1>--}}
{{--<ul class="list-inline">--}}
{{--<li><i class="fa fa-briefcase"></i>{{$job->category->name}}</li>--}}
{{--<li><i class="fa fa-clock-o"></i>EXP--}}
{{--Date: {{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}--}}
{{--</li>--}}
{{--<li><i class="fa fa-paperclip"></i>Budget: <span--}}
{{--class="salary">${{$job->budget}}</span></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div><!-- end job-detailtop -->--}}
{{--<div class="job-detailbottom clearfix">--}}
{{--<div class="row job-margintop">--}}
{{--<div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>--}}
{{--<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-sp-12">--}}
{{--<div class="box clearfix">--}}
{{--<div class="job-extra-info">--}}
{{--<div class="job-info-lf">--}}
{{----}}
{{--@if(Auth::check() && isset(Auth::user()->freelancer))--}}
{{--@if(Auth::user()->can('sendProposal', $job))--}}
{{--<a class="btn btn-default"--}}
{{--href="{{route('job.new_proposal',['slug'=>$job->slug])}}"--}}
{{--title="Bidding this job">--}}
{{--Bidding this job--}}
{{--</a>--}}
{{--@else--}}
{{--<span>It is not possible to apply for this job.</span>--}}
{{--@endif--}}
{{--<button class="btn btn-save job-save {{$job->myFavorites->where('user_id', auth()->id())->count() ? 'btn-success' : ''}}"--}}
{{--data-href="{{route('job.favorite',['job' => $job->id])}}"--}}
{{--title="Save this job">Save this job--}}
{{--</button>--}}
{{--@endif--}}
{{--</div>--}}
{{--<div class="social_share social_block">--}}
{{--<ul class="links">--}}
{{--<li><a href="#" title="Facebook"><em class="fa fa-facebook"></em><span--}}
{{--class="unvisible">facebook</span> </a></li>--}}
{{--<li><a href="#" title="Twitter"><em class="fa fa-twitter"></em><span--}}
{{--class="unvisible">Twitter</span> </a></li>--}}
{{--<li><a href="#" title="Google"><em class="fa fa-google-plus"></em><span--}}
{{--class="unvisible">Google</span> </a></li>--}}
{{--<li><a href="#" title="Print"><em class="fa fa-print"></em><span--}}
{{--class="unvisible">Print</span> </a></li>--}}
{{--<li><a href="#" title="E-mail"><em class="fa fa-envelope"></em><span--}}
{{--class="unvisible">E-mail</span> </a></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="job-descrip">--}}
{{--{{$job->description}}--}}
{{--</div>--}}
{{--<div class="job-tag">--}}
{{--<strong>skill requires</strong>--}}
{{--<ul class="list-inline">--}}
{{--@foreach($job->skills as $skill)--}}
{{--<li><a href="#" title="{{$skill->name}}">{{$skill->name}}</a></li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="job-tag">--}}
{{--<strong>Freelancer count</strong>--}}
{{--{{$job->freelancer_count}}--}}
{{--</div>--}}
{{--<div class="col-nd-12">--}}
{{--@include('jobs.partials.files', ['files' => $job->attachments])--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="post-project">--}}
{{--<h4 class="title_block">Project posted (3)</h4>--}}
{{--<div class="job-list" id="job-list">--}}
{{--<div class="job-listnormal">--}}
{{--@php($jobs = $job->category--}}
{{--->jobs--}}
{{--->where('id', '!=', $job->id)--}}
{{--->random($job->category->jobs->where('id', '!=', $job->id)->count() < 3 ? $job->category->jobs->where('id', '!=', $job->id)->count(): 3))--}}
{{--@include('jobs.job-item')--}}
{{--</div><!-- end job-listnormal -->--}}
{{--</div><!-- end job-list -->--}}
{{--</div><!-- end post-project -->--}}
{{--</div><!-- end job-detail -->--}}
{{--</div> <!-- end container -->--}}
{{--</div><!-- end warpper -->--}}
{{--<div class="bg-bottom"></div>--}}
{{--</div><!--end columns-->--}}

