<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->filter(request(['category','author','search']))->paginate(3)->withQueryString();
        // dd($posts);
        // $selected_category = Category::firstWhere('slug',request('category'));
        return view('posts.index',compact('posts'));
    }

    public function show(Post $post){
        // dd($post);
        return view('posts.show', compact('post'));
    }
    
}
