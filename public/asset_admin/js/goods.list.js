/**
 * 返回goods
 * @return {[type]} [description]
 */
var goods = function($this){
    $this.loading = true;
    $('#datatable_goods').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/goods/ajaxIndex",
            'data' : {
                'bid' : $('#bid').val(),
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "goods_name","name" : "goods_name","orderable" : false},
            {"data": "keyword","name": "keyword","orderable" : false},
            {"data": "goods_brief","name": "goods_brief","orderable" : false},
            {"data": "goods_desc","name": "goods_desc","orderable" : false},
            {"data": "type_name","name": "type_name","orderable" : false},
            {"data": "is_refer","name": "is_refer","orderable" : false},
            {"data": "create_time","name": "create_time","orderable" : true},
            {"data": "update_time","name": "update_time","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });
}
