<div class="login-modal d-flex align-items-center justify-content-center close-own-modal write-help" style="z-index: 999">
    <div class="bg"></div>
    <div class="inner-modal w-25 py-0 position-relative">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active active-tab" id="login-tab" data-toggle="tab" href="#login" role="tab"
                   aria-controls="home" aria-selected="true">Login</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="info-container"></div>

            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form class="p-3" action="{{ route('support.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="tetx" name="user_name"
                               class="form-control{{$errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="Your Name" required/>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
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
                        <input type="text" name="phone" id="phone_number"
                               class="form-control{{$errors->has('phone') ? ' is-invalid' : '' }}"
                               placeholder="Your Phone" required/>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Your Message..." name="message" id="" cols="30" rows="10"  class="form-control{{$errors->has('message') ? ' is-invalid' : '' }}"></textarea>
                        @if ($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="text-center">
                        <button type="submit" class="own-btn"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading...">Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <a href="" class="close-modal"><img src="{{asset('storage/img/close.png')}}" alt="close modal"
                                            class="img-fluid"></a>
    </div>
</div>