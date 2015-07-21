    <script src="/chimporter/datatables-1.10.7/media/js/jquery.dataTables.js"></script>
    <script src="/chimporter/datatables-1.10.7/extensions/TableTools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript">
    /*$(document).ready(function() {
        var eventFired = function ( type ) {
            var n = $('#demo_info')[0];
            n.innerHTML += '<div>'+type+' event - '+new Date().getTime()+'</div>';
            n.scrollTop = n.scrollHeight;      
        }
     
        $('#example')
            .on( 'order.dt',  function () { eventFired( 'Order' ); } )
            .on( 'search.dt', function () { eventFired( 'Search' ); } )
            .on( 'page.dt',   function () { eventFired( 'Page' ); } )
            .dataTable();
        } 
    );*/

    $(document).ready(function() {
        $('#example2').DataTable( {
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "/chimporter/datatables-1.10.7/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        } );
    } );
    </script>