
var classes = function($this){
    $this.loading = true;
    $('#datatable-classes').DataTable({
        "processing": false,
        'language':lang,
        "serverSide": true,
        'searchDelay':300,//搜索延时
        "sPaginationType": "full_numbers",
        'search':{
            regex : true//是否开启模糊搜索
        },
        "ajax": {
            'url' : "/admin/classes/ajaxIndex",
            data: {
                bid : ($('#bid').val())?$('#bid').val():0,
                ctype : ($('#class_type').val())?$('#class_type').val():0,
                is_dash : ($('#is_dash').val())?$('#is_dash').val():0,
            }
        },
        "columns": [
            {"data": "id","name" : "id"},
            {"data": "name","name" : "name","orderable" : false},
            {"data": "businesses_name","name": "businesses_name","orderable" : false},
            {"data": "status_name","name": "status_name","orderable" : false},
            {"data": "description","name": "description","orderable" : false},
            {"data": "create_at","name": "create_at","orderable" : true},
            {"data": "update_at","name": "update_at","orderable" : true},
            {"data": "button","name": "button",'type':'html',"orderable" : false}
        ],
        "fnRowCallback" : function(nRow, aData, iDataIndex){
            //为了能够用tree table
            $(nRow).attr('pId', aData.parent_id);
        },
        "fnDrawCallback": function(){
            var option = {
                theme:'vsStyle',
                expandLevel : 2,
                beforeExpand : function($treeTable, id) {
                    if ($('.' + id, $treeTable).length) { return; }
                    $treeTable.addChilds(html);
                },
                onSelect : function($treeTable, id) {
                    window.console && console.log('onSelect:' + id);
                }
            };
            $('#datatable-classes').treeTable(option);
            $this.loading = false;
        }
    });

}
