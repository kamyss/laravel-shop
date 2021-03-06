@extends('layouts.admin')
@section('title','权限列表')
@section('content')
    <div class="section-body contain">
        <div class="card">
            <div class="card-body">
                <div id="exampleTableEventsToolbar" class="btn-group hidden-xs">
                    <a href="{{route('permission.create')}}"><button class="btn btn-raised ink-reaction btn-primary">添加</button></a>
                </div>
                <table id="exampleTableEvents">
                    <thead>
                    <tr>
                        <th data-width="3%" class="text-center">ID</th>
                        <th class="text-center">名称</th>
                        <th class="text-center">权限</th>
                        <th class="text-center">描述</th>
                        <th data-width="10%" class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission as $per)
                        <tr>
                            <td>{{$per->id}}</td>
                            <td>{{$per->name}}</td>
                            <td><h4><span class="label label-primary">{{$per->slug}}</span></h4></td>
                            <td>{{$per->description}}</td>
                            <td class="text-center">
                                <form method="post" action="{{route('permission.destroy',$per->id)}}">
                                    <input type="hidden" name="_method" value="delete">
                                    <a href="{{route('permission.edit',$per->id)}}">
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