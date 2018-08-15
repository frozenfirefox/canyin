var region = function($this){
    $this.loading = true;
    $('#datatable').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/region/ajaxIndex",
            data: {
                pid : ($('#pid').val())?$('#pid').val():1,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "letter","name" : "letter","orderable" : false},
            {"data": "region_name","name": "region_name","orderable" : false},
            {"data": "belong_area_name","name": "belong_area_name","orderable" : false},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "columnDefs":[
            {
                "render": function ( data, type, row ) {
                    return ' <a target="_blank" href="javascript:;" class="region" data-id="'+ row['id'] +'" data-name="'+ row['region_name'] +'('+ row['belong_area_name'] +')">查看城市</a>';
                },
                "targets": 4
            }
        ],
        "fnDrawCallback": function(){
            $('.region').on('click', function(){
                vue.view($(this).attr('data-id'), $(this).attr('data-name'));
            });
            $this.loading = false;
        }
    });
}
