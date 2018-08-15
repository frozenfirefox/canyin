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
            <li><a href="javascript:;">商户员工列表</a></li>
            <li class="active">商户员工信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改商户员工信息 <small>商户员工详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $staff['name'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/staff/'.$staff['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="businesses_id" value="{{ $staff['businesses_id'] }}" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择商户员工 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#businesses_error"
                                            data-parsley-required-message="请选择商户员工"
                                            name="user_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($users as $value)
                                            <option value="{{ $value->id }}" @if($value->id == $staff['user_id']) selected="selected" @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="businesses_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择职位 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#position_error"
                                            data-parsley-required-message="请选择职位"
                                            name="position">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($classes as $value)
                                            <option value="{{ $value['id'] }}"  @if($value['id'] == $staff->position) selected="selected" @endif  >{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="position_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="phone">电话 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="phone" type="text" name="phone"
                                           placeholder="电话"
                                           data-parsley-length="[11,11]"
                                           data-parsley-pattern="/^1(3[0-9]|5[189]|8[6789])[0-9]{8}$/"
                                           data-parsley-pattern-message="电话号码不符合规范"
                                           data-parsley-length-message="电话长度11字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入电话"
                                           value="{{ $staff['phone'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择管理 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_id_error"
                                            data-parsley-required-message="请选择管理"
                                            name="parent_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($user_name as $k => $v)
                                            @foreach($v as $k2 => $v2)
                                                <option value="{{ $v2->id }}"  @if( $v2->id == $staff->user_id ) selected="selected" @endif  >{{ $v2->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <p id="parent_id_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">员工描述 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="description"
                                              placeholder="员工描述"
                                              data-parsley-length="[1,1000]"
                                              data-parsley-length-message="员工描述长度1~1000字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入员工描述">{{ $staff['description'] }}
                                    </textarea>
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