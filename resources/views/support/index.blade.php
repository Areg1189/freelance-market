@extends('layouts.app')

@section('content')
    <!-- container -->
    <div class="container mt-3">
        <h1 class="text-center">Support</h1>
        <div class="row bg-white py-4">

            @foreach($supports->where('parent_id', null) as $mainSupport)
                <div class="col-md-4">
                    <h6 class="mb-2 fw-800">{{$mainSupport->name}}</h6>
                    <ul class="questions pl-3">
                        @foreach($supports->where('parent_id', $mainSupport->id) as $subSupport)
                           <li><a href="" class="support-item-faq fs-14" data-id="{{$subSupport->id}}">{{$subSupport->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach


            {{--<button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#myModal">--}}
            {{--Other--}}
            {{--</button>--}}
        </div>
    </div>

    @include('support.partials.writ-help')
@endsection
@section('js-scripts')

    <script>
        $('.support-item-faq').on('click', function (e) {
            e.preventDefault()
            var id = $(this).data('id');
            {{--var  url = '{{route('support.send.get')}}';--}}
            $.ajax({
                url: '{{route('support.result')}}',
                type: 'GET',
                data: {id: id},
                success: function (result) {
                    $('#support-show-item').remove();
                    if (result.html) {
                        $('body').append(result.html);
                    }
                }
            });
        });
        $(document).on('click', '.close-modal-icon', function (e) {
            $('#support-show-item').remove();
            var id = $(this).data('id');
            $.ajax({
                url: '{{route('support.like')}}',
                type: 'POST',
                data: {id: id},
            })
        })

        $(document).on('click', '.ask-question', function () {
            $('#support-show-item').remove();
            $('.write-help').removeClass('close-own-modal');
        })

    </script>
@endsection
