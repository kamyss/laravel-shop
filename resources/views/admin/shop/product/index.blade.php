@extends('layouts.admin')
@section('title','商品列表')
@section('content')
    <div class="section-body contain">
        <div class="card">
            <div class="card-body">
                <div id="exampleTableEventsToolbar" class="btn-group hidden-xs">
                    <a href="{{route('product.create')}}"><button class="btn btn-raised ink-reaction btn-primary">添加商品</button></a>
                </div>
                <table id="exampleTableEvents">
                    <thead>
                    <tr>
                        <th data-width="3%" class="text-center">ID</th>
                        <th class="text-center">封面图</th>
                        <th class="text-center">商品名</th>
                        <th class="text-center">分类</th>
                        <th class="text-center">商品简介</th>
                        <th class="text-center">库存</th>
                        <th class="text-center">价格</th>
                        <th class="text-center">是否促销</th>
                        <th class="text-center">促销价格</th>
                        <th class="text-center">是否热门</th>
                        <th class="text-center">是否上架</th>
                        <th data-width="10%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <?php $cate = DB::table('shop_category')->where('id','=',$product->cate_id)->first();?>
                        <tr>
                            <td>{{$product->product_id}}</td>
                            <td><img style="height: 50px;width: 200px" src="{{$product->cover}}"></td>
                            <td>{{$product->title}}</td>
                            <td>{{$cate->title}}</td>
                            <td>{{$product->descr}}</td>
                            <td>{{$product->num}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                @if($product->is_sale == 0)
                                    <span class="label label-danger">否</span>
                                @else
                                    <span class="label label-info">是</span>
                                @endif
                            </td>
                                <td>{{$product->sale_price}}</td>
                            <td>
                                @if($product->is_hot == 0)
                                    <span class="label label-danger">否</span>
                                @else
                                    <span class="label label-info">是</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_on == 0)
                                    <span class="label label-danger">否</span>
                                @else
                                    <span class="label label-info">是</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn ink-reaction btn-raised btn-accent"><i class="fa fa-eye"></i></button>
                                <a href="{{route('product.edit',$product->product_id)}}">
                                <button type="button" class="btn ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
                                    <a href="{{route('product.delete',$product->product_id)}}">
                                <a href="{{route('product.delete',$product->product_id)}}">
                                <button type="button" class="btn ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection