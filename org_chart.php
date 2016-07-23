<?php

require_once 'includes/init.php';

$data = generate_tree();
$test = json_encode($data);
// print_r($test);
// exit;

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Authentication App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style>
    	div.dataTables_processing { z-index: 1; }
    </style>
  </head>
  <body>
  	<div class="container-fluid">
	  	<table id="example" class="table table-striped table-bordered">
			<thead class="thead-inverse">
	  			<tr>
	  				<th>ID</th>
	  				<th>Employee Name</th>
	  				<th>Boss Name</th>
	  				<th>Distance from CEO</th>
	  				<th># of Subordinates</th>
	  			</tr>
	  		</thead>
	  		<tfoot>
	  			<tr>
	  				<th>ID</th>
	  				<th>Employee Name</th>
	  				<th>Boss Name</th>
	  				<th>Distance from CEO</th>
	  				<th># of Subordinates</th>
	  			</tr>
	  		</tfoot>
	  	</table>
	  </div>
  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
	    $('#example').DataTable( {
		    data: <?php print $test;?>,
		    processing: true,
		    "bProcessing": true,
		    initComplete: function(settings, json) {
				alert( 'DataTables has finished its initialisation.' );
			},
		    columns: [
		    	{ data: 'id' },
		        { data: 'name' },
		        { data: 'bossName' },
		        { data: 'depth' },
		        { data: 'numEmployees' }
		    ]
		} );
	} );

    </script>
  </body>
</html>