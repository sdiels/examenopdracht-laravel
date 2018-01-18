@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Edit comment</div>

                <div class="panel-content">
                    
                    

                    <!-- New Task Form -->
                    <form action="/comments/update/{{$comment->id}}" method="post" class="form-horizontal">
                       {{ method_field('PUT')}}
                       
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />

                        <!-- Article data -->
                        <div class="form-group">
                            <label for="article-title" class="col-sm-3 control-label">Comment</label>

                            <div class="col-sm-6">
                                <input type="text" name="comment" id="comment" class="form-control" value="{{$comment->comment}}">
                            </div>
                        </div>

                        <!-- Edit comment Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit comment
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection