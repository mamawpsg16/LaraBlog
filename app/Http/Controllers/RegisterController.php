<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(RegisterRequest $request){
        // dd($request);
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($attributes['password']);
        // $attributes['role_id']  = 1;
        
        $user = User::create($attributes);
        
        $user->save();

        auth()->login($user);

        // session()->flash('success','Your account has been created');
        
        return redirect('/')->with('success','Your account has been created');
    }
}
