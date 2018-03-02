<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-12
 * Time: 下午6:33
 */
namespace App\Admin\Http\Controllers;

use App\Admin\Models\Category;
use App\Admin\Models\Product;
use App\Admin\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.shop.product.index',['products'=>$products]);
    }


    public function create()
    {
        $cate = new Category();
        $cate = $cate->setPrefix();
        return view('admin.shop.product.create',['cates'=>$cate]);
    }



    public function store(ProductRequest $request)
    {
        $product = new Product();
        $result = $product->store($request->all());
        if ($result){
            return redirect()->route('product.index')->with([
                'alert-type'=>'success',
                'message'=>'创建成功',
            ]);
        }
    }

    public function delete($product_id)
    {
        $result = Product::where('product_id',$product_id)->delete();
        $content = \DB::table('shop_product_content')->where('product_id','=',$product_id)->delete();
        $pics = \DB::table('shop_product_pics')->where('product_id','=',$product_id)->delete();
        if ($result && $content && $pics){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'删除成功',
            ]);
        }
    }


    public function edit($id)
    {
        $cate = new Category();
        $cates = $cate->setPrefix();
        $content = \DB::table('shop_product_content')->where('product_id','=',$id)->first();
        $product = Product::where('product_id',$id)->first();
        return view('admin.shop.product.edit',['product'=>$product,'content'=>$content,'cates'=>$cates]);
    }



    public function update($id,Request $request)
    {
        $product = new Product();
        $result = $product->updateProduct($id,$request->all());
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'更新成功',
            ]);
        }

    }
}