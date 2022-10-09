<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\HttP\Requests\PostRequest;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index(){
        $posts = Post::filterPosts(request('published'))->latest()->paginate(10);
        return view('post.index',['posts' => $posts]);
    }


    public function create(){
        return view('post.create');
    }
    public function store(PostRequest $request){

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug(request()->title);
        $data['published_at'] = isset($data['published_at']) ? now() : null;
        $data['image'] = request()->file('image')->storeAs('thumbnails',request()->file('image')->hashName(),'public');
        $image = Image::make(public_path("storage/{$data['image']}"))->fit(1000, 1000);
        $image->save();

        Post::create($data);

        return back()->with('success','Post Succesfully Created');
    }

    public function show(Post $post){

        return view('post.show', compact('post'));
    }

    
    public function edit(Post $post){


        return view('post.edit',compact('post'));

    }
    
    public function update(Post $post,PostRequest $request){

        
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        $data['published_at'] = isset($data['published_at']) ? now() : null;
        
        if(request()->hasFile('image')){
            $data['image'] = request()->file('image')->storeAs('thumbnails',request()->file('image')->hashName(),'public');
            $image = Image::make(public_path("storage/{$data['image']}"))->fit(1000, 1000);
            $image->save();
        }

        $post->update($data);

        return back()->with('success','Post Succesfully Updated');
    }
    
    public function destroy(Post $post){
        $post->delete();

        return back()->with('success','Post Succesfully Deleted');
    }

    public function likePost(Request $request){
        auth()->user()->liked()->toggle($request->post_id);

        return back()->with('success','Post Liked Successfully');
    }
}
