<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午8:38
 */
namespace App\Admin\Repositories\Presenter;

class MenuPresenter{
    public function getCategory($menu)
    {
        if ($menu){
        }
    }

    public function getMenuList($menu)
    {
        if ($menu){
            $item = '';
            foreach ($menu as $v){
                $item .= $this->getComments($v['id'],$v['title'],$v['child'],$v['order'],$v['url']);
            }
            return $item;
        }
        return '没有菜单';
    }


    public function getComments($id,$title,$child,$order,$url)
    {
        if ($child){
            return $this->getHandleList($id,$title,$child,$order,$url);
        }
        return ' <li data-order="'.$order.'"class="dd-item" data-id="'.$id.'"><div class="dd-handle"><span class="pull-right">
         <a href ="'.route('menu.edit',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
         </a>
         <a href ="'.route('menu.delete',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
         </a>
        </span>'.$title.' ('.$url.')</div></li>';
    }

    public function getHandleList($id,$title,$child,$order,$url)
    {
        $handle = '<li data-order="'.$order.'" class="dd-item" data-id="'.$id.'"><div class="dd-handle"><span class="pull-right">
         <a href ="'.route('menu.edit',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
         </a>
         <a href ="'.route('menu.delete',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
         </a>
        </span>'.$title.' ('.$url.')</div><ol class="dd-list">';
        foreach ($child as $v){
            $handle .= $this->getComments($v['id'],$v['title'],$v['child'],$v['order'],$v['url']);
        }
        $handle .= '</ol></li>';
        return $handle;
    }

}