<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index',['user' => auth()->user()->load(['profile','posts'])]);
    }

    public function store(Request $request){
        $profile = auth()->user()->following()->toggle($request->profile_id);
        // dd($profile);
        return back()->with('success','Profile Updated Successfully');

    }

    public function show($username){
        $user = User::with(['profile','posts'])->firstWhere('username',$username);
        // dd($user);
        if(!$user){
            abort(404);
        }
        return view('profile.show',compact('user'));
    }
    
    public function edit(){
        return view('profile.update');
    }
    public function update(ProfileRequest $request){
        
        $data = $request->validated();

        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->storeAs('profiles',request()->file('image')->hashName(),'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(100, 100);
            auth()->user()->profile()->update(['image' => $imagePath]);
            $image->save();
        }

        auth()->user()->update([
            'username' => $data['username'],
            'name'     => $data['name'],
            'email'    => $data['email'],
        ]);

        auth()->user()->profile()->update([
            'date_of_birth'   => $data['date_of_birth'],
            'contact_number'  => $data['contact_number'],
            'address'         => $data['address']
        ]);

        return back()->with('success','Profile Successfully Updated!');
    }
}
