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
            <li><a href="{{ url('admin/file') }}">文件列表</a></li>
            <li class="active">文件信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">修改文件信息 <small>文件详情信息</small></h1>
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
                        <h4 class="panel-title">{{ $file['name'] }}</h4>
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
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/file/'.$file['id']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="name">文件原名 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="name"
                                           placeholder="文件原名"
                                           data-parsley-length="[1,35]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入文件原名"
                                           value="{{  $file['name'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="size">文件尺寸 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="size"
                                           placeholder="文件尺寸" data-parsley-length="[1,10]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入文件尺寸"
                                           value="{{  $file['size'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="ext">扩展名 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="ext"
                                           placeholder="扩展名" data-parsley-length="[1,9]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入扩展名"
                                           value="{{  $file['ext'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="md5">文件md5 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="md5"
                                           placeholder="文件md5"
                                           data-parsley-length="[1,32]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入文件md5"
                                           value="{{  $file['md5'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="sha1">文件shal * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="sha1"
                                           placeholder="文件shal"
                                           data-parsley-length="[1,40]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入文件md5"
                                           value="{{  $file['sha1'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="mime">文件mime类型 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="mime"
                                           placeholder="文件mime类型"
                                           data-parsley-length="[1,40]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入文件mime类型"
                                           value="{{  $file['mime'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="savename">保存文件名 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="savename"
                                           placeholder="保存文件名"
                                           data-parsley-length="[1,25]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入保存文件名"
                                           value="{{  $file['savename'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="savepath">保存路径 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="savepath"
                                           placeholder="保存路径"
                                           data-parsley-length="[1,45]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入保存路径"
                                           value="{{  $file['savepath'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="role">文件保存位置 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker"
                                            data-live-search="true"
                                            data-style="btn-white"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#location_error"
                                            data-parsley-required-message="请选择文件保存位置"
                                            name="location">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($arr as $k=>$v)
                                            <option value="{{ $k }}"
                                            @if($k == $file['location']) selected="selected"
                                             @endif>{{$v}}</option>
                                        @endforeach

                                    </select>
                                    <p id="location_error"></p>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="savepath">保存路径 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="savepath"
                                           placeholder="保存路径"
                                           data-parsley-length="[1,45]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入保存路径"
                                           value="{{  $file['savepath'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="path">全相对路径 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="path"
                                           placeholder="全相对路径"
                                           data-parsley-length="[1,60]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入全相对路径"
                                           value="{{  $file['path'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="abs_url">绝对地址 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="abs_url"
                                           placeholder="绝对地址"
                                           data-parsley-length="[1,105]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入绝对地址"
                                           value="{{  $file['abs_url'] }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="oss_path">OSS服务器路径 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="oss_path"
                                           placeholder="OSS服务器路径"
                                           data-parsley-length="[1,105]"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请输入OSS服务器路径"
                                           value="{{  $file['oss_path'] }}"/>
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