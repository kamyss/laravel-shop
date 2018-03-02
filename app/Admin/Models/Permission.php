<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-10
 * Time: 下午1:17
 */
namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use HuangYi\Rbac\Managers\PermissionManager;

class Permission extends Model
{

    /**
     * 创建权限
     * @param $name string
     * @param $slug string
     * @param $description string
     * @return bool
     */
    public function createPermission($name,$slug,$description)
    {
        $permissionManager = new PermissionManager();
        $permission = $permissionManager->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
        if ($permission){
            return true;
        }
    }

    /**
     * 删除权限
     * @param $id int
     * @return bool
     */
    public function deletePermission($id)
    {
        $permissionManager = new PermissionManager();
        $deleted = $permissionManager->delete($id);  //删除id为$id的数据
        if ($deleted){
            return true;
        }
    }

    /**
     * 更新权限
     * @param $id int
     * @param $name string
     * @param $slug string
     * @param $description string
     * @return bool
     */
    public function updatePermission($id,$name,$slug,$description)
    {
        $permissionManager = new PermissionManager();
        $update = $permissionManager->update($id, [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
        if ($update){
            return true;
        }
    }

    /**
     * 查找权限
     * @param $id int
     * @return object
     */
    public function selectPermission($id)
    {
        $permissionManager = new PermissionManager();
        $permission = $permissionManager->find($id);
        if ($permission){
            return $permission;
        }
    }
}