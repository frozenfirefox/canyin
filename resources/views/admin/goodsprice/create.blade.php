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
            <li><a href="{{ url('/admin') }}">首页</a></li>
            <li><a href="{{ url('/admin/goods/info/id/'.$gid) }}">{{ $goods['goods_name'] }}</a></li>
            <li class="active">添加价格</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $goods['goods_name'] }} 价格 <small>{{ $goods['goods_name'] }} 价格</small></h1>
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
                        <h4 class="panel-title">添加类别</h4>
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
                        <form id="form-add" class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/goodsprice') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="goods_id" value="{{ $gid }}" />
                            <input type="hidden" id="pic-ids" name="goods_img" value="" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">商品名称 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $goods['goods_name'] }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_specification">规格 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_specification"
                                           placeholder="规格"
                                           data-parsley-length="[3,100]"
                                           data-parsley-length-message="规格长度3~100字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入规格"
                                           value="{{ old('goods_specification') }}"/>
                                </div>
                            </div>
                            @if(isset($goodsattr))
                                @if(isset($goodsattr2))
                                    @foreach($goodsattr as $kal => $val)
                                        @foreach($goodsattr2 as $k=>$v)
                                        @if($val['id']==$k )
                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-4" for="role">{{$val['name']}} * :</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="form-control selectpicker"
                                                            data-live-search="true"
                                                            data-style="btn-white"
                                                            data-parsley-required="true"
                                                            data-parsley-errors-container="#name_error"
                                                            data-parsley-required-message="请选择{{$val['name']}}"
                                                            name="name_{{$k}}">
                                                        <option value="">-- 请选择 --</option>
                                                            @foreach($v as $k1=>$v1)
                                                            <option value="{{ $v1['id'] }}" >{{$v1['goods_attr_value']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p id="name_error"></p>
                                                </div>
                                            </div>
                            @endif
                            @endforeach
                            @endforeach
                            @endif
                            @endif
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="settlement_price">结算价格 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="settlement_price" type="text"
                                           name="settlement_price"
                                           placeholder="结算价格"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="结算价格不符合规范"
                                           data-parsley-length-message="结算价格长度1-9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入结算价格"
                                           value="{{ old('settlement_price') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="shop_price">销售价格 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="shop_price"
                                           placeholder="销售价格"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="销售价格不符合规范"
                                           data-parsley-length-message="销售价格长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入销售价格"
                                           value="{{ old('shop_price') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="market_price">市场价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="market_price"
                                           placeholder="市场价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="市场价不符合规范"
                                           data-parsley-length-message="市场价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入市场价"
                                           value="{{ old('market_price') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_weight">商品重量单位 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_weight"
                                           placeholder="商品重量单位"
                                           data-parsley-length="[1,10]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,3})?$/"
                                           data-parsley-pattern-message="商品重量单位不符合规范"
                                           data-parsley-length-message="商品重量单位长度1~10字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商品重量单位"
                                           value="{{ old('goods_weight') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="wy_price"> 无优价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="wy_price"
                                           placeholder="无优价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="无优价不符合规范"
                                           data-parsley-length-message="无优价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入无优价"
                                           value="{{ old('wy_price') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="yx_price">优享价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="yx_price"
                                           placeholder="优享价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="优享价不符合规范"
                                           data-parsley-length-message="优享价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入优享价"
                                           value="{{ old('yx_price') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="integral">积分价格 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="integral"
                                           placeholder="积分价格"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="积分价格不符合规范"
                                           data-parsley-length-message="积分价格长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入积分价格"
                                           value="{{ old('integral') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="discount"> 红券使用比例(单位%) * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="discount"
                                           placeholder="红券使用比例(单位%)"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="红券使用比例(单位%)不符合规范"
                                           data-parsley-length-message=" 红券使用比例(单位%)长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入红券使用比例(单位%)"
                                           value="{{ old('discount') }}"/>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="red_rurn_integral">红券返积分 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="red_rurn_integral"
                                           placeholder="红券返积分"
                                           data-parsley-length="[1,9]"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="红券返积分必须是数字"
                                           data-parsley-length-message="红券返积分长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入红券返积分"
                                           value="{{ old('red_rurn_integral') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="yellow_discount"> 黄券使用比例 (%) * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="yellow_discount"
                                           placeholder="黄券使用比例 (%)"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="黄券使用比例(单位%)不符合规范"
                                           data-parsley-length-message=" 黄券使用比例(单位%)长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入黄券使用比例(单位%)"
                                           value="{{ old('yellow_discount') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="yellow_return_integral"> 黄券返积分 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="yellow_return_integral"
                                           placeholder="黄券返积分"
                                           data-parsley-length="[1,9]"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="黄券返积分必须是数字"
                                           data-parsley-length-message="黄券返积分长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入黄券返积分"
                                           value="{{ old('yellow_return_integral') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="blue_discount"> 蓝券使用比例(%) * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="blue_discount"
                                           placeholder="蓝券使用比例(%)"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="蓝券使用比例(单位%)不符合规范"
                                           data-parsley-length-message=" 蓝券使用比例(单位%)长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入蓝券使用比例(单位%)"
                                           value="{{ old('blue_discount') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">商品缩略图 * :</label>
                                <div class="col-md-6 col-sm-6 wt-dropzone" id="mydropzone">
                                </div>
                                <span class="dz-max-files-reached"></span>
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
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('render');
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
                this.on('addedfile', function(file){
                    if(this.files && this.files.length >1){
                        $("#mydropzone").children().eq(0).remove();
                    }
                });
                this.on("success", function(file, data) {
                    renew_string('#pic-ids', data.data);
                });
                this.on("queuecomplete",function(file) {

                });
                this.on("removedfile",function(file){
                    //删除文件时触发的方法
                });
            }
        });
        /*如果这里需要一些其他的方法和属性 请自行查看文档*/

        function renew_string(id, pid){
            var pid         = pid;
            var oldstring   = $(id).val();
            var pic_arr     = '';
            pic_arr         = pid;
            $(id).val(pic_arr);
        }


    </script>
@endsection