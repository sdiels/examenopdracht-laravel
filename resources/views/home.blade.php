@extends('layout') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="contentHeader panel-heading">Article overview</div>

                <div class="panel-body">
                    <ul class="article-overview">


                        @foreach ($posts as $post)

                        <li class="post clearfix">
                            <div class="vote">
                                @auth
                                <div class="form-inline upvote">
                                    <a href="/upvote/{{$post->id}}/{{Auth::user()->id}}"><i class="fa fa-btn fa-caret-up upvote" title="Upvote">&uarr;</i></a>
                                </div>

                                <div class="form-inline upvote">
                                    <a href="/downvote/{{$post->id}}/{{Auth::user()->id}}"><i class="fa fa-btn fa-caret-down downvote" title="Downvote">&darr;</i></a>
                                </div>
                                @endauth
                                @guest
                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-up upvote" title="You need to be logged in to upvote">&uarr;</i>
                                </div>

                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-down downvote" title="You need to be logged in to downvote">&darr;</i>
                                </div>
                                @endguest
                            </div>

                            <div>
                                <div class="url">
                                    <a href="{{$post->url}}" class="urlTitle">{{$post->title}}</a>
                                </div>

                                <div class="info">
                                    {{$post->points}} points | posted by {{$post->user->name}} | <a href="comments/{{$post->id}}">{{count($post->comments)}} comments</a>
                                </div>

                                @auth @if ($post->user_id === Auth::user()->id)
                                <a href="/post/edit/{{$post->id}}" class="btn btn-primary btn-xs edit-btn">edit</a>
                                <form action="/post/delete/{{$post->id}}" method="post">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <input type="hidden" name="confirm" value="false" />
                                    <button type="submit" class="btn btn-primary btn-xs edit-btn">Delete</button>
                                </form>
                                @endif @endauth
                            </div>
                        </li>

                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
