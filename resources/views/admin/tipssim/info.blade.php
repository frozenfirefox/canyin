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
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/tipssim') }}">模拟打赏</a></li>
            <li class="active">添加打赏</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $busname}} <small>添加打赏</small></h1>
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
                        <h4 class="panel-title">添加打赏</h4>
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
                    <div class="panel-body panel-form" id="form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/tipssim') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="ct_bus_id" name="ct_bus_id" value="{{ $busid }}"/>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_user_id">客户ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ct_user_id" placeholder="客户ID" data-parsley-length="[1,100]" data-parsley-length-message="客户ID长度1~100字符" data-parsley-required="true" data-parsley-required-message="请输入客户ID" value="{{ old('ct_user_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_qrcode">原始二维码 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ct_qrcode" placeholder="原始二维码" data-parsley-length="[1,255]" data-parsley-length-message="二维码长度1~255字符" data-parsley-required="true" data-parsley-required-message="请输入二维码" value="{{ old('ct_qrcode') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_tuser_id">用户 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_error"
                                            data-parsley-required-message="请选择用户"
                                            name="ct_tuser_id">
                                        <option value="0"> 未选择用户 </option>
                                        @foreach($users as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="parent_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_order_id">订单ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ct_order_id" placeholder="订单ID" data-parsley-length="[1,100]" data-parsley-length-message="订单ID长度1~100字符" data-parsley-required="true" data-parsley-required-message="请输入订单ID" value="{{ old('ct_order_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_food_id">菜品ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ct_food_id" placeholder="菜品ID" data-parsley-length="[1,100]" data-parsley-length-message="菜品ID长度1~100字符" data-parsley-required="true" data-parsley-required-message="请输入菜品ID" value="{{ old('ct_food_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_target">打赏对象 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#target_error"
                                            data-parsley-required-message="请选择打赏对象"
                                            name="ct_target"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($tipstarget as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="target_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_paytype">支付方式 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#paytype_error"
                                            data-parsley-required-message="请选择支付方式"
                                            name="ct_paytype"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($paytype as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="paytype_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_memo">简评 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="ct_memo" placeholder="简评" data-parsley-length="[0,500]" data-parsley-length-message="简评" data-parsley-required="false" data-parsley-required-message="请输入简评">{{ old('ct_memo') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ct_amount">打赏金额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#amount_error"
                                            data-parsley-required-message="请选择打赏金额"
                                            name="ct_amount"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($amount as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="amount_error"></p>
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
    @include('admin.layouts.dropzonepre')
@endsection

@section('admin-js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    <script>
        $('.selectpicker2').selectpicker('render');
        $('.select-three').selectpicker('render');

    </script>
@endsection
