<?php
require_once 'includes/dbConnect.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PIN Time Study</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Pin Time Study</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Part Timing <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="cutting.php">Cutting</a></li>
							<li><a href="machining.php">Machining</a></li>
							<li><a href="edgebanding.php">Edgebanding</a></li>
							<li class="divider"></li>
							<li><a href="#">Assembly</a></li>
							<li class="divider"></li>
							<li><a href="#">Packaging</a></li>
						</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Login</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings</a></li>
							<li><a href="#">Another action</a></li>
							<li class="divider"></li>
							<li><a href="./admin/admin.php">Administration</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Machining</li>
	</ol>
	<div class="container-fluid">
		<!-- Stack the columns on mobile by making one full-width and the other half-width -->
		<div class="row">
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-5"><h4>Parent Part Number:</h4></div>
					<div class="col-md-6"><input type="text" class="form-control" placeholder="Enter part number"></div>
				</div>
				<ul class="tree">
					<li>Thing <span>Hello world</span>
						<ul>
							<li>Sub Thing 1 <span>Hello world</span></li>
							<li>
								Sub Thing 2 <span>Hello world</span>
								<ul>
									<li>Sub Sub Thing A <span>Hello world</span></li>
									<li>Sub Sub Thing B <span>Hello world</span></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>Other Thing <span>Hello world</span></li>
					<li>Other Thing <span>Hello world</span></li>
				</ul>
			</div>
			<div class="col-md-7">
				<div class="row">
					<table class="table table-hover">
						<tr>
							<th>Work Center</th>
							<th>Machine</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
						<?php
						$result = mysqli_query($db,"SELECT * FROM timestudy.workcenter ORDER BY center ASC");

						while($row = mysqli_fetch_array($result)) {
							$mid =  $row['id'];
							$wc = $row['center'];
							$mName = $row['name'];
							$mType = $row['type'];
							if ($mType == 1) {
								$mType = "Machining Center";
							}else{
								$mType = "Edgebander";
							}

							echo "<tr class=\"clickableRow\" id=\"$mid\"><td>".$wc."</td><td>".$mName."</td><td>No Time</td><td>".$mType."</td></tr>";
						}
						mysqli_close($db);
						?>
					</table>
				</div>
			
			</div>
		</div>
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(".tree li:has(ul)").addClass("parent").click(function(event) {
			$(this).toggleClass("open");
			event.stopPropagation();
		});
	</script>
</body>
</html>