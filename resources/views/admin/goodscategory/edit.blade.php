@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/goodscategory') }}">商品分类（测试）</a></li>
            <li class="active">商品分类</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改商品分类 <small>商品分类信息</small></h1>
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
                        <h4 class="panel-title">{{ $goodscategory['name'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/goodscategory/'.$goodscategory['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_id">商品ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_id"
                                           placeholder="商品ID"
                                           data-parsley-length="[1,255]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商品ID"
                                           value="{{ $goodscategory['goods_id'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="name"
                                           placeholder="名称"
                                           data-parsley-length="[2,255]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入名称"
                                           value="{{ $goodscategory['name'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="short_name">缩略名 :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="short_name"
                                           placeholder="缩略名"
                                           data-parsley-length="[2,255]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入缩略名"
                                           value="{{ $goodscategory['short_name'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cate_img">分类图标 :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="cate_img"
                                           placeholder="分类图标"
                                           data-parsley-length="[1,100]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入分类图标"
                                           value="{{ $goodscategory['cate_img'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="parent_id">父ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="parent_id"
                                           placeholder="父ID"
                                           data-parsley-length="[1,255]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入父ID"
                                           value="{{ $goodscategory['parent_id'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="min_rate">平台分成比例 :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="min_rate"
                                           placeholder="平台分成比例"
                                           data-parsley-length="[1,10]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入平台分成比例"
                                           value="{{ $goodscategory['min_rate'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="sort">排序 :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="sort"
                                           placeholder="排序" data-parsley-length="[1,100]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入排序"
                                           value="{{ $goodscategory['sort'] }}"/>
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
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('render');
    </script>
@endsection