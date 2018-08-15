@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="javascript:;">商户列表</a></li>
            <li class="active">商户列表</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">商户列表 <small>商户列表页面</small></h1>
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
                    <div class="panel-body" id="body">
                        @if(auth('admin')->user()->can('businesses.add'))
                        <a href="{{ url('admin/businesses/create/') }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 新增</button>
                        </a>
                        @endif
                        <table class="table table-bordered table-hover" id="treeTable">
                            <thead>
                            <tr>
                                <th width="10%">商家名称</th>
                                <th>营业额</th>
                                <th>商家电话</th>
                                <th width="15%">商家地址</th>
                                <th width="5%">商家经理</th>
                                <th width="5%">商户状态</th>
                                <th>添加时间</th>
                                <th>更新时间</th>
                                <th width="12%">操作</th>
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
    <script src="{{ asset('asset_admin/assets/plugins/treeTable/jquery.treeTable.js') }}"></script>
    <script src="{{ asset('asset_admin/js/datatable.lang.js')}}"></script>
    <script src="{{ asset('asset_admin/js/businesses.list.js')}}"></script>
    <script>
        $(function(){
            var _token = "{{ csrf_token()}}";
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

            vue = new Vue({
                el : '#content',
                delimiters: ['${', '}'],
                data: function(){
                    return {
                        now_id : '',
                        data_data : '<?php echo $status; ?>',
                        loading: false
                    }
                },
                mounted: function(){
                    businesses(this);
                    this.treeTable();
                },
                methods: {
                    update_status: function($bid, $jid){
                        $status  = $($jid).attr('data-status');
                        _this    =  this;
                        var data = $.parseJSON(this.data_data);
                        $html    = '';
                        for(var i in data){
                            $html += '<label class="radio-inline" style="font-size:15px;">';
                            $html += '<input type="radio" name="businesses_status" id="inlineRadio_'+i+'" value="'+i+'"';
                            if($status == i){
                                $html += ' checked="true"';
                            }
                            $html += '>';
                            $html += data[i];
                            $html += '</label>';
                        }

                        swal({
                            title: "<span style='font-size:18px;'>确定改变营业状态吗？</span>",
                            text: $html,
                            html: true,
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "确定",
                            closeOnConfirm: false,
                            cancelButtonText: "取消",
                        },
                        function(){
                            var $status = $('input[name="businesses_status"]:checked').val();
                            _this.ajaxReturn($bid, $status, $jid);
                        });
                    },
                    treeTable: function(){
                        var option = {
                            theme:'vsStyle',
                            expandLevel : 2,
                            beforeExpand : function($treeTable, id) {
                                if ($('.' + id, $treeTable).length) { return; }
                                $treeTable.addChilds(html);
                            },
                            onSelect : function($treeTable, id) {
                                window.console && console.log('onSelect:' + id);
                            }
                        };
                        $('#treeTable').treeTable(option);
                    },
                    ajaxReturn: function($id, $status, $jid){
                        $.ajax({
                            url: '/admin/businesses/updateSingle',
                            type: 'post',
                            dataType: 'json',
                            data: {id: $id, _token: _token, update: {status : $status}},
                            success: function(data){
                                if(data.status === 200){
                                    var data = $.parseJSON(_this.data_data);
                                    $($jid).attr('data-status', $status).text(data[$status]);
                                    swal("确定", "营业状态已改变", "success");
                                }else{
                                    console.log(data.message);
                                }
                            }
                        });
                    }
                },
            });
        });
    </script>

@endsection