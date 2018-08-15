
var businesses = $('#datatable').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/adminuser/ajaxIndex"
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "name","name" : "name","orderable" : false},
            {"data": "email","name": "email","orderable" : false},
            {"data": "role","name": "role","orderable" : false},
            {"data": "created_at","name": "created_at","orderable" : true},
            {"data": "updated_at","name": "updated_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ]
    });