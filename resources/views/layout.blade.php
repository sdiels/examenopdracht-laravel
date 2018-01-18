<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Layout</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
        <div class="page">
          <div class="header">
            <div class="navigationLeft">
              <ul>
                <li><a href="{{ url('/') }}">Hackernews.local</a></li>
                <li><a href="{{ url('/') }}">Home</a></li>
                @auth
                <li><a href="{{ url('/post') }}">Add post</a></li>
                @endauth
              </ul>
            </div>
            <div class="navigationRight">
              <ul>
              <!--@if (Route::has('login'))
                      @auth
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                      @else
                          <li><a href="{{ route('login') }}">Login</a></li>
                          <li><a href="{{ route('register') }}">Register</a></li>
                      @endauth
              @endif-->
              @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
              </ul>
            </div>
          </div>
          <div class="content">
            @yield('content')
          </div>

        </div>
    </body>
</html>