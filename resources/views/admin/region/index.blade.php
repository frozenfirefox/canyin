@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <input type="hidden" id="pid" value="1">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="javascript:;">地区查看</a></li>
            <li class="active">地区查看</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">地区查看 <small>地区查看列表页面</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">列表</h4>
                    </div>
                    <div class="panel-body" id="pic">
                        <table class="table table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>首字母</th>
                                <th>地区名称</th>
                                <th>地区地域</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->

        <!--这是地区组件-->
        <modal-list :data="data_detail" :name="rname" :fname="fname" :filed="filed" ref="detail"></modal-list>
        <!--城市的区-->
        <modal-list :data="data_district" :name="rnameq" :fname="fname" :filed="filed" ref="district"></modal-list>
        <!--这是街道组件-->
        <modal-list :data="data_street" :name="rnames" :fname="fnames" :filed="fileds" ref="street"></modal-list>
        @include('admin.layouts.modal')
        @include('admin.layouts.loading')
    </div>
@endsection

@section('admin-js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.js') }}"></script>
    <script src="{{ asset('asset_admin/js/datatable.lang.js')}}"></script>
    <script src="{{ asset('asset_admin/js/region.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/vue/modal-list.js')}}"></script>
    <script>
        $(function(){
            @if (session()->has('flash_notification.file'))
                //通知信息
                $.gritter.add({
                    title: '操作消息！',
                    text: '{!! session('flash_notification.file') !!}'
                });
            @endif

            //删除
            $(document).on('click','.destroy',function(){
                var _delete_id = $(this).attr('data-id');
                swal({
                        title: "确定删除？",
                        text: "删除后将加入回收站！",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonText: "取消",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    },
                    function () {
                        $('form[name=delete_item_'+_delete_id+']').submit();
                    }
                );
            });
        });

        vue = new Vue({
            el : '#content',
            delimiters: ['${', '}'],
            data: function(){
                return {
                    now_id : '',
                    data_detail: [
                    ],
                    data_district: [],
                    rname : '',
                    rnameq: '',
                    fname: ['id', '首字母', '地区名称', '地区地域', '操作'],
                    filed: ['id', 'letter', 'region_name', 'belong_area_name', 'button'],
                    data_street: [],
                    rnames : '',
                    fnames: ['id', '街道名称', '状态'],
                    fileds: ['street_id', 'street_name', 'status'],
                    loading: false,

                }
            },
            mounted: function(){
                region(this);
            },
            methods: {
                view: function($id, $name){
                    var _this = this;
                    $.ajax({
                        url: '/admin/region/ajaxIndex',
                        type: 'get',
                        dataType: 'json',
                        data: {pid: $id, length: 10000},
                        success: function(data){
                            if(data.data){
                                _this.rname = $name;
                                _this.data_detail = [];
                                _this.data_detail = JSON.parse(JSON.stringify(data.data));
                                var my = $(_this.$refs.detail.$el);
                                 _this.$nextTick(function(){
                                    my.find('a').on('click', function(){
                                        _this.view_district($(this).attr('data-id'), $(this).attr('data-data'));
                                    });
                                    my.modal('show');
                                });
                            }else{
                                console.log(data.message);
                            }
                        }
                    });
                },
                view_district: function($pid, $name){
                    var _this = this;
                    $.ajax({
                        url: '/admin/region/ajaxIndex',
                        type: 'get',
                        dataType: 'json',
                        data: {pid: $pid, length: 10000},
                        success: function(data){
                            if(data.data){
                                _this.rnameq = $name;
                                _this.data_district = [];
                                _this.data_district = JSON.parse(JSON.stringify(data.data));
                                var my = $(_this.$refs.district.$el);
                                _this.$nextTick(function(){
                                    my.find('a').off('click').on('click', function(){
                                        _this.view_street($(this).attr('data-id'), $(this).attr('data-data'));
                                    });
                                    my.modal('show');
                                });
                            }else{
                                console.log(data.message);
                            }
                        }
                    });
                },
                view_street: function($pid, $name){
                    var _this = this;
                    $.ajax({
                        url: '/admin/region/getStreet',
                        type: 'get',
                        dataType: 'json',
                        data: {pid: $pid, length: 10000},
                        success: function(data){
                            if(data.data){
                                _this.rnames      = $name;
                                _this.data_street = [];
                                _this.data_street = JSON.parse(JSON.stringify(data.data));
                                var my = $(_this.$refs.street.$el);
                                _this.$nextTick(function(){
                                    my.modal('show');
                                });

                            }else{
                                console.log(data.message);
                            }
                        }
                    });
                }
            },
        });

    </script>

@endsection