@extends('test.layouts.css')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <!--
    需要引入
        <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
        <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    -->
    <div id="content">
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">上传文件用法讲解 <small>上传文件用法讲解</small></h1>
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
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">上传文件用法讲解</h4>
                    </div>
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/businesses') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">上传图片 * :</label>
                                <div class="col-md-6 col-sm-6 wt-dropzone" id="mydropzone">
                                </div>
                            </div>
                        </form>
                        <pre>
                                                                                /**
                                                                                 *　　┏┓　　　┏┓+ +
                                                                                 *　┏┛┻━━━┛┻┓ + +
                                                                                 *　┃　　　　　　　┃ 　
                                                                                 *　┃　　　━　　　┃ ++ + + +
                                                                                 * ████━████ ┃+
                                                                                 *　┃　　　　　　　┃ +
                                                                                 *　┃　　　┻　　　┃
                                                                                 *　┃　　　　　　　┃ + +
                                                                                 *　┗━┓　　　┏━┛
                                                                                 *　　　┃　　　┃　　　　　　　　　　　
                                                                                 *　　　┃　　　┃ + + + +
                                                                                 *　　　┃　　　┃
                                                                                 *　　　┃　　　┃ +  神兽保佑
                                                                                 *　　　┃　　　┃    代码无bug　　
                                                                                 *　　　┃　　　┃　　+　　　　　　　　　
                                                                                 *　　　┃　 　　┗━━━┓ + +
                                                                                 *　　　┃ 　　　　　　　┣┓
                                                                                 *　　　┃ 　　　　　　　┏┛
                                                                                 *　　　┗┓┓┏━┳┓┏┛ + + + +
                                                                                 *　　　　┃┫┫　┃┫┫
                                                                                 *　　　　┗┻┛　┗┻┛+ + + +
                                                                                 */
                        </pre>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">二维码讲解 <small>详细解释参考：<a target="_blank" href="http://doc.wotianhui.com/web/#/6?page_id=99">http://doc.wotianhui.com/web/#/6?page_id=99</a></small></h1>
            </div>
            <div class="col-md-12">
                <div class=" col-md-4 text-center">
                    {!! QrCode::format('svg')->size(100)->generate(Request::url()); !!}
                    <p>{{ Request::url() }}</p>
                </div>
                <div class=" col-md-4 text-center">
                    {!! QrCode::encoding('UTF-8')->size(100)->generate('你好，我是开发者！'); !!}
                    <p>你好，我是开发者！</p>
                </div>
                <div class=" col-md-4 text-center">
                    <img src="{{ $path }}" />
                    <p>{{ Request::url() }}</p>
                </div>
                <div class="clearfix"></div>
                <div class=" col-md-4 text-center">
                    {!! QrCode::encoding('UTF-8')->SMS('13949056342','测试发短信扫码'); !!}
                    <p>扫我打电话 13949056342！</p>
                </div>

            </div>
        </div>
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
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    <script>

        /*如果这里需要一些其他的方法和属性  请自行查看文档*/

        var dropzone = new Dropzone('#mydropzone', {
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
                    console.log(file, data);
                });
                this.on("queuecomplete",function(file) {

                });
                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });

        /*如果这里需要一些其他的方法和属性 请自行查看文档*/
    </script>
@endsection