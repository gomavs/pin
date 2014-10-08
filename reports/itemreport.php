<?php
require '../includes/check_login.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Pin Time Study</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../css/dashboard.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../css/sb-admin-2.css" rel="stylesheet">
	<link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/jquery-ui.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
	<!--<link href="../css/jquery-ui.structure.css" rel="stylesheet">-->
	<link href="../css/jquery-ui.theme.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
<?php
include '../includes/navbar.php';
?>
<ol class="breadcrumb">
	<li><a href="..">Home</a></li>
	<li><a href="index.php">Reports</a></li>
	<li class="active">Part Times</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-2 main">
			<h2 class="page-header">Part Times</h2>
		</div>
		<div class="col-md-12">
				<div class="row col-md-12 bottom_fix">
					<form method = "POST">
						<div class="col-md-2"><label>Part Number:</label></div>
						<div class="col-md-3"><input type="text" class="form-control" name="partnumber" id="autocomplete" autofocus placeholder="Enter part number"><input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/></div>
					</form>
					<!--<div class="col-md-2 do_action">
						<button id="searchdate" type="button" class="btn btn-primary">Search Part</button>
					</div>-->
				</div>
			</form>
			<div class="row col-md-12">
				<table id="table_id" class="display">
					<thead>
						<tr>
							<th>Part Number</th>
							<th>Part Description</th>
							<th>Parent Number</th>
							<th>Work Center</th>
							<th>Machine</th>
							<th>Date</th>
							<th>Time</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.js"></script>
<!--<script src="../assets/js/docs.min.js"></script>-->

<script>
	
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var myDate = new Date();
	todaysDate = ( months[(myDate.getMonth())] + '-' + (myDate.getDate()) + '-' + (myDate.getFullYear()));
	var oneWeekAgo = new Date();
	oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
	var start_date = ( months[(oneWeekAgo.getMonth())] + '-' + (oneWeekAgo.getDate()) + '-' + (oneWeekAgo.getFullYear()));
	table_fill(start_date, todaysDate);
	
	$(function(){
		$('#autocomplete').autocomplete({
			serviceUrl:"../ajax/search.php",
			onSelect: function(suggestion) {
			}
		});
	});
	
	
	var table;

	$( ".do_action" ).on( "click", "[id = searchdate]", function() {
		var start_date = $( "#from" ).val();
		var end_date = end_date = $( "#to" ).val();
		start_date=start_date.split(" ");
		var newStartDate=start_date[1]+"-"+start_date[0]+"-"+start_date[2];
		end_date=end_date.split(" ");
		var newEndDate=end_date[1]+"-"+end_date[0]+"-"+end_date[2];
		table.destroy();
		
		table_fill(newStartDate, newEndDate);
	});
	
	function table_fill(startDate, endDate){
		$(document).ready(function() {
			table = $('#table_id').DataTable( {
				//"processing": true,
				"bProcessing": true,
				"sAjaxDataProp":"",
				//"bServerSide": true,
				"ajax": "../ajax/updatepartsreport.php?starttime=" + startDate + "&endtime=" + endDate,
				"columns": [
					{ "data": "Part Number" },
					{ "data": "Part Description" },
					{ "data": "Parent Number" },
					{ "data": "Work Center" },
					{ "data": "Machine" },
					{ "data": "Date" },
					{ "data": "Time" }
				]
			} );
		} );
	};

</script>
</body>
</html>