<?php
require_once '../includes/dbConnect.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PIN Time Study</title>

	<!-- Bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">

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
			<a class="navbar-brand" href="..">Pin Time Study</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Operations <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="users.php">Users</a></li>
						<li><a href="machines.php">Machines</a></li>
						<li><a href="parts.php">Parts</a></li>
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
						<li><a href="admin.php">Administration</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<ol class="breadcrumb">
	<li><a href="..">Home</a></li>
	<li><a href="admin.php">Administration</a></li>
	<li class="active">Users</li>
</ol>
<div class="container-fluid">
	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6"><h3>Add User:</h3></div>

			</div>
			<Form action="">
				<div class="row">
					<div class="col-md-4"><h4>First Name:</h4></div>
					<div class="col-md-4"><input type="text" class="form-control" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Last Name:</h4></div>
					<div class="col-md-4"><input type="text" class="form-control" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Email:</h4></div>
					<div class="col-md-4"><input type="text" class="form-control" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Password:</h4></div>
					<div class="col-md-4"><input type="text" class="form-control" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Access Level:</h4></div>
					<div class="col-md-4">
						<select class="form-control" name="type">
							<option value="1">Operator</option>
							<option value="5">Admin</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>User Active:</h4></div>
					<div class="col-md-4">
						<input type="radio" name="yes" value="yes">Yes <input type="radio" name="no" value="no">NO
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<button type="button" class="btn btn-default" name="submit">Add User</button>
					</div>
				</div>


			</Form>
		</div>
		<div class="col-md-6">
			<div class="row">
				<table class="table table-hover">
					<tr>
						<th>id</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Active</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Shawn</td>
						<td>Brunson</td>
						<td>sbrunson@pin.com</td>
						<td>Yes</td>
					</tr>
				</table>
			</div>

		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
	$(".tree li:has(ul)").addClass("parent").click(function(event) {
		$(this).toggleClass("open");
		event.stopPropagation();
	});
</script>
</body>
</html>
