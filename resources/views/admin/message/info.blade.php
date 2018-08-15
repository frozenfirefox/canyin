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
            <li><a href="{{ url('/admin/message') }}">消息列表</a></li>
            <li class="active">消息信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $message['title'] }} 消息信息 <small> {{ $message['title'] }} 消息信息</small></h1>
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
                                <td>消息id</td>
                                <td>{{ $message['id'] }}</td>
                            </tr>
                            <tr>
                                <td>消息标题</td>
                                <td>{{ $message['title'] }} </td>
                            </tr>
                            <tr>
                                <td>消息内容</td>
                                <td>{{ $message['context'] }}</td>
                            </tr>
                            <tr>
                                <td>消息类型</td>
                                <td>{{ $message['msg_type'] }}</td>
                            </tr>
                            <tr>
                                <td>状态</td>
                                <td>{{ $message['status'] }}</td>
                            </tr>
                            <tr>
                                <td>用户分类</td>
                                <td>{{ $message['user_id'] }}</td>
                            </tr>
                            <tr>
                                <td>消息修改时间</td>
                                <td>{{ $message['create_at'] }}</td>
                            </tr>

                            <tr>
                                <td>消息最近修改时间</td>
                                <td>{{ $message['update_at'] }}</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
@endsection