@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/common.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('admin-content')

    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="javascript:;">评论列表</a></li>
            <li class="active">评论列表</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">评论列表 <small>评论列表页面</small></h1>
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
                    <div class="panel-body">


                        @if(auth('admin')->user()->can('comment.add'))
                        <a href="{{ url('admin/comment/create') }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 新增</button>
                        </a>
                        @endif
                        <div id="index_top">
                            @foreach($module_id as $v1)
                                <div class="table table-bordered table-hover" id="name_{{ $v1['id']  }}_top">
                                        <div  class="comment_div" style="line-height: 60px;margin-left: 300px">订单编号：{{$v1['order_sn'] }}
                                            <a id="11" style="cursor:pointer;float: right;margin-right: 300px" onclick="javascript:huifu(JSON.stringify({{ json_encode($v1)}}), 'name_{{ $v1['id']  }}_top', 1);">回复

                                            </a>
                                        </div>
                                        <div id="content_md">
                                            @foreach($v1['data'] as $v)
                                                <div style="line-height: 30px;margin-left: 300px"  id="name_{{ $v1['id']  }}_{{ $v['id']  }}">{{ $v['pre'] }}{{$v['user1_id']}}：<span>{{ $v['content'] }}</span>
                                                    <a style="cursor:pointer;float: right;margin-right: 300px" onclick="javascript:huifu(JSON.stringify({{ json_encode($v)}}),'name_{{ $v1['id']  }}_{{ $v['id']  }}');">回复
                                                    </a>
                                                </div>
                                            @endforeach
                                                {{--ajax分页--}}
                                                <div id="page" data-mid="1">下一页</div>
                                                {{--ajax分页--}}
                                        </div>
                                </div>
                            @endforeach
                        </div>
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
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script>
                var _token = "{{ csrf_token()}}";
                function huifu($params,$id, $status){
                    var $params_arr = JSON.parse($params);
                    swal({
                            title: '<span style="font-size:14px;">评论回复 <a href="#">@'+$params_arr['user1_id']+'</a></span>',
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
                            if( !($params_arr['user2_id'])){
                                        $params_arr['module_id'] = $params_arr['id'];
                                        $params_arr['user2_id']  = "";
                                        $params_arr['type']      = "";
                            }else{
                                $params_arr['user2_id']  = "";
                            }
                            $.ajax({
                                url: '{{ url('admin/comment/ajaxSweet') }}',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                        "id"        :   $params_arr['id'],
                                        "module_id" :   $params_arr['module_id'],
                                        'user2_id'  :   $params_arr['user1_id'],
                                        'user1_id'  :   $params_arr['user1_id'],
                                        'type'      :   $params_arr['type'],
                                        '_token'    :   _token,
                                        'content'   :   inputValue
                                },
                                success: function(data){
                                    if(data === 200){
                                        if($status){
                                            $('#'+$id).append('<div style="line-height: 30px;margin-left: 300px">'+'{{ $v['pre'] }}{{$v['user1_id']}}：'+inputValue+' <a style="cursor:pointer;float: right;margin-right: 300px" onclick="javascript:huifu(JSON.stringify({{ json_encode($v) }}),  this);">回复</a></div>');
                                        }else{
                                            $('#'+$id).after('<div style="line-height: 30px;margin-left: 300px">'+'{{ $v['pre'] }}{{$v['user1_id']}}：'+ inputValue+' <a style="cursor:pointer;float: right;margin-right: 300px" onclick="javascript:huifu(JSON.stringify({{ json_encode($v) }}),  this);">回复</a></div>');
                                        }
                                        swal("", "回复成功" ,"success");
                                    }else{
                                        swal("", "回复不成功" ,"error");
                                    }
                                }
                            });
                        }
                    );
                }
                $(function(){
                    @if (session()->has('flash_notification.comment'))
                //通知信息
                $.gritter.add({
                    title: '操作消息！',
                    text: '{!! session('flash_notification.commment') !!}'
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
        });

        {{--AJAX分页--}}
        //ajax分页开始
        $("#page").click(function(){
            {{--var _token = "{{ csrf_token()}}";--}}
            var ts = 2;//每页显示的条数
            var page = 1;//当前页
            var module_id = $(this).data('mid');
            $.ajax({
            url: '{{ url('admin/comment/ajaxPage') }}',
            type: 'post',
            dataType: 'json',
            data:{
                "page"     :page,
                "ts"       :ts,
                "module_id":module_id,
                "_token"    :   _token
            },//page是显示的页数；ts是显示的条数
            success: function(data){
                var content_mm ="";
                for(var j in data){
                    console.log(data[j].user1_id);
                    var middle = "name_"+(data[j].module_id)+"_"+(data[j].id);
            content_mm += ' <div style="line-height: 30px;margin-left: 300px"  id="name_'+(data[j].module_id)+'_'+(data[j].id)+'">'+(data[j].pre)+(data[j].user1_id)+'：'+(data[j].content) +'<a style="cursor:pointer;float: right;margin-right: 300px" onclick="javascript:huifu(JSON.stringify({{ json_encode($v)}}),'+ middle +');">回复 </a> </div>';

                }
                var content = $("#content_md").html(content_mm);
            }
            })  ;
        });
            </script>



@endsection