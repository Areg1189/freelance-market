

    <div class="col-lg-11 mt-4">
        <div class="job-block single-job-show" data-url="{{route('job.show', $job->slug)}}">
            <div class="job-title">
                <h3 class="my-3 fw-800 fs-20">{{$job->title}}</h3>
            </div>
            <div class="job-description ">
                <p class="fs-14">
{{--                    {!! !!}--}}
                    {!! str_limit(strip_tags( $job->description),300,'...') !!}
                </p>
            </div>
            <div class="job-data d-flex align-items-center my-3">
                <div class="client-info pr-4"><img
                            src="{{asset('storage/img/freelancers/job/picer.png')}}"
                            alt="picker"> <span class="gray pl-1">{{$job->user->employer->country->code ?? ''}}</span></div>
                <div class="client-info pr-4"><img
                            src="{{asset('storage/img/freelancers/job/price.png')}}"
                            alt="price"> <span class="gray pl-1">$ {{$job->budget}}</span>
                </div>
                <div class="client-info pr-4"><img
                            src="{{asset('storage/img/freelancers/job/info.png')}}"
                            alt="user"> <span class="gray pl-1">{{$job->user->jobs->where('status', 'completed')->count() > 0 ? $job->user->jobs->where('status', 'completed')->count().' Job completed' : 'No jobs completed yet'}}</span>
                </div>
            </div>
            <div class="job-tags">
                <div class="client-info pr-4 ">
                    <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag"
                         class="mr-2">
                    @foreach($job->skills as $skill)
                        <a href="{{route('job.index',['skill' => $skill->slug])}}" class="tag search-tags"><span
                                    class="white">{{$skill->name}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="job-divider mt-3 mb-0 w-100"></div>
        </div>
    </div>
