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
            <li><a href="{{ url('admin/businesses/info/id/'.$goods['merchant_id']) }}">{{ $goods['businesses_name'] }}</a></li>
            <li class="active">产品信息</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $goods['goods_name'] }} 信息 <small>{{ $goods['goods_name'] }} 详细信息</small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-toolbar" style="border-radius: 6px; background-color: rgb(5, 46, 82);">
                        <ul style="margin-left:0;padding-left: 0;">
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 1) }" @click="select(1)">商品信息</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 2) }" @click="select(2)">价格体系</a></li>
                            <li><a href="javascript:;" class="btn btn-sm  btn-default" :class="{ 'btn-primary' : (active_tab === 3) }" @click="select(3)">商品评论</a></li>
                        </ul>
                    </div>
                    <input type="hidden" id="goods_id" value="{{ $goods['id'] }}" />

                    <div class="panel panel-inverse" v-if="active_tab == 1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">{{ $goods['goods_name'] }}商品信息</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <th width="20%">产品名称</th>
                                    <td>{{ $goods['goods_name'] }}</td>
                                </tr>
                                <tr>
                                    <th>产品关键字</th>
                                    <td>{{ $goods['keyword'] }}</td>
                                </tr>
                                <tr>
                                    <th>产品简介</th>
                                    <td>{{ $goods['goods_brief'] }}</td>
                                </tr>
                                <tr>
                                    <th>产品描述</th>
                                    <td>{{ $goods['goods_desc'] }}</td>
                                </tr>
                                <tr>
                                    <th>产品类型</th>
                                    <td>{{ $goods['goods_typeid'] }}</td>
                                </tr>
                                <tr>
                                    <th>创建时间</th>
                                    <td>{{ $goods['create_time'] }}</td>
                                </tr>
                                <tr>
                                    <th>最近修改时间</th>
                                    <td>{{ $goods['update_time'] }}</td>
                                </tr>
                                <tr>
                                    <th>产品图片</th>
                                    <td>
                                        @if($path_img)
                                            <img data-original="{{$path_img}}" src="{{$path_img}}" style="width: 80px;height: 80px;border-radius: 25px"/>
                                        @else
                                            暂无图片
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>产品图片集</th>
                                    <td>
                                        @if(!empty($gallery))
                                            @foreach($gallery as $k => $v )
                                                <img data-original="{{$v}}" src="{{$v}}" style="width: 80px;height: 80px;border-radius: 25px"/>
                                            @endforeach
                                        @else
                                            暂无图片
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
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
                            <h4 class="panel-title">价格体系</h4>
                        </div>
                        <div class="panel-body" id="gallery">
                            <h5>价格体系 &nbsp;
                                <a href="{{ url('admin/goodsprice/create/gid/'.$goods['id']) }}" target="_blank">
                                    <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i>添加价格</button>
                                </a>
                            </h5>
                            <table class="table table-bordered table-hover" id="datatable_goods_price">
                                <thead>
                                <tr>
                                    <th>商品规格</th>
                                    <th>结算价格</th>
                                    <th>销售价格</th>
                                    <th>市场价</th>
                                    <!-- <th>商品重量单位</th>
                                    <th>无优价</th>
                                    <th>优享价</th>
                                    <th>积分价格</th>
                                    <th>红券使用比例(单位%)</th>
                                    <th>红券返积分</th>
                                    <th>黄券使用比例 (%)</th>
                                    <th>黄券返积分</th>
                                    <th>蓝券使用比例(%)</th> -->
                                    <th>创建时间</th>
                                    <th>修改时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    {{--begin--}}
                    <div class="panel panel-inverse"  v-if="active_tab === 3">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">评论</h4>
                        </div>
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
                    {{--end--}}
                    <!-- end panel --!>
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
    <script src="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/js/datatable.lang.js')}}"></script>
    <script src="{{ asset('asset_admin/js/classes.list.js')}}"></script>
    <script src="{{ asset('asset_admin/js/goodsprice.list.js')}}"></script>
    <script>
        $(function(){
            var _token = "{{ csrf_token()}}";
            var goods_id = "{{ $goods['id'] }}";
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
                        now_key : 0,
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
                            data: {goods_id: goods_id,_token: _token, limit: 3, offset : $offset},
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
                                    "goods_id" :   goods_id,
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
                                    var _this = this;
                                    goodsprice(function(){
                                        _this.loading = false;
                                    });
                                });
                                break;
                            case 3:
                                var _this = this;
                                setTimeout(function(){
                                    _this.loading = false;
                                }, 300);
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