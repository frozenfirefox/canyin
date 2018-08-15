$(document).ready(function () {
    var lang = {
        "sProcessing": "处理中...",
        "sLengthMenu": "每页 _MENU_ 项",
        "sZeroRecords": "没有匹配结果",
        "sInfo": "当前显示第 _START_ 至 _END_ 项，共 _TOTAL_ 项。",
        "sInfoEmpty": "当前显示第 0 至 0 项，共 0 项",
        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
        "sInfoPostFix": "",
        "sSearch": "搜索:",
        "sUrl": "",
        "sEmptyTable": "没有查到数据",
        "sLoadingRecords": "载入中...",
        "sInfoThousands": ",",
        "oPaginate": {
            "sFirst": "首页",
            "sPrevious": "上页",
            "sNext": "下页",
            "sLast": "末页",
            "sJump": "跳转"
        },
        "oAria": {
            "sSortAscending": ": 以升序排列此列",
            "sSortDescending": ": 以降序排列此列"
        }};
    $('#datatable').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/comment/ajaxIndex"
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "user1_id","name" : "user1_id","orderable" : false},
            {"data": "user2_id","name": "user2_id","orderable" : false},
            {"data": "pid","name": "pid","orderable" : false},
            {"data": "content","name": "content","orderable" : false},
            {"data": "module_id","name": "module_id","orderable" : false},
            {"data": "type","name": "type","orderable" : false},

            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "status","name": "status","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}

        ]
    });


});