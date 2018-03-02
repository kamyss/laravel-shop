@extends('layouts.admin')
@section('title','添加商品')
@section('css')
    <link href="/style/admin/dropzone/dropzone.css" rel="stylesheet">
    <link href="/style/admin/dropzone/basic.css" rel="stylesheet">
@stop
@section('content')

    <div class="section-body contain-lg">
        <div class="card">
            <div class="card-head style-primary">
                <header>添加商品</header>
            </div>
            <div class="card-body">
                {{--图像上传--}}
                <form id="uploader" action="{{route('plug.upload')}}" class="dropzone">
                    {{csrf_field()}}
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                </form>
                <br>
                {{--结束--}}
                <button class="btn btn-raised ink-reaction btn-primary " id="up">上传</button>
                <hr>
                <form class="form" role="form" action="{{route('product.store')}}" method="post">
                    {{csrf_field()}}
                    <input id="img" type="hidden"  name="img" value="">
                    <div class="form-group floating-label">
                        <input name="title" type="text" class="form-control" id="regular2">
                        <label for="regular2">商品名称</label>
                    </div>
                    <div class="form-group floating-label">
                        <select id="select2" name="cate_id" class="form-control">
                            <option value="">&nbsp;</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate['id']}}">{{$cate['title']}}</option>
                            @endforeach
                        </select>
                        <label for="select2">商品分类</label>
                    </div>
                    <div class="form-group floating-label">
                        <textarea name="descr" id="textarea2" class="form-control" rows="3" placeholder=""></textarea>
                        <label for="textarea2">商品描述</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input name="num" type="number" class="form-control" id="regular2">
                                <label for="regular2">库存</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input name="price" type="number" class="form-control" id="regular2">
                                <label for="regular2">价格</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group floating-label">
                                <input value="0.00" name="sale_price" type="number" class="form-control" id="regular2">
                                <label for="regular2">促销价格(不开启不用修改)</label>
                            </div>
                        </div>
                    </div>


                    <div>
                        <label for="regular2">商品详情</label>
                        <textarea name="content" id="ckeditor" class="form-control control-12-rows" placeholder="输入商品详情"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" control-label">是否促销</label>
                                <div class="">
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="is_sale" value="1"><span>是</span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input checked="true" type="radio" name="is_sale" value="0"><span>否</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" ">是否热门</label>
                                <div class="">
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="is_hot" value="1"><span>是</span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input checked="true"  type="radio" name="is_hot" value="0"><span>否</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class=" control-label">是否上架</label>
                                <div class="">
                                    <label class="radio-inline radio-styled">
                                        <input checked="true" type="radio" name="is_on" value="1"><span>是</span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="is_on" value="0"><span>否</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group floating-label">
                        <button class="btn btn-raised ink-reaction btn-primary " onclick="up()" type="submit">保存</button>
                        <a href="{{route('product.index')}}"><button class="btn-raised ink-reaction btn-danger btn" type="button">返回</button></a>
                    </div>
                </form>
            </div>

        </div>
    </div>





@endsection
@section('js')
    <script src="/style/admin/dropzone/dropzone.js"></script>
    <script src="/style/admin/js/libs/ckeditor/ckeditor.js"></script>
    <script src="/style/admin/js/libs/ckeditor/adapters/jquery.js"></script>
    <script src="/style/admin/js/core/demo/DemoFormEditors.js"></script>
    <script>
        $("#uploader").dropzone({

            acceptedFiles: ".gif,.jpg,.png",
            success: function (file, response, e) {
                var res = JSON.parse(response);
                document.getElementById('img').value = res;
            },
             init: function() {
            var submitButton = document.querySelector("#up")
            myDropzone = this;
            submitButton.addEventListener("click", function() {
                myDropzone.processQueue();
                $("#up").hide();
            });
        }
});
    </script>
@stop
