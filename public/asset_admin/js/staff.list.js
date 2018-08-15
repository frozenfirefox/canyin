/**
 * 返回js
 * @return {[type]} [description]
 */
var staff = function($this){
    $this.loading = true;
    $('#datatable_staff').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/staff/ajaxIndex",
            'data' : {
                'bid' : $('#bid').val(),
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "name","name" : "name","orderable" : false},
            {"data": "phone","name": "phone","orderable" : false},
            {"data": "businesses_name","name": "businesses_name","orderable" : false},
            {"data": "position","name": "position","orderable" : false},
            {"data": "parent_id","name": "parent_id","orderable" : false},
            {"data": "description","name": "description","orderable" : false},
            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
             $this.loading = false;
        }
    });
};

