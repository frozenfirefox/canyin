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
            {{--<li><a href="{{ url('/admin/order/info/id/'.$oid) }}">订单信息</a></li>--}}
            <li class="active">订购产品</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">订购产品 <small>订购产品信息</small></h1>
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
                        <h4 class="panel-title">添加订购产品</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/ordergoods') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="order_id" value="{{ $oid }}" />
                            <input type="hidden" name="merchant_id" value="{{$order->merchant_id}} " />
                            <input type="hidden" name="merchant_name" value="{{$order->merchant_name}} " />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">商品名称* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#goods_id_error"
                                            data-parsley-required-message="请选择商品名称"
                                            name="goods_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($goods_id as $k => $value)
                                            <option value="{{ $value['id']}}">{{ $value['goods_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="goods_id_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_attr">商品属性组合 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_attr"
                                           placeholder="商品属性组合"
                                           data-parsley-length="[1,255]"
                                           data-parsley-length-message="商品属性组合长度1~255字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商品属性组合"
                                           value="{{ old('goods_attr') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="settlement_price">结算价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="settlement_price"
                                           placeholder="结算价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="结算价不符合规范"
                                           data-parsley-length-message="结算价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入结算价"
                                           value="{{ old('settlement_price') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="shop_price">销售价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="shop_price"
                                           placeholder="销售价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="销售价不符合规范"
                                           data-parsley-length-message="销售价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入销售价"
                                           value="{{ old('shop_price') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="market_price">市场价 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="market_price"
                                           placeholder="市场价"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="市场价不符合规范"
                                           data-parsley-length-message="市场价长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入市场价"
                                           value="{{ old('market_price') }}"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="discount">红券使用比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="discount"
                                           placeholder="红券使用比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="红券使用比例不符合规范"
                                           data-parsley-length-message=" 红券使用比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入红券使用比例"
                                           value="{{ old('discount') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="yellow_discount">黄券使用比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="yellow_discount"
                                           placeholder="黄券使用比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="黄券使用比例不符合规范"
                                           data-parsley-length-message=" 黄券使用比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入黄券使用比例"
                                           value="{{ old('yellow_discount') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="blue_discount">蓝券使用比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="blue_discount"
                                           placeholder="蓝券使用比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="蓝券使用比例不符合规范"
                                           data-parsley-length-message=" 蓝券使用比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入蓝券使用比例"
                                           value="{{ old('blue_discount') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="red_return_integral">红券返回积分比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="red_return_integral"
                                           placeholder="红券返回积分比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="红券返回积分比例不符合规范"
                                           data-parsley-length-message=" 红券返回积分比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入红券返回积分比例"
                                           value="{{ old('red_return_integral') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="yellow_return_integral">黄券返回积分比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="yellow_return_integral"
                                           placeholder="黄券返回积分比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="黄券返回积分比例不符合规范"
                                           data-parsley-length-message=" 黄券返回积分比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入黄券返回积分比例"
                                           value="{{ old('yellow_return_integral') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="blue_return_integral">蓝券返回积分比例 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="blue_return_integral"
                                           placeholder="蓝券返回积分比例"
                                           data-parsley-length="[1,3]"
                                           data-parsley-pattern="/^([1-9]\d?|100)$/"
                                           data-parsley-pattern-message="蓝券返回积分比例不符合规范"
                                           data-parsley-length-message=" 蓝券返回积分比例长度1~3字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入蓝券返回积分比例"
                                           value="{{ old('blue_return_integral') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="goods_num">购买数量 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="goods_num"
                                           placeholder="购买数量"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="购买数量输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="购买数量长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入购买数量"
                                           value="{{ old('goods_num') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">配送方式 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#send_type_error"
                                            data-parsley-required-message="请选择配送方式"
                                            name="send_type">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($send_type as $k => $value)
                                            <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="send_type_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="send_company">快递id * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="send_company"
                                           placeholder="快递id"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="快递id输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="快递id长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入快递id"
                                           value="{{ old('send_company') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="send_nu">运单号 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="send_nu"
                                           placeholder="运单号"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入运单号"
                                           value="{{ old('send_nu') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="delivery_time">配送时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="delivery_time"
                                           placeholder="配送时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入配送时间"
                                           value="{{ old('delivery_time') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#status_error"
                                            data-parsley-required-message="请选择状态"
                                            name="status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($status_buy as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="status_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="sure_delivery_time">确认收货时间 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="sure_delivery_time"
                                           placeholder="确认收货时间"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入确认收货时间"
                                           value="{{ old('sure_delivery_time') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">退换货状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#after_type_error"
                                            data-parsley-required-message="请选择退换货状态"
                                            name="after_type">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($after_type as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="after_type_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">评论状态 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#comment_status_error"
                                            data-parsley-required-message="请选择评论状态"
                                            name="comment_status">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($comment_status as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="comment_status_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">商家是否同意退货 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#is_sales_error"
                                            data-parsley-required-message="请选择商家是否同意退货"
                                            name="is_sales">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($is_sales as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="is_sales_error"></p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">商家是否同意退货 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#is_invoice_error"
                                            data-parsley-required-message="请选择商家是否同意退货"
                                            name="is_invoice">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($is_invoice as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="is_invoice_error"></p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="invoice_type_id"> 发票类型id* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="invoice_type_id"
                                           placeholder="发票类型id"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="发票类型id输入不正确"
                                           data-parsley-length="[1,6]"
                                           data-parsley-length-message="发票类型id长度1~6位数字"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入发票类型id"
                                           value="{{ old('invoice_type_id') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">发票抬头类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#invoice_rise_error"
                                            data-parsley-required-message="请选择发票抬头类型"
                                            name="invoice_rise">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($invoice_rise  as $k => $value)
                                        <option value="{{ $k}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p id="invoice_rise_error"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="rise_name"> 抬头名* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="rise_name"
                                           placeholder="抬头名"
                                           data-parsley-length="[1,100]"
                                           data-parsley-length-message="发票明细长度1~100字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入抬头名"
                                           value="{{ old('rise_name') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="invoice_detail"> 发票明细* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="invoice_detail"
                                              placeholder="发票明细"
                                              data-parsley-length="[1,1000]"
                                              data-parsley-length-message="发票明细长度1~1000字符"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入发票明细" >{{ old('invoice_detail') }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="recognition"> 识别号* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="recognition"
                                           placeholder="识别号"
                                           data-parsley-length="[1,1000]"
                                           data-parsley-length-message="识别号长度1~1000字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入识别号"
                                           value="{{ old('recognition') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="tax_pay"> 税金金额* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="tax_pay"
                                           placeholder="税金金额"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="税金金额不符合规范"
                                           data-parsley-length-message="税金金额长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入税金金额"
                                           value="{{ old('tax_pay') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="express_fee"> 发票运费* :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="express_fee"
                                           placeholder="发票运费"
                                           data-parsley-length="[1,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="发票运费不符合规范"
                                           data-parsley-length-message="发票运费长度1~9字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入发票运费"
                                           value="{{ old('express_fee') }}" />
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