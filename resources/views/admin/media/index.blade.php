@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="/style/admin/css/media/media.css"/>
    <link rel="stylesheet" type="text/css" href="/style/admin/js/select2/select2.min.css">
    <link rel="stylesheet" href="/style/admin/css/media/dropzone.css"/>
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="section-body contain">
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>媒体文件</header>
                        </div>
                        <div class="clear"></div>

                        <div id="filemanager">

                            <div id="toolbar">
                                <div class="btn-group offset-right">
                                    <button type="button" class="btn btn-primary btn-raised ink-reaction" data-toggle="modal" data-target="#myModal">
                                        上传
                                    </button>
                                </div>
                                <button type="button" class="btn btn-success btn-raised ink-reaction" id="refresh">
                                    刷新
                                </button>
                                <div class="btn-group offset-right">
                                    <button type="button" class="btn btn-danger btn-raised ink-reaction" id="move">
                                        移动
                                    </button>
                                    <button type="button" class="btn btn-danger btn-raised ink-reaction" id="rename">
                                        重命名
                                    </button>
                                    <button type="button" class="btn btn-danger btn-raised ink-reaction" id="delete">
                                        删除
                                    </button>
                                </div>
                            </div>
                            <div id="content">
                                <div class="flex">
                                    <div id="left">
                                        <ul id="files">
                                            <li >
                                                <div class="file_link">
                                                    <div class=""><h4>213</h4>
                                                        <small>
                                                            213
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dropz"></div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('js')
    <script src="/style/admin/js/media/dropzone.js"></script>
@stop
