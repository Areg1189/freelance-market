@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <h1 class="text-center fw-600"> Notifications</h1>
                    <div class="notification_container">
                        {{--{{dd($notifications)}}--}}
                        @foreach($notifications as $notification)
                            {{--@if($notification['data']['type'] == "job_create")--}}
                            <div class="alert alert-{{$notification['data']['alert_type']??'warning'}} {{!$notification->read_at ? 'shadow-lg p-4 mb-4' : 'shadow-none p-4 mb-4'}}"
                                 id="notification_{{$notification->id}}" role="alert">
                                <strong>{{($notification['data']['title'])??'TEST'}} </strong> <br>
                                <p> {!! $notification['data']['message']??'TEST MESSAGE' !!}  </p>
                            </div>
                            {{--@endif--}}
                        @endforeach
                    </div>
                </div>
                {{$notifications->links()}}
            </div>
        </div>
    </div>
@endsection
@section('js-scripts')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route('notifications.mark-as-read')}}',
                type: 'POST',
                success: function (result) {
                    $('.notif-count-notification').text(0).removeClass('active');
                }

            })

        })
    </script>
@endsection