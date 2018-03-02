@extends('layouts.admin')
@section('title','编辑菜单')
@section('content')
    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>编辑{{$menu['title']}}</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" method="post" action="{{route('menu.update',$menu['id'])}}">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input value="{{$menu['title']}}" name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">分类名</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$menu['url']}}" name="url" type="text" class="form-control" id="regular2">
                        <label for="regular2">url地址</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$menu['icon']}}" name="icon" type="text" class="form-control" id="regular2">
                        <label for="regular2">图标</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$menu['order']}}" name="order" type="text" class="form-control" id="regular2">
                        <label for="regular2">排序</label>
                    </div>
                    <div class="form-group floating-label">
                        <select id="select2" name="parent_id" class="form-control">
                            <?php $p = DB::table('menus')->where('id','=',$menu['parent_id'])->first();?>
                            @if($menu['parent_id']!=0)
                                <option value="{{$p->id}}">{{$p->title}}</option>
                            @else
                            @endif
                            <option value="0">顶级分类</option>
                            @foreach($menus as $list)
                                <option value="{{$list['id']}}">{{$list['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">更改分级</label>
                    </div>
                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('menu.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection