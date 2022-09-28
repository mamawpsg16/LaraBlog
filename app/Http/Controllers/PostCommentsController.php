<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post){
        // add a comment to the specific post
        request()->validate([
            'body' => ['required']
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ]);
        
        // dd($post);
        return back();
        
    }
}
