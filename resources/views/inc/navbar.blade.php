      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name','RateYourCourse') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <ul class="nav navbar-nav mr-auto">
                            <li><a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a></li>
                            
                            
                            <!---
                            <li class="nav-item">
                                <a class="nav-link" href="/lsapp/public/services">Services</a>
                            </li>
                            --->
                            <li class="nav-item">
                                <a class="nav-link" href="/posts">Reviews</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="/posts/create">Post a Review!</a>
                            </li>
                            <li>
                                    {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
                                        {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search For Reviews'])}}
                                        <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
                                    {!! Form::close() !!}
                            </li>
                     </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About Us</a>
                             </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/dashboard">
                                         {{ __('Dashboard') }}
                                        </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>