<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Post;
use App\Comment;
use App\User;
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
    
    public function commentsDelete ($id) {
        $comment = Comment::Find($id);
        $comment->delete();
        
        return back();
    }
    
    public function commentsEdit ($id) {
        $comment = Comment::Find($id);
        $postId = $comment->post->id;

        return view('commentsEdit', compact('comment'));  
    }
    
    public function commentsUpdate (Request $request, $id) {
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();
        
        return redirect()->route('comments', [$comment->post_id]);
    }
    
    public function commentsAdd (Request $request) {
        
        $post = Post::Find($request->post_id);
        $post->comments()->save(new Comment(['comment' => $request->comment, 'user_id' => $request->user_id]));
        
        return back();
    }
    
    //POSTS_____________________________________________________________________________________________________________________________________________________
    
    public function post () {
        return view('post');
    }
    
    public function postAdd (Request $request) {
        $user = Auth::user();
        $user->posts()->save(new Post(['title' => $request->title, 'url' => $request->url]));
        
        return redirect()->route('home');
    }
    
    public function postDelete ($id) {
        $post = Post::Find($id);
        $post->delete();
        
        return back();
    }
    
    public function postEdit ($id) {
        $post = Post::Find($id);

        return view('postEdit', compact('post'));  
    }
    
    public function postUpdate (Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->url = $request->url;
        $post->save();
        
        return redirect()->route('home');
    }
}