//Products table
if(document. getElementById("products-datatable")) {
    var table = $('#products-datatable').DataTable({
        "dom": 'fBrltip',
        "responsive": true,
        "autoWidth": false,
        "scrollX": true,
        buttons : [
            {
                text: '<i class="fas fa-filter"></i>',
                titleAttr: 'Filter',
                attr: { id: 'products-filter' },
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    $("#products-filter").ControlSidebar('toggle');
                    //this.column( 2 )
                    //    .search( 'Done', true, false )
                    //    .draw();
                }
            },
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
                text: '<i class="fas fa-user-check"></i>',
                titleAttr: 'Reasign',
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    let rows = document.querySelectorAll('#products-datatable tr.selected');
                    var items = [];
                    rows.forEach(function(item) {
                        items.push($(item).data('row'))
                    });
                }
            },
            {
                text: '<i class="fas fa-flag"></i>',
                titleAttr: 'Change status',
                className: 'btn btn-default',
                action: function ( e, dt, node, config ) {
                    let rows = document.querySelectorAll('#products-datatable tr.selected');
                    var items = [];
                    rows.forEach(function(item) {
                        items.push($(item).data('row'))
                    });

                    $('#products-selected-change-status').html(items.length);
                    $('#modal-items-change-status').val(JSON.stringify(items));
                    $('#modal-change-status-tasks').modal('show');

                }
            },
            {
                extend:    'colvis',
                className: 'btn btn-default',
            }]
    }).buttons().container().appendTo('#products-datatable_wrapper .col-md-6:eq(0)');

    $('#products-datatable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });

    //Products filter
    if(document.getElementById("products-filter")){
        function handleFilterExpandedEvent(e) {
            //sidebar expanded
        }

        $('#products-filter').on('expanded.lte.controlsidebar', handleFilterExpandedEvent)

        //Filters
        $("#products-filters-apply").click(function(ev){
            ev.preventDefault();
            var dt = $('#products-datatable').DataTable();
            //column 3 - Brand
            if($('select[name=brand_id]').val() > 0){
                var brand = $('select[name=brand_id] option:selected').text();
                dt.column(3).search( brand, true, false ).draw();
            }else{
                dt.column(3).search( "", true, false ).draw();
            }
        });
    }

}
