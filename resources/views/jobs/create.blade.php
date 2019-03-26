@extends('layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css"
          rel="stylesheet"/>
    @parent
    {{--<link rel="stylesheet" href="{{asset('old-css/dropzone.css')}}">--}}
@stop

@section('content')
    <!--POST A NEW JOB-->
    <section class="client-block mt-5 pt-3">
        <div class="container">
            <form action="{{route('job.store')}}" id="postjob-form" class="attachment-file-content" method="POST">
                @csrf
                <h1 class="fw-800 text-center mb-5">Post a new job</h1>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="fw-800 fs-17">Category</h5>
                        <select id="category" name="category"
                                class="form-control border-orange fs-14{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                required>
                            <option value="">Choose a category</option>
                            @foreach($titles as $title)
                                <option value="{{$title->id}}" {{$title->id ==  old('category')? 'selected':'' }}>
                                    {{$title->name}}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-800 fs-17">Job Title</h5>
                        <input type="text" id="textProject" name="title"
                               class="form-control border-orange fs-14{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               placeholder="Enter a job title" value="{{old('title')}}" required/>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3{{ $errors->has('description') ? ' is-invalid' : '' }}">
                    <div class="col-12">
                    <textarea name="description" id="description"
                              class="form-control border-orange fs-14" cols="30" rows="10"
                              placeholder="Job Description" required>{{old('description')}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h5 class="fw-800 fs-17">Budget</h5>
                        <input type="text" id="textBudget" name="budget"
                               class="form-control border-orange fs-14{{ $errors->has('budget') ? ' is-invalid' : '' }}"
                               placeholder="Eg: $ 2500" {{old('budget')}} required>
                        @if ($errors->has('budget'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('budget') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-800 fs-17">Exp Date</h5>
                        <input type="date" id="date" name="exp_date"
                               class="form-control border-orange fs-14{{ $errors->has('exp_date') ? ' is-invalid' : '' }}"
                               placeholder="Eg: June 15th 2016" value="{{old('exp_date')}}">
                        @if ($errors->has('exp_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('exp_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-800 fs-17">Freelancers count</h5>
                        <input type="text" name="freelancer_count"
                               class="form-control border-orange fs-14{{ $errors->has('freelancer_count') ? ' is-invalid' : '' }}"
                               placeholder="Eg: 2" value="{{old('freelancer_count',1)}}">
                        @if ($errors->has('freelancer_count'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('freelancer_count') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 class="fw-800 fs-17">Skill Required</h5>
                        {{--<input type="text" placeholder="Eg: UI/UX Design ..." class="form-control border-orange fs-14">--}}
                        <select class="form-control job-skills {{ $errors->has('skills') ? ' is-invalid' : '' }}"
                                type="text" id="textSkill" name="skills[]" multiple required></select>
                        @if ($errors->has('skills'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skills') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--<div class="row mb-3">--}}
                {{--<div class="col-12">--}}
                {{--<h5 class="fw-800 fs-17">Upload Files</h5>--}}
                {{--<div class="img-upload form-control d-flex py-5 align-items-center justify-content-center">--}}
                {{--<span> Drop files here to upload</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

            </form>

            <form action="{{ route('attachments.dropzone')  }}" class="dropzone dz-attachment"   id="my-dropzone">
                {{ csrf_field() }}
            </form>

            <div class="row mb-3">
                <div class="col-md-6">
                    @if(!auth()->user()->verifyPayPalEmail())
                        <a href="{{route('profile.edit')}}"
                           class="own-btn to-login"
                           title="{{!auth()->user()->verifyPayPalEmail()?'Please activate your payment method here':''}}">
                            Edit Profile
                        </a>
                    @else
                        <button form="postjob-form" type="submit" class="own-btn"
                                title="View and submit job">
                            View and submit job
                        </button>
                    @endif

                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <input form="postjob-form" type="checkbox" id="agree" name="agree" class="mr-3" required/>
                    <label for="agree" class="text-right">
                        By clicking 'Post Project', you are indicating that you have read and agree to the
                        <a href="" class="orange">Terms & Conditions</a> and <a href="" class="orange">Privacy
                            Policy</a>
                    </label>
                </div>
            </div>
        </div>

    </section>
@stop

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('js/dropzone-config.js')}}"></script>
    <script>
        $('.exp-date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d',
            autoclose: true
        });
        $('.job-skills').select2({
            placeholder: "Eg: UI/UX Design...",
            maximumSelectionLength: 6,
            minimumInputLength: 2,
            ajax: {
                url: '{{route('skills.find')}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        skill: $.trim(params.term)
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

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('#postjob-form').on('submit', function (form) {
            form.preventDefault();
            $this = $(this);
            $.ajax({
                url: '{{route('job.before_create')}}',
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (data) {
                    $('#before-save-past').remove();
                    $("#job-post-modal").removeClass('close-own-modal')
                    $('body').append(data.view);
                    $(document).on('click', '#save-post', function () {
                        $this.unbind("submit").submit();
                    });
                }
            })
        });

        $('#description').summernote();


    </script>
@stop
