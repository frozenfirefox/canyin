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
            <li><a href="{{ url('admin/businesses/'.$order['merchant_id'].'/info') }}">{{ $order['businesses_name'] }}</a></li>
            <li class="active">订单编辑</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">订单编辑 <small>订单编辑详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $order['order_sn'] }} 订单</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/order/'.$order['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="merchant_id" value="{{ $order['merchant_id'] }}" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">订单id :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['id'] }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">订单商户 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['businesses_name'] }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">下单用户 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['user_name'] }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">收货人 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['receiver'] }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">收货人电话 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['phone'] }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">添加时间 :</label>
                                <div class="col-md-6 col-sm-6">
                                  <label class="control-label text-left">{{ $order['create_time'] }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">上次修改时间 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <label class="control-label text-left">{{ $order['update_at'] }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="address">订单详细地址 :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input  class="form-control" name="address" rows="5"
                                            placeholder="订单详细地址"
                                            data-parsley-length="[6,50]"
                                            data-parsley-length-message="收货人详细地址长度6~50字符"
                                            data-parsley-required="true"
                                            data-parsley-required-message="请输入收货人详细地址"
                                            value="{{ $order['address'] }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">订单类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#order_type_error"
                                            data-parsley-required-message="请选择订单类型"
                                            name="order_type">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_order_type as $k => $value)
                                            <option value="{{ $k}}"
                                            @if($k == $order['order_type']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="order_type_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">支付方式 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#pay_type_error"
                                            data-parsley-required-message="请选择支付方式"
                                            name="pay_type">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_pay_type as $k => $value)
                                            <option  value="{{ $k}}" @if($k == $order['pay_type']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="pay_type_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">订单状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#order_status_error"
                                            data-parsley-required-message="请选择订单状态"
                                            name="order_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_order_status as  $k => $value)
                                            <option  value="{{ $k}}" @if($k == $order['order_status']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="order_status_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">是否需要 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#settlement_error"
                                            data-parsley-required-message="请选择是否需要"
                                            name="settlement_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_settlement_status as $k => $value)
                                            <option  value="{{ $k}}" @if($k == $order['settlement_status']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="settlement_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">支付状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#pay_status_error"
                                            data-parsley-required-message="请选择支付状态"
                                            name="arr_pay_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_pay_status as $k => $value)
                                            <option  value="{{ $k}}" @if($k == $order['pay_status']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="pay_status_error"></p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">代金券使用 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#ticket_color_error"
                                            data-parsley-required-message="请选择代金券使用"
                                            name="ticket_color">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_ticket_color as  $k => $value)
                                            <option  value="{{ $k}}" @if($k == $order['ticket_color ']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="ticket_color_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="freight">运费 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="freight"
                                           placeholder="运费"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="运费不符合规范"
                                           data-parsley-length-message="运费长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入运费"
                                           value="{{ $order['freight'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="pay_time">支付时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="pay_time"
                                           placeholder="支付时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入支付时间"
                                           value="{{ $order['pay_time'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">订单评论状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#comment_error"
                                            data-parsley-required-message="请选择订单评论状态"
                                            name="arr_comment_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_comment_status as $k => $value)
                                            <option value="{{ $k }}" @if($k == $order['comment_status ']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="comment_error"></p>
                                </div>
                            </div>


                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-md-4 col-sm-4" for="wx_sn">微信支付订单号 * :</label>--}}
                                {{--<div class="col-md-6 col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="wx_sn" placeholder="微信支付订单号"   data-parsley-required="true" data-parsley-required-message="请输入微信支付订单号" value="{{ $order['wx_sn'] }}"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="return_integral">返还积分数 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="return_integral"
                                           placeholder="返还积分数"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="返还积分数数字"
                                           data-parsley-length="[1,9]"
                                           data-parsley-length-message="返还积分数长度1~9位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入返还积分数"
                                           value="{{ $order['return_integral'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">是否开具发票 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#is_tax_error"
                                            data-parsley-required-message="请选择是否开具发票"
                                            name="is_tax_mx">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr_is_tax as $k => $value)
                                            <option value="{{ $k }}"
                                            @if($k == $order['is_tax ']) selected="selected" @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="is_tax_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="express_fee">发票运费 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="express_fee"
                                           placeholder="发票运费"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="发票运费不符合规范"
                                           data-parsley-length-message="发票运费长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入发票运费"
                                           value="{{ $order['express_fee'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="tax_pay">发票税金 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="tax_pay"
                                           placeholder="发票税金"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="发票税金不符合规范"
                                           data-parsley-length-message="发票税金长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入发票税金"
                                           value="{{ $order['tax_pay'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="welfare">公益金额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="welfare"
                                           placeholder="公益金额"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="公益金额不符合规范"
                                           data-parsley-length-message="公益金额长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入公益金额"
                                           value="{{ $order['welfare'] }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="import_tax">进口税总额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="import_tax"
                                           placeholder="进口税总额"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入进口税总额"
                                           value="{{ $order['import_tax'] }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="mark">备注 :</label>
                                <div class="col-md-6 col-sm-6">
                                   <textarea  class="form-control" name="mark" rows="5"
                                              placeholder="备注"
                                              data-parsley-length="[1,1000]"
                                              data-parsley-length-message="备注长度1~1000字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入备注">{{ $order['mark'] }}
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
@endsection