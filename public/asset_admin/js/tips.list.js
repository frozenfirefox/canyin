var tips = function($this){
    $this.loading = true;
    $('#datatable').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/tips/ajaxIndex"
        },
        "columns": [
            {"data": "id","name" : "id","orderable" : true},
            {"data": "ct_user_id","name" : "ct_user_id","orderable" : false},
            {"data": "name","name" : "name","orderable" : false},
            {"data": "ct_tuser","name": "ct_tuser","orderable" : false},
            {"data": "ct_order_id","name": "ct_order_id","orderable" : false},
            {"data": "ct_food_id","name": "ct_food_id","orderable" : false},
            {"data": "ct_target","name": "ct_target","orderable" : false},
            {"data": "ct_paytype","name": "ct_paytype","orderable" : false},
            {"data": "ct_amount","name": "ct_amount","orderable" : false},
            {"data": "ct_status","name": "ct_status","orderable" : false},
            {"data": "ct_create_time","name": "ct_create_time","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });

};