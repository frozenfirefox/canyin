var tipssetting = function($this){
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
            'url' : "/admin/tipssetting/ajaxIndex"
        },
        "columns": [
            {"data": "name","name" : "name"},
            {"data": "cts_type","name" : "cts_type","orderable" : false},
            {"data": "cts_smileflag","name": "cts_smileflag","orderable" : false},
            {"data": "cts_smilerate","name": "cts_smilerate","orderable" : false},
            {"data": "cts_smilemin","name": "cts_smilemin","orderable" : false},
            {"data": "cts_def_amount","name": "cts_def_amount","orderable" : false},
            {"data": "cts_create_time","name": "cts_create_time","orderable" : true},
            {"data": "cts_update_time","name": "cts_update_time","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });

};