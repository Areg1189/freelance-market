{{--@foreach($jobs as $job)--}}
{{--<div class=" col-sp-12">--}}
{{--<div class="panel panel-default">--}}
{{--<div class="panel-body">--}}
{{--<span class="label label-{{$job->pivot->status == 'canceled'? 'danger' : 'success'}}">{{$job->pivot->status}}</span>--}}
{{--<div class="extra-info job-name">--}}
{{--View job : <a href="{{route('job.show', $job->slug)}}"--}}
{{--title="{{$job->category->name}}">--}}
{{--{{$job->category->name}}--}}
{{--</a>--}}
{{--</div>--}}
{{--<div>--}}
{{--<span>--}}
{{--{{optional($job->pivot->created_at)->diffForHumans()}}--}}
{{--</span>--}}
{{--</div>--}}
{{--<div>--}}
{{--<a href="{{route('contract.history',['contract' => $job->pivot->id])}}" class="show-contract-history">--}}
{{--Show history--}}
{{--</a>--}}
{{--</div>--}}

{{--@if($job->pivot->status == 'completed')--}}
{{--<div>--}}
{{--<a href="{{route('contract.feedback.create',['contract' => $job->pivot->id, 'recipient' => 'employer'])}}" class="show-contract-history">--}}
{{--Make feedback--}}
{{--</a>--}}
{{--</div>--}}
{{--@elseif($job->pivot->status == 'on_development')--}}
{{--<button data-toggle="collapse" data-target="#finished-job-{{$job->slug}}"--}}
{{--type="button"--}}
{{--title="If you are finished, find the button and send a notification to the employer."--}}
{{--class="btn btn-success job-finished">--}}
{{--Finished--}}
{{--</button>--}}
{{--<button data-toggle="collapse" data-target="#cancel-job-{{$job->slug}}"--}}
{{--type="button"--}}
{{--class="btn btn-danger  job-canceled">--}}
{{--cancel job--}}
{{--</button>--}}
{{--<div id="finished-job-{{$job->slug}}" class="collapse">--}}
{{--<div class="panel-footer">--}}
{{--<input type="hidden" name="receiverId" value="{{$job->user->id}}">--}}
{{--<textarea id="message-body" name="message" rows="2"--}}
{{--placeholder="Type your message..."></textarea>--}}
{{--<form action="{{ route('attachments.dropzone')  }}" class="dropzone" id="my-dropzone">--}}
{{--{{ csrf_field() }}--}}
{{--</form>--}}
{{--<div class="attachment-file-content"></div>--}}
{{--<div>--}}
{{--<button type="submit" class="btn btn-primary send-finished-job"--}}
{{--data-finished="{{route('contract.finished.freelancer', ['contract' => $job->pivot->id])}}">--}}
{{--SEND FINISHED JOB--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div id="cancel-job-{{$job->slug}}" class="collapse">--}}
{{--<div class="panel-footer">--}}
{{--<h4>Select a reason for cancellation.</h4>--}}
{{--<form action="{{route('contract.closed.freelancer', ['contract' => $job->pivot->id])}}" method="POST"--}}
{{--class="cancel-job-form">--}}
{{--<div class="radio">--}}
{{--<label><input type="radio" class="cancel-reason" data-cancel="{{$job->slug}}"--}}
{{--name="message"--}}
{{--value="What is Lorem Ipsum?" checked>What is Lorem Ipsum?</label>--}}
{{--</div>--}}
{{--<div class="radio">--}}
{{--<label><input type="radio" class="cancel-reason" value="Where does it come from?"--}}
{{--data-cancel="{{$job->slug}}" name="message">Where does it come--}}
{{--from?</label>--}}
{{--</div>--}}
{{--<div class="radio">--}}
{{--<label><input type="radio" class="cancel-reason" value="Where can I get some?"--}}
{{--data-cancel="{{$job->slug}}" name="message">Where can I get--}}
{{--some?</label>--}}
{{--</div>--}}
{{--<div class="radio">--}}
{{--<label><input type="radio" class="cancel-reason" value="other"--}}
{{--data-cancel="{{$job->slug}}">Other</label>--}}
{{--<textarea id="message-body" class="other-text" name="message" rows="2"--}}
{{--data-status="{{$job->slug}}"--}}
{{--placeholder="Other..." disabled required></textarea>--}}
{{--</div>--}}
{{--<button type="submit"--}}
{{--class="btn btn-danger">--}}
{{--cancel job--}}
{{--</button>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endforeach--}}

{{--{{dd(auth()->user()->freelancer->hiredJobs)}}--}}
<section class="client-block mt-5 pt-3">
    <div class="container">
        <ul class="nav nav-tabs align-items-center justify-content-center text-center " id="myTab" role="tablist">
            <!--OPEN JOBS-->
            <li class="nav-item ow-tabs">
                <a class="nav-link {{isset($status) && $status == 'active' ? 'active active-tab' : ''}} ow-tb"
                   id="active-job-tab"
                   href="{{route('freelancer.contracts', ['status' => 'active'])}}"
                   aria-controls="home" aria-selected="true">Active
                    Contracts({{auth()->user()->freelancer->hiredJobs->where('pivot.status', 'on_development')->count()}})</a>
            </li>
            <!--JOBS IN PROGRESS-->
            <li class="nav-item ow-tabs">
                <a class="nav-link {{isset($status) && $status == 'close' ? 'active active-tab' : ''}} ow-tb"
                   id="close-contract-tab"
                   href="{{route('freelancer.contracts', ['status' => 'close'])}}"
                   aria-controls="profile" aria-selected="false">Close Contracts
                    ({{auth()->user()->freelancer->hiredJobs->where('pivot.status', 'canceled')->count()}})</a>
            </li>
            <!--JOBS IN PROGRESS-->
            <li class="nav-item ow-tabs">
                <a class="nav-link {{isset($status) && $status == 'offers' ? 'active active-tab' : ''}} ow-tb"
                   id="offer-tab"
                   href="{{route('freelancer.contracts', ['status' => 'offers'])}}"
                   aria-controls="profile" aria-selected="false">Offers
                    ({{auth()->user()->freelancer->offers()->count()}})</a>
            </li>
        </ul>
        <div class="tab-content notification_container" id="myTabContent">
            <!--OPEN JOBS-->
            @if(isset($status) && $status == 'active')
                <div class="tab-pane fade show active" id="active-job"
                     role="tabpanel" aria-labelledby="active-job-tab">
                    @forelse($jobs as $contract)
                        <a href="#0" data-url="{{route('job.show',$contract->slug)}}"
                           class="single-item single-job-show">
                            <div class="to-single mt-3 py-3">
                                <h5 class="text-center fw-600">{{$contract->title}}</h5>
                                <div class="row text-center mt-3">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/category.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->category->name}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                                        <span class="before-pos">{{$contract->exp_date ? \Carbon\Carbon::parse($contract->exp_date)->format('M. j, Y') : 'Without date'}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                                        <span class="before-pos">$ 500</span>
                                    </div>
                                </div>
                                <div class="row text-center mt-3">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/freelancers/job/info.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->user->name}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/freelancers/job/picer.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->user->employer->country->code}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/start-time.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{\Carbon\Carbon::parse($contract->updated_at)->format('M. j, Y')}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <button data-toggle="collapse" data-target="#finished-job-{{$contract->slug}}"
                                type="button"
                                title="If you are finished, find the button and send a notification to the employer."
                                class="btn btn-success job-finished">
                            Finished
                        </button>
                        <button data-url="{{route('contract.show_contract_cancel_modal', ['from' => 'freelancer', 'contracts' => $contract->pivot->id])}}"
                                type="button"
                                class="own-btn cancel-contract">
                            cancel contract
                        </button>
                        <div id="finished-job-{{$contract->slug}}" class="collapse">
                            <div class="panel-footer">
                                <input type="hidden" name="receiverId" value="{{$contract->user->id}}">
                                <textarea id="message-body" name="message" rows="2"
                                          placeholder="Type your message..."></textarea>
                                <form action="{{ route('attachments.dropzone')  }}" class="dropzone" id="my-dropzone">
                                    {{ csrf_field() }}
                                </form>
                                <div class="attachment-file-content"></div>
                                <div>
                                    <button type="submit" class="btn btn-primary send-finished-job"
                                            data-finished="{{route('contract.finished.freelancer', ['contract' => $contract->pivot->id])}}">
                                        SEND FINISHED JOB
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>And you have no active contracts.</p>
                    @endforelse
                </div>
            @elseif(isset($status) && $status == 'close')
            <!--JOBS IN PROGRESS-->
                <div class="tab-pane fade show active"
                     id="close-contract"
                     role="tabpanel" aria-labelledby="close-contract-tab">
                    @forelse($jobs as $contract)
                        <a href="#0" data-url="{{route('job.show',$contract->slug)}}"
                           class="single-item single-job-show">
                            <div class="to-single mt-3 py-3">
                                <h5 class="text-center fw-600">{{$contract->title}}</h5>
                                <div class="row text-center mt-3">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/category.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->category->name}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                                        <span class="before-pos">{{$contract->exp_date ? \Carbon\Carbon::parse($contract->exp_date)->format('M. j, Y') : 'Without date'}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                                        <span class="before-pos">$ 500</span>
                                    </div>
                                </div>
                                <div class="row text-center mt-3">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/freelancers/job/info.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->user->name}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/freelancers/job/picer.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{$contract->user->employer->country->code}}</span>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{asset('storage/img/icons/start-time.png')}}" alt=""
                                             class="img-quadro">
                                        <span class="before-pos">{{\Carbon\Carbon::parse($contract->updated_at)->format('M. j, Y')}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p>And you have no active contracts.</p>
                    @endforelse
                </div>
            @elseif(isset($status) && $status == 'offers')
            <!--JOBS IN PROGRESS-->
                <div class="tab-pane fade show active"
                     id="offer"
                     role="tabpanel" aria-labelledby="offer-tab">
                    @forelse($jobs as $job)
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
                    @empty
                        <p>You do not have offers.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>

</section>

