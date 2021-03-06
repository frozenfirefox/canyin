
var businesses = function(callback){
    _this = this;
    $('#treeTable').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/tipsranking/ajaxIndex",
            data:{
                 is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "name","name" : "name","orderable" : false},
            {"data": "turnover","name": "turnover","orderable" : false},
            {"data": "phone","name": "phone","orderable" : false},
            {"data": "address","name": "address","orderable" : false},
            {"data": "manage_name","name": "manage_name","orderable" : false},
            {"data": "status","name": "status","orderable" : false},
            {"data": "create_time","name": "create_time","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnRowCallback" : function(nRow, aData, iDataIndex){
            //为了能够用tree table
            $(nRow).attr('pId', aData.parent_id);
        },
        "fnDrawCallback": function(){
            if(callback){
                callback.apply();
            }
        }
    });
}
