<?php

namespace App\Admin\Http\Controllers;

use App\Admin\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    public function index()
    {
        $permission = Permission::all();
        return view('admin.rbac.permission.index',['permission'=>$permission]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions',
            'slug'=>'required|unique:permissions',
        ]);
        $per = new Permission();
        $result = $per->createPermission($request->input('name'),$request->input('slug'),$request->input('description'));
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'创建成功',
            ]);
        }

    }


    public function create()
    {
        return view('admin.rbac.permission.create');
    }

    public function show($id)
    {

    }


    public function update($id,Request $request)
    {
        $per = new Permission();
        $result = $per->updatePermission($id,$request->input('name'),$request->input('slug'),$request->input('description'));
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'更新成功',
            ]);
        }
    }


    public function destroy($id)
    {
        $model = new Permission();
        $result = $model->deletePermission($id);
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'删除成功',
            ]);
        }
    }


    public function edit($id)
    {
        $per = Permission::find($id);
        return view('admin.rbac.permission.edit',['permission'=>$per]);
    }
}
