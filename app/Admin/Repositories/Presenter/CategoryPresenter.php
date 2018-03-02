<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午8:38
 */
namespace App\Admin\Repositories\Presenter;

class CategoryPresenter{
    public function getCategory($cate)
    {
        if ($cate){

        }
    }

    public function getCateList($cate)
    {
        if ($cate){
            $item = '';
            foreach ($cate as $v){
                $item .= $this->getComments($v['id'],$v['title'],$v['child'],$v['order']);
            }
            return $item;
        }
        return '没有分类';
    }


    public function getComments($id,$title,$child,$order)
    {
        if ($child){
            return $this->getHandleList($id,$title,$child,$order);
        }
        return ' <li data-order="'.$order.'"class="dd-item " data-id="'.$id.'"><div class="dd-handle"><span class="pull-right">
         <a href ="'.route('category.edit',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
         </a>
         <a href ="'.route('category.delete',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
         </a>
        </span>'.$title.'</div></li>';
    }

    public function getHandleList($id,$title,$child,$order)
    {
        $handle = '<li data-order="'.$order.'" class="dd-item " data-id="'.$id.'"><div class="dd-handle"><span class="pull-right">
         <a href ="'.route('category.edit',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
         </a>
         <a href ="'.route('category.delete',$id).'">
         <button type="button" class="btn btn-xs ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
         </a>
        </span>'.$title.'</div><ol class="dd-list">';
        foreach ($child as $v){
            $handle .= $this->getComments($v['id'],$v['title'],$v['child'],$v['order']);
        }
        $handle .= '</ol></li>';
        return $handle;
    }

}