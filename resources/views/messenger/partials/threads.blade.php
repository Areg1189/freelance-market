{{--<div class="panel panel-default">--}}
{{--<div class="panel-heading"><h4>Threads</h4></div>--}}

{{--<div class="panel-body">--}}
{{--@foreach ($threads as $key => $thread)--}}

{{--@if ($thread->lastMessage)--}}
{{--<a href="/messenger/t/{{$thread->withUser->slug}}" class="thread-link">--}}
{{--<div class="row thread-row--}}
{{--@if (--}}
{{--!$thread->lastMessage->is_seen &&--}}
{{--$thread->lastMessage->sender_id != auth()->id()--}}
{{--)--}}
{{--unseen--}}
{{--@endif--}}
{{--@if (isset($withUser) && $thread->withUser->id === $withUser->id)--}}
{{--current--}}
{{--@endif--}}
{{--">--}}
{{--<p class="thread-user">--}}
{{--{{$thread->withUser->name}}--}}
{{--@if (\wDevStudio\LaravelMessenger\Facades\Messenger::messagesWith(auth()->id(), $thread->withUser->id)->where('sender_id', $thread->withUser->id)->where('is_seen', 0)->count())--}}

{{--<span class="badge">--}}
{{--{{\wDevStudio\LaravelMessenger\Facades\Messenger::messagesWith(auth()->id(), $thread->withUser->id)->where('sender_id', $thread->withUser->id)->where('is_seen', 0)->count()}}--}}
{{--</span>--}}
{{--@endif--}}
{{--</p>--}}
{{--<p class="thread-message">--}}
{{--@if ($thread->lastMessage->sender_id === auth()->id())--}}
{{--<i class="fa fa-reply" aria-hidden="true"></i>--}}
{{--@endif--}}
{{--{{substr($thread->lastMessage->message, 0, 20)}}--}}
{{--</p>--}}
{{--</div>--}}
{{--</a>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</div>--}}
{{--</div>--}}


<ul>
    @foreach ($threads as $key => $thread)
        @if(!isset($thread->withUser->id)) @continue @endif
        @if($withUser)

            <li class="contact {{$thread->withUser->id == $withUser->id ? 'active' : ''}}">
                @if (\wDevStudio\LaravelMessenger\Facades\Messenger::messagesWith(auth()->id(), $thread->withUser->id)->where('sender_id', $thread->withUser->id)->where('is_seen', 0)->count())

                    <span class="badge badge-warning">

                            {{\wDevStudio\LaravelMessenger\Facades\Messenger::messagesWith(auth()->id(), $thread->withUser->id)->where('sender_id', $thread->withUser->id)->where('is_seen', 0)->count()}}
                        </span>
                @endif
                <a href="{{route('messenger', ['slug' => $thread->withUser->slug])}}" class="thread-link">
                    <div class="wrap">
                        <span class="contact-status {{$thread->withUser->isOnline($thread->withUser->id) ? 'online' : 'busy'}}"></span>
                        <img src="{{asset('storage/'.$thread->withUser->avatar)}}" alt=""/>
                        <div class="meta">
                            <p class="name">{{$thread->withUser->name}}</p>
                            @if ($thread->lastMessage)
                                <p class="preview">
                                    @if ($thread->lastMessage->sender_id === auth()->id())
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                    @endif
                                    {{str_limit($thread->lastMessage->message, 40)}}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            </li>
        @endif
    @endforeach
</ul>


