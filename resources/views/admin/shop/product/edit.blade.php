@extends('layouts.admin')
@section('title','添加商品')
@section('css')
    <link rel="stylesheet" href="/style/admin/css/fileinput.min.css">
@stop
@section('content')

    <div class="section-body contain-lg">
        <div class="card">
            <div class="card-head style-primary">
                <header>编辑{{$product['title']}}</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" action="{{route('product.update',$product['product_id'])}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input value="{{$product['title']}}" name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">商品名称</label>
                    </div>
                    <div class="form-group floating-label">
                        <select id="select2" name="cate_id" class="form-control">
                            <?php $product_cate = DB::table('shop_category')->where('id','=',$product['cate_id'])->first();?>
                            <option value="{{$product_cate->id}}">{{$product_cate->title}}</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate['id']}}">{{$cate['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">商品分类</label>
                    </div>
                    <div class="form-group floating-label">
                        <textarea  name="descr" id="textarea2" class="form-control" rows="3" placeholder="">{{$product['descr']}}</textarea>
                        <label for="textarea2">商品描述</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input value="{{$product['num']}}" name="num" type="number" class="form-control" id="regular2">
                                <label for="regular2">库存</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input value="{{$product['price']}}" name="price" type="number" class="form-control" id="regular2">
                                <label for="regular2">价格</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input value="{{$product['sale_price']}}" name="sale_price" type="number" class="form-control" id="regular2">
                                <label for="regular2">促销价格(不开启不用修改)</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="regular2">商品详情</label>
                        <textarea name="content" id="ckeditor" class="form-control control-12-rows" placeholder="输入商品详情">{{$content->content}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" control-label">是否促销</label>
                                <div class="">
                                    @if($product['is_sale'] == 1)
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_sale" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input type="radio" name="is_sale" value="1"><span>否</span>
                                        </label>
                                    @else
                                        <label class="radio-inline radio-styled">
                                            <input  type="radio" name="is_sale" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_sale" value="0"><span>否</span>
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" ">是否热门</label>
                                <div class="">
                                    @if($product['is_hot'] == 1)
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_hot" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input type="radio" name="is_hot" value="1"><span>否</span>
                                        </label>
                                    @else
                                        <label class="radio-inline radio-styled">
                                            <input  type="radio" name="is_hot" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_hot" value="0"><span>否</span>
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" control-label">是否上架</label>
                                <div class="">
                                    @if($product['is_on'] == 1)
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_on" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input type="radio" name="is_on" value="1"><span>否</span>
                                        </label>
                                    @else
                                        <label class="radio-inline radio-styled">
                                            <input  type="radio" name="is_on" value="1"><span>是</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input checked="true" type="radio" name="is_on" value="0"><span>否</span>
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('product.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>



            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="/style/admin/js/libs/ckeditor/ckeditor.js"></script>
    <script src="/style/admin/js/libs/ckeditor/adapters/jquery.js"></script>
    <script src="/style/admin/js/core/demo/DemoFormEditors.js"></script>

@stop