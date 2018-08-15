var file = function($this){
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
            'url' : "/admin/file/ajaxIndex",
            data: {
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "name","name" : "name","orderable" : false},
            {"data": "size","name": "size","orderable" : false},
            {"data": "ext","name": "ext","orderable" : false},
            {"data": "mime","name": "mime","orderable" : false},
            {"data": "savename","name": "savename","orderable" : false},
            {"data": "savepath","name": "savepath","orderable" : false},
            {"data": "location","name": "location","orderable" : false},
            {"data": "create_time","name": "create_time","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "columnDefs":[
            {
                "render": function ( data, type, row ) {
                    return data +' <a target="_blank" href="'+row['path']+'"><img width="20" height="20" data-original="'+row['path']+'"src="'+row['path']+'" alt="pic"></a>';
                },
                "targets": 1
            }
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }

    });

};