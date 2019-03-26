@extends('layouts.app')

@section('css-styles')
    {{--<link rel="stylesheet" href="{{asset('css/messenger.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/chat.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/media.css')}}" media="all">
@endsection

@section('content')
    <style>
        #messages-preloader {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
            margin: auto;
        }
    </style>


    <section class="chat">

        <div id="frame">
            <div id="sidepanel">
                <div id="profile">
                    <div class="wrap">
                        <img id="profile-img" src="{{asset('storage/'.auth()->user()->avatar)}}" class="online" alt=""/>
                        <p>{{auth()->user()->name}}</p>
                        {{--<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>--}}
                        {{--<div id="status-options">--}}
                        {{--<ul>--}}
                        {{--<li id="status-online" class="active"><span class="status-circle"></span>--}}
                        {{--<p>Online</p></li>--}}
                        {{--<li id="status-away"><span class="status-circle"></span>--}}
                        {{--<p>Away</p></li>--}}
                        {{--<li id="status-busy"><span class="status-circle"></span>--}}
                        {{--<p>Busy</p></li>--}}
                        {{--<li id="status-offline"><span class="status-circle"></span>--}}
                        {{--<p>Offline</p></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div id="expanded">--}}
                        {{--<label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>--}}
                        {{--<input name="twitter" type="text" value="mikeross"/>--}}
                        {{--<label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>--}}
                        {{--<input name="twitter" type="text" value="ross81"/>--}}
                        {{--<label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>--}}
                        {{--<input name="twitter" type="text" value="mike.ross"/>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div id="search">
                    <!--<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>-->
                    <input type="text" placeholder="Search contacts..."/>
                </div>
                <div id="contacts" class="threads">
                    @include('messenger.partials.threads')
                </div>
            </div>
            <div class="content">
                @if($withUser)
                    <div class="contact-profile">
                        <img src="{{asset('storage/'.$withUser->avatar)}}" alt=""/>
                        <p>{{$withUser->name}}</p>
                        <div class="social-media">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-instagram"></i>
                        </div>
                    </div>
                @endif
                <div class="messages messenger">

                    @if($withUser)
                        @if (isset($messages) && count($messages) === 20)
                            <div id="messages-preloader"></div>
                        @else
                            <p class="text-center">Conversation started</p>
                        @endif
                        <ul class="messenger-body">
                            @include('messenger.partials.messages')
                        </ul>
                    @else
                        <p class="text-center">You have no conversations</p>
                    @endif
                </div>
                <div class="message-input">
                    <form action="{{ route('attachments.dropzone')  }}" class="dropzone d-ow-none message-dropzone" id="my-dropzone">
                        {{ csrf_field() }}
                    </form>
                    <div class="attachment-file-content"></div>
                    <div class="wrap">
                        <input type="text" id="message-body" name="message" placeholder="Write your message..."/>
                        <div class="attach-file-img-block">
                            <img src="{{asset('storage/img/icons/attach.png')}}" alt="attach file"
                                 class="attach-file-img dz-attachment"/>
                        </div>
                        <input type="file" class="attach-file d-none"/>
                        <button class="submit own-btn" id="send-btn">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-3 threads">--}}
    {{--@include('messenger.partials.threads')--}}
    {{--</div>--}}

    {{--<div class="col-md-6">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading"><h4>{{$withUser->name}}</h4></div>--}}

    {{--<div class="panel-body">--}}
    {{--<div class="messenger">--}}
    {{--@if (isset($messages) && count($messages) === 20)--}}
    {{--<div id="messages-preloader"></div>--}}
    {{--@else--}}
    {{--<p class="start-conv">Conversation started</p>--}}
    {{--@endif--}}
    {{--<div class="messenger-body">--}}
    {{--@include('messenger.partials.messages')--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="panel-footer">--}}
    {{--<input type="hidden" name="receiverId" value="{{$withUser->id}}">--}}
    {{--<textarea id="message-body" name="message" rows="2"--}}
    {{--placeholder="Type your message..."></textarea>--}}
    {{--<form action="{{ route('attachments.dropzone')  }}" class="dropzone" id="my-dropzone">--}}
    {{--{{ csrf_field() }}--}}
    {{--</form>--}}
    {{--<div class="attachment-file-content"></div>--}}
    {{--<div>--}}
    {{--<button type="submit" id="send-btn" class="btn btn-primary">SEND</button>--}}
    {{--</div>--}}
    {{--</div>--}}


@endsection
@section('js-scripts')
    <script>
//        $(".messages").animate({scrollTop: $(document).height()}, "fast");
//
//        $("#profile-img").click(function () {
//            $("#status-options").toggleClass("active");
//        });
//
//        $(".expand-button").click(function () {
//            $("#profile").toggleClass("expanded");
//            $("#contacts").toggleClass("expanded");
//        });
//
//        $("#status-options ul li").click(function () {
//            $("#profile-img").removeClass();
//            $("#status-online").removeClass("active");
//            $("#status-away").removeClass("active");
//            $("#status-busy").removeClass("active");
//            $("#status-offline").removeClass("active");
//            $(this).addClass("active");
//
//            if ($("#status-online").hasClass("active")) {
//                $("#profile-img").addClass("online");
//            } else if ($("#status-away").hasClass("active")) {
//                $("#profile-img").addClass("away");
//            } else if ($("#status-busy").hasClass("active")) {
//                $("#profile-img").addClass("busy");
//            } else if ($("#status-offline").hasClass("active")) {
//                $("#profile-img").addClass("offline");
//            } else {
//                $("#profile-img").removeClass();
//            }
//            ;
//
//            $("#status-options").removeClass("active");
//        });




//        $(window).on('keydown', function (e) {
//            if (e.which == 13) {
//                $('#send-btn').trigger("click");
//                return false;
//            }
//        });
//        $('.attach-file-img').click(function () {
//            $('.attach-file').trigger("click");
//        })
        //# sourceURL=pen.js
    </script>
    <script src="{{asset('js/dropzone-config.js')}}"></script>
@stop




