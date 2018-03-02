<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-10
 * Time: 下午1:18
 */
namespace App\Admin\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use HuangYi\Rbac\Managers\RoleManager;
use HuangYi\Rbac\RbacTrait;

class Role extends Model
{


    /**
     * 创建角色
     * @param $name string
     * @param $slug string
     * @param $description string
     * @return bool
     */
    public function createRole($name,$slug,$description)
    {
        $roleManager = new RoleManager();
        $role = $roleManager->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
        if ($role){
            return true;
        }
    }


    /**
     * 删除角色
     * @param $id int
     * @return bool
     */
    public function deleteRole($id)
    {
        $roleManager = new RoleManager();
        $deleted = $roleManager->delete($id);
        if ($deleted){
            return true;
        }
    }


    /**
     * 更新角色
     * @param $id int
     * @param $name string
     * @param $slug string
     * @param $description string
     * @return bool
     */
    public function updateRole($id,$name,$slug,$description)
    {
        $roleManager = new RoleManager();
        $updated = $roleManager->update($id, [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
        if ($updated){
            return true;
        }
    }

    /**
     * 查询角色
     * @param $id int
     * @return object
     */
    public function selectRole($id)
    {
        $roleManager = new RoleManager();
        $role = $roleManager->find($id);
        if ($role){
            return $role;
        }
    }

    /**
     * 为角色绑定权限
     * @param $data array
     * @param $id int
     * 如果已存在则跳过存在的权限
     */

    public function attachPermissions($id,$data)
    {
        $roleManager = new RoleManager();
        if ($data !=''){
            foreach ($data as $item => $v){
                $result = \DB::table('role_permission')->where([
                    ['role_id','=',$id],
                    ['permission_id','=',$v]
                ])->first();
                if ($result != null){
                    unset($data[$item]);
                }
            }
            $roleManager->attachPermissions($id,$data); //同时添加多个权限
        }
    }

    /**
     * 为角色解绑权限
     * @param $id int
     * @param $data array
     *
     */
    public function detachPermissions($id,$data)
    {
        $roleManager = new RoleManager();
        if ($data ==''){
            \DB::table('role_permission')->delete();

        }else{
            foreach ($data as $item => $v){
                \DB::table('role_permission')->where([
                    ['role_id','=',$id],
                    ['permission_id','!=',$v]
                ])->delete();
            }
            $roleManager->attachPermissions($id,$data); //同时删除多个权限
        }
    }

    /**
     * 为用户分配角色
     * @param $id int
     * @param $data array
     */
    public function attachRoles($id,$data)
    {
        if ($data !=''){
            foreach ($data as $item => $v){
                $result = \DB::table('user_role')->where([
                    ['user_id','=',$id],
                    ['role_id','=',$v]
                ])->first();
                if ($result != null){
                    unset($data[$item]);
                }
            }
            $user = User::find($id);
            $user->attachRoles($data);
        }
    }

    /**
     * 删除角色
     * @param $id
     * @param $data
     * @return bool
     */
    public function detachRoles($id,$data)
    {
        if ($data ==''){
            \DB::table('user_role')->delete();
        }else{
            foreach ($data as $item => $v){
                \DB::table('user_role')->where([
                    ['user_id','=',$id],
                    ['role_id','!=',$v]
                ])->delete();
            }
            return true;
        }
    }
}


/*
 *
 *
 *
 $user = \App\User::find(1);
// 判断一个角色
$user->hasRole('admin');
// 判断多个角色
$user->hasRole('seller|operator');
$user = \App\User::find(1);

// 判断一个权限
$user->hasPermission('product.create');

// 判断多个权限
$user->hasPermission('product.create|product.update');
 */