var goodsattr = function($this){
    $this.loading = true;
    $('#datatable-goods-attr').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/goodsattr/ajaxIndex",
            'data' : {
                'bid' : $('#bid').val(),
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,

            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "goods_attr_value","name" : "goods_attr_value","orderable" : false},
            {"data": "goods_attr_id","name": "goods_attr_id","orderable" : false},
            {"data": "businesses_name","name": "businesses_name","orderable" : false},
            {"data": "type_name","name": "type_name","orderable" : false},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            $this.loading = false;
        }
    });
}
