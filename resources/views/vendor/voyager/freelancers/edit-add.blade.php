@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(!is_null($dataTypeContent->getKey()))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{(!is_null($dataTypeContent->getKey()) ? 'editRows' : 'addRows' )};
                            @endphp
                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend
                                        class="text-{{isset($row->details->legend->align) ? $row->details->legend->align : 'center'}}"
                                        style="background-color: {{isset($row->details->legend->bgcolor) ? $row->details->legend->bgcolor : '#f0f0f0'}};padding: 5px;">{{$row->details->legend->text}}</legend>
                                @endif
                                @if (isset($row->details->formfields_custom))
                                    @include('voyager::formfields.custom.' . $row->details->formfields_custom)
                                @else
                                    <div
                                        class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ isset($display_options->width) ? $display_options->width : 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label for="name">{{ $row->display_name }}</label>
                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                        @if($row->type == 'relationship')
                                            {{--{{dd($row->details)}}--}}
                                            @include('voyager::freelancers.relationship', ['options' => $row->details])

                                        @elseif($row->field == 'employments')
                                            <table id="employment" class=" table order-list">
                                                <tbody>
                                                @if($dataTypeContent->employments)
                                                    @php($employments = json_decode($dataTypeContent->employments))
                                                    @foreach($employments as $employment)
                                                        <tr>
                                                            <td class="col-md">
                                                                <input type="text" class="form-control employment"
                                                                       value="{{$employment->employment}}"
                                                                       placeholder="Employment Name"/>
                                                            </td>
                                                            <td class="col-md">
                                                                <input type="text"
                                                                       class="form-control employment_staff"
                                                                       value="{{$employment->staff??''}}"
                                                                       placeholder="ex. Manager"/>
                                                            </td>
                                                            <td class="col-md">
                                                                <input type="text"
                                                                       class="form-control employment_date"
                                                                       value="{{$employment->date}}"
                                                                       placeholder="Date"/>
                                                            </td>
                                                            <td class="col-md">
                                                                <textarea class="form-control employment_desc"
                                                                          placeholder="Employment description">{{$employment->description??''}}</textarea>
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
                                                                   placeholder="Employment Name"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control employment_staff"
                                                                   placeholder="ex. Manager"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control employment_date"
                                                                   placeholder="Date"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <textarea class="form-control employment_desc"
                                                                   placeholder="Employment description"></textarea>
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
                                                               data-selector="employment" value="Add Row"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="employments">
                                        @elseif($row->field == 'educations')
                                            <table id="education" class=" table order-list">
                                                <tbody>
                                                @if($dataTypeContent->educations)
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
                                                                       class="form-control education_staff"
                                                                       value="{{$education->staff??''}}"
                                                                       placeholder="ex. Bachelor degree"/>
                                                            </td>
                                                            <td class="col-md">
                                                                <input type="text"
                                                                       class="form-control education_date"
                                                                       value="{{$education->date}}"
                                                                       placeholder="Date"/>
                                                            </td>
                                                            <td class="col-md">
                                                                <textarea class="form-control education_desc"
                                                                       placeholder="Education description">{{$education->description??''}}</textarea>
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

                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="col-md">
                                                            <input type="text" class="form-control education"
                                                                   placeholder="Education Name"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text"
                                                                   class="form-control education_staff"
                                                                   placeholder="ex. Bachelor degree"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <input type="text"
                                                                   class="form-control education_date"
                                                                   placeholder="Date"/>
                                                        </td>
                                                        <td class="col-md">
                                                            <textarea class="form-control education_desc"
                                                                   placeholder="Education description"></textarea>
                                                        </td>
                                                        <td class="col-md"><a class="deleteRow"></a></td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td style="text-align: left;">
                                                        <input type="button" class="btn btn-lg btn-block addrow"
                                                               data-selector="education"
                                                               value="Add Row"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="educations">
                                        @elseif($row->field == 'work_history')
                                            <table id="work_history" class=" table order-list">
                                                <tbody>
                                                @if($dataTypeContent->work_history)
{{--                                                    @php($work_history = json_decode($dataTypeContent->work_history))--}}
                                                    @foreach($dataTypeContent->workHistories as $item)
                                                        <tr>
                                                            <td class="col">
                                                                <input type="text" class="form-control work_history"
                                                                       value="{{$item->work_history}}"
                                                                       placeholder="Work history"/>
                                                            </td>
                                                            <td class="col">
                                                                <input type="text"
                                                                       value="{{$item->work_date}}"
                                                                       class="form-control work_date" placeholder="Work date"/>
                                                            </td>
                                                            <td class="col">
                                                        <textarea class="form-control feedback"
                                                                  placeholder="Feedback">{{$item->feedback}}</textarea>
                                                            </td>
                                                            <td class="col">
                                                                <input type="text"
                                                                       value="{{$item->star}}"
                                                                       class="form-control star" placeholder="Star"/>
                                                            </td>
                                                            <td class="col">
                                                                <input type="text" class="form-control earned"
                                                                       value="{{$item->earned}}"
                                                                       placeholder="Earned"/>
                                                            </td>
                                                            <td class="col">
                                                                <input type="text"
                                                                       value="{{$item->hour_rate}}"
                                                                       class="form-control hour_rate" placeholder="Hour rate"/>
                                                            </td>
                                                            <td class="col">
                                                                <input type="text"
                                                                       class="form-control work_hours"
                                                                       value="{{$item->work_hours}}"
                                                                       placeholder="Work hours"/>
                                                            </td>
                                                            <td class="col"><a class="deleteRow"></a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="col">
                                                            <input type="text" class="form-control work_history"
                                                                   placeholder="Work history"/>
                                                        </td>
                                                        <td class="col">
                                                            <input type="text"
                                                                   class="form-control work_date" placeholder="Work date"/>
                                                        </td>
                                                        <td class="col">
                                                        <textarea class="form-control feedback"
                                                                  placeholder="Feedback"></textarea>
                                                        </td>
                                                        <td class="col">
                                                            <input type="text"
                                                                   class="form-control star" placeholder="Star"/>
                                                        </td>
                                                        <td class="col">
                                                            <input type="text" class="form-control earned"
                                                                   placeholder="Earned"/>
                                                        </td>
                                                        <td class="col">
                                                            <input type="text"
                                                                   class="form-control hour_rate" placeholder="Hour rate"/>
                                                        </td>
                                                        <td class="col">
                                                            <input type="text"
                                                                   class="form-control work_hours"
                                                                   placeholder="Work hours"/>
                                                        </td>
                                                        <td class="col">
                                                            @if($loop->index == 0)
                                                                <a class="deleteRow"></a>
                                                            @else
                                                                <input type="button"
                                                                       class="ibtnDel btn btn-md btn-danger "
                                                                       data-delete="employment" value="Delete">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td style="text-align: left;">
                                                        <input type="button" class="btn btn-lg btn-block addrow"
                                                               data-selector="work_history"
                                                               value="Add Row"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="work_history">



                                        @elseif($row->field == 'languages')

                                            <table id="languages" class=" table order-list">
                                                <tbody>
                                                @if($dataTypeContent->languages)
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
                                                               data-selector="language" value="Add Row"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="languages">
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit"
                                    class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'
                    </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function () {
                $file = $(this).siblings(tag);

                params = {
                    slug: '{{ $dataType->slug }}',
                    filename: $file.data('file-name'),
                    id: $file.data('id'),
                    field: $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('[name="country"]').change(function () {
            var country = $(this).val();
            if (country) {
                $.ajax({
                    url: '{{route('admin.change_country')}}/' + country,
                    type: 'get',
                    success: function (data) {
                        $('[name="city"]').html(data).select2();
                    }
                })
            }
        });


        $(document).ready(function () {


            $(".addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                var selector = $(this).data('selector');
                if (selector == 'employment') {
                    cols += '<td><input type="text" class="form-control employment"  placeholder="Employment Name"/></td>';
                    cols += '<td><input type="text" class="form-control employment_staff" placeholder="ex. Manager"/></td>';
                    cols += '<td><input type="text" class="form-control employment_date" placeholder="Data"/></td>';
                    cols += '<td><textarea class="form-control employment_desc"  placeholder="Employment description"></textarea></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " data-delete="employment"  value="Delete"></td>';
                    newRow.append(cols);
                    $("#employment").append(newRow);

                } else if (selector == 'education') {
                    cols += '<td><input type="text" class="form-control education" placeholder="Education"/></td>';
                    cols += '<td><input type="text" class="form-control education_staff" placeholder="ex. Bachelor degree"/></td>';
                    cols += '<td><input type="text" class="form-control education_date" placeholder="Data"/></td>';
                    cols += '<td><textarea class="form-control education_desc" placeholder="Education description"></textarea></td>';
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
                else if (selector == 'work_history') {
                    cols += '<td class="col">\n' +
                        '                                                            <input type="text"  class="form-control work_history"\n' +
                        '                                                                   placeholder="Work history"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <input type="text"\n' +
                        '                                                                   class="form-control work_date" placeholder="Work date"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <textarea class="form-control feedback" placeholder="Feedback"></textarea>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <input type="text"\n' +
                        '                                                                   class="form-control star" placeholder="Star"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <input type="text" class="form-control earned" placeholder="Earned"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <input type="text"\n' +
                        '                                                                   class="form-control hour_rate" placeholder="Hour rate"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td class="col">\n' +
                        '                                                            <input type="text"\n' +
                        '                                                                   class="form-control work_hours" placeholder="Work hours"/>\n' +
                        '                                                        </td>\n' +
                        '                                                        <td><input type="button" class="ibtnDel btn btn-md btn-danger " data-delete="education"  value="Delete"></td>';
                    newRow.append(cols);
                    $("#work_history").append(newRow);
                }
            });


            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
            });


        });



        $('.form-edit-add').submit(function (form) {
            var employment = [];
            var education = [];
            var work_history = [];
            var languages = [];
            $('.employment').each(function (i, j) {
                employment.push({
                    "employment": $(this).val(),
                    "staff": $('.employment_staff').eq(i).val(),
                    "date": $('.employment_date').eq(i).val(),
                    "description": $('.employment_desc ').eq(i).val(),
                })
            });

            $('.education').each(function (i, j) {
                education.push({
                    "education": $(this).val(),
                    "staff": $('.education_staff').eq(i).val(),
                    "date": $('.education_date').eq(i).val(),
                    "description": $('.education_desc').eq(i).val(),
                })
            });
            $('.language_prefix').each(function (i, j) {
                languages.push({
                    "prefix": $(this).val(),
                    "quality": $('.language_quality').eq(i).val(),
                })
            });

            $('.work_history').each(function (i, j) {
                work_history.push({
                    "work_history": $(this).val(),
                    "work_date": $('.work_date').eq(i).val(),
                    "feedback": $('.feedback').eq(i).val(),
                    "star": $('.star').eq(i).val(),
                    "earned": $('.earned').eq(i).val(),
                    "hour_rate": $('.hour_rate').eq(i).val(),
                    "work_hours": $('.work_hours').eq(i).val(),
                })
            });

            $('input[name="employments"]').val(JSON.stringify(employment));
            $('input[name="educations"]').val(JSON.stringify(education));
            $('input[name="work_history"]').val(JSON.stringify(work_history));
            $('input[name="languages"]').val(JSON.stringify(languages));
        })

    </script>
@stop
