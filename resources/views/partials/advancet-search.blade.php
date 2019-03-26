@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    @parent
@stop

<div class="job-searchform">
    <a href="#" class="btn-close" title="close"><i class="fa fa-close"></i></a>
    <div class="container">
        <div class="job-search">
            <form id="job-searchbox" action="{{route('freelancers.index')}}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <input type="text" class="form-control" id="inputKeywords" name="keywords" placeholder="Keywords...">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <select id="selectCategories" name="category" class="form-control">
                            <option value="">Categories</option>
                            @foreach(getCategories() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option> >
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <select id="selectLocation" name="location" class="form-control">
                            <option  value="">Location</option>
                            @foreach(getCountries() as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <select id="selectProject" name="project_type" class="form-control">
                            <option>Project type</option>
                            <option>Submit some Articles</option>
                            <option>Analyze some Data</option>
                            <option>Fill in a Spreadsheet with Data</option>
                            <option>Post some Advertisements</option>
                            <option>Hire a Virtual Assistant </option>
                            <option>Search the Web for Something</option>
                            <option>Find Information from Websites</option>
                            <option>Do some Excel Work</option>
                            <option>Help with customer support</option>
                        </select>
                    </div>
                    <div class="skill-search col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <select class="form-control job-skills"
                                type="text"
                                id="textSkill" name="skills[]" multiple required>
                            <option>Skills...</option>
                            @foreach(getSkills() as $skill)
                                <option value="{{$skill->id}}">
                                    {{$skill->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                        <div id="slider-range" class="tiva-filter">
                            <label>Budget</label>
                            <div class="filter-item price-filter">
                                <div class="layout-slider">
                                    <input id="price-filter" name="price" value="0;100" />
                                </div>
                                <div class="layout-slider-settings"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6 col-sp-12 fr-search">
                        <button type="submit" class="btn btn-primary btn-shadown pull-right">Search now</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6 col-sp-12 fr-search">
                        <button type="button" class="btn btn-primary btn-shadown save-search pull-left">Save</button>
                    </div>
                </div>
            </form>
        </div><!-- end job-search -->
    </div>
</div><!-- end job-searchform -->
<div class="job-advancedsearch">
    <a href="#"><i class="fa fa-search"></i><span>Advanced search</span></a>
</div><!-- end job-advancedsearch -->

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

        $('.save-search').click(function () {

            var token = $('meta[name="csrf-token"]').attr('content');
            var url = '{{route('search.save')}}';
            var keywords = $('#inputKeywords').val();
            var category = $('#selectCategories').val();
            var location = $('#selectLocation').val();
            var skills = $('#textSkill').val();
            if(keywords || category || skills){
                $.ajax({
                url:url,
                type: "POST",
                data: {_token: token, keywords: keywords, category:category, location:location, skills:skills},
                success : function (data) {
                    toastr.success(data.message);
                },
                error: function (reject) {
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        toastr.warning(errors.errors.keywords[0]);
                    }
                }
            })
            }else {
                toastr.success("Please chose one of Keywords,Category,Skills...");
            }

        });
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

    </script>
@stop