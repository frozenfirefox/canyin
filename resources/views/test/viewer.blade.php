@extends('test.layouts.css')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.css') }}" rel="stylesheet" />

@endsection

@section('admin-content')
    <!--
    需要引入
        <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
        <script src="{{ asset('asset_admin/assets/plugins/dropzone/source/dropzone.js') }}"></script>
    -->
    <div id="content">
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">viewer预览图片的简单用法 <small>viewer预览图片的简单用法</small></h1>
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
                        <h4 class="panel-title">viewer预览图片的简单用法</h4>
                    </div>
                    <div class="panel-body panel-form" id="change">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>沃天id</th>
                                    <th>沃天头衔</th>
                                    <th>沃天面试情况</th>
                                    <th>沃天走向</th>
                                    <th>图片</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data">
                                    <td>${ item.id }</td>
                                    <td>${ item.head }</td>
                                    <td>${ item.status }</td>
                                    <td>${ item.forward }</td>
                                    <td><img :data-original="item.url" :src="item.url" width="50" height="50" alt="图片1"></td>
                                </tr>
                            </tbody>
                        </table>
                        <pre>
                                                                                /**
                                                                                 *　　┏┓　　　┏┓+ +
                                                                                 *　┏┛┻━━━┛┻┓ + +
                                                                                 *　┃　　　　　　　┃ 　
                                                                                 *　┃　　　━　　　┃ ++ + + +
                                                                                 * ████━████ ┃+
                                                                                 *　┃　　　　　　　┃ +
                                                                                 *　┃　　　┻　　　┃
                                                                                 *　┃　　　　　　　┃ + +
                                                                                 *　┗━┓　　　┏━┛
                                                                                 *　　　┃　　　┃　　　　　　　　　　　
                                                                                 *　　　┃　　　┃ + + + +
                                                                                 *　　　┃　　　┃
                                                                                 *　　　┃　　　┃ +  神兽保佑
                                                                                 *　　　┃　　　┃    代码无bug　　
                                                                                 *　　　┃　　　┃　　+　　　　　　　　　
                                                                                 *　　　┃　 　　┗━━━┓ + +
                                                                                 *　　　┃ 　　　　　　　┣┓
                                                                                 *　　　┃ 　　　　　　　┏┛
                                                                                 *　　　┗┓┓┏━┳┓┏┛ + + + +
                                                                                 *　　　　┃┫┫　┃┫┫
                                                                                 *　　　　┗┻┛　┗┻┛+ + + +
                                                                                 */
                        </pre>

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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.js') }}"></script>
    <script>
        var vue = new Vue({
            el : '#change',
            delimiters: ['${', '}'],
            data: function(){
                return {
                    item : '200000',
                    name : '沃天科技',
                    address : '天津市南开区白堤路科技中心108号',
                    phone : '4002452323',
                    data: [],
                }
            },
            mounted: function(){
                console.log('This is my first vue output ! ');
                this.ajaxIndex();

            },
            methods: {
                ajaxIndex: function(){
                    var $data = [
                        {id: 1, head: '得力干将1', status: '一切顺利1', forward: '走向世界1', url: '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png'},
                        {id: 2, head: '得力干将2', status: '一切顺利2', forward: '走向世界2', url: '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png'},
                        {id: 3, head: '得力干将3', status: '一切顺利3', forward: '走向世界3', url: '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png'},
                        {id: 4, head: '得力干将4', status: '一切顺利4', forward: '走向世界4', url: '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png'},
                        {id: 5, head: '得力干将5', status: '一切顺利5', forward: '走向世界5', url: '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png'}
                        ];
                    this.data = JSON.parse(JSON.stringify($data));
                    console.log(this.data);
                }
            }
        });

        vue.$nextTick(function(){
            var viewer = new Viewer(document.getElementById('change'), {
                url: 'data-original'
            });
        });


    </script>
@endsection