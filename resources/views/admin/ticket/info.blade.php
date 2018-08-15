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
            <li><a href="{{ url('/admin/ticket') }}">优惠劵列表</a></li>
            <li class="active">优惠劵信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $ticket['ticket_name'] }} 优惠劵信息 <small> {{ $ticket['ticket_name'] }} 优惠劵信息</small></h1>
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
                                <td>优惠劵id</td>
                                <td>{{ $ticket['id'] }}</td>
                            </tr>
                            <tr>
                                <td>优惠劵编号</td>
                                <td>{{ $ticket['ticket_code'] }}</td>
                            </tr>
                            <tr>
                                <td>优惠劵名称</td>
                                <td>{{ $ticket['ticket_name'] }}</td>
                            </tr>
                            <tr>

                                <td>描述</td>
                                <td>{{ $ticket['ticket_desc'] }}</td>
                            </tr>
                            <tr>
                                <td>优惠类型</td>
                                <td>{{ $ticket['ticket_type'] }}</td>
                            </tr>
                            <tr>
                                <td>面值</td>
                                <td>{{ $ticket['value'] }}</td>
                            </tr>
                            <tr>
                                <td>使用条件</td>
                                <td>{{ $ticket['condition'] }}</td>
                            </tr>
                            <tr>
                                <td>使用对象</td>
                                <td>{{ $ticket['goods_id'] }}</td>
                            </tr>
                            <tr>
                                <td>后台发放类型</td>
                                <td>{{ $ticket['merchant_id'] }}</td>
                            </tr>
                            <tr>
                                <td>数量上限</td>
                                <td>{{ $ticket['ticket_num'] }}</td>
                            </tr>
                            <tr>
                                <td>已领取数量</td>
                                <td>{{ $ticket['use_num'] }}</td>
                            </tr>
                            <tr>
                                <td>使用数量</td>
                                <td>{{ $ticket['true_use_num'] }}</td>
                            </tr>
                            <tr>
                                <td>是否限制</td>
                                <td>{{ $ticket['limit_num'] }}</td>
                            </tr>
                            <tr>
                                <td>有效期开始</td>
                                <td>{{ $ticket['start_time'] }}</td>
                            </tr>
                            <tr>
                                <td>有效期结束</td>
                                <td>{{ $ticket['end_time'] }}</td>
                            </tr>
                            <tr>
                                <td>消息修改时间</td>
                                <td>{{ $ticket['create_at'] }}</td>
                            </tr>
                            <tr>
                                <td>消息最近修改时间</td>
                                <td>{{ $ticket['update_at'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection