
var tipschef = function(){
    $('#datatable_chef').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        "sPaginationType": "full_numbers",
        "bPaginate": false, //翻页功能
        "bLengthChange": false, //改变每页显示数据数量
        "bFilter": false, //过滤功能
        "bSort": false, //排序功能
        "bInfo": false,//页脚信息
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/tipsranking/ajaxtips",
            data: {
                bid : ($('#bid').val())?$('#bid').val():0,
                ctype :4,
            }
        },
        "columns": [
            {"data": "name","name" : "name","orderable" : false},
            {"data": "ranking","name": "ranking","orderable" : false}
        ],
        "fnRowCallback" : function(nRow, aData, iDataIndex){
        },
        "fnDrawCallback": function(){
        }
    });
}
