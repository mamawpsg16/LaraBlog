<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(Request $request){
        // dd($request);
        $attributes = request()->validate([
            'username' => 'required|max:255|min:4|unique:users,username',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7'
        ]);
        // $attributes['password'] = bcrypt($attributes['password']);

        $user =User::create($attributes);

        auth()->login($user);

        // session()->flash('success','Your account has been created');
        
        return redirect('/')->with('success','Your account has been created');
    }
}
