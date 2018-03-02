<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午2:08
 */
namespace App\Admin\Http\Controllers;

use App\Admin\Models\Role;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = User::where('is_admin',1)->get();
        return view('admin.rbac.adminuser.index',['users'=>$user]);
    }

    public function create()
    {
        return view('admin.rbac.adminuser.create');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.rbac.adminuser.show',['user'=>$user,'roles'=>$roles]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.rbac.adminuser.edit',['user'=>$user]);
    }

    public function update($id, Request $request)
    {
        $user = new User();
        $result = $user->updateUser($id,$request->all());
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'更新成功',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|unique:users',
            'email'=>'required|unique:users|email',
        ]);
        $model = new User();
        $result = $model->createUser($request->all());
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'创建成功',
            ]);
        }
    }

    public function destroy($id)
    {
        $result = User::find($id)->delete();
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'删除成功',
            ]);
        }
    }


    public function attachRoles($id,Request $request)
    {
        $model = new Role();
        $model->attachRoles($id,$request->input('role'));
        $model->detachRoles($id,$request->input('role'));
        return redirect()->route('adminuser.index')->with([
            'alert-type'=>'success',
            'message'=>'分配成功',
        ]);
    }

}