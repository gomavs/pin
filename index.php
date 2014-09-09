<?php
require_once 'includes/dbConnect.php';
include 'includes/sessionstatus.php';
echo $_SESSION['FIRST_NAME'];

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
			<a class="navbar-brand" href="#">Pin Time Study</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Part Timing <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Cutting</a></li>
						<li><a href="machining.php">Machining</a></li>
						<li><a href="#">Edgebanding</a></li>
						<li class="divider"></li>
						<li><a href="#">Assembly</a></li>
						<li class="divider"></li>
						<li><a href="#">Packaging</a></li>
					</ul>
				</li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings</a></li>
						<?php
						if($_SESSION['AUTH_LEVEL'] == 5){
						 echo "<li class=\"divider\"></li><li><a href=\"./admin/admin.php\">Administration</a></li>";}
						?>
					</ul>
				</li>
			</ul>
			<?php
			if($_SESSION['LOGGED'] == 1){
			echo "<p class=\"navbar-text navbar-right\">Signed in as <a class=\"navbar-link\" href=\"#\">".$_SESSION['FIRST_NAME']."</a></p>";
			
			}else{
			 echo "<form data-toggle=\"validator\" class=\"navbar-form navbar-right\" role=\"form\">";
				echo "<div class=\"form-group\">";
					echo "<label class=\"sr-only\" for=\"exampleInputEmail2\">Email address</label>";
					echo "<input type=\"email\" class=\"form-control input-sm\" id=\"InputEmail\" name=\"email\" placeholder=\"Enter email\" required>&nbsp;";
				echo "</div>";
				
				echo "<div class=\"form-group\">";
					echo "<label class=\"sr-only\" for=\"exampleInputPassword2\">Password</label>";
					echo "<input data-minlength=\"5\" type=\"password\" class=\"form-control input-sm\" id=\"InputPassword\" name=\"password\" placeholder=\"Password\" required>&nbsp;";
				echo "</div>";
				echo "<div class=\"form-group login_button\">";
				echo "<button type=\"button\" class=\"btn btn-primary btn-sm signin\" name=\"signin\">Sign in</button>";
				echo "</div>";
			echo "</form>";
			}
			?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<ol class="breadcrumb">

	<li class="active">Home</li>
</ol>
<div class="container administration">
	<div class="row">
		<div class="col-lg-4">
			<img class="img-rounded" src="images/cuttingtime.png" alt="Cutting Times" style="width: 140px; height: 140px;">
			<h2>Cutting Times</h2>
			<p>Here you can add, edit and deactivate users.</p>
			<p>
				<a class="btn btn-default" href="#" role="button">Cutting Times</a>
			</p>
		</div>
		<div class="col-lg-4">
			<img class="img-rounded" src="images/edgebandingtime.png" alt="Edgebanding Times" style="width: 140px; height: 140px;">
			<h2>Edgebanding Times</h2>
			<p>Here you can add, edit and deactivate machinery.</p>
			<p>
				<a class="btn btn-default" href="#" role="button">Edgebanding Times</a>
			</p>
		</div>
		<div class="col-lg-4">
			<img class="img-rounded" src="images/machinestime.png" alt="Machining Times" style="width: 140px; height: 140px;">
			<h2>Machining Times</h2>
			<p>Here you can add, edit, and delete parts.</p>
			<p>
				<a class="btn btn-default" href="machining.php" role="button">Machining Times</a>
			</p>
		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/timestudy.js"></script>

</body>
</html>