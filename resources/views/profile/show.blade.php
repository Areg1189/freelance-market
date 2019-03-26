@extends('layouts.app')

@section('content')
    <div id="columns" class="columns-container">
        <div class="bg-top"></div>
        <div class="warpper">
            <!-- container -->
            <div class="container">
                @if(auth()->user()->hasRole('freelancer'))
                    <div class="freelance-detail">
                        <div class="freelance-detail-tab box">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#about-me" aria-controls="about-me"
                                                                          role="tab" data-toggle="tab">About me</a></li>
                                <li role="presentation"><a href="#protfolio" aria-controls="protfolio" role="tab"
                                                           data-toggle="tab">Protfolio</a></li>
                                <li role="presentation"><a href="#my-skills" aria-controls="my-skills" role="tab"
                                                           data-toggle="tab">My skills</a></li>
                                <li role="presentation" class="pull-right"><a href="{{route('profile.edit')}}"><i
                                                class="fa fa-edit"></i>Edit Profile</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="about-me">
                                    <div class="tabbox-content">
                                        <div class="media clearfix">
                                            <div class="pull-left">
                                                <span class="avatar-profile">
                                                   @if($profile->avatar != null)
                                                        <img class="img-responsive"
                                                             src="{{asset('storage/'.$profile)}}"
                                                             alt="{{$profile->first_name.' '.$profile->last_name}}">
                                                    @else
                                                        <i class="fa fa-user fa-big-avatar img-thumbnail"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h2>{{$profile->title}}</h2>
                                                <h4 class="position-profile">{{$profile->category->name ?? ''}}</h4>
                                                <p class="pdropcap">
                                                    {{$profile->overview}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="des">
                                            <p class="pdropcap">
                                            <address>
                                                <strong>Address:</strong> {{$profile->country ? getCountries($profile->country)->name : ''}}
                                                , {{$profile->city ? getCities($profile->city)->name : ''}}<br>
                                                {{--<abbr title="Phone">P:</abbr> (123) 456-7890--}}
                                                <strong>Birthday:</strong> {{ $profile->birthday }}
                                            </address>

                                            </p>
                                        </div>
                                        <a class="btn btn-default btn-shadown" href="#" title="Download my resume">Download
                                            my resume</a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="protfolio">

                                    <div class="tabbox-content">
                                        <div class="des">
                                            <div class="row">
                                                <div class="portfolio">
                                                    @include('include.portfolio')
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
                                                    <div class="protfolio-image" id="add-portfolio">
                                                        <i class="fa fa-plus-square-o fa-big" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-md-offset-3 add_portfolio" hidden>
                                                <h5 class="modal-title text-center">Add New Portfolio</h5>

                                                <form method="post" class="form-horizontal"
                                                      enctype="multipart/form-data" id="port-form">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label>Picture<sup>*</sup></label>
                                                        <input type="file" class="form-control" id="port-file"
                                                               name="port_file">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name<sup>*</sup></label>
                                                        <input type="text" class="form-control" id="port-name"
                                                               name="port_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Link</label>
                                                        <input type="text" class="form-control" id="port-link"
                                                               name="port_link">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Desceription</label>
                                                        <textarea class="form-control"
                                                                  id="port-description"
                                                                  name="port_description"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger pull-right"
                                                            id="port-save">
                                                        Save
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-6 col-md-offset-3 edit_portfolio" hidden>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="my-skills">
                                    <div class="tabbox-content">
                                        <div class="des">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
                                                    <div class="my-progress">
                                                        <h4>My skills</h4>
                                                    </div>
                                                </div>
                                                @foreach ($profile->skills->chunk(4) as $skills)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-sp-12">
                                                        <div class="my-progress">
                                                            <div class="my-progresscontent">
                                                                @foreach ($skills as $skill)
                                                                    <div class="progress-item">
                                                                        <div class="progress-title">
                                                                            <a href="#"
                                                                               title="UI/UX">{{$skill->name}}</a>
                                                                            <span class="pull-right">74%</span>
                                                                        </div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-black-bg progress-bar-striped"
                                                                                 role="progressbar" aria-valuenow="40"
                                                                                 aria-valuemin="0" aria-valuemax="100"
                                                                                 style="width: 74%">
                                                                                <span class="sr-only">74% Complete</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="hire-me">
                                    <div class="tabbox-content">
                                        <div class="des">
                                            <form method="post" action="#" id="cform">
                                                <div class="row">
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="name" name="name" class="form-control"
                                                               placeholder="Your name..."/>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="phone" name="phone" class="form-control"
                                                               placeholder="0123456789"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="nameSubject" name="nameSubject"
                                                           class="form-control" placeholder="Subject..."/>
                                                </div>
                                                <div class="form-group">
                                                <textarea id="message" name="message" class="form-control"
                                                          placeholder="Your message..."></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn button btn-default btn-shadown">
                                                        Submit
                                                        message
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end freelance-detail-tab -->

                    @if($profile->workHistories()->count())
                        <div class="detail-other clearfix">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sp-12">
                                    <div class="tab-info">
                                        <div class="row tab-info-title">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
                                                <span>Freelancer bidding ({{$profile->workHistories()->count()}})</span>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7"><span
                                                        class="short-pre">Short preview</span>
                                            </div>
                                        </div>
                                        <div class="tab-info-content box">
                                            <div class="bidding-list">
                                                @foreach ($profile->workHistories as $item)
                                                    <div class="bidding-item">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-sp-12">
                                                                <div class="media">
                                                                    {{--<div class="pull-left">--}}
                                                                    {{--<img src="img/default/avatar/avatar1.jpg" alt="">--}}
                                                                    {{--</div>--}}
                                                                    <div class="media-body">
                                                                        <span class="name-profile">{{$item->work_history}}</span><br>
                                                                        <span class="position-profile">{{$item->work_date}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-sp-12">
                                                                <div class="bidding-des">
                                                                    <p>
                                                                        {{$item->feedback != "" ?$item->feedback :'No Feedback'}}
                                                                    </p>
                                                                </div>
                                                                @if ($item->star && $item->star != "")
                                                                    @include('freelancers.star', ['star' => $profile->workHistories()->avg('star')])
                                                                @endif
                                                                <div class="pull-right">
                                                                    {{$item->earned}} <br>
                                                                    {{$item->hour_rate}} <br>
                                                                    {{$item->work_hours}} <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div><!-- end tab-info -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                                    <div class="tab-info">
                                        <div class="row tab-info-title">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <span>Information</span>
                                            </div>
                                        </div>
                                        <div class="tab-info-content last box">
                                            <div class="tab-info-company">
                                                <ul class="bullet">
                                                    <li>
                                                        <div class="spent"><i class="fa fa-diamond"></i>
                                                            Total Spent <span
                                                                    class="info">{{$profile->total_earned}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="spent"><i class="fa fa-clock-o"></i>
                                                            Hours worked <span
                                                                    class="info">{{$profile->hours_worked}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="spent"><i class="fa fa-user-secret"></i>
                                                            Hires <span class="info">{{$profile->jobs}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="spent"><i class="fa fa-star"></i>
                                                            Rating
                                                            @include('freelancers.rating', ['class' => 'info'])
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end detail-other -->
                    @endif
            </div><!-- end freelance-detail -->
            @else
                <div class="row mt-3">
                    <div class="col-10 d-flex flex-wrap">
                        <div class="">
                            @if($profile->user->avatar != null)
                                <img class="img-fluid"
                                     src="{{Voyager::image($profile->user->avatar)}}"
                                     alt="{{$profile->first_name.' '.$profile->last_name}}">
                            @else
                                <i class="fa fa-user fa-big-avatar img-thumbnail"></i>
                            @endif
                        </div>
                        <div class="ml-3">
                            <h1>{{$profile->first_name.' '.$profile->last_name}}</h1>
                            <address>
                                <strong class="fw-600">Address:</strong>
                                <span>
                                                    {{$profile->country_id ? getCountries($profile->country_id)->name : ''}}
                                    , {{$profile->city_id ? getCities($profile->city_id)->name : ''}}, {{$profile->postal_code ? $profile->postal_code : ''}}
                                                </span>
                                <div></div>
                                {{--<abbr title="Phone">P:</abbr> (123) 456-7890--}}
                                <strong class="fw-600">Birthday:</strong>
                                <span>{{ $profile->birthday }}</span>
                            </address>
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="{{route('profile.edit')}}"><i class="fa fa-edit"></i> Edit info</a>
                    </div>

                </div>

            @endif
        </div>
    </div>
    </div> <!-- end container -->
    </div><!-- end warpper -->
    <div class="bg-bottom"></div>
    </div><!--end columns-->

@stop
@section('script')
    @parent
    <script>
        //============================CREATE
        var click_add = false;
        $('#add-portfolio').click(function () {
            if (click_add) {
                $('#add-portfolio').html('<i class="fa fa-plus-square-o fa-big" aria-hidden="true"></i>');
                $('.add_portfolio').hide();
                click_add = false;
            } else {
                $('#add-portfolio').html('<i class="fa fa-minus-square-o fa-big" aria-hidden="true"></i>');
                $('.add_portfolio').show();
                click_add = true;
            }
        });

        $('#port-form').on('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            if ($('#port-file').val() && $('#port-name').val()) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('store.portfolio')}}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('.portfolio').html(data.view);
                        toastr.success(data.message);
                        $('#port-form')[0].reset();
                        $('.add_portfolio').hide();

                    }
                });
            }
        });
        //============================EDIT
        var click_edit = false;
        $(document).on('click', '.edit-port', function (event) {
            event.preventDefault();
            $('.edit_portfolio').html('');
            $('.edit-port').html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
            if (click_edit) {
                $(this).html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
                $('.edit_portfolio').html('');
                $('.edit_portfolio').hide();
                click_edit = false;
            } else {
                $.ajax({
                    type: 'GET',
                    url: $(this).data('url'),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('.edit_portfolio').html(data.view);
                    }
                });
                $(this).html('<i class="fa fa-window-close-o" aria-hidden="true"></i>');

                $('.edit_portfolio').show();
                click_edit = true;
            }
        });

        $(document).on('submit', '#edit-port-form', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            if ($('#edit-name').val()) {
                $.ajax({
                    type: 'POST',
                    url: $(this).data('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('.portfolio').html(data.view);
                        toastr.success(data.message);
                        $('#edit-port-form')[0].reset();
                        $('.edit_portfolio').hide();

                    }
                });
            }
        });

        var token = $('meta[name="csrf-token"]').attr('content');
        //============================DELETE
        $(document).on('click', '.delete-port', function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).data('url'),
                data: {_token: token},
                success: function (data) {
                    $('.portfolio').html(data.view);
                    toastr.success(data.message);
                }
            });
        });

        //============================HIDE-SHOW
        $(document).on('click', '.hide-port', function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).data('url'),
                data: {_token: token},
                success: function (data) {
                    $('.portfolio').html(data.view);
                    toastr.success(data.message);
                }
            });
        });


    </script>
@stop