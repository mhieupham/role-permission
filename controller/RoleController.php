<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Premission;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('role.index',compact('roles'));
//        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Premission::all();
        return view('role.add',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            DB::beginTransaction();
            //insert data to role table
            $roleCreate = new Role();
            $roleCreate->name = $request->name;
            $roleCreate->display_name = $request->display_name;
            $roleCreate->save();
            //insert data to role_permission table
            $roleCreate->permission()->attach($request->permission);
            DB::commit();
            return redirect()->route('role.index');
        }catch(Exception $exception){
            DB::rollBack();
            \Log::error($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $role = Role::find($id);
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::findOrFail($id);
//        dd($role);
        $permissions = Premission::all();
        $listPermissionOfRole = DB::table('premission_role')->where('role_id',$id)->pluck('premission_id');
//        $check =  $listPermissionOfRole->contains();
//        dd($check);
        return view('role.edit',compact('role','permissions','listPermissionOfRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            DB::beginTransaction();
            //insert data to role table
            $roles = Role::where('id',$id)->update([
                'name'=>$request->name,
                'display_name'=>$request->display_name
            ]);

            //insert data to role_permission table
            DB::table('premission_role')->where('role_id',$id)->delete();
            $roleCreate = Role::find($id);
            $roleCreate->permission()->attach($request->permission);
            DB::commit();
            return redirect()->route('role.index');
        }catch(Exception $exception){
            DB::rollBack();
            \Log::error($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete role
        $role = Role::find($id);
        $role->delete();
        //delete premission_role
        $role->permission()->detach();
        return redirect()->route('role.index');

    }
}
