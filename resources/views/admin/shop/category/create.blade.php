@extends('layouts.admin')
@section('title','创建新分类')
@section('content')
    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>添加新分类</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" method="post" action="{{route('category.store')}}">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">分类名</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="0" name="order" type="text" class="form-control" id="regular2">
                        <label for="regular2">排序</label>
                    </div>
                    <div class="form-group floating-label">
                        <select id="select2" name="parent_id" class="form-control">
                            <option value="0">顶级分类</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate['id']}}">{{$cate['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">上级分类</label>
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