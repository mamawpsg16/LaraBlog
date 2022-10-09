<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {   
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);
        if(isset($data['roles'])){
            // foreach ($data['roles'] as $role) {
                    $user->roles()->attach($data['roles']);
                    $user->save();
            // }
        }
        
        return back()->with('success','User successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.user.show',compact('user','permissions','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.user.edit',compact('user','permissions','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->roles()->detach();
        $user->update($request->validated());
        if(isset($request->validated()['roles'])){
            foreach ($request->validated()['roles'] as $value) {
                $user->roles()->attach($value);
                $user->save();
            }
        }

        return back()->with('success','User successfully updated');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->profile()->delete();
        $user->following()->detach();
        
        $user->delete();

        return back()->with('success','User successfully deleted');
    }
}
