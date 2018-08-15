@extends('test.layouts.css')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/dropzone.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
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
        <h1 class="page-header">上传文件用法讲解 <small>上传文件用法讲解</small></h1>
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
                        <h4 class="panel-title">关于VUE简单用法简介</h4>
                    </div>
                    <div class="panel-body panel-form" id="change">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>沃天id</th>
                                    <th>沃天头衔</th>
                                    <th>沃天面试情况</th>
                                    <th>沃天走向</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data">
                                    <td>${ item.id }</td>
                                    <td>${ item.head }</td>
                                    <td>${ item.status }</td>
                                    <td>${ item.forward }</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>1.目前的项目几乎每个页面都用到了1.0的ready钩子函数，然而2.0已废弃不用，进而使用mounted替换，同时还新增了beforeMount、beforeUpdate、updated等，私以为越来越向react看齐了有木有。。

                        beforeUpdate的作用是在页面初始渲染视图之后，一旦监测到data发生变化，在变化的数据重新渲染视图之前会触发beforeUpdate钩子函数，这也是重新渲染之前最后修改数据的机会

                        updated的作用则是在data发生变化渲染更新视图之后触发。</h4>

                        <h4>2.同时废弃的还有events、$dispatch、$broadcast，官方推荐使用vuex或者全局的事件驱动，然而废弃的这些方法在vux UI框架中很多地方都有使用，无疑在项目中用到它的地方在2.0版本都会不起作用，甚至会报错。</h4>

                        <h4>3.v-ref、v-el 弃用 统一使用ref属性为元素或组件添加标记，然后通过this.$refs获取

                        例如<p ref="a"></p>   获取方法为this.$refs.a 对于自定义组件同样适用</h4>

                        <h4>4.$els 是用来获取元素DOM对象，这个也废弃不用，$refs可以起到替代性作用。</h4>

                        <h4>5.v-for循环中常用的$index、$key也已不支持使用，trackby被key属性替换。</h4>

                        <h4>6.自定义组件中的partial，弃用，这个一直没用到</h4>

                        <h4>7.新增 v-once指令</h4>

                        <h4>8.新增 propsData</h4>

                        <h4>9.新增 render</h4>


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
            <div class="col-sm-12">
                <a href="javascript:;" class="btn-default" @click="thick">点击编辑</a>
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
        <!--这是地区组件-->
        <modal-edit :data="data" :name="name" :form="form" ref="test"></modal-edit>
        @include('admin.layouts.edit')

    </div>
@endsection

@section('admin-js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="{{ asset('asset_admin/js/vue/modal-edit.js')}}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/viewerjs/dist/viewer.js') }}"></script>
    <script>
        var vue = new Vue({
        el : '#content',
        delimiters: ['${', '}'],
        data: function(){
            return {
                item : '200000',
                name : '沃天科技',
                address : '天津市南开区白堤路科技中心108号',
                phone : '4002452323',
                data: [],
                form: [
                    {id: 'email',name:'用户邮箱'},
                    {id: 'id',name:'用户id'},
                    {id: 'passwd',name:'用户密码'},
                    {id: 'repasswd',name:'用户密码确认'},
                    {id: 'role',name:'用户角色'},
                    {id: 'love',name:'用户喜好'},
                    {id: 'sum',name:'用户总结'},
                    {id: 'sum',name:'好吃的'},
                ],
                name: '创建用户页面',
            }
        },
        mounted: function(){
            this.ajaxIndex();
        },
        methods: {
            ajaxIndex: function(){
                //模拟请求取数据
                // $.ajax({
                //     url: '/path/to/file',
                //     type: 'default GET (Other values: POST)',
                //     dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                //     data: {param1: 'value1'},
                //     success: function(data){
                //         console.console.log(data);
                //     }
                // });
                var $data = [
                    {id: 1, head: '得力干将1', status: '一切顺利1', forward: '走向世界1'},
                    {id: 2, head: '得力干将2', status: '一切顺利2', forward: '走向世界2'},
                    {id: 3, head: '得力干将3', status: '一切顺利3', forward: '走向世界3'},
                    {id: 4, head: '得力干将4', status: '一切顺利4', forward: '走向世界4'},
                    {id: 5, head: '得力干将5', status: '一切顺利5', forward: '走向世界5'}
                    ];
                this.data = JSON.parse(JSON.stringify($data));
                console.log(this.data);
            },
            thick: function(){
                $(this.$refs.test.$el).modal('show');
            }
        }
    });

    </script>
@endsection