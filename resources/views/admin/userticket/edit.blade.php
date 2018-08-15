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
            <li><a href="{{ url('admin/businesses') }}">用户优惠劵列表</a></li>
            <li class="active">用户优惠劵信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改用户优惠劵信息 <small>用户优惠劵详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $userticket['user_id'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/userticket/'.$userticket['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ticket_id">优惠劵id * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ticket_id"
                                           placeholder="优惠劵id"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="优惠劵id输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="优惠劵id长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入优惠劵id"
                                           value="{{ $userticket['ticket_id'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="user_id">用户id * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="user_id"
                                           placeholder="用户id"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="用户id输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="用户id长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入用户id"
                                           value="{{  $userticket['user_id'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">使用状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#status_error"
                                            data-parsley-required-message="请选择使用状态"
                                            name="status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr as $k=>$v)
                                            <option value="{{ $k }}"
                                            @if($k == $userticket['status']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="status_error"></p>
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