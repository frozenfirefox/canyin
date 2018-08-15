/**
 * 返回goodsprice
 * @return {[type]} [description]
 */
var goodsprice = function(callback){
    $('#datatable_goods_price').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/goodsprice/ajaxIndex",
            'data' : {
                'gid' : ($('#goods_id').val())?$('#goods_id').val():0
            }
        },
        "columns": [
            {"data": "goods_specification","name" : "goods_specification"},
            {"data": "settlement_price","name" : "settlement_price","orderable" : false},
            {"data": "shop_price","name": "shop_price","orderable" : false},
            {"data": "market_price","name": "market_price","orderable" : false},
            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            if(callback){
                callback.apply();
            }
        }
    });
}