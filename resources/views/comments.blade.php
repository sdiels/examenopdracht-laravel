@extends('layout')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <a href="{{ url('/') }}"><p>← Back to overview</p></a>
            <div class="panel panel-default">
                <div class="contentHeader panel-heading">Article: {{$post->title}}</div>
                
                <div class="contentCont panel-body">
                    <ul class="article-overview">
                            <div class="vote">
                               
                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-up disabled upvote" title="You need to be logged in to upvote"></i>
                                </div>

                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-down disabled downvote" title="You need to be logged in to downvote"></i>
                                </div>
                            </div>

                            <div class="url">
                                <a href="{{$post->url}}" class="urlTitle"><h3>{{$post->title}}</h3></a>
                            </div>

                            <div class="info">
                                {{$post->points}} points | posted by {{$post->user->name}} | {{count($post->comments)}} comments
                            </div>
                    </ul>
                    
                    @foreach ($post->comments as $comment)
                    <li class="comment">
                        <p>{{$comment->comment}}</p>
                        <div class="info">
                            posted by {{$comment->user->name}} on {{$comment->created_at}}
                            </div>
                            
                            @auth
                            @if ($comment->user_id === Auth::user()->id)
                            <a href="/comments/edit/{{$comment->id}}" class="btn btn-primary btn-xs edit-btn">edit</a>
                            <form action="/comments/delete/{{$comment->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-primary btn-xs edit-btn">Delete</button>
                            </form>
                            @endif
                            @endauth
                    </li>
                    @endforeach
                    
                    @auth
                    <form action="/comments/add" method="POST" class="form-horizontal">
                                        <input type="hidden" name="_token" value="BAxG24DUpIfBJr3FY4cw93Ifv31IlDCCxaVbt0fn">

                                        <!-- Comment data -->
                                        <div class="form-group">
                                            <label for="body" class="col-sm-3 control-label">Comment</label>

                                            <div class="col-sm-6">
                                                <textarea type="text" name="comment" id="comment" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                        <!-- Add comment -->
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-plus"></i> Add comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection