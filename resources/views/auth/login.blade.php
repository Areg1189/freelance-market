@extends('layouts.app')

@section('content')
<div id="columns" class="columns-container">
    <div class="bg-top"></div>
    <div class="warpper">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form action="#" id="create-account-form" class="form-horizontal box panel panel-default">
                        <h3 class="panel-heading">Create an account</h3>
                        <div class="form_content panel-body clearfix">
                            <p>Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                            <a href="{{route('register')}}" class="btn button btn-default" title="Create an account" rel="nofollow"><i class="fa fa-user left"></i> Create an account</a>
                        </div>
                    </form><!--end form -->
                </div>
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('login') }}" id="form-login" class="form-horizontal box panel panel-default">
                        @csrf
                        <h3 class="panel-heading">Already registered?</h3>
                        <div class="form_content panel-body clearfix">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="email" >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label for="passwd">Password</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="passwd" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <p class="lost_password">
                                        <a href="{{ route('password.request') }}" title="Recover your forgotten password" rel="nofollow">Forgot your password?</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button class="btn button btn-default"><i class="fa fa-lock left"></i> Sing in</button>
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
