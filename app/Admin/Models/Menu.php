<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-12
 * Time: 上午12:25
 */
namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    /**
     *前台调用输出
     */
    public function leftMenu()
    {
        $menu = $this->sortMenuSetCache();
        $menuList = $this->getMenuList($menu);
        echo $menuList;
    }


    /**
     * @param $menu
     * @return string
     * 拼接菜单
     */
    public function getMenuList($menu)
    {
        if ($menu){
            $item = '';
            foreach ($menu as $v){
                $item .= $this->getComments($v['parent_id'],$v['title'],$v['child'],$v['url'],$v['icon']);
            }
            return $item;
        }
        return '没有菜单';
    }


    /**
     * @param $parent_id int
     * @param $title string
     * @param $child array
     * @param $url string
     * @param $icon string
     * @return string
     * 遍历顶级如果有子级调用getHandleList遍历
     */
    public function getComments($parent_id,$title,$child,$url,$icon)
    {
        if ($child){
            return $this->getHandleList($parent_id,$title,$child,$url,$icon);
        }
        if ($parent_id == '0'){
            $active = trim($url,'/');
            return '  <li><a class="'.active_class(if_uri_pattern(["$active"])).'" href="'.$url.'" ><div class="gui-icon"><i class="'.$icon.'"></i></div><span class="title">'.$title.'</span></a></li>';
        }else{
            $active = trim($url,'/');
            return '  <li><a class="'.active_class(if_uri_pattern(["$active"])).'" href="'.$url.'" ><span class="title">'.$title.'</span></a></li>';
        }
    }


    /**
     * @param $parent_id int
     * @param $title string
     * @param $child array
     * @param $url string
     * @param $icon string
     * @return string
     * 遍历子级
     */

    public function getHandleList($parent_id,$title,$child,$url,$icon)
    {
        if ($parent_id == 0){
            $active = trim($url,'/');
            $handle = '<li class="gui-folder "><a  class="'.active_class(if_uri_pattern(["$active"])).'" href="'.$url.'"><div class="gui-icon"><i class="'.$icon.'"></i></div><span class="title">'.$title.'</span></a><ul>';
        }else{
            $active = trim($url,'/');
            $handle = '<li class="gui-folder"><a class="'.active_class(if_uri_pattern(["$active"])).'" href="'.$url.'"><span class="title">'.$title.'</span></a><ul>';
        }
        foreach ($child as $v){
            $handle .= $this->getComments($v['parent_id'],$v['title'],$v['child'],$v['url'],$v['icon']);
        }
        $handle .= '</ul></li>';
        return $handle;
    }

    /**
     * @param $menu array
     * @param int $pid
     * @return array
     * 递归生成树型数组返回
     */
    public function sortMenu($menu,$pid = 0)
    {
        $array = [];
        if (!empty($menu)){
            foreach ($menu as $key => $v){
                if ($v['parent_id'] == $pid){
                    $array[$key] = $v;
                    $array[$key]['child'] = self::sortMenu($menu,$v['id']);
                }
            }
        }
        return $array;
    }

    /**
     * @return array|string
     * 顺序查找所有数据并转换数组
     * 交到sortMenu递归 返回数据循环并排序
     */
    public function sortMenuSetCache()
    {
        $menu = $this::where([])->orderBy('order','asc')->get()->toArray();
        if ($menu){
            $menuList = $this->sortMenu($menu);
            foreach ($menuList as $key => $v){
                if ($v['child']){
                    $sort = array_column($v['child'],'order');
                    array_multisort($sort,SORT_ASC,$v['child']);
                }
            }
            return $menuList;
        }
        return '';
    }


    public function getList()
    {
        return $this->sortMenuSetCache();
    }




    ////////////////////////////////////////////管理///////////////////////////////////////////////////
    /**
     * @return array
     * 获取数据并转换数组
     */
    public function getData()
    {
        $list = $this::all()->toArray();
        return $list;
    }


    /**
     * @param $data
     * @param int $pid
     * @return array
     * 排序树
     */
    public function getTree($data,$pid=0)
    {
        $tree = [];
        foreach ($data as $item){
            if ($item['parent_id'] == $pid){
                $tree[] = $item;
                $tree = array_merge($tree,$this->getTree($data,$item['id']));
            }
        }
        return $tree;
    }

    /**
     * @param string $pre
     * @return array
     * 菜单前缀
     */
    public function setPrefix($pre = "|——")
    {
        $getData = $this->getData();
        $data = $this->getTree($getData);
        $tree = [];
        $num = 1;
        $prefix = [0 => 0];
        while ($value = current($data)){
            $key = key($data);
            if ($key > 0){
                if ($data[$key - 1]['parent_id'] != $value['parent_id']){
                    $num++;
                }
            }
            if (array_key_exists($value['parent_id'],$prefix)){
                $num = $prefix[$value['parent_id']];
            }
            $value['title'] = str_repeat($pre,$num).$value['title'];
            $prefix[$value['parent_id']] = $num;
            $tree[] = $value;
            next($data);
        }
        return $tree;
    }


    /**
     * @param $data array
     * @return bool
     */
    public function store($data)
    {
        $menu = new $this;
        $menu->title = $data['title'];
        $menu->parent_id = $data['parent_id'];
        $menu->order = $data['order'];
        $menu->url = $data['url'];
        $menu->icon = $data['icon'];
        if ($menu->save()){
            return true;
        }
    }

    /**
     * @param $id int
     * @param $data array
     * @return bool
     */
    public function updateMenu($id,$data)
    {
        $result = Menu::where('id',$id)->update([
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'order' => $data['order'],
            'url' => $data['url'],
            'icon' => $data['icon'],
        ]);
        if ($result){
            return true;
        }
    }

}