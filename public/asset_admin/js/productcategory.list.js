$(document).ready(function () {
    $('#datatable').DataTable({
        "processing": true,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/productcategory/ajaxIndex",
            data: {
                'bid' : $('#bid').val()
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "goods_id","name" : "goods_id","orderable" : false},
            {"data": "name","name": "name","orderable" : false},
            {"data": "short_name","name": "short_name","orderable" : false},
            {"data": "cate_img","name": "cate_img","orderable" : false},
            {"data": "parent_id","name": "parent_id","orderable" : false},
            {"data": "min_rate","name": "min_rate","orderable" : false},
            {"data": "sort","name": "sort","orderable" : false},
            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ]
        //"columnDefs":[
        //    {
        //        "render": function ( data, type, row ) {
        //            return data +' <a target="_blank" href="'+row['path']+'"><img width="20" height="20" data-original="'+row['path']+'"src="'+row['path']+'" alt="pic"></a>';
        //        },
        //        "targets": 1
        //    }
        //]
    });


});