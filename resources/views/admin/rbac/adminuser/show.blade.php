@extends('layouts.admin')
@section('title','分配权限')
@section('content')

    <div class="section-body contain-sm">
        <div class="card">
            <div class="card-head style-primary">
                <header>为{{$user['name']}}分配权限</header>
            </div>
            <form method="POST" action="{{route('adminuser.attachRoles',$user['id'])}}">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="checkbox checkbox-inline checkbox-styled ">
                        <label >
                            <input type="checkbox" id="SelectAll"  value="全选" onclick="selectAll();"/><text class="text-accent">全选</text>
                        </label>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($roles as $role)
                        <div class="col-sm-4 ">
                            <div  class="checkbox checkbox-inline checkbox-styled ">
                                <label >
                                    <?php $a = DB::table('user_role')->where([
                                        ['user_id','=',$user['id']],
                                        ['role_id','=',$role->id]
                                    ])->first();?>
                                    <input  onclick="setSelectAll();" id="subcheck" name="role[]" value="{{$role->id}}" type="checkbox" @if($a)checked="checked"@endif >{{$role->name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary" type="submit">保存</button>
                        <a href="{{route('adminuser.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function selectAll(){
            if ($("#SelectAll").attr("checked")) {
                $(":checkbox").attr("checked", true);
            } else {
                $(":checkbox").attr("checked", false);
            }
        }

        function setSelectAll(){

            if (!$("#subcheck").checked) {
                $("#SelectAll").attr("checked", false);
            }
            var chsub = $("input[type='checkbox'][id='subcheck']").length;
            var checkedsub = $("input[type='checkbox'][id='subcheck']:checked").length;
            if (checkedsub == chsub) {
                $("#SelectAll").attr("checked", true);
            }
        }
    </script>
@endsection