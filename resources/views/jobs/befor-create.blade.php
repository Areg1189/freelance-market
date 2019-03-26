<div class="login-modal job-post-modal d-flex align-items-center justify-content-center" id="before-save-past">
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
                <span class="before-pos">{{$job->created_at}}</span>
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
                        @foreach($skills as $skill)
                            <a href="" class="tag"><span class="white">{{$skill->name}}</span></a>
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

        @if(!empty($attachments))
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <h6 class="fw-600">Attached Files</h6>
                    <div class="d-flex align-items-center  flex-wrap">
                        @foreach ($attachments as $file)
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
            <button class="own-btn" id="save-post">Save And Post</button>
        </div>

        <a href="" class="close-modal"><img src="{{asset('storage/img/close.png')}}" alt="close modal"
                                            class="img-fluid"></a>
    </div>
</div>
