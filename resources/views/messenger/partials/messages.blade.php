{{--@php--}}
{{--$authId = auth()->id();--}}
{{--@endphp--}}
{{--@if ($messages)--}}
{{--@foreach ($messages as $key => $message)--}}
{{--<div class="row message-row">--}}
{{--<div title="{{date('d-m-Y h:i A' ,strtotime($message->created_at))}}"--}}
{{--@if ($message->sender_id === $authId)--}}
{{--class="sent"--}}
{{--@else--}}
{{--class="received"--}}
{{--@endif>--}}
{{--<p>{!! $message->message !!}</p>--}}
{{--@include('vendor.messenger.partials.files')--}}
{{--</div>--}}

{{--@if ($message->sender_id === $authId)--}}
{{--<i class="fa fa-ellipsis-h fa-2x pull-right" aria-hidden="true">--}}
{{--<div class="delete" data-id="{{$message->id}}">Delete</div>--}}
{{--</i>--}}
{{--@else--}}
{{--<i class="fa fa-ellipsis-h fa-2x pull-left" aria-hidden="true">--}}
{{--<div class="delete" data-id="{{$message->id}}">Delete</div>--}}
{{--</i>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endforeach--}}
{{--@endif--}}


@php
    $authId = auth()->id();
@endphp
@if ($messages)
    @foreach ($messages as $key => $message)

        <li class="{{$message->sender_id === $authId ? 'sent' : 'replies'}}">
            <img src="{{asset('storage/'.$message->sender->avatar)}}" alt=""/>
            <p>{!! $message->message !!}</p>
            {{--@include('messenger.partials.files')--}}
        </li>

    @endforeach
@endif