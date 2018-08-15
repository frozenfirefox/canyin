var order = function($this){
    $this.loading = true;
    $('#datatable-order').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/order/ajaxIndex",
            data: {
                bid : ($('#bid').val())?$('#bid').val():0,
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "order_sn","name" : "order_sn","orderable" : false},
            {"data": "businesses_name","name": "businesses_name","orderable" : false},
            {"data": "user_name","name": "user_name","orderable" : false},
            {"data": "order_type","name": "order_type","orderable" : false},
            {"data": "receiver","name": "receiver","orderable" : false},
            {"data": "phone","name": "phone","orderable" : false},
            {"data": "create_time","name": "create_time","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });
};