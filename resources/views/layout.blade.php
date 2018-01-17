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
              </ul>
            </div>
            <div class="navigationRight">
              <ul>
              @if (Route::has('login'))
                      @auth
                        <li><a href="{{ url('/') }}">Home</a></li>
                      @else
                          <li><a href="{{ route('login') }}">Login</a></li>
                          <li><a href="{{ route('register') }}">Register</a></li>
                      @endauth
              @endif
              </ul>
            </div>
          </div>
          <div class="content">
            @yield('content')
          </div>

        </div>
    </body>
</html>