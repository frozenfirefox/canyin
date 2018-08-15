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
            <li><a href="{{ url('admin/ticket') }}">优惠劵列表</a></li>
            <li class="active">优惠劵信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改优惠劵信息 <small>优惠劵详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $ticket['ticket_name'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/ticket/'.$ticket['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ticket_code">优惠劵编号 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"  readonly="readonly" type="text"  name="ticket_code"
                                           placeholder="优惠劵编号"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入优惠劵编号"
                                           value="{{ $ticket['ticket_code']  }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ticket_name">优惠劵名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ticket_name"
                                           placeholder="优惠劵名称"
                                           data-parsley-length="[1,20]"
                                           data-parsley-length-message="优惠劵名称长度2~20字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入优惠劵名称"
                                           value="{{ $ticket['ticket_name'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ticket_desc">使用说明 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="ticket_desc"
                                              placeholder="使用说明"
                                              data-parsley-length="[1,100]"
                                              data-parsley-length-message="使用说明长度1~100字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入使用说明">{{ $ticket['ticket_desc']}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">优惠劵类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#ticket_type_error"
                                            data-parsley-required-message="请选择优惠劵类型"
                                            name="ticket_type">
                                        <option value="{{ $ticket['ticket_type'] }}">-- 请选择 --</option>
                                        @foreach($arr_ticket_type as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $ticket['ticket_type']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="ticket_type_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">面值 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#value_error"
                                            data-parsley-required-message="请选择面值"
                                            name="value">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_value as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $ticket['value']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="value_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">使用条件 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#condition_error"
                                            data-parsley-required-message="请选择使用条件"
                                            name="condition">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_condition as $k=>$v)
                                            <option value="{{ $k }}"
                                            @if($k == $ticket['condition']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="condition_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">使用对象 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#goods_error"
                                            data-parsley-required-message="请选择使用对象"
                                            name="goods_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_goods_id as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $ticket['goods_id']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="goods_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">后台发放 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#merchant_error"
                                            data-parsley-required-message="请选择后台发放"
                                            name="merchant_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_merchant_id as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $ticket['merchant_id']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="merchant_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="use_num">已领取数量 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="use_num"
                                           placeholder="已领取数量"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="已领取数量输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="已领取数量长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入已领取数量"
                                           value="{{ $ticket['use_num'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">数量上限 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#num_error"
                                            data-parsley-required-message="请选择数量上限"
                                            name="ticket_num">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_ticket_num as $k=>$v)
                                            <option value="{{ $k }}" @if($k == $ticket['ticket_num']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="num_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="true_use_num">使用数量 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="true_use_num"
                                           placeholder="使用数量"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="使用数量输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="使用数量长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入使用数量值"
                                           value="{{ $ticket['true_use_num'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">是否限制 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#limit_error"
                                            data-parsley-required-message="请选择是否限制"
                                            name="limit_num">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_limit_num as $k=>$v)
                                            <option value="{{ $k }}"
                                            @if($k == $ticket['limit_num']) selected="selected" @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <p id="limit_num"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="start_time">有效期开始 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input name="start_time" class="form-control" style="background-color: white;" type="text" readonly id="form_datetime" value="2018-01-01 00:00:00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="end_time">有效期结束 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input name="end_time" class="form-control" style="background-color: white;" type="text" readonly id="form_datetime2"  value="2018-04-04 00:00:00">
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
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <script language="JavaScript">
        $("#form_datetime").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            startDate: "2018-01-01",
            autoclose: true,
            language:"zh-CN"
        });
        $("#form_datetime2").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            startDate: "2018-04-04",
            autoclose: true,
            language:"zh-CN"
        });
    </script>
    <script>
        $('.selectpicker').selectpicker('render');
    </script>
@endsection