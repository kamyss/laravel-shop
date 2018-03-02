@extends('layouts.admin')
@section('title','编辑角色')
@section('content')

    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>编辑{{$roles['name']}}</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" action="{{route('role.update',$roles['id'])}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group floating-label">
                        <input value="{{$roles['name']}}" name="name" type="text" class="form-control" id="regular2">
                        <label for="regular2">名称</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$roles['slug']}}" name="slug" type="text" class="form-control" id="regular2">
                        <label for="regular2">角色</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$roles['description']}}" name="description" type="text" class="form-control" id="regular2">
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