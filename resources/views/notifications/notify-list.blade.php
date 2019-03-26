@forelse($notifications as $notification)
    <div class="alert alert-warning alert-{{$notification['data']['alert_type']??'warning'}} fade show" role="alert">
        @if(isset($notification['data']['redirect_url']))
            <a href="{{$notification['data']['redirect_url']}}">
                <strong>{{($notification['data']['title'])??'TEST'}}</strong>
                {!! $notification['data']['message'] ? str_limit($notification['data']['message'], 50, '...'):'TEST MESSAGE' !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                        data-href="{{route('notifications.mark-as-read', $notification->id)}}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </a>
        @else
            <strong>{{($notification['data']['title'])??'TEST'}}</strong>
            {!! $notification['data']['message'] ? str_limit($notification['data']['message'], 50, '...'):'TEST MESSAGE' !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    data-href="{{route('notifications.mark-as-read', $notification->id)}}">
                <span aria-hidden="true">&times;</span>
            </button>
        @endif
    </div>
@empty
    <p class="fs-12">No new notifications!</p>
@endforelse