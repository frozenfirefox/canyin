@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('/admin') }}">首页</a></li>
            <li><a href="{{ url('/admin/businesses/info/id/'.$bid) }}">商户信息</a></li>
            <li class="active">添加自定义属性</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">添加自定义属性 <small>添加自定义属性</small></h1>
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
                        <h4 class="panel-title">添加自定义属性</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/goodsattr') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="businesses_id" value="{{ $bid }}" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="attr_type">自定义属性分类 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#attr_error"
                                            data-parsley-required-message="请选择自定义属性分类"
                                            name="classes_type">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($classes as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="attr_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_attr_value">自定义属性名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_attr_value"
                                           placeholder="自定义属性名称"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="自定义属性名称长度1~20字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入自定义属性名称"
                                           value="{{ old('goods_attr_value') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_attr_id">自定义属性id值 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_attr_id"
                                           placeholder="自定义属性id值，类似于英文别名"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="自定义属性id值长度1~20字符"
                                           data-parsley-pattern="[a-z]"
                                           data-parsley-pattern-message="自定义属性id值位小写字母"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入自定义属性id值"
                                           value="{{ old('goods_attr_id') }}"/>
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