<?php

namespace App\Http\Middleware;

use App\Premission;
use App\User;
use Closure,DB;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission = null)
    {
        // lay tat ca cac quyen khi user dang nhap vao
        //1.lay tat ca cac role cua user login vao he thong
//        $listRoleUser = DB::table('users')
//            ->join('role_user', 'users.id', '=', 'role_user.user_id')
//            ->join('roles', 'roles.id', '=', 'role_user.role_id')
//            ->where('users.id',auth()->id())
//            ->select('roles.*')
//            ->get()->pluck('id')->toArray();// pluck lấy trong roles trường  id
        $listRoleUser = User::find(auth()->id())->roles()->select('roles.id')->pluck('id')->toArray();
        //2.lay tat ca cac permission khi user login vao he thong
        $listPermissionRole = DB::table('roles')
            ->join('premission_role', 'premission_role.role_id', '=', 'roles.id')
            ->join('premissions', 'premission_role.premission_id', '=', 'premissions.id')
            ->whereIn('roles.id',$listRoleUser)
            ->select('premissions.*')
            ->get()->pluck('id')->unique();
        //lay ra mã màn hình tương ứng
        $checkPermission = Premission::where('name',$permission)->value('id');
        //kiem tra xem user co được phép vào màn hình hay không

        if($listPermissionRole->contains($checkPermission)){
            return $next($request);
        }else{
            return abort(401);
        }

    }
}
