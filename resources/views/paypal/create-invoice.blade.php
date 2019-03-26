@extends('layouts.app')

@section('content')
    <div id="columns" class="columns-container">
        <div class="bg-top"></div>
        <div class="warpper">
            <!-- container -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <form method="POST" action="{{ route('paypal.invoice.create',['slug' => 'clients']) }}" id="form-account-creation"
                              class="form-horizontal box panel panel-default">
                            @csrf
                            <h3 class="panel-heading">Create and send Invoice</h3>
                            <div class="form_content panel-body clearfix">
                                <div id="apidetails">The CreateAndSendInvoice API combines the functionality of
                                    CreateInvoice and SendInvoice.
                                </div>
                                <div class="params">
                                    <?php if (isset($_GET['permToken'])) echo $_GET['permToken'];?>
                                    <input type="checkbox" id="permissions" name="permissions"
                                           <?php if (isset($_GET['permToken'])) echo ' checked ';?>  />
                                    <label for="permissions"> Use Permission Credentials </label><br/>
                                    <div id="permissionsdata"
                                         style="display: <?php if (isset($_GET['permToken'])) echo 'block'; else echo 'none'; ?>">
                                        <div class="overview">The PayPal Permissions API allows you to request and
                                            obtain permissions to execute one or more APIs on behalf of your customers
                                            (third party). The granted permission is represented by a access token and
                                            token secret pair that you must store securely.
                                        </div>
                                        <div class="param_name">Access Token</div>
                                        <div class="param_value">
                                            <input type="text" name="accessToken"
                                                   value="<?php if (isset($_GET['permToken'])) echo $_GET['permToken'];?>"
                                                   size="50"/>

                                        </div>
                                        <div class="param_name">Token Secret</div>
                                        <div class="param_value">
                                            <input type="text" name="tokenSecret" id="auth"
                                                   value="<?php if (isset($_GET['permTokenSecret'])) echo $_GET['permTokenSecret'];?>"
                                                   size="50"/>
                                        </div>
                                        Click <a href="Permissions/RequestPermissions.php">here</a> to get AccessToken
                                        and TokenSecret<br/>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn button btn-default">Create and Send</button>
                                        <p class="pull-right required"><span><sup>*</sup>Required field</span></p>
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
    <script>
        $("#permissions").click(function(){
            var elem = document.getElementById('permissionsdata');
            var style = elem.style.display;
            if(style == 'block') {
                elem.style.display = 'none';
            } else {
                elem.style.display = 'block';
            }
        });
        {{--var country_id = '{{$employer->country_id}}';--}}
        {{--var city_id = '{{$employer->city_id}}';--}}

        {{--$('[name="country_id"]').change(function () {--}}
        {{--country_id = $(this).val();--}}
        {{--getCity(country_id);--}}
        {{--});--}}

        {{--function getCity(country_id) {--}}
        {{--if (country_id) {--}}
        {{--$.ajax({--}}
        {{--url: '{{route('admin.change_country')}}/' + country_id,--}}
        {{--type: 'get',--}}
        {{--success: function (data) {--}}
        {{--$('[name="city_id"]').html(data);--}}
        {{--}--}}
        {{--})--}}
        {{--}--}}
        {{--}--}}

        {{--if(country_id){--}}
        {{--getCity(country_id);--}}
        {{--}--}}

    </script>
@stop