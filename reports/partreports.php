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

<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Pin Time Study</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Part Timing <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Cutting</a></li>
						<li><a href="#">Edgebanding</a></li>
						<li><a href="../machining.php">Machining</a></li>
						<li class="divider"></li>
						<li><a href="#">Assembly</a></li>
						<li class="divider"></li>
						<li><a href="#">Packaging</a></li>
					</ul>
				</li>
				<?php
				if($_SESSION['user_auth_level'] >= 3){
					echo "<li><a href=\"index.php\">Reports</a></li>";
				}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="../settings.php">Settings</a></li>
						<?php
						if($_SESSION['user_auth_level'] == 5){
							echo "<li class=\"divider\"></li><li><a href=\"../admin/admin.php\">Administration</a></li>";}
						?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<a href="../logout.php" class="btn btn-default navbar-btn btn-xs">Sign Out</a>
			</ul>
			<p class="navbar-text navbar-right">Signed in as <a class="navbar-link" href="../settings.php"><b><?php echo $_SESSION['user_first_name']." ".$_SESSION['user_last_name'] ?>&nbsp;</b></a></p>
		</div><!-- /.navbar-collapse -->
	</div>
</div>
<ol class="breadcrumb">
	<li><a href="..">Home</a></li>
	<li><a href="index.php">Reports</a></li>
	<li class="active">Performed Studies</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="index.php">Overview</a></li>
				<li><a href="machines.php">Machine Reports</a></li>
				<li><a href="userreports.php">User Reports</a></li>
				<li class="active"><a href="#">Performed Studies</a></li>
			</ul>
		</div>


		<div class="col-md-10 col-md-offset-2 main">
			<h2 class="page-header">Part Time Studies Completed</h2>
		</div>
		<div class="col-md-10 col-sm-offset-3 col-md-10 col-md-offset-2">
				<div class="row col-md">
					<div class="col-md-3">
						<label for="from">Date</label>
						<input type="text" id="from" name="from" required>
					</div>
					<div class="col-md-1">
						<button id="searchdate" type="button" class="btn btn-primary btn-xs">Search Date</button>
					</div>
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
							<td>Row 1 Data 1</td>
							<td>Row 1 Data 2</td>
							<td>Row 1 Data 3</td>
							<td>Row 1 Data 4</td>
							<td>Row 1 Data 5</td>
							<td>Row 1 Data 6</td>
							<td>Row 1 Data 7</td>
						</tr>
						<tr>
							<td>Row 2 Data 1</td>
							<td>Row 2 Data 2</td>
							<td>Row 2 Data 3</td>
							<td>Row 2 Data 4</td>
							<td>Row 2 Data 5</td>
							<td>Row 2 Data 6</td>
							<td>Row 2 Data 7</td>
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
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.js"></script>
<!--<script src="../assets/js/docs.min.js"></script>-->

<script>
/*
	$(document).ready( function () {
		$('#table_id').DataTable();
	});
*/
	$(document).ready(function() {
		$('#table_id').dataTable( {
			"processing": true,
			//"ajax": {
				//"url": "../ajax/updatepartsreport.php"

				"bProcessing": true,
				"sAjaxDataProp":"",
				"bServerSide": true,
				"sAjaxSource": "../ajax/updatepartsreport.php"


			//}
		} );
	} );
	
	
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var myDate = new Date();
	todaysDate = ( months[(myDate.getMonth())] + '-' + (myDate.getDate()) + '-' + (myDate.getFullYear()));
	var oneWeekAgo = new Date();
	oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
	var start_date = ( months[(oneWeekAgo.getMonth())] + '-' + (oneWeekAgo.getDate()) + '-' + (oneWeekAgo.getFullYear()));


	$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			dateFormat:"dd M yy",
			changeMonth: true,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	});

	$( ".do_action" ).on( "click", "[id = searchdate]", function() {
		var start_date = $( "#from" ).val();
		start_date=start_date.split(" ");
		var newStartDate=start_date[1]+"-"+start_date[0]+"-"+start_date[2];
		alert(newStartDate);
	});

</script>
</body>
</html>