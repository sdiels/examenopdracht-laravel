<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Post;
use App\Comment;
use App\User;
use App\Point;
use Auth;

class MainController extends Controller
{
    public function home () {
        $posts = Post::All();
        $posts->load('user', 'comments');
        
        return view('home', compact('posts'));
    }
    
    //COMMENTS___________________________________________________________________________________________________________________________________________________

    public function comments ($id) {
        $post = Post::Find($id);
        $post->load('comments.user', 'user');
        return view('comments', compact('post'));
    }
    
    public function commentsDelete ($id, Request $request) {
        if($request->confirm == 'false') {
            return back()->with('message', 'Are you sure you want to delete your comment?');
        }else {
            $comment = Comment::Find($id);
            $comment->delete();
        
            return back()->with('message', 'Your comment has been deleted.');
        }
    }
    
    public function commentsEdit ($id) {
        $comment = Comment::Find($id);
        $postId = $comment->post->id;

        return view('commentsEdit', compact('comment'));  
    }
    
    public function commentsUpdate (Request $request, $id) {
        
        if($request->comment == "") {
            return back()->with('message', 'Please fill in the comment section.');
        }else {
            $comment = Comment::find($id);
            $comment->comment = $request->comment;
            $comment->save();
        
            return redirect()->route('comments', [$comment->post_id])->with('message', 'Your comment has been edited.');
        }
    }
    
    public function commentsAdd (Request $request) {
        
        if($request->comment == "") {
            return back()->with('message', 'Please fill in the comment section.');
        }else {
            $post = Post::Find($request->post_id);
            $post->comments()->save(new Comment(['comment' => $request->comment, 'user_id' => $request->user_id]));
        
            return back()->with('message', 'Your comment has been added.');
        }
    }
    
    //POSTS_____________________________________________________________________________________________________________________________________________________
    
    public function post () {
        return view('post');
    }
    
    public function postAdd (Request $request) {
        if($request->title == "") {
            return back()->with('message', 'Please fill in the title.');
        }else if ($request->url == "") {
            return back()->with('message', 'Please fill in the url.');
        }else {
            $user = Auth::user();
            $user->posts()->save(new Post(['title' => $request->title, 'url' => $request->url]));
        
            return redirect()->route('home')->with('message', 'Your post has been added.');
        }
    }
    
    public function postDelete ($id, Request $request) {
        if($request->confirm == 'false') {
            return back()->with('message', 'Are you sure you want to delete your post?');
        }else {
            $post = Post::Find($id);
        $post->delete();
        
        return back()->with('message', 'Your post has been deleted.');
        }
    }
    
    public function postEdit ($id) {
        $post = Post::Find($id);

        return view('postEdit', compact('post'));  
    }
    
    public function postUpdate (Request $request, $id) {
        
        if($request->title == "") {
            return back()->with('message', 'Please fill in the title.');
        }else if ($request->url == "") {
            return back()->with('message', 'Please fill in the url.');
        }else {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->url = $request->url;
            $post->save();
        
            return redirect()->route('home')->with('message', 'Your post has been edited.');
        }
    }
    
    //VOTES_____________________________________________________________________________________________________________________________________________________
    
    public function upvote ($postid, $userid) {
        $post = Post::Find($postid);
        if (Point::where([['post_id', '=', $postid], ['user_id', '=', $userid]])->exists()) {
            $point = Point::where([['post_id', '=', $postid], ['user_id', '=', $userid]])->first();
            $point->point = 1;
            $point->save();
        } else {
            $post->points()->save(new Point(['user_id' => $userid, 'point' => 1]));
        }
        
        $points = 0;
        $pointsArray = Point::where('post_id', $postid)->get();
        foreach ($pointsArray as $point){
            if($point->point == 1) {
                $points+=1;
            }else {
                $points-=1;
            }
        }
        $post->points = $points;
        $post->save();
        
        return back()->with('message', 'Your vote has been submitted.');
    }
    
    public function downvote ($postid, $userid) {
        $post = Post::Find($postid);
        if (Point::where([['post_id', '=', $postid], ['user_id', '=', $userid]])->exists()) {
            $point = Point::where([['post_id', '=', $postid], ['user_id', '=', $userid]])->first();
            $point->point = -1;
            $point->save();
        } else {
            $post->points()->save(new Point(['user_id' => $userid, 'point' => -1]));
        }
        
        $points = 0;
        $pointsArray = Point::where('post_id', $postid)->get();
        foreach ($pointsArray as $point){
            if($point->point == 1) {
                $points+=1;
            }else {
                $points-=1;
            }
        }
        $post->points = $points;
        $post->save();
        
        return back()->with('message', 'Your vote has been submitted.');
    }
}