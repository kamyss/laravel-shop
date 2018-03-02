<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午6:56
 */
namespace App\Admin\Http\Controllers;

use App\Admin\Models\Menu;
use App\Admin\Repositories\Presenter\MenuPresenter;
use App\Admin\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menu;
    public function __construct(MenuPresenter $menu)
    {
        $this->menu = $menu;
    }


    public function index()
    {
        $menu  = new Menu();
        $menu = $menu->sortMenuSetCache();
        $menuList = $this->menu->getMenuList($menu);
        return view('admin.menu.index',['list'=>$menuList]);
    }



    public function order(Request $request)
    {
        $array = json_decode($request->input('order'),true);
        foreach ($array as $key){
//            Category::where('id',$key['id'])->update([
//                'order' => $key['order'],
//            ]);
            echo $key['order'].'<br>';
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 渲染创建视图
     */
    public function create()
    {
        $menus = new Menu();
        $menus = $menus->setPrefix();
        return view('admin.menu.create',['menus'=>$menus]);
    }


    /**
     * @param MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 保存新建菜单
     */
    public function store(MenuRequest $request)
    {
        $menu = new Menu();
        $result = $menu->store($request->all());
        if ($result){
            return back()->with([
                'alert-type' => 'success',
                'message' => '创建成功',
            ]);
        }
    }


    public function edit($id)
    {
        $menus = new Menu();
        $menus = $menus->setPrefix();
        $menu = Menu::find($id);
        return view('admin.menu.edit',['menu'=>$menu,'menus'=>$menus]);
    }


    public function update($id,Request $request)
    {
        $menu = new Menu();
        $result = $menu->updateMenu($id,$request->all());
        if ($result){
            return back()->with([
                'alert-type' => 'success',
                'message' => '更新成功',
            ]);
        }
    }

    public function delete($id)
    {
        $cate = Menu::where('id',$id)->first();
        $data = Menu::where('parent_id',$cate['id'])->first();
        if ($data){
            return back()->with([
                'alert-type' => 'error',
                'message' => '请先删除该菜单下的所有子菜单'
            ]);
        }
        $result = Menu::find($id)->delete();
        if ($result){
            return back()->with([
                'alert-type' => 'success',
                'message' => '删除成功'
            ]);
        }
    }
}
