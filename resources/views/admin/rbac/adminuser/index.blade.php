@extends('layouts.admin')
@section('title','管理员列表')
@section('content')


    <div class="section-body contain">
        <div class="card">
            <div class="card-body">
                <div id="exampleTableEventsToolbar" class="btn-group hidden-xs">
                    <a href="{{route('adminuser.create')}}"><button class="btn btn-raised ink-reaction btn-primary">添加</button></a>
                </div>
                <table id="exampleTableEvents">
                    <thead>
                    <tr>
                        <th data-width="3%" class="text-center">ID</th>
                        <th class="text-center">用户名</th>
                        <th class="text-center">邮箱</th>
                        <th data-width="10%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td><h5>{{$user->email}}</h5></td>
                            <td class="text-center">
                                <form method="post" action="{{route('adminuser.destroy',$user->id)}}">
                                    <input type="hidden" name="_method" value="delete">
                                    <a href="{{route('adminuser.show',$user->id)}}">
                                        <button type="button" class="btn ink-reaction btn-raised btn-accent"><i class=" fa fa-lock"></i></button>
                                    </a>
                                    <a href="{{route('adminuser.edit',$user->id)}}">
                                    <button type="button" class="btn ink-reaction btn-raised btn-info"><i class=" fa fa-pencil"></i></button>
                                </a>
                                    <button type="submit" class="btn ink-reaction btn-raised btn-danger"><i class=" fa fa-trash"></i></button>
                               {{csrf_field()}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection