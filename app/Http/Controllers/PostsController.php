<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = Post::latest()->filter(request(['category','author','search']))->paginate(3)->withQueryString();
        // $selected_category = Category::firstWhere('slug',request('category'));
        return view('posts.index',compact('posts'));
    }
}
