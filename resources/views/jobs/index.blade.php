@extends('layouts.app')

@section('content')
    @if(Auth::guest() || auth()->user()->can(('show-jobs')))
        <section class="freelancer-jobs">
            <div class="container mt-4  ">
                <div class="bg-shad">
                    <div class="row justify-content-center">
                        <div class="col-12 ">
                            <div class="fl-job-header py-3 ">
                                <h1 class="orange fw-800 text-center m-0">Posted Jobs</h1>
                            </div>
                        </div>
                        <!--Jobs-->
                        @foreach($jobs as $job)
                            @can('to-hire-job', $job)
                                @include('jobs.job-item')
                            @endcan
                        @endforeach

                        {{$jobs->links()}}
                        {{--@if ($jobs->lastPage() > 1)--}}
                        {{--<div class="row align-items-center justify-content-center py-4">--}}
                        {{--<a href="{{ ($jobs->currentPage() == 1) ? '' : $jobs->url(1) }}">Previous</a>--}}
                        {{--@for ($i = 1; $i <= $jobs->lastPage(); $i++)--}}
                        {{--<a class="num{{ ($jobs->currentPage() == $i) ? ' active' : '' }}"--}}
                        {{--href="{{ $jobs->url($i) }}">{{ $i }}</a>--}}
                        {{--@endfor--}}
                        {{--<a href="{{ ($jobs->currentPage() == $jobs->lastPage()) ? '' : $jobs->url($jobs->currentPage()+1) }}">Next</a>--}}
                        {{--</div>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>
        </section>

    @endif
@endsection
@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#skills').select2({
                placeholder: "Eg: UI/UX Design...",
                maximumSelectionLength: 6,
                minimumInputLength: 2,
                ajax: {
                    url: '{{route('skills.find')}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            skill: $.trim(params.term),
                            value: $.trim(params.id),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        })
    </script>
@stop
