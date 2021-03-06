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
            <li><a href="{{ url('admin/adminuser') }}">后台用户列表</a></li>
            <li class="active">添加后台用户</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">新增后台用户 <small>添加后台用户信息</small></h1>
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
                            {{--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>--}}
                        </div>
                        <h4 class="panel-title">添加后台用户</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/adminuser') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="email">邮箱 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="email"
                                           placeholder="邮箱（将会作为登录名）"
                                           data-parsley-required="true"
                                           data-parsley-type="email"
                                           data-parsley-type-message="请输入正确的邮箱格式"                                                                                           data-parsley-required-message="请输入邮箱"
                                            value="{{ old('email') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">姓名 * :</label>
                                <div class="col-md-6 col-sm-6">
                                     <input class="form-control" type="text" name="name"
                                            placeholder="姓名"
                                            data-parsley-required="true"
                                            data-parsley-length="[2,20]"                                                                                                               data-parsley-pattern="/^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,20}$/"
                                            data-parsley-pattern-message="请输入中文名"
                                            data-parsley-length-message="姓名长度2~20字符"                                                                                            data-parsley-required-message="请输入姓名"
                                            value="{{ old('name') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="password">密码 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="password" type="text" name="password"
                                           placeholder="密码"
                                           data-parsley-required="true"
                                           data-parsley-length="[6,12]"
                                           data-parsley-length-message="密码长度6~12字符"
                                           data-parsley-pattern="/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/"
                                           data-parsley-pattern-message="请输入6~12位数字和字母组合"
                                           data-parsley-required-message="请输入密码"
                                           value="{{ old('password') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="password">确认密码 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="password_confirmation"
                                           placeholder="确认密码"
                                           data-parsley-length="[6,12]"                                                                                                               data-parsley-length-message="密码长度6~12字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请确认密码"
                                           data-parsley-equalto="#password"
                                           data-parsley-equalto-message="两次密码输入不一致"
                                           value="{{ old('password_confirmation') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择角色 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#role_error"
                                            data-parsley-required-message="请选择角色"
                                            name="role">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($roles as $key=>$value)
                                            <option value="{{ $value['id'] }}">{{ $value['display_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="role_error"></p>
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
    {{--<script src="{{ asset('asset_admin/assets/plugins/parsley/src/i18n/zh_cn.js') }}"></script>--}}
    <script>
        $('.selectpicker').selectpicker('render');
    </script>
@endsection