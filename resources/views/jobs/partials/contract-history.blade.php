@forelse($histories as $history)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
        <div class=""><span>{{$history->text}}</span></div>
        @include('jobs.partials.files', ['files' => $history->attachments])
    </div>
@empty
    <p>Note result history</p>
@endforelse


