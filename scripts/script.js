$(document).ready( function () {
    $('.myTable').DataTable();
} );

$(document).ready(function() {
    $('#top10').DataTable( {
        "order": [[ 1, "desc" ]],
        "paging": false,
    } );
} );