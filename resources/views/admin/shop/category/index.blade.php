@extends('layouts.admin')
@section('title','分类列表')
@section('css')
    <link type="text/css" rel="stylesheet" href="/style/admin/css/nestable.css" />

@endsection
@section('content')
    <h1>分类列表</h1>
    <menu id="nestable-menu">
        <a href="{{route('category.create')}}">
            <button type="button" class="btn btn-primary btn-raised ink-reaction">添加分类</button>
        </a>
        <button type="button" class="btn btn-accent btn-raised ink-reaction" data-action="expand-all">全部展开</button>
        <button type="button" class="btn btn-info btn-raised ink-reaction" data-action="collapse-all">全部关闭</button>
    </menu>

    <div class="cf nestable-lists">
        <div class="dd" id="nestable">
            <ol class="dd-list">
                {!!$list!!}
            </ol>
        </div>
    </div>


    <input id="nestable-output">
@endsection

@section('js')
    <script src="/style/admin/js/jquery.nestable.js"></script>
    <script>

        $(document).ready(function()
        {
            $('.dd').nestable({/* config options */});
            var updateOutput = function(e)
            {

                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify($('.dd').nestable('serialize')));//, null, 2));
                    {{--$.post('{{route('category.order')}}',{--}}
                        {{--order:JSON.stringify($('.dd').nestable('serialize')),--}}
                        {{--_token: '{{csrf_token()}}',--}}
                    {{--},function (data) {--}}
                        {{--toastr.success("成功排序");--}}
                    {{--});--}}
                } else {
                    toastr.error("获取数据失败");
                }
            };
            $('#nestable').nestable({
                group: 1
            })
                .on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('#nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
                $('.dd').on('change', function (e) {
                    toastr.success("成功排序");
                });

                $('.dd').on('change', function() {

                });


            });

        });
    </script>
@endsection