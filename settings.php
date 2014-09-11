<?php
require 'includes/check_login.php';

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
<?php
include 'includes/navbar.php';
?>
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li class="active">Settings</li>
</ol>
<div class="container">
	<div class="row">
		<div class="col-lg-3">
	
		</div>
		<div class="col-lg-6">
			<div class="panel-group" id="accordion">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<b>
								Name
							</b>
							Shawn Brunson
						</div>
						
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo $_SESSION['user_first_name']. " " . $_SESSION['user_last_name']; ?>
							<form data-toggle="validator" role="form" method="post" id="changeName">
								<div class="form-group col-md-6">
									<label for="inputFirstName" class="control-label">First Name</label>
									<input type="text" class="form-control" id="inputFirstName" name="firstname" placeholder="First Name" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputLastName" class="control-label">Last Name</label>
									<input type="text" class="form-control" id="inputLastName" name="lastname" placeholder="Last Name" required>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								Email
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo $_SESSION['user_email']; ?>
							<form data-toggle="validator" role="form" method="post" id="changeEmail">
								<div class="form-group col-md-8">
									<label for="inputEmail" class="control-label">Email</label>
									<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" data-error="That email address is invalid" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group col-md-8">
									<button type="submit" name="changeEmail" class="btn btn-primary" formmethod="post">Change Email</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								Password
							</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">
							<form data-toggle="validator" role="form" method="post" id="changePassword">
								<div class="form-group">
									<label for="inputPassword" class="control-label col-md-12">New Password</label>
									<div class="form-group col-md-6">
										<input type="password" data-minlength="5" class="form-control pull-left" id="inputPassword" name="password" placeholder="Password" required>
										<span class="help-block">Minimum of 5 characters</span>
									</div>
									<div class="form-group col-md-6">
										<input type="password" class="form-control" id="inputPasswordConfirm" name="confirmPassword" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm New Password" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="form-group col-md-8">
									<button type="submit" name="changePass" class="btn btn-primary" formmethod="post">Change Password</button>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div> 
			  
			
			
		</div>
		<div class="col-lg-3">
	
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/timestudy.js"></script>

</body>
</html>