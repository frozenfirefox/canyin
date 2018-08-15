@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">首页</a></li>
            <li><a href="javascript:;">消息列表</a></li>
            <li class="active">消息信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改消息信息 <small>消息详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $message['title'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/message/'.$message['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="title">消息标题 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="title" placeholder="消息标题" data-parsley-length="[1,60]"  data-parsley-required="true" data-parsley-required-message="请输入消息标题" value="{{ $message['title'] }}"/>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="context">消息内容 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="context" placeholder="消息内容" data-parsley-length="[1,100]"  data-parsley-required="true" data-parsley-required-message="请输入消息内容" value="{{  $message['context'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">消息类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#msg_error"
                                            data-parsley-required-message="请选择消息类型"
                                            name="msg_type">
                                        <option value="">-- 请选择 --</option>
                                        <option value="0" selected="selected">系统消息</option>
                                        <option value="1">订单消息</option>
                                    </select>
                                    <p id="msg_error"></p>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#status_error"
                                            data-parsley-required-message="请选择状态"
                                            name="status">
                                        <option value="">-- 请选择 --</option>
                                        <option value="0" selected="selected">正常</option>
                                        <option value="1">不正常</option>
                                    </select>
                                    <p id="status_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">用户分类 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#user_error"
                                            data-parsley-required-message="请选择状态"
                                            name="user_id">
                                        <option value="">-- 请选择 --</option>
                                        <option value="0" selected="selected">全部用户</option>
                                        <option value="1">个人用户</option>
                                    </select>
                                    <p id="user_error"></p>
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
@endsection