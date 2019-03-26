<footer class="pt-5 mt-3">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="social-icons ml-3"><a href=""><img src="{{asset('storage/img/footer-social/facebook.png')}}"
                                                           alt="facebook"/></a>
            </div>
            <div class="social-icons ml-3"><a href=""><img src="{{asset('storage/img/footer-social/gmail.png')}}"
                                                           alt="G+"/></a></div>
            <div class="social-icons ml-3"><a href=""><img src="{{asset('storage/img/footer-social/linkedin.png')}}"
                                                           alt="linkedin"/></a>
            </div>
            <div class="social-icons ml-3"><a href=""><img src="{{asset('storage/img/footer-social/twitter.png')}}"
                                                           alt="Twitter"/></a></div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-md-left text-center">
                <ul class="footer-navigation">
                    <li><a href="{{route('page',['terms-of-service'])}}" class="footer-link">Terms of Service</a></li>
                    <li><a href="{{route('page',['privacy-policy'])}}" class="footer-link">Privacy Policy</a></li>
                    <li><a href="{{route('page',['cookie-policy'])}}" class="footer-link">Cookie Policy</a></li>
                    <li><a href="{{route('faq.show')}}" class="footer-link">F.A.Q</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul class="footer-navigation">
                    <li><a href="{{route('page',['how-it-works'])}}" class="footer-link">How It Works</a></li>
                    @if(Auth::guest() || !Auth::user()->hasRole('employer'))
                        <li><a href="{{route('job.index')}}" class="footer-link">Posted Jobs</a></li>
                    @endif
                    @if(Auth::guest() || !Auth::user()->hasRole('freelancer'))
                        <li><a href="{{route('freelancers.index')}}" class="footer-link">Freelancers</a></li>
                    @endif
                    <li><a href="{{route('page',['applications'])}}" class="footer-link">Applications</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-md-right text-center">
                <ul class="footer-navigation">
                    <li><a href="" class="footer-link">Support</a></li>
                    <li><a href="" class="footer-link">Contact Us</a></li>
                    <li><a href="" class="footer-link">Our Team</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-white py-3">
        <p class="m-0 p-0 text-center">
            &copy; 2017 - 2019 <a href="https://maximumcode.net" target="_blank"><span class="orange">MaximumCode</span></a>
            LLC.
        </p>
    </div>
</footer>
