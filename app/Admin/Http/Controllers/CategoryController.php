<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-11
 * Time: 下午6:56
 */
namespace App\Admin\Http\Controllers;

use App\Admin\Models\Category;
use App\Admin\Repositories\Presenter\CategoryPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Requests\CategoryRequest;

class CategoryController extends Controller
{
    private $cate;
    public function __construct(CategoryPresenter $cate)
    {
        $this->cate = $cate;
    }

    public function index()
    {
        $cate  = new Category();
        $cate = $cate->sortCateSetCache();
        $cateList = $this->cate->getCateList($cate);
        return view('admin.shop.category.index',['list'=>$cateList]);
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 渲染编辑视图
     */
    public function edit($id)
    {
        $cate = Category::find($id);
        $cates = new Category();
        $cates = $cates->setPrefix();
        return view('admin.shop.category.edit',['cate'=>$cate,'cates'=>$cates]);
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 保存更新
     */
    public function update($id,Request $request)
    {
        $cate = new Category();
        $result = $cate->updateCate($id,$request->all());
        if ($result){
            return back()->with([
                'alert-type' => 'success',
                'message' => '更新成功',
            ]);
        }
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 渲染创建视图
     */


    public function create()
    {
        $cates = new Category();
        $cates = $cates->setPrefix();
        return view('admin.shop.category.create',['cates' => $cates]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     * 保存新分类
     */


    public function store(CategoryRequest $request)
    {
        $cate = new Category();
        $result = $cate->store($request->all());
        if ($result){
            return back()->with([
                'alert-type'=>'success',
                'message'=>'创建成功',
            ]);
        }
    }

    public function delete($id)
    {
        $cate = Category::where('id',$id)->first();
        $data = Category::where('parent_id',$cate['id'])->first();
        if ($data){
            return back()->with([
                'alert-type' => 'error',
                'message' => '请先删除该分类下的所有子类'
            ]);
        }
        $result = Category::find($id)->delete();
        if ($result){
            return back()->with([
                'alert-type' => 'success',
                'message' => '删除成功'
            ]);
        }
    }

}
