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
            <li><a href="{{ url('admin/businesses') }}">商户列表</a></li>
            <li class="active">商户信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改商户信息 <small>商户详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $businesses['name'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/businesses/'.$businesses['id']) }}" method="POST" onSubmit="return checkform();">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="tag" id="tag"  />
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">商家名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="name"
                                           placeholder="商家名称"
                                           data-parsley-pattern="/^[\u4e00-\u9fa5A-Za-z]{2,30}$/"
                                           data-parsley-pattern-message="请输入正确商家名称"
                                           data-parsley-length="[2,30]"
                                           data-parsley-length-message="商家名称长度2~30字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商家名称"
                                           value="{{ $businesses['name'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="tag">父级商家 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker2"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#parent_error"
                                            data-parsley-required-message="请选择父级商家"
                                            name="parent_id"
                                            >
                                        <option value="0" @if(0 === $businesses['parent_id']) selected="selected" @endif> 顶级商户 </option>
                                        @foreach($businesses_type as $value)
                                            @if($value['id'] !== $businesses['id'])
                                                <option value="{{ $value['id'] }}" @if($value['id'] === $businesses['parent_id']) selected="selected" @endif>{{ $value['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p id="parent_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="tag">商家类别 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker select-three"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            multiple data-max-options="3"
                                            title="-- 请选择 --"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#tag_error"
                                            data-parsley-required-message="请选择商家类别"
                                            >
                                        <option value="" disabled="true">-- 请选择 --</option>
                                        @foreach($classes as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p id="tag_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="turnover">营业额 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="turnover"
                                           placeholder="营业额"
                                           data-parsley-length="[2,9]"
                                           data-parsley-pattern="/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/"
                                           data-parsley-pattern-message="营业额不符合规范"
                                           data-parsley-length-message="营业额长度2~13字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入营业额"
                                           value="{{ $businesses['turnover'] }}"/>
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
                                           value="{{ $businesses['phone'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="address">商家地址 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="address"
                                           placeholder="商家地址"
                                           data-parsley-length="[6,50]"
                                           data-parsley-length-message="商家地址长度6~50字符"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入商家地址"
                                           value="{{ $businesses['address'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">选择商家经理 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#businesses_error"
                                            data-parsley-required-message="请选择角色"
                                            name="user_id">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($users as $value)
                                            <option value="{{ $value->id }}" @if($value->id == $businesses['user_id']) selected="selected" @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="businesses_error"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="description">商家描述 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" type="text" name="description"
                                              placeholder="商家描述"
                                              data-parsley-length="[1,255]"                                                                                                              data-parsley-length-message="商家描述"
                                              data-parsley-required="true"
                                              data-parsley-required-message="请输入商家描述">{{ $businesses['description'] }}
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
        $('.selectpicker2').selectpicker('render');
        /**为了默认选值**/
        var arr_select = "{{ $businesses['tag'] }}";

        if(arr_select){
            var arr = arr_select.split(',');
            $('.select-three').selectpicker('val', arr);
            $('.select-three').selectpicker('refresh');
        }else{
            $('.select-three').selectpicker('render');
        }
        /**为了默认选值**/
        function checkform(){
            tag_arr = $('.select-three').val();
            if(tag_arr && tag_arr.length > 0){
                $("#tag").val(tag_arr.join(','));
                return true;
            }else{
                return false;
            }
        }
    </script>
@endsection