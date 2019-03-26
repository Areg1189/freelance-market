<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-1 own-shadow px-own ">
        <a class="navbar-brand py-0" href="{{route('home')}}">
            <img src="{{asset('storage/img/logo.png')}}" alt="{{ config('app.name', 'HIRE < Profs />') }}">
        </a>
        {{--<div class="container">--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ownNavbar"
                aria-controls="ownNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="ownNavbar">
            <ul class="navbar-nav m-auto align-items-center">
                @guest
                <li class="nav-item {{ (Request::url()==route('page',['how-it-works']) ?'active':'') }}">
                    <a class="nav-link {{ (Request::url()==route('page',['how-it-works']) ?'active':'') }}"
                       href="{{route('page',['how-it-works'])}}">How It Works</a>
                </li>
                @if(Auth::guest() || auth()->user()->can('show-jobs'))
                    <li class="nav-item {{ (Request::is("job*")?'active':'') }} ">
                        <a class="nav-link {{ (Request::is("job*")?'active':'') }}" href="{{route('job.index')}}">Posted
                            Jobs</a>
                    </li>
                @endif
                <li class="nav-item {{ (Request::is("faq*")?'active':'') }}">
                    <a class="nav-link {{ (Request::is("faq*")?'active':'') }}"
                       href="{{route('faq.show')}}">F.A.Q</a>
                </li>
                @else
                    @if(auth()->user()->hasRole('employer'))
                        <li class="nav-item {{ (Request::is("/")?'active':'') }}">
                            <a class="nav-link {{ (Request::is("/")?'active':'') }}"
                               href="{{route('home')}}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item {{ (Request::is("job*")?'active':'') }}">
                            <a class="nav-link {{ (Request::is("job*")?'active':'') }}" href="{{route('home')}}">Dashboard</a>
                        </li>
                    @endif

                    @if(auth()->user()->hasRole('employer'))
                        <li class="nav-item dropdown {{Request::is('emp/my/jobs*')?'active':''}}">
                            <a class="nav-link dropdown-toggle d-flex align-items-center {{Request::is('emp/my/jobs*')?'active':''}}"
                               href="#" id="jobs"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My jobs
                            </a>
                            <div class="dropdown-menu py-0 text-center navbar-dropdown" aria-labelledby="jobs">
                                <a class="dropdown-item"
                                   href="{{route('employer.job', ['status' => 'in-processing'])}}">In progress</a>
                                <a class="dropdown-item" href="{{route('employer.job', ['status' => 'open'])}}">Open</a>
                                <a class="dropdown-item" href="{{route('employer.job', ['status' => 'completed'])}}">Completed</a>
                                <a class="dropdown-item" href="{{route('employer.job', ['status' => 'canceled'])}}">Canceled</a>
                            </div>
                        </li>
                    @else

                        <li class="nav-item {{ (Request::url()==route('freelancer.proposal') ?'active':'') }}">
                            <a class="nav-link {{ (Request::url()==route('freelancer.proposal') ?'active':'') }}"
                               href="{{route('freelancer.proposal')}}">My proposals</a>
                        </li>
                    @endif
                    @if(auth()->user()->hasRole('employer'))
                        <li class="nav-item {{ (Request::url()== route('employer.reports') ?'active':'') }} ">
                            <a class="nav-link {{(Request::url()== route('employer.reports') ?'active':'') }}"
                               href="{{route('employer.reports')}}">Reports</a>
                        </li>
                    @else
                        <li class="nav-item {{ (Request::url()== route('freelancer.reports') ?'active':'') }} ">
                            <a class="nav-link {{ (Request::url()== route('freelancer.reports') ?'active':'') }}"
                               href="{{route('freelancer.reports')}}">Reports</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown {{((Request::is('contracts/*') || Request::is('contracts*'))?'active':'') }}">
                        <a class="nav-link dropdown-toggle d-flex align-items-center {{((Request::is('contracts/*') || Request::is('contracts*'))?'active':'') }}"
                           href="#" id="contracts"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contracts
                        </a>
                        @if(auth()->user()->hasRole('employer'))
                            <div class="dropdown-menu py-0 text-center navbar-dropdown"
                                 aria-labelledby="contracts">
                                <a class="dropdown-item"
                                   href="{{ route('employer.contracts', ['status' => 'active'])}}">Active</a>
                                <a class="dropdown-item"
                                   href="{{ route('employer.contracts', ['status' => 'close'])}}">Close</a>
                            </div>
                        @else
                            <div class="dropdown-menu py-0 text-center navbar-dropdown"
                                 aria-labelledby="contracts">
                                <a class="dropdown-item"
                                   href="{{ route('freelancer.contracts', ['status' => 'active'])}}">Active</a>
                                <a class="dropdown-item"
                                   href="{{route('freelancer.contracts', ['status' => 'close'])}}">Close</a>
                                <a class="dropdown-item"
                                   href="{{route('freelancer.contracts', ['status' => 'offers'])}}">Offers</a>
                            </div>
                        @endif

                    </li>
                    <li class="nav-item {{ (Request::is("support*")?'active':'') }}">
                        <a class="nav-link {{ (Request::is("support*")?'active':'') }}"
                           href="{{route('support.show')}}"><sup></sup>Support</a>
                    </li>
                    <li class="nav-item pl-3">
                        <a href="" class="search-link">
                            <img src="{{asset('storage/img/navbar/search-icon.png')}}" alt="search icon">
                        </a>
                    </li>
                    @endguest
            </ul>
            @guest
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link to-login" href="#" title="Login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link own-btn to-login btn-login-post" href="{{route('job.create')}}"
                       title="Post a Project">Post a project</a>
                </li>
            </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item d-flex mr-3 align-items-center">
                        <a class="nav-link p-00  mv-30 position-relative" href="{{route('messenger')}}">
                            <img src="{{asset('storage/img/message.png')}}" alt="Message" class="img-fluid"/>
                            <span class="position-absolute notif-count notif-count-message bg-orange white {{noteSeeCount(auth()->id()) > 0 ? 'active' : ''}}">{{noteSeeCount(auth()->id())}}</span>

                        </a>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link p-00 dropdown-toggle d-flex align-items-center show-notify mv-30 position-relative"
                           href="#"
                           id="notification"
                           role="button" data-href="{{route('notifications.index')}}"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('storage/img/bell.png')}}" alt="notifications" class="img-fluid">

                            <span class="position-absolute notif-count notif-count-notification bg-orange white {{auth()->user()->unreadNotifications->count() ? 'active' : ''}}">{{auth()->user()->unreadNotifications->count()}}</span>

                        </a>
                        <div class="dropdown-menu py-0 text-center navbar-dropdown" aria-labelledby="notification">
                            <div id="not-list">
                            </div>
                            <a class="dropdown-item orange" href="{{route('notifications.index')}}">See all
                                notifications</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profile"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="user-name pr-3">{{auth()->user()->name}}</span>
                            <span class="user-img mv-40">
                                        <img src="{{Voyager::image(auth()->user()->avatar)}}"
                                             alt="{{auth()->user()->name}}" class="img-fluid"/>
                                    </span>
                        </a>
                        <div class="dropdown-menu py-0 text-center navbar-dropdown" aria-labelledby="profile">
                            @if(auth()->user()->hasRole('employer'))
                                <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                            @endif
                            @if(auth()->user()->hasRole('freelancer'))
                                <a class="dropdown-item" href="{{route('freelancers.show', auth()->user()->slug)}}">Profile</a>
                                <a class="dropdown-item" href="{{route('freelancer.favorite')}}">Favorite</a>
                            @endif
                            @if(auth()->user()->hasRole('admin'))
                                <a class="dropdown-item" href="/admin">Admin Panel</a>
                            @endif
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
                        </div>
                    </li>

                </ul>
                @endguest
        </div>
        @auth
        <div class="search-block">
            <form action="{{auth()->user()->hasRole('freelancer') ? route('job.index') : route('freelancers.index')}}">
                <div class="input-group">
                    <input type="text" class="form-control search-des keyword" aria-label="Search Keywords"
                           placeholder="Keyword">
                    <select class="form-control  search-des cat-search">
                        <option value=""> Category</option>
                        @foreach(getCategories() as $category)
                            <option value="{{$category->slug}}">{{$category->name}}</option> >
                        @endforeach
                    </select>
                    <select class="form-control search-des">
                        <option value="">Location</option>
                        @foreach(getCountries() as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    {{--<select class="form-control" name="skills[]" id="skills" multiple > </select>--}}
                    <select class="form-control" name="skills[]" hidden multiple> </select>
                    <button type="submit" class="search-button search-des">Search</button>
                </div>
            </form>
        </div>
        @endauth
        {{--</div>--}}
    </nav>
</header>
