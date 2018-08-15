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
            <li><a href="{{ url('/admin/businesses/info/id/'.$bid) }}">添加订单</a></li>
            <li class="active">添加订单</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">新增订单 <small>添加订单信息</small></h1>
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
                        <h4 class="panel-title">添加类别</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/order') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="businesses_id" value="{{ $bid }}" />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="user_id">用户ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="user_id"
                                           placeholder="用户ID"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="用户ID输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="用户ID长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入用户ID"
                                           value="{{ old('user_id') }}"/>
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
                                        @foreach($order_type as $value)
                                            <option value="{{ $value}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="order_type_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="receiver">收货人 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="receiver"
                                           placeholder="收货人"
                                           data-parsley-length="[2,20]"                                                                                                               data-parsley-pattern="/^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,20}$/"
                                           data-parsley-pattern-message="收货人错误"
                                           data-parsley-length-message="收货人长度2~20字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入收货人"
                                           value="{{ old('receiver') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="phone">收货人电话 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="phone"
                                           placeholder="收货人电话"
                                           data-parsley-length="[11,11]"
                                           data-parsley-pattern="/^1(3[0-9]|5[189]|8[6789])[0-9]{8}$/"
                                           data-parsley-pattern-message="电话号码不符合规范"
                                           data-parsley-length-message="电话长度11字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入收货人电话"
                                           value="{{ old('phone') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="address">收货人详细地址 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="address"
                                           placeholder="收货人详细地址"
                                           data-parsley-length="[6,50]"
                                           data-parsley-length-message="收货人详细地址长度6~50字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入收货人详细地址"
                                           value="{{ old('address') }}"/>
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
                                        @foreach($pay_type as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
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
                                        @foreach($order_status as $value)
                                        <option value="{{ $value}}">{{ $value }}</option>
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
                                        @foreach($settlement_status as $value)
                                        <option value="{{ $value }}">{{ $value}}</option>
                                        @endforeach
                                    </select>
                                    <p id="settlement_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="settlement_time">计划任务执行时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="settlement_time"
                                           placeholder="计划任务执行时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入计划任务执行时间"
                                           value="{{ old('settlement_time') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="settlement_end_time">计划任务完成时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="settlement_end_time"
                                           placeholder="计划任务执行时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入计划任务执行时间"
                                           value="{{ old('settlement_end_time') }}"/>
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
                                            name="pay_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($pay_status as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="pay_status_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="order_goods_id">订单商品表ID * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="order_goods_id"
                                           placeholder="订单商品表ID"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="订单商品表ID输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="订单商品表ID长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入订单商品表ID"
                                           value="{{ old('order_goods_id') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_num">商品数量 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_num"
                                           placeholder="商品数量"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="商品数量输入数字"
                                           data-parsley-length="[1,9]"
                                           data-parsley-length-message="商品数量长度1~9位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商品数量"
                                           value="{{ old('goods_num') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="use_integral">使用积分 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="use_integral"
                                           placeholder="使用积分"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="使用积分数字"
                                           data-parsley-length="[1,9]"
                                           data-parsley-length-message="使用积分长度1~9位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入使用积分"
                                           value="{{ old('use_integral') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="pay_tickets">实际券支付金额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="pay_tickets"
                                           placeholder="实际券支付金额"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="实际券支付金额不符合规范"
                                           data-parsley-length-message="实际券支付金额长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入实际券支付金额"
                                           value="{{ old('pay_tickets') }}"/>
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
                                        @foreach($ticket_color as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
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
                                           value="{{ old('freight') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="pay_time">支付时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="pay_time"
                                           placeholder="支付时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入支付时间"
                                           value="{{ old('pay_time') }}"/>
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
                                            name="comment_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($comment_status as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="comment_error"></p>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-md-4 col-sm-4" for="wx_sn">微信支付订单号 * :</label>--}}
                                {{--<div class="col-md-6 col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="wx_sn"--}}
                                           {{--placeholder="微信支付订单号"--}}
                                           {{--data-parsley-required="true"--}}
                                           {{--data-parsley-required-message="请输入微信支付订单号"--}}
                                           {{--value="{{ old('wx_sn') }}"/>--}}
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
                                           value="{{ old('return_integral') }}"/>
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
                                            name="is_tax">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($is_tax as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
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
                                           value="{{ old('express_fee') }}"/>
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
                                           value="{{ old('tax_pay') }}"/>
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
                                           value="{{ old('welfare') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="mark">备注 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="mark"
                                              placeholder="备注"
                                              data-parsley-length="[1,1000]"
                                              data-parsley-length-message="备注长度1~1000字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入备注" >{{ old('mark') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="import_tax">进口税总额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="import_tax"
                                           placeholder="进口税总额"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="进口税总额不符合规范"
                                           data-parsley-length-message="进口税总额长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入进口税总额"
                                           value="{{ old('import_tax') }}" />
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