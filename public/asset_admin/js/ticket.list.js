var ticket = function($this){
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
            'url' : "/admin/ticket/ajaxIndex"
        },
        "columns": [
            {"data": "ticket_code","name" : "ticket_code","orderable" : false},
            {"data": "ticket_name","name": "ticket_name","orderable" : false},
            {"data": "ticket_desc","name": "ticket_desc","orderable" : false},
            {"data": "true_use_num","name": "true_use_num","orderable" : false},
            {"data": "use_num","name": "use_num","orderable" : false},
            {"data": "start_time","name": "start_time","orderable" : true},
            {"data": "end_time","name": "end_time","orderable" : true},
            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });


};