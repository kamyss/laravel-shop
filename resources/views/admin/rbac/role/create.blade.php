@extends('layouts.admin')
@section('title','添加角色')
@section('content')

    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>添加角色</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" action="{{route('role.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group floating-label">
                        <input name="name" type="text" class="form-control" id="regular2">
                        <label for="regular2">名称</label>
                    </div>
                    <div class="form-group floating-label">
                        <input name="slug" type="text" class="form-control" id="regular2">
                        <label for="regular2">角色</label>
                    </div>
                    <div class="form-group floating-label">
                        <input name="description" type="text" class="form-control" id="regular2">
                        <label for="regular2">描述</label>
                    </div>
                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('role.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>



            </div>
        </div>
    </div>

@endsection