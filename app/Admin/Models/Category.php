<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午10:41
 */
namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'shop_category';

    public function sortCate($cate,$pid =0)
    {
        $array = [];
        if (!empty($cate)){
            foreach ($cate as $key => $v){
                if ($v['parent_id']==$pid){
                    $array[$key] = $v;
                    $array[$key]['child'] = self::sortCate($cate,$v['id']);
                }
            }
        }
        return $array;
    }

    public function sortCateSetCache()
    {
        $cate = $this::where([])->orderBy('order','asc')->get()->toArray();
        if ($cate){
            $cateList = $this->sortCate($cate);

        foreach ($cateList as $key => $v){
            if ($v['child']){
                $sort = array_column($v['child'],'order');
                array_multisort($sort,SORT_ASC,$v['child']);
            }
        }
        return $cateList;
        }
        return '';
    }


    public function getList()
    {
        return $this->sortCateSetCache();
    }


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
     * 分类前缀
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



    public function store($data)
    {
        $cate = new $this;
        $cate->title = $data['title'];
        $cate->parent_id = $data['parent_id'];
        $cate->order = $data['order'];
        if ($cate->save()){
            return true;
        }
    }

    public function updateCate($id,$data)
    {
        $result = $this::where('id',$id)->update([
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'order' => $data['order'],
        ]);
        if ($result){
            return true;
        }
    }

}