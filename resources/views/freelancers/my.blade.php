@extends('layouts.app')

@section('css-styles')
    {{--<link rel="stylesheet" href="{{asset('css/messenger.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('css/dropzone.css')}}">--}}
@endsection

@section('content')

    @include('freelancers.partials.'.$page)

    {{$jobs->links()}}
 {{--<div id="columns" class="columns-container">--}}
        {{--<div class="bg-top"></div>--}}
        {{--<div class="warpper">--}}
            {{--<!-- container -->--}}
            {{--<div class="container">--}}
                {{--<div class="job-search-all">--}}
                    {{--<div class="job-search-title">--}}
                        {{--<h4 class="title_block">We found <span>{{$jobs->total()}}</span> available jobs for you</h4>--}}
                    {{--</div>--}}
                    {{--<div class="job-list load-content" id="job-list">--}}
                        {{--<div class="job-listnormal">--}}
                            {{--{{dd($page)}}--}}
                            {{--@include('freelancers.partials.'.$page)--}}
                        {{--</div><!-- end job-listnormal -->--}}

                    {{--</div><!-- end job-list -->--}}
                    {{--<div class="job-load load-more text-center">--}}
                        {{--@if($jobs->hasMorePages())--}}
                            {{--<a href="{{$jobs->nextPageUrl()}}" class="btn btn-default" title="Load more job">Load more--}}
                                {{--job</a>--}}
                        {{--@endif--}}
                    {{--</div><!-- end job-load -->--}}
                {{--</div>--}}
            {{--</div> <!-- end container -->--}}
        {{--</div><!-- end warpper -->--}}
        {{--<div class="bg-bottom"></div>--}}
    {{--</div><!--end warp-->--}}
@stop

@section('js-scripts')
    <script src="{{asset('js/dropzone-config.js')}}"></script>

    <script>

        $(document).on('click', '.show-contract-history', function (event) {
            event.preventDefault();
        });


        $('.send-finished-job').click(function () {
            var url = $(this).data('finished');
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

        $('.show-contract-history').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            axios.get(url).then(function (response) {
                Swal.fire({
                    html: response.data.html
                })
            })
        })

    </script>
@stop