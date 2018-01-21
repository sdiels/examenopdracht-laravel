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
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
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

            @if(Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message')}}
                
                @if(Session::get('message') === 'Are you sure you want to delete your post?')
                <form action="/post/delete/{{$post->id}}" method="post">
                    {{ csrf_field() }} {{ method_field('DELETE') }}
                    <input type = "hidden" name = "confirm" value = "true" />
                    <button type="submit" class="btn btn-primary btn-xs edit-btn">Confirm</button>
                </form>
                @endif
                
                @if(Session::get('message') === 'Are you sure you want to delete your comment?')
                <form action="/comments/delete/{{$comment->id}}" method="post">
                    {{ csrf_field() }} {{ method_field('DELETE') }}
                    <input type = "hidden" name = "confirm" value = "true" />
                    <button type="submit" class="btn btn-primary btn-xs edit-btn">Confirm</button>
                </form>
                @endif
            </div>
            @endif @yield('content')
        </div>

    </div>
</body>

</html>
