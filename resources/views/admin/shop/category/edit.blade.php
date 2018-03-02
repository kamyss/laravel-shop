@extends('layouts.admin')
@section('title','编辑分类')
@section('content')
    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>编辑{{$cate['title']}}</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" method="post" action="{{route('category.update',$cate['id'])}}">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input value="{{$cate['title']}}" name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">分类名</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$cate['order']}}" name="order" type="text" class="form-control" id="regular2">
                        <label for="regular2">排序</label>
                    </div>

                    <div class="form-group floating-label">
                        <select id="select2" name="parent_id" class="form-control">
                            <?php $p = DB::table('shop_category')->where('id','=',$cate['parent_id'])->first();?>
                            @if($cate['parent_id']!=0)
                                <option value="{{$p->id}}">{{$p->title}}</option>
                            @else
                            @endif
                            <option value="0">顶级分类</option>
                            @foreach($cates as $list)
                                <option value="{{$list['id']}}">{{$list['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">更改分级</label>
                    </div>
                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('category.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection