<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-12
 * Time: 下午6:37
 */
namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'shop_product';

    public function cate_id()
    {
        return $this->hasOne('App\Admin\Models\Category','id','cate_id');
    }

    public function store($data)
    {
        $picsArray = explode(',',$data['img']);
        $product = new $this;
        $product->title      = $data['title'];
        $product->cate_id    = $data['cate_id'];
        $product->descr      = $data['descr'];
        $product->num        = $data['num'];
        $product->price      = $data['price'];
        $product->is_sale    = $data['is_sale'];
        $product->sale_price = $data['sale_price'];
        $product->is_hot     = $data['is_hot'];
        $product->is_on      = $data['is_on'];
        if ($product->save()){
            \DB::table('shop_product_content')->insert([
                'product_id' => $product->id,
                'content'    => $data['content'],
            ]);
            foreach ($picsArray as $img => $v){
                \DB::table('shop_product_pics')->insert([
                    'product_id' => $product->id,
                    'pics' => 'shopImages/'.$v,
                ]);
            }
            $cover = \DB::table('shop_product_pics')->where('product_id','=',$product->id)->get();
            foreach ($cover as $image)
                $this::where('product_id',$product->id)->update([
                    'cover' => '/'.$image->pics,
                ]);
            return true;
        }
        return false;
    }


    public function updateProduct($id,$data)
    {
        $result = $this::where('product_id',$id)->update([
            'title'     => $data['title'],
            'cate_id'   => $data['cate_id'],
            'descr'     => $data['descr'],
            'num'       => $data['num'],
            'price'     => $data['price'],
            //'cover'   => $data['cover'],
            'is_sale'   => $data['is_sale'],
            'is_hot'    => $data['is_hot'],
            'is_on'     => $data['is_on'],
        ]);
        $content = \DB::table('shop_product_content')->where('product_id','=',$id)->update([
            'content' => $data['content']
        ]);
        if ($result && $content){
            return true;
        }
        return false;
    }
}