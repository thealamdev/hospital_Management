    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#test_table thead th:eq(1)').each( function () {
      var title = $('#test_table tfoot th').eq( $(this).index() ).text();
      $(this).html( '<input class="form-control" type="text" placeholder=" Patient Id" />' );
    } );




    // DataTable
    var table = $('#test_table').DataTable();

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
      $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
        table
        .column( colIdx )
        .search( this.value )
        .draw();
      } );
    } );
  });