@extends('layouts.admin')
@section('title','编辑角色')
@section('content')

    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>编辑{{$user['name']}}</header>
            </div>
            <div class="card-body">
                <form class="form" role="form" action="{{route('adminuser.update',$user['id'])}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group floating-label">
                        <input value="{{$user['name']}}" name="name" type="text" class="form-control" id="regular2">
                        <label for="regular2">用户名</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="" name="password" type="text" class="form-control" id="regular2">
                        <label for="regular2">密码（留空不变）</label>
                    </div>
                    <div class="form-group floating-label">
                        <input value="{{$user['email']}}" name="email" type="text" class="form-control" id="regular2">
                        <label for="regular2">邮箱</label>
                    </div>
                    <div >
                        <label>是否管理员用户</label><br>
                        <label class="radio-inline radio-styled">
                            <input value="1" name="is_admin" checked="" type="radio"><span>是</span>
                        </label>
                        <label class="radio-inline radio-styled">
                            <input value="0" name="is_admin" type="radio"><span>否</span>
                        </label>
                    </div>
                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('adminuser.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>



            </div>
        </div>
    </div>

@endsection