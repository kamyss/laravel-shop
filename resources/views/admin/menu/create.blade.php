@extends('layouts.admin')
@section('title','创建新菜单')
@section('css')
@stop
@section('content')
    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>添加新菜单</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" method="post" action="{{route('menu.store')}}">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">菜单名</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="#" name="url" type="text" class="form-control" id="regular2">
                        <label for="regular2">url地址(例:/admin/index/)</label>
                    </div>
                    <div class="form-group floating-label">
                        <input name="icon" type="text" class="form-control" id="regular2">
                        <label for="regular2">图标(例：md md-home)</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="1" name="order" type="text" class="form-control" id="regular2">
                        <label for="regular2">排序</label>
                    </div>
                    <div class="form-group floating-label">
                        <select id="select2" name="parent_id" class="form-control">
                            <option value="0">顶级菜单</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu['id']}}">{{$menu['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">上级菜单</label>
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
@section('js')
@stop