<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // .........................................
    public function editPost(Post $post){

        if(Auth::user()->id !== $post->user_id) return redirect('/');
        
        // return $post->id. " " . $post->title;
        
        return view('editpost', ['post' => $post]);
    }

    // .........................................
    public function updatePost(Request $request, Post $post){
        if(Auth::user()->id !== $post->user_id) return redirect('/');

        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max: 100'],
            'body' => ['required', 'min:10', 'max: 300'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        
        // return "update post: " . $post->id . " " . $post->title;
        $post->update($incomingFields);
        return redirect('/');
    }

    // .........................................
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => ['required', 'min:3', 'max: 100'],
            'body' => ['required', 'min:10', 'max: 300'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] =  Auth::user()->id;

        // print_r($incomingFields); // associate array
        Post::create($incomingFields);
        return redirect(Route('home'));     
    }

        // .........................................
    public function deletePost(Post $post){
        if(Auth::user()->id !== $post->user_id) return redirect('/');
        
        $post->delete();
        return redirect('/');
    }
} 
