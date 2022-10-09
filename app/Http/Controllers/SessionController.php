<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('session.create');
    }

    public function store(){
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //attempt authenticate the user
        if(!auth()->attempt($data)){
        
            //auth failed
            throw ValidationException::withMessages([
                'email' => 'provided credentials doesnt match'
            ]);

        }
        session()->regenerate();
        //auth failed
        // return back()
        // ->withInput()
        // ->withErrors(['email' => 'Credentials doesnt match']);

        //session fixation
        return redirect('/')->with('success','Welcome Back');

    }

    public function destroy(){
        // dd('log out');
        auth()->logout();
        return redirect('/')->with('success','Goodbye!');
    }
}
