@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets//DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/tips') }}">打赏列表</a></li>
            <li class="active">打赏信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">打赏 <small>打赏信息页面</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">基本信息</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $tips['id'] }}</td>
                            </tr>
                            <tr>
                                <td>客户ID</td>
                                <td>{{ $tips['ct_user_id'] }}</td>
                            </tr>
                            <tr>
                                <td>原始二维码</td>
                                <td>{{ $tips['ct_qrcode'] }}</td>
                            </tr>
                            <tr>

                                <td>商户</td>
                                <td>{{ $tips['ct_bus_id'] }}</td>
                            </tr>
                            <tr>
                                <td>用户ID</td>
                                <td>{{ $tips['ct_tuser_id'] }}</td>
                            </tr>
                            <tr>
                                <td>订单ID</td>
                                <td>{{ $tips['ct_order_id'] }}</td>
                            </tr>
                            <tr>
                                <td>菜品ID</td>
                                <td>{{ $tips['ct_food_id'] }}</td>
                            </tr>
                            <tr>
                                <td>打赏对象</td>
                                <td>{{ $tips['ct_target'] }}</td>
                            </tr>
                            <tr>
                                <td>支付方式</td>
                                <td>{{ $tips['ct_paytype'] }}</td>
                            </tr>
                            <tr>
                                <td>打赏金额</td>
                                <td>{{ $tips['ct_amount'] }}</td>
                            </tr>
                            <tr>
                                <td>简评</td>
                                <td>{{ $tips['ct_memo'] }}</td>
                            </tr>
                            <tr>
                                <td>打赏状态</td>
                                <td>{{ $tips['ct_status'] }}</td>
                            </tr>
                            <tr>
                                <td>登录日期</td>
                                <td>{{ $tips['ct_create_time'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection