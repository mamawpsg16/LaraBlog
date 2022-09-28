<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use App\HttP\Requests\PostRequest;
class AdminController extends Controller
{
    public function index(){

        return view('admin.posts.index',['posts' => Post::latest()->paginate(10)]);

    }

    public function edit(Post $post){
        return view('admin.posts.edit',compact('post'));

    }

    public function create(){
        return view('admin.posts.create');
    }
    public function store(PostRequest $request){

        $data = $request->validated();
        
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug(request()->title);
        $data['image'] = request()->file('image')->storeAs('thumbnails',request()->file('image')->hashName(),'public');

        Post::create($data);

        return back()->with('success','Post Succesfully Created');
    }

    public function update(Post $post,PostRequest $request){

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if(request()->hasFile('image')){
            $data['image'] = request()->file('image')->storeAs('thumbnails',request()->file('image')->hashName(),'public');
        }

        $post->update($data);

        return back()->with('success','Post Succesfully Updated');
    }
    
    public function destroy(Post $post){
        $post->delete();

        return back()->with('success','Post Succesfully Deleted');
    }
}
