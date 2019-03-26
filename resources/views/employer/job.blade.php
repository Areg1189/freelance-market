@extends('layouts.app')

{{--@section('css-styles')--}}
{{--<link rel="stylesheet" href="{{asset('css/messenger.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/dropzone.css')}}">--}}
{{--@endsection--}}

@section('content')
    <div id="columns" class="columns-container mt-3">
        <div class="warpper bg-top">
            <div class="container">
                <h1 class="fw-600 text-center mb-4 d-flex align-items-center justify-content-center text-capitalize">
                    {{$job->title}}
                    <span class="sick align-self-start ml-2">{{str_replace('_',' ',$job->status)}}</span>
                </h1>

                <ul class="nav nav-tabs align-items-center justify-content-center text-center">
                    <li class="nav-item ow-tabs ">
                        <a href="{{route('employer.job.show', ['slug' => $job->slug, 'open' => 'details'])}}"
                           id="details-tab" class="ow-tb  nav-link {{$open == 'details' ? 'active active-tab' : ''}}"
                           aria-controls="details" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item ow-tabs">
                        <a id="proposal-tab"
                           href="{{route('employer.job.show', ['slug' => $job->slug, 'open' => 'proposal'])}}"
                           class="ow-tb nav-link {{$open == 'proposal' ? 'active active-tab' : ''}}"
                           aria-controls="proposal"
                           aria-selected="false">Proposal ({{$job->proposals()->count()}})</a>
                    </li>
                    <li class="nav-item ow-tabs">
                        <a id="offers-tab"
                           href="{{route('employer.job.show', ['slug' => $job->slug, 'open' => 'offers'])}}"
                           class="ow-tb nav-link {{$open == 'offers' ? 'active active-tab' : ''}}"
                           aria-controls="offers"
                           aria-selected="false">Offers ({{$job->offers()->count()}})</a>
                    </li>
                    <li class="nav-item ow-tabs">
                        <a id="best-match-tab"
                           href="{{route('employer.job.show', ['slug' => $job->slug, 'open' => 'best-match'])}}"
                           class="ow-tb nav-link {{$open == 'best-match' ? 'active active-tab' : ''}}"
                           aria-controls="best-match"
                           aria-selected="false">Best match ({{$fest_match_freelancers->count()}})</a>
                    </li>
                    {{--@if($job->contracts->count() > 0)--}}
                    {{--<li class="nav-item ow-tabs">--}}
                    {{--<a id="contracts-tab" data-toggle="tab" role="tab" href="#contracts" class="ow-tb nav-link"--}}
                    {{--aria-controls="contracts" aria-selected="false">{{$job->contracts->count()}} Contract</a>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    @if($job->workerWaiting->count() > 0)
                        <li class="nav-item ow-tabs">
                            <a id="prohibited-tab"
                               href="{{route('employer.job.show', ['slug' => $job->slug, 'open' => 'waiting'])}}"
                               class="ow-tb nav-link {{$open == 'waiting' ? 'active active-tab' : ''}}"
                               aria-controls="waiting" aria-selected="false">{{$job->workerWaiting->count()}}
                                Waiting
                            </a>
                        </li>
                    @endif

                </ul>

                <div class="tab-content" id="single-jon-tab">
                    @if ($open == 'details')
                        <div id="details" role="tabpanel" aria-labelledby="details-tab"
                             class="tab-pane fade {{$open == 'details' ? 'active show' : ''}} bg-white py-3">
                            <!--INFO-->
                            <div class="row text-center mt-3">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/category.png')}}" alt="" class="img-quadro">
                                    <span class="before-pos">{{$job->category->name}}</span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                                    <span class="before-pos">{{$job->exp_date ? date('F j, Y', strtotime($job->exp_date)) : 'Unlimitted'}}</span>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                                    <span class="before-pos">$ {{$job->budget}}</span>
                                </div>
                            </div>

                            <!--SHARE JOB-->
                            <div class="row align-items-center justify-content-center mt-3">
                                <div class="before-pos-social-icons ml-2">
                                    <a href=""><img src="{{asset('storage/img/icons/facebook.png')}}"
                                                    alt="facebook"></a>
                                </div>
                                <div class="before-pos-social-icons ml-2">
                                    <a href=""><img src="{{asset('storage/img/icons/gmail.png')}}" alt="G+"></a>
                                </div>
                                <div class="before-pos-social-icons ml-2">
                                    <a href=""><img src="{{asset('storage/img/icons/linkedin.png')}}"
                                                    alt="linkedin"></a>
                                </div>
                                <div class="before-pos-social-icons ml-2">
                                    <a href=""><img src="{{asset('storage/img/icons/twitter.png')}}" alt="Twitter"></a>
                                </div>
                            </div>
                            <!--DESCRIPTION-->
                            <div class="row m-0 mt-3 job-description-posting">
                                <div class="col-md-12 font-family-gothic">
                                    {!! $job->description !!}
                                </div>
                            </div>

                            <!--TAGS-->
                            <div class="row mt-3">
                                <div class="col-md-10 offset-md-1">
                                    <div class="job-tags">
                                        <div class="client-info pr-4 ">
                                            <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag"
                                                 class="mr-2">
                                            @foreach($job->skills as $skill)
                                                <a href="" class="tag"><span class="white">{{$skill->name}}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
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
                        </div>
                    @endif
                    @if ($open == 'proposal')
                        <div id="proposal" role="tabpanel" aria-labelledby="proposal-tab"
                             class="tab-pane fade bg-white py-3 {{$open == 'proposal' ? 'active show' : ''}}">
                            {{--<h3 class="text">Proposals</h3>--}}
                            <div class="col-12">
                                <div class="accordion" id="prop">
                                    @foreach($job->proposals as $freelancer)
                                        <div class="card">
                                            <div class="card-header py-1" id="heading-{{$freelancer->id}}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link w-100 d-flex align-items-center justify-content-around"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapse-{{$freelancer->id}}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse-{{$freelancer->id}}">
                                                    <span class="mv-40">
                                                        <img src="{{asset('storage/'.($freelancer->user->avatar??'img/default.png'))}}"
                                                             alt="{{$freelancer->full_name}}" class="img-fluid"/>
                                                    </span>

                                                        <a class="mssg-btn fw-600"
                                                           href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                           target="_blank">
                                                            {{$freelancer->full_name}}
                                                        </a>
                                                        <a class="mssg-btn"
                                                           href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                           target="_blank">
                                                            <img src="{{asset('storage/img/message.png')}}"
                                                                 alt="message"
                                                                 class="mv-30"/>
                                                        </a>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse-{{$freelancer->id}}" class="collapse "
                                                 aria-labelledby="heading-{{$freelancer->id}}"
                                                 data-parent="#prop">
                                                <div class="card-body">
                                                    <p> {{$freelancer->pivot->message}} </p>
                                                    @if($freelancer->pivot->budget)
                                                        <img src="{{asset('storage/img/icons/price.png')}}" alt=""
                                                             class="img-quadro">
                                                        <span> $ {{$freelancer->pivot->budget}}</span> <br>
                                                    @endif
                                                    <div class="my-2">
                                                        <div>
                                                            @if($freelancer->pivot->count_day)
                                                                <span> {{$freelancer->message}} Day</span> <br>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if($freelancer->pivot->start_date)
                                                                <span class="orange"> <b>Start</b> : {{$freelancer->pivot->start_date}}</span>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if($freelancer->pivot->end_date)
                                                                <span class="orange"> <b>End</b> : {{$freelancer->pivot->end_date}}</span>
                                                            @endif
                                                        </div>


                                                    </div>

                                                    {{--@if($freelancer->user->can('makeOffer',$job))--}}
                                                    <div>
                                                        <button class="own-btn {{!$freelancer->user->can('makeOffer',$job) ? 'cancel-offer-later' : 'hire-freelancer'}}"
                                                                title="You have already sent the offer to this freelancer. You want to cancel the offer later ?"
                                                                data-name="{{$freelancer->full_name}}"
                                                                data-user="{{$freelancer->user->slug}}">
                                                            Hire {{$freelancer->full_name}}
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($open == 'offers')
                        <div id="offers" role="tabpanel" aria-labelledby="offers-tab"
                             class="tab-pane fade bg-white py-3 {{$open == 'offers' ? 'active show' : ''}}">
                            <div class="col-12">
                                @foreach($job->offers->sortByDesc('pivot.id') as $freelancer)
                                    <div class="bg-nevy-gray mt-2">

                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <div>
                                                <span>{{optional($freelancer->pivot->created_at)->diffForHumans()}}</span>
                                                <span>You sent an offer to</span>
                                                <a class="orange"
                                                   href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    {{$freelancer->full_name}}
                                                </a>
                                                <span>for $ {{$freelancer->pivot->budget}}</span>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a class=""
                                                   href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                   target="_blank">
                                                    <img src="{{asset('storage/img/message.png')}}" alt="message"
                                                         class="mv-30"/>
                                                </a>
                                                @if($freelancer->pivot->status == 'in_processing')
                                                    <a href="{{route('offer.cancel', ['freelancerJobOffer' => $freelancer->pivot->id])}}"
                                                       data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."
                                                       data-target="{{$job->id}}"
                                                       class="color-red fs-13  offer-btn">Cancel</a>
                                                @elseif($freelancer->pivot->status == 'accepted')
                                                    <h5 class="m-0 ml-1">
                                                        This offer accepted
                                                    </h5>
                                                @elseif($freelancer->pivot->status == 'canceled')
                                                    <h5 class="m-0 ml-1">This offer canceled</h5>
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($open == 'best-match')
                        <div id="best-match" role="tabpanel" aria-labelledby="best-match-tab"
                             class="tab-pane fade bg-white py-3 {{$open == 'best-match' ? 'active show' : ''}}">

                            {{--<h3>Best match</h3>--}}
                            <div class="col-12">
                                @foreach($fest_match_freelancers as $freelancer)
                                    <div class="panel-heading">
                                        <h2 class="fs-20 orange text-center fw-600 mb-3">
                                            {{$freelancer->full_name}}
                                            <a class="ml-2"
                                               href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                               target="_blank">
                                                <img src="{{asset('storage/img/message.png')}}" alt="message"
                                                     class="mv-30"/>
                                            </a>
                                        </h2>
                                        <p>
                                            {!!  substr(strip_tags($freelancer->overview), 0, 150) !!}
                                            {{--{{str_limit($freelancer->overview,200,)}}--}}
                                        </p>
                                        <div class="text-center">
                                            <button class="own-btn hire-freelancer"
                                                    data-name="{{$freelancer->full_name}}"
                                                    data-user="{{$freelancer->user->slug}}">
                                                Hire {{$freelancer->full_name}}
                                            </button>
                                            <a class="own-btn ml-3"
                                               href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                               target="_blank">
                                                View profile
                                            </a>
                                        </div>
                                    </div>
                                    <div class="job-divider my-3 mb-0 w-100"></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($job->workerWaiting->count() > 0 &&  $open == 'waiting')
                        <div id="waiting" role="tabpanel" aria-labelledby="prohibited-tab"
                             class="tab-pane fade bg-white py-3 {{$open == 'waiting' ? 'active show' : ''}}">
                            <h3>Waiting</h3>
                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-sp-9">
                                <div class="job-meta">
                                    <div class="panel-group">
                                        @foreach($job->workerWaiting as $freelancer)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <a class="mssg-btn"
                                                               href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                               target="_blank">
                                                                {{$freelancer->full_name}}
                                                            </a>
                                                            <a class="mssg-btn"
                                                               href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                               target="_blank">
                                                                <i class="fa fa-comments  fa-2x"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                {!!  substr(strip_tags($freelancer->overview), 0, 150) !!}
                                                                {{--{{str_limit($freelancer->overview,200,)}}--}}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @foreach($freelancer->pivot->histories as $history)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
                                                    <div class=""><span>{{$history->text}}</span></div>
                                                    @include('jobs.partials.files', ['files' => $history->attachments])
                                                </div>
                                            @endforeach
                                            <button data-toggle="collapse" type="button"
                                                    data-accept_url="{{route('contract.accept.employer', ['contract' => $freelancer->pivot->id])}}"
                                                    data-accept="{{$freelancer->pivot->id}}"
                                                    class="btn btn-success accept-job-finished">Accept Finished
                                            </button>
                                            <button data-toggle="collapse"
                                                    data-target="#no-accept-job-{{$freelancer->pivot->id}}"
                                                    type="button"
                                                    class="btn btn-danger job-finished">
                                                Not to accept
                                            </button>
                                            <div id="no-accept-job-{{$freelancer->pivot->id}}" class="collapse">
                                                <div class="panel-footer">
                                                    <textarea id="message-body" name="message" rows="2"
                                                              placeholder="Type your message..."></textarea>
                                                    <form action="{{ route('attachments.dropzone')  }}"
                                                          class="dropzone"
                                                          id="my-dropzone">
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <div class="attachment-file-content"></div>
                                                    <div>
                                                        <button type="submit"
                                                                class="btn btn-primary send-not-accept-job"
                                                                data-no_accept="{{route('contract.closed.employer', ['contract' => $freelancer->pivot->id])}}">
                                                            SEND FINISHED JOB
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($job->modal)
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Fest match</h4>
                        </div>
                        <div class="modal-body">
                            <div class="job-meta">
                                <div class="panel-group">
                                    @foreach($fest_match_freelancers as $freelancer)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <ul class="list-inline">
                                                    <li>
                                                        <a class="mssg-btn"
                                                           href="{{route('freelancers.show',['slug' =>  $freelancer->user->slug])}}"
                                                           target="_blank">
                                                            {{$freelancer->full_name}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            {!!  substr(strip_tags($freelancer->overview), 0, 150) !!}
                                                            {{--{{str_limit($freelancer->overview,200,)}}--}}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <a class="mssg-btn"
                                                           href="{{route('messenger',['slug' =>  $freelancer->user->slug])}}"
                                                           target="_blank">
                                                            <i class="fa fa-comments  fa-2x"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="btn btn-default hire-freelancer"
                                                                data-name="{{$freelancer->full_name}}"
                                                                data-user="{{$freelancer->user->slug}}">
                                                            Hire {{$freelancer->full_name}}
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
    <div class="my-rating"></div>
    <div class="my-rating"></div>
@endsection

@section('script')

    @parent
    <script src="{{asset('js/dropzone-config.js')}}"></script>
    <script>


        $('.send-not-accept-job').click(function () {
            var url = $(this).data('no_accept');
            var message_files = [];
            var message = $('#message-body').val();

            if ($('.file-ids').length > 0) {
                $('.file-ids').each(function (i) {
                    message_files.push($('.file-ids').eq(i).val());
                })
            }
            axios.post(url, {
                message_files: message_files,
                message: message,
            }).then(function (response) {
                if (response.statusText == 'OK') {
                    toastr.success('Your request has been sent')
                }
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });

        });

        $('.accept-job-finished').click(function () {
            var accept = $(this).data('accept');
            var url = $(this).data('accept_url');
            Swal.fire({
                title: 'Are you sure?',
                text: "After confirmation you can not change your decision",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, accepted !'
            }).then((result) => {
                if (result.value) {
                    axios.post(url).then((response) => {
                        if (response.data.success) {
                            toastr.options.onclick = function () {
                                location.href = response.data.url
                            };

                            toastr.success('Your application has been sent to your account.<br> You can leave a review about the freelancer by clicking on this link.');

                        }
                    }).catch(error => {
                        console.log(error);
                    })
                }
            })
        });


        $(document).ready(function () {
            $('#myModal').modal('show');
        });
        // Eire Freelancer

        $('.hire-freelancer').click(function () {
            var freelancer_name = $(this).data('name');
            var user = $(this).data('user');
            var job = '{{$job->slug}}';
            Swal.fire({
                title: `You want to send a offer ${freelancer_name} for this job`,
                input: 'number',
                inputValue: '{{$job->budget}}',
                text: 'price shows a dollar',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'To offer',
                showLoaderOnConfirm: true,
                preConfirm: (price) => {
                    return axios.post(`{{route('offer.send')}}/${user}`, {
                        price: price,
                        job: job,
                    }).then((response) => {
                        if (response.statusText != 'OK') {
                            throw new Error(response.statusText)
                        }
                        return response.data.message
                    })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                console.log(result)
                if (result.value) {
                    Swal.fire({
                        title: `${result.value}`,
                    })
                }
            })
        });

        //Hire freelancer exist offer

        $('.cancel-offer-later').click(function () {
            var freelancer_name = $(this).data('name');
            var user = $(this).data('user');
            var job = '{{$job->slug}}';
            var text = $(this).attr('title')

            Swal.fire({
                title: text,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Yes',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return Swal.fire({
                        title: `You want to send a offer ${freelancer_name} for this job`,
                        input: 'number',
                        inputValue: '{{$job->budget}}',
                        text: 'price shows a dollar',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'To offer',
                        showLoaderOnConfirm: true,
                        preConfirm: (price) => {
                            return axios.post(`{{route('offer.send')}}/${user}`, {
                                price: price,
                                job: job,
                                _token: '{{csrf_token()}}'
                            }).then((response) => {
                                if (response.statusText != 'OK') {
                                    throw new Error(response.statusText)
                                }
                                return response.data.message
                            })
                                .catch(error => {
                                    Swal.showValidationMessage(
                                        `Request failed: ${error}`
                                    )
                                })
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        console.log(result)
                        if (result.value) {
                            Swal.fire({
                                title: `${result.value}`,
                            })
                        }
                    })
                }
            })


        })

    </script>

@endsection
