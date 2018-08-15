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
            <li><a href="javascript:;">首页</a></li>
            <li><a href="{{ url('/admin/userticket') }}">用户优惠劵列表</a></li>
            <li class="active">用户优惠劵信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $userticket['user_id'] }} 用户优惠劵信息 <small> {{ $userticket['user_id'] }} 用户优惠劵信息</small></h1>
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
                                <td width="20%">优惠劵id</td>
                                <td>{{ $userticket['ticket_id'] }}</td>
                            </tr>
                            <tr>
                                <td>用户id</td>
                                <td>{{ $userticket['user_id'] }}</td>
                            </tr>
                            <tr>
                                <td>使用状态</td>
                                <td>{{ $userticket['status'] }}</td>
                            </tr>
                            <tr>
                                <td>商户创建时间</td>
                                <td>{{ $userticket['create_time'] }}</td>
                            </tr>
                            <tr>
                                <td>商户最近修改时间</td>
                                <td>{{ $userticket['update_at'] }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

@endsection