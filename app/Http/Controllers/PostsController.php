<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        Post::create([
            'title' => $request->title,
            'post_owner' => Auth::user()->id,
            'content' => $request->content,
            'score' => 0
        ]);    

        $posts = Post::where(['id' => Auth::user()->id])->get();
        return view('home', compact('posts'));
    }

    public function upvote(Request $request) {
        $score = Post::findOrFail($request->id);
        $score->update([
            'score' => $score->score + 1
        ]);
        $posts = Post::where(['id' => Auth::user()->id])->get();
        return view('home', compact('posts'));
    }

    public function downvote(Request $request) {
        $score = Post::findOrFail($request->id);
        $score->update([
            'score' => $score->score - 1
        ]);

        $posts = Post::where(['id' => Auth::user()->id])->get();
        return view('home', compact('posts'));      
    }
}
