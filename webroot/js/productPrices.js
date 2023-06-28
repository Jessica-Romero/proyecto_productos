//Products table
if(document. getElementById("products-datatable")) {
    var table = $('#products-datatable').DataTable({
        "dom": 'fBrltip',
        "responsive": true,
        "autoWidth": false,
        "scrollX": true,
        buttons : [
            {
                extend:    'csv',
                text:      '<i class="far fa-file-excel"></i>',
                titleAttr: 'CSV',
                className: 'btn btn-default',
            },
            {
                extend:    'print',
                text:      '<i class="far fa-file-pdf"></i>',
                titleAttr: 'PDF',
                className: 'btn btn-default',
            },
            {
                extend:    'colvis',
                className: 'btn btn-default',
            }]
    }).buttons().container().appendTo('#products-datatable_wrapper .col-md-6:eq(0)');

    $('#products-datatable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
}
