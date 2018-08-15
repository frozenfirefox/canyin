@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/common.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('/admin/businesses') }}">商户列表</a></li>
            <li class="active">商户信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $businesses['name'] }} 商户信息 <small> {{ $businesses['name'] }} 商户信息</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <input type="hidden" id="bid" value="{{ $id }}"/>
            <input type="hidden" id="class_type" value="{{ $class_type }}"/>
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" style="border-radius: 6px; background-color: rgb(5, 46, 82);">
                    <div class="panel-toolbar" style="border-radius: 6px; background-color: rgb(5, 46, 82);">
                            <ul style="margin-left:0;padding-left: 0;">
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 1) }" @click="select(1)">基本信息</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 2) }" @click="select(2)">商户产品分类</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 3) }" @click="select(3)">商品自定义属性</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 4) }" @click="select(4)">员工信息</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 5) }" @click="select(5)">产品信息</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 6) }" @click="select(6)">订单列表</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 7) }" @click="select(7)">商户评论</a></li>
                            </ul>
                    </div>
                </div>
                <!-- end panel -->
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" v-if="active_tab == 1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">基本信息</h4>
                    </div>


                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td width="20%">商户id</td>
                                <td>{{ $businesses['id'] }}</td>
                            </tr>
                            <tr>
                                <td>商户名称</td>
                                <td>{{ $businesses['name'] }}</td>
                            </tr>
                            <tr>
                                <td>商户分类（标签）</td>
                                <td>{{ $businesses['tag_name'] }}</td>
                            </tr>
                            <tr>
                                <td>商户手机号</td>
                                <td>{{ $businesses['phone'] }}</td>
                            </tr>
                            <tr>
                                <td>商户地址</td>
                                <td>{{ $businesses['address'] }}</td>
                            </tr>
                            <tr>
                                <td>商户经理</td>
                                <td>{{ $businesses['user_name'] }}</td>
                            </tr>
                            <tr>
                                <td>商户描述</td>
                                <td>{{ $businesses['description'] }}</td>
                            </tr>
                            <tr>
                                <td>商户创建时间</td>
                                <td>{{ $businesses['create_time'] }}</td>
                            </tr>
                            <tr>
                                <td>商户最近修改时间</td>
                                <td>{{ $businesses['update_at'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" v-if="active_tab == 2">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">商户产品分类</h4>
                    </div>
                    <div class="panel-body">

                        @if(auth('admin')->user()->can('classes.add'))
                        <a href="{{ url('admin/classes/create/bid/'.$id) }}/type/1">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 添加</button>
                        </a>
                        @endif
                        <table class="table table-bordered table-hover" id="datatable-classes">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>类别名称</th>
                                <th>商家名称</th>
                                <th>状态</th>
                                <th>描述</th>
                                <th>添加时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
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
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" id="defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">商品自定义属性</h4>
                    </div>
                    <div class="panel-body">
                        @if(auth('admin')->user()->can('goodsattr.add'))
                        <a href="{{ url('admin/goodsattr/create/bid/'.$id) }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 添加</button>
                        </a>
                        @endif
                        <table class="table table-bordered table-hover" id="datatable-goods-attr">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>商品属性名称</th>
                                <th>商品属性别名</th>
                                <th>商品属性商户</th>
                                <th>商品属性类型</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" v-if="active_tab == 4">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">员工信息</h4>
                    </div>
                    <div class="panel-body">
                        @if(auth('admin')->user()->can('staff.add'))
                        <a href="{{ url('admin/staff/create/bid/'.$id) }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 添加</button>
                        </a>
                        @endif
                        <table class="table table-bordered table-hover" id="datatable_staff">

                            <thead>
                            <tr>
                                <th>id</th>
                                <th>用户Id</th>
                                <th>手机号</th>
                                <th>商户名称</th>
                                <th>职位</th>
                                <th>父id</th>
                                <th>员工描述</th>
                                <th>添加时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" v-if="active_tab == 5">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">产品信息</h4>
                    </div>
                    <div class="panel-body">
                        @if(auth('admin')->user()->can('goods.add'))
                        <a href="{{ url('admin/goods/create/bid/'.$id) }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 添加 </button>
                        </a>
                        @endif
                        <table class="table table-bordered table-hover" id="datatable_goods">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>商品名</th>
                                <th>关键字</th>
                                <th>商品简介</th>
                                <th>商品描述</th>
                                <th>商品种类</th>
                                <th>是否推荐到封面</th>
                                <th>添加时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
                <!-- begin panel -->
                <!-- <div class="panel panel-inverse" data-sortable-id="table-basic-5"> -->
                <div class="panel panel-inverse" v-if="active_tab == 6">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" id="defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">订单列表</h4>
                    </div>
                    <div class="panel-body">
                        @if(auth('admin')->user()->can('order.add'))
                  <a href="{{ url('admin/order/create/bid/'.$id) }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 添加订单</button>
                      </a>
                        @endif
                        <table class="table table-bordered table-hover" id="datatable-order">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>订单号</th>
                                <th>商户</th>
                                <th>用户</th>
                                <th>订单类型</th>
                                <th>收货人</th>
                                <th>收货人电话</th>
                                <th>添加时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="panel panel-inverse" v-if="active_tab == 7">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" id="defaut-click" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">商户评论</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <h5>评论区</h5>
                            <div id="index_top">

                                <table class="table table-bordered table-hover">
                                    <tr v-for="(vi, key) in comment">
                                        <td>${ vi.pre } ${ vi.user1_id } :  ${ vi.content } <a href="javascript:;" @click="reback(key)">回复</a></td>
                                    </tr>
                                </table>

                                <div id="page_test">
                                    <span @click="ajaxGetComment(page.id)" :class="{ 'active' : (now_page === page.id) }" v-for="page in pagedata"> ${ page.page } </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
        @include('admin.layouts.loading')
    </div>
@endsection
@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/treeTable/jquery.treeTable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/js/datatable.lang.js')}}"></script>
    <script src="{{ asset('asset_admin/js/staff.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/goods.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/classes.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/order.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/goodsattr.list.js')}}"></script>
    <script>
        $(function(){
            var bus_id = '{{ $businesses['id']}}';
            var _token = '{{ csrf_token() }}';
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

            //这里使用vue
            var vue = new Vue({
                el : '#content',
                delimiters: ['${', '}'],
                data: function(){
                    return {
                        active_tab : 1,
                        comment: [],
                        pagenum: 0,
                        pagedata: [],
                        now_page: 1,
                        loading: false
                    }
                },
                mounted: function(){
                    this.ajaxGetComment();
                },
                methods: {
                    ajaxGetComment: function($page = 1){
                        this.loading = true;
                        this.now_page = $page;
                        $offset = ($page-1)*3;
                        var _this = this;
                        $.ajax({
                            url: '/admin/comment/pinglun',
                            type: 'post',
                            dataType: 'json',
                            data: {bus_id: bus_id,_token: _token, limit: 3, offset : $offset},
                            success: function(data){
                                if(data.status === 200){
                                    _this.pagenum = data.count;
                                    _this.ajaxPageRender();
                                    _this.comment = JSON.parse(JSON.stringify(data.data));
                                    _this.loading = false;
                                }else{
                                    console.log(data.message);
                                }
                            }
                        });
                    },
                    ajaxPageRender: function(){
                        this.pagedata = [];
                        var page = parseInt(Math.ceil(this.pagenum/3));
                        var arr = [];
                        for (var i=1;i<=page;i++){
                            arr.push({'page': "第"+i+"页", 'id': i});
                        }
                        this.pagedata = JSON.parse(JSON.stringify(arr));
                    },
                    reback: function($id){
                        var _this = this;
                        this.now_key = $id;
                        $name = this.comment[this.now_key]['user1_id'];
                        //评论回复
                        swal({
                                title: '<span style="font-size:14px;">评论回复 <a href="#">@'+ $name +'</a></span>',
                                html: true,
                                type: 'input',
                                showCancelButton: true,
                                closeOnConfirm: false,
                                confirmButtonText: "确定回复",
                                cancelButtonText: "取消回复"
                            },
                            function(inputValue){
                                if (inputValue === false) return false;
                                if (inputValue === "") {
                                    swal.showInputError("你需要输入一些话！");
                                    return false;
                                }
                                $id = _this.now_key;

                                var data = {
                                    "id"        :   _this.comment[$id]['id'],
                                    "bus_id" :   bus_id,
                                    'user2_id'  :   _this.comment[$id]['user1_id'],
                                    'user1_id'  :   _this.comment[$id]['user1_id'],
                                    'type'      :   1,
                                    '_token'    :   _token,
                                    'content'   :   inputValue
                                };
                                var data_data = data;
                                data_data.pre =  _this.comment[$id]['pre']+'──';
                                $.ajax({
                                    url: "<?php echo e(url('admin/comment/ajaxSweet')); ?>",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: data,
                                    success: function(data){
                                        if(data.status === 'success'){
                                            _this.comment.splice(_this.now_key + 1 , 0 ,  data_data);
                                            console.log(_this.comment);
                                            swal("", "回复成功" ,"success");
                                        }else{
                                            swal("", "回复不成功" ,"error");
                                        }
                                    }
                                });
                            });
                    },

                    select: function($id){
                        var _this = this;
                        _this.loading = true;
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
                                var _this = this;
                                setTimeout(function(){
                                    _this.loading = false;
                                }, 300);
                            break;
                            case 2:
                                this.$nextTick(function(){
                                    classes(this);
                                });
                            break;
                            case 3:
                                this.$nextTick(function(){
                                    goodsattr(this);
                                });
                            break;
                            case 4:
                                this.$nextTick(function(){
                                    staff(this);
                                });
                            break;
                            case 5:
                                this.$nextTick(function(){
                                    goods(this);
                                });
                            break;
                            case 6:
                                this.$nextTick(function(){
                                    order(this);
                                });
                                break;
                            default:
                                var _this = this;
                                setTimeout(function(){
                                    _this.loading = false;
                                }, 300);
                            break;
                        }
                    }
                }
            });
        });

    </script>

@endsection