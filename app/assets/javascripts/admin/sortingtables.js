 $(document).ready(function() {
 	var table_default = {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 3 ] },
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
        [15, 30, 50, -1],
        [15, 30, 50, "All"]
    ],
    
    "fnPreDrawCallback": function (oSettings, json) {
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_length select').addClass('form-control');
        $('.dataTables_filter input').attr('placeholder', 'Search');
    }
   };
    
        $('#PatrolTable').dataTable(table_default);
     
});
    
    
