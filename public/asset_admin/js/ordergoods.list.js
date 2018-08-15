var orderlist = function(callback){
    $('#datatable-order').DataTable({
        "processing":false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/ordergoods/ajaxIndex",
            data: {
                'oid' : $('#oid').val()
            }
        },
        "columns": [
            {"data": "merchant_name","name": "merchant_name","orderable" : false},
            {"data": "settlement_price","name": "settlement_price","orderable" : false},
            {"data": "shop_price","name": "shop_price","orderable" : false},
            {"data": "market_price","name": "market_price","orderable" : false},
            {"data": "goods_num","name": "goods_num","orderable" : true},
            {"data": "total","name": "total","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnDrawCallback": function(){
            if(callback){
                callback.apply();
            }
        }

    });
}