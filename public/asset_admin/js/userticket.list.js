var userticket = function($this){
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
            'url' : "/admin/userticket/ajaxIndex"
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "ticket_id","name" : "ticket_id","orderable" : false},
            {"data": "user_id","name": "user_id","orderable" : false},
            {"data": "status","name": "status","orderable" : false},
            {"data": "create_time","name": "create_time","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });


};