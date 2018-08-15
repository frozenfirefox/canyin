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
            <li><a href="{{ url('/admin/file') }}">文件列表</a></li>
            <li class="active">文件信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $file['name'] }} 文件信息 <small> {{ $file['name'] }} 文件信息</small></h1>
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
                                <td>文件id</td>
                                <td>{{ $file['id'] }}</td>
                            </tr>
                            <tr>
                                <td>文件原名</td>
                                <td>{{ $file['name'] }}</td>
                            </tr>
                            <tr>
                                <td>文件尺寸</td>
                                <td>{{ $file['size'] }}</td>
                            </tr>
                            <tr>

                                <td>扩展名</td>
                                <td>{{ $file['ext'] }}</td>
                            </tr>
                            <tr>
                                <td>文件md5</td>
                                <td>{{ $file['md5'] }}</td>
                            </tr>
                            <tr>
                                <td>文件sha1</td>
                                <td>{{ $file['sha1'] }}</td>
                            </tr>
                            <tr>
                                <td>文件mime</td>
                                <td>{{ $file['mime'] }}</td>
                            </tr>
                            <tr>
                                <td>保存文件名</td>
                                <td>{{ $file['savename'] }}</td>
                            </tr>
                            <tr>
                                <td>保存路径</td>
                                <td>{{ $file['savepath'] }}</td>
                            </tr>
                            <tr>
                                <td>保存文件位置</td>
                                <td>{{ $file['location'] }}</td>
                            </tr>
                            <tr>
                                <td>全相对路径</td>
                                <td>{{ $file['path'] }}</td>
                            </tr>
                            <tr>
                                <td>绝对地址</td>
                                <td>{{ $file['abs_url'] }}</td>
                            </tr>
                            <tr>
                                <td>OSS服务器路径</td>
                                <td>{{ $file['oss_path'] }}</td>
                            </tr>

                            <tr>
                                <td>创建时间</td>
                                <td>{{ $file['create_time'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection