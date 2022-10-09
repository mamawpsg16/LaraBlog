<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
    
        $role = Role::create($data);
        
        foreach ($data['permissions'] as $permission) {
                $role->permissions()->attach($permission);
                $role->save();
        }

        return back()->with('success','Role successfully updated!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.role.show',compact('role'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {   
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $role->permissions()->detach();
        $role->update($data);
        

        foreach ($data['permissions'] as $permission) {
                $role->permissions()->attach($permission);
                $role->save();
        }
        
        return back()->with('success','Role successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {   
        // $role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();
        return back()->with('success','Role successfully deleted!');
    }
}
