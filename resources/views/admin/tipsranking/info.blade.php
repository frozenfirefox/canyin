@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/tipsranking') }}">打赏排行</a></li>
            <li class="active">商户信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $busname}} 信息 <small>{{ $busname}} 详细信息</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-toolbar" style="border-radius: 6px; background-color: rgb(5, 46, 82);">
                        <ul style="margin-left:0;padding-left: 0;">
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 1) }" @click="select(1)">服务员排行</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 2) }" @click="select(2)">厨师排行</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 3) }" @click="select(3)">菜品排行</a></li>
                        </ul>
                    </div>
                    <input type="hidden" id="bid" value="{{ $busid }}" />

                    <div class="panel panel-inverse" v-if="active_tab == 1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">服务员排行</h4>
                        </div>
                        <div class="panel-body" id="gallery">
                            <table class="table table-bordered table-hover" id="datatable_waiter">
                                <thead>
                                <tr>
                                    <th>服务员</th>
                                    <th>打赏次数</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>


                    <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                    <div class="panel panel-inverse" v-if="active_tab == 2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">厨师排行</h4>
                        </div>
                        <div class="panel-body" id="gallery">
                            <table class="table table-bordered table-hover" id="datatable_chef">
                                <thead>
                                <tr>
                                    <th>厨师</th>
                                    <th>打赏次数</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->


                    <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                    <div class="panel panel-inverse" v-if="active_tab == 3">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">菜品排行</h4>
                        </div>
                        <div class="panel-body" id="gallery">
                            <table class="table table-bordered table-hover" id="datatable_goods">
                                <thead>
                                <tr>
                                    <th>菜品</th>
                                    <th>打赏次数</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/js/datatable.lang.js')}}"></script>
    <script src="{{ asset('asset_admin/js/tipsranking_waiter.js')}}"></script>
    <script src="{{ asset('asset_admin/js/tipsranking_chef.js')}}"></script>
    <script src="{{ asset('asset_admin/js/tipsranking_goods.js')}}"></script>
    <script>
        $(function(){
            @if (session()->has('flash_notification.message'))
                //通知信息
                $.gritter.add({
                    title: '操作消息！',
                    text: '{!! session('flash_notification.message') !!}'
                });
            @endif

            //删除
            $(document).on('click','.destroy',function(){
                var _delete_id = $(this).attr('data-id');
                swal({
                        title: "确定删除？",
                        text: "删除将不可逆，请谨慎操作！",
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

            var viewer = new Viewer(document.getElementById('gallery'), {
                url: 'data-original'
            });

            //这里使用vue
            var vue = new Vue({
                el : '#content',
                delimiters: ['${', '}'],
                data: function(){
                    return {
                        active_tab : 1,
                        comment:[],
                    }
                },
                mounted: function(){
                    this.$nextTick(function(){
                        tipswaiter();
                    });
                },
                methods: {
                    select: function($id){
                        if($id !== this.active_tab){
                            this.active_tab = $id;
                            this.switch_case();
                        }else{
                            setTimeout(function(){
                                swal({
                                    title: "刷新成功！",
                                    timer: 500,
                                    showConfirmButton: false,
                                });
                            }, 500);
                        }
                    },
                    switch_case: function(){
                        switch(this.active_tab){
                            case 1:
                                  this.$nextTick(function(){
                                    tipswaiter();
                                  });
                                break;
                            case 2:
                                this.$nextTick(function(){
                                    tipschef();
                                });
                                break;
                            case 3:
                                this.$nextTick(function(){
                                    tipsgoods();
                                });
                                break;
                            default:
                                //todo
                                break;
                        }
                    }
                }
            });

        });
    </script>

@endsection