<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role,DB;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index()
    {
        //
        $listUser = $this->user->all();
        // return $listUser;
        return view('user.index',compact('listUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = $this->role->all();
        // return $roles;
        return view('user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            //insert data to user table
            $userCreate = $this->user->create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            //insert data to role_user table
            $userCreate->roles()->attach($request->role);
            // $roles = $request->role;
            // foreach($roles as $role){
            //     DB::table('role_user')->insert([
            //         'user_id' => $userCreate->id,
            //         'role_id' => $role
            //     ]);
            // };
            DB::commit();
            return redirect()->route('user.index');
        }catch(Exception $exception){
            DB::rollBack();
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
        $roles = $this->role->all();
        $user = $this->user->findOrFail($id);
        $listRoleOfUser = DB::table('role_user')->where('user_id',$id)->pluck('role_id');

        return view('user.edit',compact('roles','user','listRoleOfUser'));
//        return $user->id;
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
        try{
            DB::beginTransaction();
            //update user table
            $this->user->where('id',$id)->update([
                'name'=>$request->name,
            ]);
            //update to role
            DB::table('role_user')->where('user_id',$id)->delete();
            $userCreate = $this->user->find($id);
            $userCreate->roles()->attach($request->role);
            DB::commit();
            return redirect()->route('user.index');
        }catch (\Dropbox\Exception $exception){
            DB::rollBack();
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
        //delete user
        $user = $this->user->find($id);
        $user->delete();
        //delete role user
        $user->roles()->detach();
//        $this->user->delete($id);
        return redirect()->route('user.index');
    }
}
