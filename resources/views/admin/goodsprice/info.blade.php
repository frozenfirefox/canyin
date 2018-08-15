@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/goods/info/id/'.$goodsprice['goods_id']) }}">{{ $goodsprice['goods_name'] }}</a></li>
            <li class="active">{{ $goodsprice['goods_specification'] }}</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $goodsprice['goods_name'] }} - {{ $goodsprice['goods_specification'] }} 信息 <small>{{ $goodsprice['goods_name'] }} 详细信息</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">{{ $goodsprice['goods_name'] }}</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th width="20%">规格</th>
                                    <td>{{ $goodsprice['goods_specification'] }}</td>
                                </tr>


                                @foreach($goodsattr as $k=>$v)

                                <tr>
                                    <th width="20%">{{$k}}</th>

                                    @foreach($v as $k2=>$v2)
                                    <td>{{$v2['goods_attr_value']}}</td>
                                    @endforeach


                                </tr>

                                @endforeach
                                <tr>
                                    <th>结算价格</th>
                                    <td>{{ $goodsprice['settlement_price'] }}</td>
                                </tr>
                                <tr>
                                    <th>销售价格</th>
                                    <td>{{ $goodsprice['shop_price'] }}</td>
                                </tr>
                                <tr>
                                    <th>市场价</th>
                                    <td>{{ $goodsprice['market_price'] }}</td>
                                </tr>
                                <tr>
                                    <th>商品重量单位</th>
                                    <td>{{ $goodsprice['goods_weight'] }}</td>
                                </tr>
                                <tr>
                                    <th>无优价</th>
                                    <td>{{ $goodsprice['wy_price'] }}</td>
                                </tr>
                                <tr>
                                    <th>优享价</th>
                                    <td>{{ $goodsprice['yx_price'] }}</td>
                                </tr>
                                <tr>
                                    <th>积分价格</th>
                                    <td>{{ $goodsprice['integral'] }}</td>
                                </tr>
                                <tr>
                                    <th>红券使用比例(单位%)</th>
                                    <td>{{ $goodsprice['discount'] }}</td>
                                </tr>
                                <tr>
                                    <th>红券返积分</th>
                                    <td>{{ $goodsprice['red_rurn_integral'] }}</td>
                                </tr>
                                <tr>
                                    <th>黄券使用比例 (%)</th>
                                    <td>{{ $goodsprice['yellow_discount'] }}</td>
                                </tr>
                                <tr>
                                    <th>黄券返积分</th>
                                    <td>{{ $goodsprice['yellow_return_integral'] }}</td>
                                </tr>
                                <tr>
                                    <th>蓝券使用比例(%)</th>
                                    <td>{{ $goodsprice['blue_discount'] }}</td>
                                </tr>
                                <tr>
                                    <th>价格图片</th>
                                    <td>
                                        @if(!empty($path_img))

                                                <img data-original="{{$host}}{{$path_img}}" src="{{$host}}{{$path_img}}" style="width: 80px;height: 80px;border-radius: 25px"/>
                                        @else
                                            暂无图片
                                        @endif

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_admin/js/classes.list.js')}}"></script>
    <script>
        $(function(){
            @if (session()->has('flash_notification.message'))
                //通知信息
                $.gritter.add({
                    title: '操作消息！',
                    text: '{!! session('flash_notification.message') !!}'
                });
            @endif

            //删除
            $(document).on('click','.destroy',function(){
                var _delete_id = $(this).attr('data-id');
                swal({
                        title: "确定删除？",
                        text: "删除将不可逆，请谨慎操作！",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonText: "取消",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    },
                    function () {
                        $('form[name=delete_item_'+_delete_id+']').submit();
                    }
                );
            });
        });
    </script>

@endsection