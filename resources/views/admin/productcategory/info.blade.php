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
            <li><a href="{{ url('/admin/goodscategory') }}">商品分类（测试）</a></li>
            <li class="active">商品分类</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">商品分类（测试） <small> 商品分类</small></h1>
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
                                <td>{{ $productcategory['id'] }}</td>
                            </tr>
                            <tr>
                                <td>商品ID</td>
                                <td>{{ $productcategory['goods_id'] }}</td>
                            </tr>
                            <tr>
                                <td>名称</td>
                                <td>{{ $productcategory['name'] }}</td>
                            </tr>
                            <tr>

                                <td>缩略名</td>
                                <td>{{ $productcategory['short_name'] }}</td>
                            </tr>
                            <tr>
                                <td>分类图标</td>
                                <td>{{ $productcategory['cate_img'] }}</td>
                            </tr>
                            <tr>
                                <td>父ID</td>
                                <td>{{ $productcategory['parent_id'] }}</td>
                            </tr>
                            <tr>
                                <td>平台分成比例</td>
                                <td>{{ $productcategory['min_rate'] }}</td>
                            </tr>
                            <tr>
                                <td>排序</td>
                                <td>{{ $productcategory['sort'] }}</td>
                            </tr>
                            <tr>
                                <td>创建时间</td>
                                <td>{{ $productcategory['create_at'] }}</td>
                            </tr>
                            <tr>
                                <td>更新时间</td>
                                <td>{{ $productcategory['update_at'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection