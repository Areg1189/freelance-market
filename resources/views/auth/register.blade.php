@extends('layouts.app')

@section('content')
<div id="columns" class="columns-container">
    <div class="bg-top"></div>
    <div class="warpper">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <form method="POST" action="{{ route('register') }}" id="form-account-creation" class="form-horizontal box panel panel-default">
                        @csrf
                        <h3 class="panel-heading">Create an account</h3>
                        <div class="form_content panel-body clearfix">
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <label >First name <sup>*</sup></label>
                                    <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <label >Last Name <sup>*</sup></label>
                                    <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <label>Email address <sup>*</sup></label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <label>Password <sup>*</sup></label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <label>Confirm Password <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-lg-12">
                                    <div class="radio">
                                        <label><input type="radio"  name="role" value="employer" {{old('role') != 'freelancer' ? 'checked' :''}} >Employer</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="role" value="freelancer" {{old('role') == 'freelancer' ? 'checked' :''}} >Freelancer</label>
                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button class="btn button btn-default">Register</button>
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

@endsection
