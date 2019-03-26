<div class="login-modal d-flex align-items-center justify-content-center close-own-modal">
    <div class="bg"></div>
    <div class="inner-modal w-25 py-0 position-relative">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active active-tab" id="login-tab" data-toggle="tab" href="#login" role="tab"
                   aria-controls="home" aria-selected="true">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="sign-up-tab" data-toggle="tab" href="#sign-up" role="tab"
                   aria-controls="profile" aria-selected="false">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="info-container"></div>

            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form class="p-3" action="{{ route('login') }}" method="POST" id="form-login">
                    <div class="form-group">
                        <input type="email" name="email" id="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}" aria-describedby="emailHelp"
                               placeholder="E-mail" required/>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password"
                               class="form-control{{$errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Password" required/>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember" id="save-me"
                               class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="save-me">Check me out</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="own-btn"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading...">Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="sign-up" role="tabpanel" aria-labelledby="sign-up-tab">
                <form class="p-3 row" method="POST" action="{{ route('register') }}" id="form-register">
                    @csrf
                    <div class="form-group col-md-6">
                        <input type="text" name="first_name" id="first-name"
                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                               value="{{ old('first_name') }}" placeholder="Your name" required/>

                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>

                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" name="last_name" id="user-surname"
                               class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                               value="{{ old('last_name') }}"
                               placeholder="Your surname" required/>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name')??'' }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-12">
                        <input type="email" name="email" id="user-email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}"
                               placeholder="Your E-mail" required/>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="password" name="password" id="user-password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Password" required/>

                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password')??'' }}</strong>
                            </span>

                    </div>

                    <div class="form-group col-md-6">
                        <input type="password" name="password_confirmation" class="form-control"
                               id="password-confirmation" placeholder="Confirm password" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="radio">
                            <label><input type="radio" name="role"
                                          value="employer" {{old('role') != 'freelancer' ? 'checked' :''}} >Employer</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="role"
                                          value="freelancer" {{old('role') == 'freelancer' ? 'checked' :''}} >Freelancer</label>
                        </div>
                        @if ($errors->has('role'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group form-check col-12 agree-container">
                        <input type="checkbox" class="form-check-input agree" name="agree" id="agree" required/>
                        <label class="form-check-label" for="agree">I agree with <a href="" class="orange">Therms and
                                conditions</a></label>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agree')??'' }}</strong>
                        </span>
                    </div>
                    <div class="text-center col-12">
                        <button type="submit" class="own-btn">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="" class="close-modal"><img src="{{asset('storage/img/close.png')}}" alt="close modal"
                                            class="img-fluid"></a>
    </div>
</div>