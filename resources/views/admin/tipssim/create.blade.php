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
            <li><a href="{{ url('admin/tipssim') }}">打赏</a></li>
            <li class="active">添加打赏</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">新增商户打赏设置 <small>添加商户打赏设置信息</small></h1>
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
                        <h4 class="panel-title">添加商户打赏设置</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/tipssetting') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="tag">商家 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_error"
                                            data-parsley-required-message="请选择商家"
                                            name="id"
                                            >
                                        @foreach($businesses_type as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="parent_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_type">现金结算方法 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#type_error"
                                            data-parsley-required-message="请选择现金结算方法"
                                            name="cts_type"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($tipstype as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="type_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_smileflag">有无笑脸打赏 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#smileflag_error"
                                            data-parsley-required-message="请选择有无笑脸打赏"
                                            name="cts_smileflag"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($smailflag as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="smileflag_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_smilerate">笑脸兑换率 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="cts_smilerate" placeholder="笑脸兑换率" data-parsley-length="[1,20]" data-parsley-length-message="笑脸兑换率长度2~20字符" data-parsley-required="true" data-parsley-required-message="请输入笑脸兑换率" value="{{ old('cts_smilerate') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_smilemin">笑脸起结数 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="cts_smilemin" placeholder="笑脸起结数" data-parsley-length="[1,20]" data-parsley-length-message="笑脸起结数长度2~20字符" data-parsley-required="true" data-parsley-required-message="请输入笑脸起结数" value="{{ old('cts_smilemin') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_def_amount">打赏金额多选项 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="cts_def_amount" placeholder="打赏金额多选项" data-parsley-length="[1,100]" data-parsley-length-message="打赏金额多选项长度1~100字符" data-parsley-required="true" data-parsley-required-message="请输入打赏金额多选项" value="{{ old('cts_def_amount') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cts_memo">备考 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="cts_memo" placeholder="备考" data-parsley-length="[0,500]" data-parsley-length-message="备考" data-parsley-required="false" data-parsley-required-message="请输入备考">{{ old('cts_memo') }}</textarea>
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