@extends('layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css"
          rel="stylesheet"/>
    @parent
@stop
@section('content')
    <div class="container mt-3">
        <div class="job-detail">
            <div class="bg-white py-2">
                <h4 class="text-center py-2 fw-600 text-uppercase">{{$job->title}}</h4>
                <!--INFO-->
                <div class="row text-center mt-3">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/category.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">{{$job->category->name}}</span>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/clock.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">{{$job->created_at}}</span>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/img/icons/price.png')}}" alt="" class="img-quadro">
                        <span class="before-pos">$ {{$job->budget}}</span>
                    </div>
                </div>

                <!--DESCRIPTION-->
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1 job-description-posting">
                        {!! $job->description !!}
                    </div>
                </div>
                <!--TAGS-->
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="job-tags">
                            <div class="client-info pr-4 ">
                                <img src="{{asset('storage/img/freelancers/job/tag.png')}}" alt="tag" class="mr-2">
                                @foreach($job->skills as $skill)
                                    <a href="{{route('job.index',['skill' => $skill->slug])}}" class="tag"><span class="white">{{$skill->name}}</span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="job-detailbottom clearfix">
                <div class="row job-margintop mt-3">
                    <div class="col-md-12">
                        <div class="box clearfix">
                            <div class="box clearfix">
                                @if($job->proposals->contains( auth()->user()->freelancer->id))
                                    <div class="alert alert-success">
                                        You already apply this job!
                                    </div>
                                @else
                                    <form name="apply" id="apply"
                                          action="{{route('job.store_proposal', ['slug'=>$job->slug])}}"
                                          method="POST"
                                          class="form-group row">
                                        @csrf
                                        <div class="form-group col-12">
                                            <label>Your message</label>
                                            <textarea
                                                    class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                    id="message" name="message" required
                                                    rows="10">{{old('message')}}</textarea>
                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Your budget</label>
                                            <input class="form-control {{ $errors->has('budget') ? ' is-invalid' : '' }}"
                                                   type="number"
                                                   id="budget" name="budget"
                                                   value="{{old('budget')}}" required>
                                            @if ($errors->has('budget'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('budget') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>How many days do you do the work</label>
                                            <input class="form-control {{ $errors->has('count_day') ? ' is-invalid' : '' }}"
                                                   type="number"
                                                   id="count_day" name="count_day"
                                                   value="{{old('count_day')}}" required>
                                            @if ($errors->has('count_day'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('count_day') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Start date</label>
                                            <input class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                                   type="text"
                                                   id="count_day" name="start_date"
                                                   value="{{old('start_date')}}" required>
                                            @if ($errors->has('start_date'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>End date</label>
                                            <input class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                                   type="text"
                                                   id="count_day" name="end_date"
                                                   value="{{old('end_date')}}" required>
                                            @if ($errors->has('end_date'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group text-center col-12">
                                            <button class="own-btn w-100" type="submit">Apply</button>
                                        </div>


                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end job-detail -->
    </div> <!-- end container -->
@endsection

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        var now = new Date();
        var start_date = $('input[name="start_date"]').datepicker({
            beforeShowDay: function (date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            if (ev.date.valueOf() > end_date.viewDate.valueOf()) {
                var newDate = new Date(ev.date);
                newDate.setDate(newDate.getDate());
                end_date.setValue(newDate);
            }
            if (end_date.viewDate) {
                $('.date-select-input-block').show();
            }
            start_date.hide();
            $('#dpd2').focus();
        }).on('clearDate', function (ev) {
            $('.date-select-input-block').hide();
        }).data('datepicker');

        var end_date = $('input[name="end_date"]').datepicker({
            beforeShowDay: function (date) {
                return date.valueOf() <= start_date.viewDate.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            end_date.hide();
        }).data('datepicker');

    </script>
@stop