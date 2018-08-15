@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="javascript:;">商品列表</a></li>
            <li class="active">商品信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改商品信息 <small>商品详情信息</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                        </div>
                        <h4 class="panel-title">{{ $goods['goods_name'] }}</h4>
                    </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/goods/'.$goods['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="businesses_id" value="{{ $goods['merchant_id'] }}" />
                            <input type="hidden" id="pic-ids-gallery" name="goods_pictures" value="{{ $pic_ids }}" />
                            <input type="hidden" id="pic-ids" name="goods_img" value="{{ $goods_img  }}" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_name">商品名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_name"
                                           placeholder="商品名称"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="商品名称长度1~20字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商品名称"
                                           value="{{ $goods['goods_name'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="keyword">关键字 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="keyword" type="text" name="keyword"
                                           placeholder="关键字"
                                           data-parsley-length="[4,50]"
                                           data-parsley-length-message="关键字长度4-50字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入关键字"
                                           value="{{ $goods['keyword'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_brief">商品简介 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="goods_brief"
                                              placeholder="商品简介"
                                              data-parsley-length="[1,255]"
                                              data-parsley-length-message="商品简介长度1~255字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入商品简介" >{{ $goods['goods_brief'] }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_desc">商品详细说明 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="goods_desc"
                                              placeholder="商品详细说明"
                                              data-parsley-length="[1,1000]"
                                              data-parsley-length-message="商品详细说明长度1~1000字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入商品详细说明">{{ $goods['goods_desc'] }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">商品类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#goods_typeid"
                                            data-parsley-required-message="请选择商品类型"
                                            name="goods_typeid">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($classes as $k => $v)
                                            <option value="{{ $v['id'] }}"  @if($v['id'] == $goods['goods_typeid']) selected="selected"@endif>{{ $v['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="goods_typeid"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">是否推荐到封面 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#is_refer_typeid"
                                            data-parsley-required-message="请选择商品类型"
                                            name="is_refer">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_refer as $k=> $v)
                                            <option value="{{$k}}" @if($k == $goods['is_refer']) selected="selected"@endif>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <p id="is_refer_typeid"></p>
                                </div>
                            </div>

                            {{--图片上传--}}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">商品图片集 * :</label>
                                <div class="col-md-6 col-sm-6 wt-dropzone"   id="mydropzone">

                                </div>
                            </div>
                            {{--图片上传--}}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">商品缩略图 * :</label>
                                <div class="col-md-6 col-sm-6 wt-dropzone"   id="picdropzone">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>

    <!--这里是上传图片过程样式可以自定义修改-->
    <div id="preview-template" style="display: none;">
        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail=""></div>
            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            <div class="dz-success-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
            </div>
            <div class="dz-error-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>error</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
    </div>

    <!--这里是上传图片过程样式可以自定义修改-->
    <div id="pic-preview-template" style="display: none;">
        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail=""></div>
            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            <div class="dz-success-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
            </div>
            <div class="dz-error-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>error</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    {{--商品图片集--}}
    <script>
        $('.selectpicker').selectpicker('render');
        /*如果这里需要一些其他的方法和属性  请自行查看文档*/
        var mydropzone = new Dropzone('#mydropzone', {
            url: '/base/upload_file',
            previewTemplate: $('#preview-template').html(),
            parallelUploads: 2,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            init:function(){
                this.on("success", function(file, data) {
                    //这里data的返回值就是  上传图片的返回值{status,data}
                    renew_string_gallery('#pic-ids-gallery', data.data);
                });
                this.on("queuecomplete",function(file) {

                });
                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });

        function renew_string_gallery(id, pid){
            var pid         = pid;
            var oldstring   = $(id).val();
            var pic_arr     = [];
            if(oldstring){
                pic_arr = oldstring.split(',');
            }
            if($.inArray(pid) < 0){
                pic_arr.push(pid);
            }
            var newstring = pic_arr.join(',');
            $(id).val(newstring);
        }

        /*如果这里需要一些其他的方法和属性 请自行查看文档*/

        {{--商品缩略图--}}
        /*如果这里需要一些其他的方法和属性  请自行查看文档*/
        var picdropzone = new Dropzone('#picdropzone', {
            url: '/base/upload_file',
            previewTemplate: $('#pic-preview-template').html(),
            parallelUploads: 2,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            init:function(){
                this.on('addedfile', function(file){
                    if(this.files && this.files.length >0){
                        if($("#picdropzone").children().length>1){
                            $("#picdropzone").children().eq(0).remove();
                        }
                    }
                });
                this.on("success", function(file, data) {
                    //这里data的返回值就是  上传图片的返回值{status,data}
                    if(data.status == 200) {

                        renew_string('#pic-ids', data.data);
                    }
                });
                this.on("queuecomplete",function(file) {
//                    $("#picdropzone").html('');
                });
                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });

        var path_img = '<?php echo $path_img; ?>';
        var path_pic = '<?php echo $path_pic; ?>';
        var host = '<?php echo $host; ?>';//域名
        function emitPic($obj, $file_arr){
            var mockFiles = JSON.parse($file_arr);
            if(mockFiles && mockFiles.length >0){
                for(var j in mockFiles){
                    var mockFile = { name: mockFiles[j].savename, size: mockFiles[j].size, accepted:true };
                    $obj.emit("addedfile", mockFile);
                    $obj.emit("thumbnail", mockFile, host +mockFiles[j].path);
                    $obj.emit("complete", mockFile);
                }
            }
        }
        //渲染缩略图
        emitPic(picdropzone, path_img);
        //渲染多张图
        emitPic(mydropzone, path_pic);

        function renew_string(id, pid){
            var pid         = pid;
            var oldstring   = $(id).val();
            var pic_arr     = [];
            pic_arr         = pid;
            $(id).val(pic_arr);
        }

        /*如果这里需要一些其他的方法和属性 请自行查看文档*/
    </script>
@endsection