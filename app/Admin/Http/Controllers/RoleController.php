<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-10
 * Time: 下午1:47
 */
namespace App\Admin\Http\Controllers;

use App\Admin\Models\Permission;
use App\Admin\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function index()
    {
        $role = Role::all();
        return view('admin.rbac.role.index',['roles'=>$role]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:roles',
            'slug'=>'required|unique:roles',
        ]);
        $role = new Role();
        $result = $role->createRole($request->input('name'),$request->input('slug'),$request->input('description'));
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'创建成功',
            ]);
        }

    }


    public function create()
    {
        return view('admin.rbac.role.create');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $per = Permission::all();
        return view('admin.rbac.role.show',['per'=>$per,'role'=>$role]);
    }




    public function update($id,Request $request)
    {
        $per = new Role();
        $result = $per->updateRole($id,$request->input('name'),$request->input('slug'),$request->input('description'));
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'更新成功',
            ]);
        }
    }


    public function destroy($id)
    {
        $model = new Role();
        $result = $model->deleteRole($id);
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'删除成功',
            ]);
        }
    }


    public function edit($id)
    {
        $roles = Role::find($id);
        return view('admin.rbac.role.edit',['roles'=>$roles]);
    }


    public function attachPermissions($id,Request $request)
    {
        $model = new Role();
        $add = $model->attachPermissions($id,$request->input('permission'));
        $delete = $model->detachPermissions($id,$request->input('permission'));
        return redirect()->route('role.index')->with([
            'alert-type'=>'success',
            'message'=>'分配成功',
        ]);

    }
}