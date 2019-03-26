@extends('layouts.app')

@section('content')
    @if(Auth::guest() || auth()->user()->can(('show-freelancers')))
        {{--<div id="columns" class="columns-container">--}}

            {{--<div class="bg-top">--}}

            {{--</div>--}}
            {{--<div class="warpper">--}}
                {{--<!-- container -->--}}

                {{--<div class="container">--}}
                    {{--<form id="searchbox"--}}
                          {{--action="{{route('freelancers.index')}}"--}}
                          {{--class="form-horizontal">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-sp-12">--}}
                                {{--<input type="text" name="keywords"--}}
                                       {{--value="{{Request::input('keywords')?Request::input('keywords'):""}}"--}}
                                       {{--class="form-control" id="inputKeywords"--}}
                                       {{--placeholder="{{(Request::input('keywords'))?Request::input('keywords'):'Keywords...'}}">--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-sp-12">--}}
                                {{--<select id="selectCategories" name="category" class="form-control">--}}
                                    {{--<option value="">Categories</option>--}}
                                    {{--@foreach($titles as $title)--}}
                                        {{--<option value="{{$title->slug}}" {{Request::input('category') ==  $title->slug ? 'selected': ''}}>{{$title->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-sp-12">--}}
                                {{--<select id="selectLocation" name="location" class="form-control">--}}
                                    {{--<option value="">Location</option>--}}
                                    {{--@foreach($countries as $country)--}}
                                        {{--<option value="{{$country->id}}" {{Request::input('location') ==  $country->id ? 'selected': ''}} >{{$country->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-sp-12">--}}
                                {{--<select class="form-control" name="skills[]" id="skills" multiple> </select>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-4 col-md-3 col-sm-6 col-xs-6 col-sp-12 fr-search">--}}
                                {{--<button type="submit" class="btn btn-primary">Search now</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    {{--<div class="job-freelancer" style="margin-top: 5%">--}}

                        {{--<div class="row load-content">--}}
                            {{--@include('freelancers.frellance-item')--}}
                        {{--</div>--}}
                        {{--<div class="job-loadprofile load-more text-center">--}}
                            {{--@if($freelancers->hasMorePages())--}}
                                {{--<a class="btn btn-default" href="{{$freelancers->nextPageUrl()}}"--}}
                                   {{--title="load more profiles">load more profiles</a>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div><!-- end job-freelancer -->--}}
                {{--</div> <!-- end container -->--}}
            {{--</div>--}}
        {{--</div><!-- end warpper -->--}}

        {{--<div class="bg-bottom"></div>--}}
        {{--</div><!--end columns-->--}}

        {{--@include('partials.advancet-search')--}}


    <section class="client-block mt-5 pt-3">
        <div class="container">
            <h1 class="fw-700 text-center text-capitalize">{{$category ? \Illuminate\Support\Str::plural($category->name) : 'Freelancers'}} </h1>
            <!--PROPOSALS-->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row ">
                        @include('freelancers.frellance-item')
                    </div>
                </div>

            </div>
            {{$freelancers->links()}}
            {{--@if ($freelancers->lastPage() > 1)--}}
                {{--<div class="row align-items-center justify-content-center py-4">--}}
                    {{--<a href="{{ ($freelancers->currentPage() == 1) ? '' : $freelancers->url(1) }}">Previous</a>--}}
                    {{--@for ($i = 1; $i <= $freelancers->lastPage(); $i++)--}}
                        {{--<a class="num{{ ($freelancers->currentPage() == $i) ? ' active' : '' }}" href="{{ $freelancers->url($i) }}">{{ $i }}</a>--}}
                    {{--@endfor--}}
                    {{--<a href="{{ ($freelancers->currentPage() == $freelancers->lastPage()) ? '' : $freelancers->url($freelancers->currentPage()+1) }}" >Next</a>--}}
                {{--</div>--}}
            {{--@endif--}}

        </div>
        </div>

    </section>
    @endif

@stop
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