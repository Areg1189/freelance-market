@extends('layouts.app')

@section('content')
    @if(Auth::guest() || auth()->user()->hasRole('admin'))
        <!--SLIDER-->
        <section class="slider">
            <img src="{{asset('storage/img/slider/slider.jpg')}}" alt="Hire a Prof" class="img-fluid">
        </section>

        <!--INFO-->
        <section class="info-block my-5 py-5">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="col-12 mb-sm-4 mb-2">
                        <h2>Join to our <span class="orange">PROFESSIONALS</span> or post your jobs</h2>
                    </div>
                    <div class="col-sm-8">
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer
                            took a galley of type and scrambled it to make a type specimen book. It has survived not
                            only five centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                            Lorem Ipsum passages, and more recently with desktop publishing software like Aldus Page
                            Maker including versions of Lorem Ipsum.
                        </p>
                    </div>
                </div>
            </div>

        </section>
    @endif
    @auth
        @if( auth()->user()->hasRole('employer'))
            <!--DASHBOARD-->
            <section class="client-block mt-3 pt-3">
                <div class="container ">
                    <h1 class="fw-800 text-center mb-5">Dashboard</h1>
                    <div class="row justify-content-center mb-2">
                        <!--CREATE A JOB-->
                        <div class="col-md-3">
                            <a href="{{route('job.create')}}" class="dash ">
                                <div class="create text-center py-3 px-3 bg-orange">
                                    <h6 class="m-0 p-0 white  fw-700">Post a new job</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="{{route('employer.job')}}" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Active Posts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Expire Posts</h6>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <!--CREATE A JOB-->
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Active Contracts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">View Close Contracts</h6>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-3">
                            <a href="" class="dash">
                                <div class="create text-center py-3 px-3 bg-white">
                                    <h6 class="m-0 p-0 orange   fw-700">All Reports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--FIND SKILLS-->
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/uiux.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/webdevs.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/graphicdes.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/uiux.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/webdevs.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                        <div class="col-md-3">
                            <a href=""><img src="{{asset('storage/img/client/dashboard/graphicdes.jpg')}}" alt=""
                                            class="img-fluid"></a>
                        </div>
                    </div>
                </div>

            </section>
        @endif
    @endauth
@endsection
