<?php

namespace App;

use HuangYi\Rbac\RbacTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use RbacTrait;

    public function check($id,$route)
    {
        $user = User::find($id);
        $result = $user->hasPermission($route);
        if ($result == false){
            //return abort('403','你没有权限进行此操作');
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createUser($data)
    {
        $user = new $this();
        $user->name = $data['name'];
        $user->password = bcrypt($data['password']);
        $user->email = $data['email'];
        $user->is_admin = $data['is_admin'];
        $result = $user->save();
        if ($result){
            return true;
        }
    }

    public function updateUser($id,$data)
    {
        $result = $this::where('id',$id)->update([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
            'is_admin' => $data['is_admin'],
        ]);
        if ($result){
            return true;
        }
    }
}
