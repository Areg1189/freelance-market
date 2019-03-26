<div class="login-modal job-post-modal d-flex align-items-center justify-content-center" id="support-show-item">
    <div class="bg"></div>
    <div class="inner-modal w-50 py-0 position-relative px-3">
        <h4 class="text-center py-3 fw-600">{{$support->name}}</h4>
        <!--INFO-->
        <div class="row text-center mt-3">
            <p class="fs-14 px-3">
                {{$support->description}}
            </p>

        </div>


        <!--DESCRIPTION-->
        <div class="row mt-3 job-description-posting">
            <div class="col-md-10 offset-md-1 text-center">
                Du you have any questions
            </div>
        </div>
        <!--ATTACHED FILES-->

        <div class="my-2 text-center">

                <button class="own-btn close-modal-icon" data-id="{{$support->id}}">
                    <i class="fas fa-thumbs-up"></i>
                </button>
            <button class="own-btn ask-question ">Have Question <i class="fas fa-question"></i></button>
        </div>

        <a href="" class="close-modal"><img src="{{asset('storage/img/close.png')}}" alt="close modal"
                                            class="img-fluid"></a>
    </div>
</div>