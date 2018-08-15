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
            <li><a href="{{ url('admin/comment') }}">评论列表</a></li>
            <li class="active">添加评论</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">新增评论 <small>添加评论信息</small></h1>
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
                        <h4 class="panel-title">添加评论</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/comment') }}" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" name="tag" id="tag"  />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="user1_id">评论者 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="user1_id"
                                           placeholder="评论者"
                                           data-parsley-required="true"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="评论者长度1~20字符"
                                           data-parsley-required-message="请输入评论者"
                                           value="{{ old('user1_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="user2_id">@的人 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="user2_id"
                                           placeholder="@的人"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="@的人长度1~20字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入@的人"
                                           value="{{ old('user2_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="pid">父级id * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="pid" placeholder="父级id "
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入父级id"
                                           value="{{ old('pid') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="content">评论内容 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="content"
                                              placeholder="评论内容"
                                              data-parsley-length="[6,500]"
                                              data-parsley-length-message="评论内容"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入评论内容">{{ old('content') }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="module_id">评论信息id * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="module_id"
                                              placeholder="评论信息id"
                                              data-parsley-length-message="评论内容"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入评论信息id">{{ old('module_id') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="type">评论类别 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#type_error"
                                            data-parsley-required-message="请选择评论类别"
                                            name="type">
                                        <option value="">-- 请选择 --</option>
                                        <option value="0">产品评论</option>
                                        <option value="1">订单评论</option>

                                    </select>
                                    <p id="type_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="index">索引 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="index"
                                           placeholder="索引"
                                           data-parsley-length-message="索引"
                                           data-parsley-required="true"
                                           data-parsley-required-message="索引"
                                           value="{{ old('index') }}" />
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
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('render');
        $('.select-three').selectpicker('render');

        function checkform(){
            tag_arr = $('.select-three').val();
            if(tag_arr && tag_arr.length > 0){
                $("#tag").val(tag_arr.join(','));
                return true;
            }else{
                return false;
            }
        }

        var dropzone = new Dropzone('#mydropzone', {
            url: '/base/upload_file',
            previewTemplate: $('#preview-template').html(),
            parallelUploads: 2,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            init:function(){
                this.on("addedfile", function(file) {
                //上传文件时触发的事件
                });
                this.on("queuecomplete",function(file) {
                    //上传完成后触发的方法
                });
                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });
    </script>
@endsection