@extends('layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <style>
        .lui-croppie-initial-visible, .lui-croppie-cropping-visible, .lui-croppie-uploading-visible,
        .lui-croppie-success-visible, .lui-croppie-error-visible {
            display: none;
        }

        .lui-croppie-initial .lui-croppie-initial-visible {
            display: block;
        }

        .lui-croppie-cropping .lui-croppie-cropping-visible {
            display: block;
        }

        .lui-croppie-uploading .lui-croppie-uploading-visible {
            display: block;
        }
    </style>
    @parent
@stop
@section('content')

    <div id="columns" class="columns-container">
        <div class="bg-top"></div>
        <div class="warpper">
            <!-- container -->
            <div class="container">
                <div class="row bg-white py-3 mt-3">
                    <div class="col-md-6">
                        @include('profile.avatar-form')
                    </div>
                    <div class="col-md-6">
                        <form enctype="multipart/form-data"
                              method="POST"
                              action="{{ auth()->user()->hasRole('freelancer') ? route('profile.update.freelancer') : route('profile.update.employer') }}"
                              id="form-account-creation"
                              class="form-horizontal box panel panel-default">
                            @csrf
                            <h3 class="panel-heading pl-3">Fill out your data</h3>
                            <div class="form_content panel-body clearfix">
                                @if(auth()->user()->hasRole('freelancer'))
                                    {{--Your Country--}}
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your Country <sup>*</sup></label>
                                            <select name="country_id"
                                                    class="form-control {{ $errors->has('country_id') ? ' is-invalid' : '' }}">
                                                @if($user->freelancer->country == null)
                                                    <option value="">--Select--</option>
                                                @endif
                                                @foreach(getCountries() as $country)
                                                    @if($country->id == $user->freelancer->country)
                                                        <option value="{{$user->freelancer->country}}"
                                                                selected>{{$country->name}}</option>
                                                    @endif
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('country_id'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{--Your City--}}
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your City <sup>*</sup></label>
                                            <select name="city_id"
                                                    class="form-control {{ $errors->has('city_id') ? ' is-invalid' : '' }}">
                                                <option value="">--Select--</option>
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{--Your Birthday--}}
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your Birthday</label>
                                            <input type="date"
                                                   class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                                   name="birthday"
                                                   value="{{$user->freelancer->birthday != null ? $user->freelancer->birthday : old('birthday')}}"
                                                   required>
                                            @if ($errors->has('birthday'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{--Category--}}
                                    <div class="form-group  col-md-12">

                                        <label for="name">Category</label>

                                        <select class="form-control  " name="category_id" tabindex="-1"
                                                aria-hidden="true">

                                            <option value="">None</option>
                                            @foreach($freelancer_titles as $freelancer_title)
                                                <option value="{{$freelancer_title->id}}"
                                                        {{isset($dataTypeContent->freelancer_id) && ($dataTypeContent->freelancer_id == $freelancer_title->id) ? 'selected' : ''}}>

                                                    {{$freelancer_title->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    {{--Employments--}}
                                    <div class="form-group  col-md-12">
                                        <label for="name">Employments</label>
                                        <table id="employment" class=" table order-list">
                                            <tbody>
                                            @if(isset($dataTypeContent->employments))
                                                @php($employments = json_decode($dataTypeContent->employments))
                                                @foreach($employments as $employment)
                                                    <tr>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control employment"
                                                                   value="{{$employment->employment}}"
                                                                   placeholder="Employment"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text"
                                                                   class="form-control employment_date"
                                                                   value="{{$employment->date}}"
                                                                   placeholder="Date"/>
                                                        </td>
                                                        <td class="col-md">
                                                            @if($loop->index == 0)
                                                                <a class="deleteRow"></a>
                                                            @else
                                                                <input type="button"
                                                                       class="ibtnDel btn btn-md btn-danger "
                                                                       data-delete="employment" value="Delete">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="col-md">
                                                        <input type="text" class="form-control employment"
                                                               placeholder="Employment"/>
                                                    </td>
                                                    <td class="col-md">
                                                        <input type="text"
                                                               class="form-control employment_date"
                                                               placeholder="Date"/>
                                                    </td>
                                                    <td class="col-md">
                                                        <a class="deleteRow"></a>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block addrow"
                                                           data-selector="employment" value="Add Row">
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="employments">

                                    </div>

                                    {{--Educations--}}
                                    <div class="form-group col-lg-12">
                                        <label for="name">Educations</label>
                                        <table id="education" class=" table order-list">
                                            <tbody>
                                            @if(isset($dataTypeContent->educations))
                                                @php($educations = json_decode($dataTypeContent->educations))
                                                @foreach($educations as $education)
                                                    <tr>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control education"
                                                                   value="{{$education->education}}"
                                                                   placeholder="Education Name"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text"
                                                                   class="form-control education_date"
                                                                   value="{{$education->date}}"
                                                                   placeholder="Date"/>
                                                        </td>
                                                        <td class="col-md">
                                                            @if($loop->index == 0)
                                                                <a class="deleteRow"></a>
                                                            @else
                                                                <input type="button"
                                                                       class="ibtnDel btn btn-md btn-danger "
                                                                       data-delete="education" value="Delete">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    {{--<tr>--}}
                                                    {{--<td class="col-md">--}}
                                                    {{--<input type="text" class="form-control education-staff"--}}
                                                    {{--value="{{$education->education_staff}}"--}}
                                                    {{--placeholder="Bachelor degree"/>--}}
                                                    {{--</td>--}}
                                                    {{--<td class="col-md">--}}
                                                    {{--<input type="text"--}}
                                                    {{--class="form-control education-desc"--}}
                                                    {{--value="{{$education->education_desc}}"--}}
                                                    {{--placeholder="Education description"/>--}}
                                                    {{--</td>--}}
                                                    {{--<td class="col-md">--}}
                                                    {{--@if($loop->index == 0)--}}
                                                    {{--<a class="deleteRow"></a>--}}
                                                    {{--@else--}}
                                                    {{--<input type="button"--}}
                                                    {{--class="ibtnDel btn btn-md btn-danger "--}}
                                                    {{--data-delete="education" value="Delete">--}}
                                                    {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--</tr>--}}
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="col-md">
                                                        <input type="text" class="form-control education"
                                                               placeholder="Education"/>
                                                    </td>
                                                    <td class="col-md">
                                                        <input type="text"
                                                               class="form-control education_date"
                                                               placeholder="Date"/>
                                                    </td>
                                                    <td class="col-md"><a class="deleteRow"></a></td>
                                                </tr>
                                                {{--<tr>--}}
                                                {{--<td class="col-md">--}}
                                                {{--<input type="text" class="form-control education-staff"--}}
                                                {{--placeholder="Bachelor degree"/>--}}
                                                {{--</td>--}}
                                                {{--<td class="col-md">--}}
                                                {{--<input type="text"--}}
                                                {{--class="form-control education-desc"--}}
                                                {{--placeholder="Education description"/>--}}
                                                {{--</td>--}}
                                                {{--<td class="col-md"><a class="deleteRow"></a></td>--}}
                                                {{--</tr>--}}
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block addrow"
                                                           data-selector="education" value="Add Row">
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="educations">
                                    </div>

                                    {{--Languages--}}
                                    <div class="form-group  col-md-12">

                                        <label for="name">Languages</label>

                                        <table id="languages" class=" table order-list">
                                            <tbody>
                                            @if(isset($dataTypeContent->languages))
                                                @php($languages = json_decode($dataTypeContent->languages))
                                                @foreach($languages as $language)
                                                    <tr>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control language_prefix"
                                                                   value="{{$language->prefix}}"
                                                                   placeholder="Prefix"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text"
                                                                   class="form-control language_quality"
                                                                   value="{{$language->quality}}"
                                                                   placeholder="Quality"/>
                                                        </td>
                                                        <td class="col-md">
                                                            @if($loop->index == 0)
                                                                <a class="deleteRow"></a>
                                                            @else
                                                                <input type="button"
                                                                       class="ibtnDel btn btn-md btn-danger "
                                                                       data-delete="language" value="Delete">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="col-md">
                                                        <input type="text" class="form-control language_prefix"
                                                               placeholder="Prefix"/>

                                                    </td>
                                                    <td class="col-md">
                                                        <input type="text"
                                                               class="form-control language_quality"
                                                               placeholder="Quality"/>
                                                    </td>
                                                    <td class="col-md">
                                                        <a class="deleteRow"></a>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block addrow"
                                                           data-selector="language" value="Add Row">
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="langs">

                                    </div>

                                    {{--Availability--}}
                                    <div class="form-group  col-md-12">
                                        <label for="name">Availability</label>
                                        <select class="form-control" name="availability" tabindex="-1"
                                                aria-hidden="true">
                                            <option value="option1" selected="&quot;selected&quot;">More than 30
                                                hrs/week
                                            </option>
                                            <option value="option2">Less than 30 hrs/week</option>
                                            <option value="option3">As needed - open to offers</option>
                                        </select>

                                    </div>
                                    {{--skills--}}
                                    <div class="form-group  col-md-12">
                                        <label>Skill Required</label>
                                        <select class="form-control job-skills {{ $errors->has('skills') ? ' is-invalid' : '' }}"
                                                type="text"
                                                id="textSkill" name="skills[]" multiple required>
                                            @foreach($skills as $skill)
                                                <option value="{{$skill->id}}" selected>
                                                    {{$skill->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('skills'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('skills') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    {{--Title--}}
                                    <div class="form-group  col-md-12">
                                        <label for="name">Title</label>
                                        <input type="text"
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                               name="title" placeholder="Title"
                                               value="{{isset($dataTypeContent->title) ? $dataTypeContent->title : old('title')}}">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    {{--Overview--}}
                                    <div class="form-group  col-md-12">
                                        <label for="name">Overview</label>
                                        <textarea class="form-control" name="overview"
                                                  rows="5"> {{isset($dataTypeContent->overview) ? $dataTypeContent->overview : old('overview')}}</textarea>
                                    </div>


                                    {{--Hourly Rate--}}
                                    {{--<div class="form-group  col-md-12">--}}
                                    {{--<label for="name">Hourly Rate</label>--}}
                                    {{--<input type="text" class="form-control" name="hourly_rate"--}}
                                    {{--placeholder="Hourly Rate"--}}
                                    {{--value="{{isset($dataTypeContent->hourly_rate) ? $dataTypeContent->hourly_rate : old('hourly_rate')}}">--}}
                                    {{--@if ($errors->has('hourly_rate'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $errors->first('hourly_rate') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    {{--<div class="col-lg-12">--}}
                                    {{--<button type="submit" class="btn button btn-default save">Save</button>--}}
                                    {{--<p class="pull-right required"><span><sup>*</sup>Required field</span></p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                @else
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your Address Line <sup>*</sup></label>
                                            <input type="text" name="address"
                                                   class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                   value="{{$user->employer->address != null ? $user->employer->address : old('address')}}"
                                                   required>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Postal Code <sup>*</sup></label>
                                            <input type="text" name="postal_code"
                                                   class="form-control {{ $errors->has('postal_code') ? ' is-invalid' : '' }}"
                                                   value="{{$user->employer->postal_code != null ? $user->employer->postal_code : old('postal_code')}}"
                                                   required>
                                            @if ($errors->has('postal_code'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your Country <sup>*</sup></label>
                                            <select name="country_id"
                                                    class="form-control {{ $errors->has('country_id') ? ' is-invalid' : '' }}">
                                                @if($user->employer->country_id == null)
                                                    <option value="">--Select--</option>
                                                @endif
                                                @foreach(getCountries() as $country)
                                                    @if($country->id == $user->employer->country_id)
                                                        <option value="{{$user->employer->country_id}}"
                                                                selected>{{$country->name}}</option>
                                                    @endif
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your City <sup>*</sup></label>
                                            <select name="city_id"
                                                    class="form-control {{ $errors->has('city_id') ? ' is-invalid' : '' }}">
                                                <option value="">--Select--</option>
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-lg-12">
                                            <label>Your Birthday</label>
                                            <input type="date"
                                                   class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                                   name="birthday"
                                                   value="{{$user->employer->birthday != null ? $user->employer->birthday : old('birthday')}}"
                                                   required>
                                            @if ($errors->has('birthday'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <h4 class="panel-heading pl-3">Fill out your PayPal data</h4>
                                    <div class="form_content panel-body clearfix">
                                        <div class="form-group required">
                                            <div class="col-lg-12">
                                                <label>Your PayPal account address <sup>*</sup></label>
                                                <input type="email"
                                                       class="form-control {{ $errors->has('pay_email') ? ' is-invalid' : '' }}"
                                                       name="pay_email"
                                                       value="{{$user->employer->payer_email != null ? $user->employer->payer_email : old('pay_email') }}"
                                                       required>
                                                @if ($errors->has('pay_email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pay_email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--<div class="form-group required">--}}
                                        {{--<div class="col-lg-12">--}}
                                        {{--<label>Match Criteria <sup>*</sup></label>--}}
                                        {{--<select name="match_criteria"--}}
                                        {{--class="form-control {{ $errors->has('match_criteria') ? ' is-invalid' : '' }}">--}}
                                        {{--<option value="">--Select--</option>--}}
                                        {{--<option value="NAME" selected="selected">Name</option>--}}
                                        {{--<option value="NONE">None</option>--}}
                                        {{--</select>--}}
                                        {{--<span class="note">NOTE: To use Match criteria NONE you must--}}
                                        {{--request and be granted advanced permission levels.</span>--}}
                                        {{--@if ($errors->has('match_criteria'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('match_criteria') }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>



                                @endif
                                <div class="form-group">
                                    <div class="d-flex align-items-center pl-3 justify-content-around">
                                        <button class="own-btn">Save</button>
                                        <p class="p-0 m-0 required "><span class="color-red"><sup>*</sup> Required field</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form><!--end form -->
                    </div>
                </div>
            </div> <!-- end container -->
        </div><!-- end warpper -->
        <div class="bg-bottom"></div>
    </div><!--end columns-->

@stop
@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>

        //=======================For Skills================

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

        //=======================For Country, City change================

        var country_id = '{{ auth()->user()->hasRole('freelancer') ? $user->freelancer->country : $user->employer->country_id}}';
        var city_id = '{{auth()->user()->hasRole('freelancer') ? $user->freelancer->city : $user->employer->city_id}}';

        $('[name="country_id"]').change(function () {
            country_id = $(this).val();
            getCity(country_id);
        });

        if (country_id) {
            getCity(country_id);
        }

        function getCity(country_id) {
            if (country_id) {
                $.ajax({
                    url: '{{route('admin.change_country')}}/' + country_id,
                    type: 'get',
                    success: function (data) {
                        $('[name="city_id"]').html(data);
                    }
                })
            }
        }

        //=======================For add row================

        $(document).ready(function () {
            $(".addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                var selector = $(this).data('selector');
                if (selector == 'employment') {
                    cols += '<td><input type="text" class="form-control employment"  placeholder="Employment"/></td>';
                    cols += '<td><input type="text" class="form-control employment_date" placeholder="Data"/></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " data-delete="employment"  value="Delete"></td>';
                    newRow.append(cols);
                    $("#employment").append(newRow);

                } else if (selector == 'education') {
                    cols += '<td><input type="text" class="form-control education" placeholder="Education"/></td>';
                    cols += '<td><input type="text" class="form-control education_date" placeholder="Data"/></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " data-delete="education"  value="Delete"></td>';
                    newRow.append(cols);
                    $("#education").append(newRow);

                } else if (selector == 'language') {
                    cols += '<td><input type="text" class="form-control language_prefix" placeholder="Prefix"/></td>';
                    cols += '<td><input type="text" class="form-control language_quality" placeholder="Quality"/></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " data-delete="language"  value="Delete"></td>';
                    newRow.append(cols);
                    $("#languages").append(newRow);

                }
            });

            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
            });
        });

        $('.form-edit-add').submit(function (form) {

            form.preventDefault();
            var employment = [];
            var education = [];
            var languages = [];
            $('.employment').each(function (i, j) {
                employment.push({
                    "employment": $(this).val(),
                    "date": $('.employment_date').eq(i).val(),
                })
            });

            $('.education').each(function (i, j) {
                education.push({
                    "education": $(this).val(),
                    "date": $('.education_date').eq(i).val(),
                })
            });
            $('.language_prefix').each(function (i, j) {
                languages.push({
                    "prefix": $(this).val(),
                    "quality": $('.language_quality').eq(i).val(),
                })
            });


            $('input[name="employments"]').val(JSON.stringify(employment));
            $('input[name="educations"]').val(JSON.stringify(education));
            $('input[name="langs"]').val(JSON.stringify(languages));

            $(this).unbind("submit").submit();
        });

    </script>
@stop

@section('script')
    @parent
    <script>
        (function () {
            var Stage = {
                initial: {label: 'initial'},
                cropping: {label: 'cropping'},
                uploading: {label: 'uploading'},
                success: {label: 'success'},
                error: {label: 'error'},
            }

            function State(form) {
                this.form = form;
                this.avatarImage = form.querySelector('[data-lui-croppie-image]');
                this.croppieElement = form.querySelector('[data-lui-croppie-viewport]');
                this.progressTextElement = form.querySelector('[data-lui-croppie-progress-text]');
                this.progressBarElement = form.querySelector('[data-lui-croppie-progress-bar]');
                this.errorElement = form.querySelector('[data-lui-croppie-errors]');
                this.rotateLeftBtn = form.querySelector('[data-lui-croppie-rotate-left]');
                this.rotateRightBtn = form.querySelector('[data-lui-croppie-rotate-right]');
                this.file_input_name = "avatar";
                this.setStage = function (stage) {
                    if (this.stage != stage) {
                        this.stage && this.form.classList.remove('lui-croppie-' + this.stage.label);
                        this.stage = stage;
                        this.form.classList.add('lui-croppie-' + this.stage.label);
                    }
                }
                this.setStage(Stage.initial);
            }

            function readFile(input, callback) {
                var reader = new FileReader();
                reader.onload = callback;
                reader.readAsDataURL(input.files[0]);
            }

            function prepareUploadForm(state) {
                let vanilla = new Croppie(state.croppieElement, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: "{{ config('croppie.image.type') }}"
                    },
                    boundary: {
                        width: {{ config('croppie.image.boundary.width') }},
                        height: {{ config('croppie.image.boundary.height') }}
                    },
                    showZoomer: true,
                    enableOrientation: true
                });
                state.rotateLeftBtn && state.rotateLeftBtn.addEventListener('click', function (event) {
                    vanilla.rotate(-90);
                });
                state.rotateRightBtn && state.rotateRightBtn.addEventListener('click', function (event) {
                    vanilla.rotate(90);
                });
                state.croppieElement.addEventListener('update', function (event) {
                });
                state.form[state.file_input_name].addEventListener('change', function (event) {
                    state.setStage(Stage.initial);
                    if (this.files && this.files.length && this.files[0]) {
                        readFile(this, function (e) {
                            state.setStage(Stage.cropping);
                            vanilla.bind({
                                url: e.target.result,
                                zoom: 0,
                            });
                        });
                    }
                });
                state.form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    vanilla.result({
                        type: 'blob'
                    }).then(function (blob) {
                        if (blob) uploadImage(state, blob);
                        state.form[state.file_input_name].value = null;
                    });
                });
            }

            function uploadImage(state, blob) {
                var formData = new FormData(state.form);
                formData.delete(state.file_input_name);
                formData.append(state.file_input_name, blob, 'avatar.png');
                var xhr = new XMLHttpRequest();
                if (xhr.upload) {
                    xhr.upload.addEventListener("progress", function (e) {
                        if (e.lengthComputable) {
                            var pc = parseInt(e.loaded / e.total * 100);
                            if (state.progressTextElement) state.progressTextElement.innerText = pc + "%";
                            if (state.progressBarElement) state.progressBarElement.style.width = pc + "%";
                        }
                    }, false);
                }
                ;
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        var response = JSON.parse(this.responseText);
                        if (this.status == 200) {
                            if (response.success) {
                                toastr.success(response.message)
                                if (response.uploaded_image_url && state.avatarImage) {
                                    state.avatarImage.src = response.uploaded_image_url;
                                    $('.user-img img').attr('src', response.uploaded_image_url);
                                }
                                if (response.redirect_url) location.href = response.redirect_url;
                            }
                        }
                        else {
                            state.errorElement.innerText = '';
                            for (var z in response.errors) {
                                response.errors[z].forEach(function (errorText) {
                                    toastr.error(errorText)
                                })
                            }

                        }
                    }
                };
                xhr.open(state.form.method, state.form.action, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.send(formData);
                state.setStage(Stage.uploading);
            }

            document.addEventListener("DOMContentLoaded", function (event) {
                let dataTag = 'data-lui-croppie-form';
                document.querySelectorAll('[' + dataTag + ']').forEach(function (form) {
                    form.removeAttribute(dataTag);
                    prepareUploadForm(new State(form));
                });
            });
        })();


        $('.fileInputOwn-span').click(function () {
            $('.fileInputOwn').click()
        });
        // on change show image with crop options
        $('.fileInputOwn').click(function () {
            // $('#file-input').change()
        });
        $('#file-input').change((e) => {
            let last_w = $('#file-input').val();
            last_w = last_w.split("\\");
            console.log(last_w)
            if (last_w != null || last_w != '' || last_w != undefined || last_w.length - 1 != 0) {
                $('.fileInputOwn-span').text(last_w[last_w.length - 1]);
                $('.sfbl').addClass('d-block')
                // $('.st_block').addClass('ow-d-none')
            }

        });

    </script>

@stop