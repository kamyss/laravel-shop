@extends('layouts.admin')
@section('title','菜单列表')
@section('css')
    <link type="text/css" rel="stylesheet" href="/style/admin/css/nestable.css" />

@endsection
@section('content')

    <h1>菜单列表</h1>
    <menu id="nestable-menu">
        <a href="{{route('menu.create')}}">
            <button type="button" class="btn btn-primary btn-raised ink-reaction">添加菜单</button>
        </a>
        <button type="button" class="btn btn-accent btn-raised ink-reaction" data-action="expand-all">全部展开</button>
        <button type="button" class="btn btn-info btn-raised ink-reaction" data-action="collapse-all">全部关闭</button>
    </menu>

    <div class="cf nestable-lists">
        <div class="dd" id="nestable">
            <ol class="dd-list">
         {!! $list !!}
            </ol>
        </div>

    </div>

    <p><strong>Serialised Output (per list)</strong></p>

    <textarea id="nestable-output"></textarea>

    <p>&nbsp;</p>

@endsection

@section('js')
    <script src="/style/admin/js/jquery.nestable.js"></script>
    <script>
        $(document).ready(function()
        {
            var updateOutput = function(e)
            {
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            })
                .on('change', updateOutput);
            // activate Nestable for list 2

            // output initial serialised data
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
            });

        });
    </script>
@endsection