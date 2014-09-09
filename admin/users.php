<?php
require '../includes/check_login.php';
//require_once '../includes/dbConnect.php';

if (isset( $_POST[ 'submit' ] ) ) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$authlevel = $_POST['authlevel'];
	$active = $_POST['active'];
	$id = $_POST["id"];

	if (!empty($id)) {
		$query = $db->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ?, authlevel = ?, active = ? WHERE id = ?");
		$query->bind_param("ssssiii", $firstname, $lastname, $email, $password, $authlevel, $active, $id);
		$query->execute();
	} else {
		mysqli_query($db,"INSERT INTO users (firstname, lastname, email, password, authlevel, active)
	VALUES ('$firstname', '$lastname','$email', '$password', '$authlevel', '$active')");
	
	}
}
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
<?php
include '../includes/navbar.php';
?>
<ol class="breadcrumb">
	<li><a href="..">Home</a></li>
	<li><a href="admin.php">Administration</a></li>
	<li class="active">Users</li>
</ol>
<div class="container-fluid">
	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
	<div class="row">
		<div class="col-md-5">
			<form data-toggle="validator" role="form" method="post" id="add">
				<input type="hidden" name="id" value=""/>
				<div class="form-group col-md-6">
					<label for="inputFirstName" class="control-label">First Name</label>
					<input type="text" class="form-control" id="inputFirstName" name="firstname" placeholder="First Name" required>
				</div>
				<div class="form-group col-md-6">
					<label for="inputLastName" class="control-label">Last Name</label>
					<input type="text" class="form-control" id="inputLastName" name="lastname" placeholder="Last Name" required>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="control-label col-md-8">Password</label>
					<div class="form-group col-md-6">
						<input type="password" data-minlength="5" class="form-control pull-left" id="inputPassword" name="password" placeholder="Password" required>
						<span class="help-block">Minimum of 5 characters</span>
					</div>
					<div class="form-group col-md-6">
						<input type="password" class="form-control" id="inputPasswordConfirm" name="confirmPassword" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm Password" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label for="inputEmail" class="control-label">Email</label>
					<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" data-error="That email address is invalid" required>
					<div class="help-block with-errors"></div>
				</div>
				
				<div class="form-group col-md-8">
					<label for="active" class="control-label">Authorization Level</label>
					<select class="form-control" name="authlevel">
						<option value="1">Operator</option>
						<option value="5">Administrator</option>
					</select>
				</div>
				<div class="form-group col-md-8">
					<label for="active" class="control-label">Active</label>
					<div class="radio">
						<label><input type="radio" name="active" value="1" required checked>Yes</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="active" value="0" required>No</label>
					</div>
				</div>

				<div class="form-group col-md-8">
					<button type="submit" name="submit" class="btn btn-primary" formmethod="post">Submit</button>
				</div>
			</form>
		</div>
		<div class="col-md-7">
			<div class="row">
				<table class="table table-hover">
					<tr>
						<th>id</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Level</th>
						<th>Active</th>
					</tr>
					<?php

					$result = mysqli_query($db,"SELECT * FROM users ORDER BY lastname ASC");

					while($row = mysqli_fetch_array($result)) {
						$id =  $row['id'];
						$firstname = $row['firstname'];
						$lastname = $row['lastname'];
						$email = $row['email'];
						$authlevel = $row['authlevel'];
						$active = $row['active'];
						if ($authlevel == 5) {
							$authlevel = "Administrator";
						}else{
							$authlevel = "Operator";
						}
						if ($active == 0){
							$active = "No";
						}else{
							$active = "Yes";
						}
						echo "<tr class=\"clickableRow\" id=\"$id\"><td>".$id."</td><td>".$firstname."</td><td>".$lastname."</td><td>".$email."</td><td>".$authlevel."</td><td>".$active."</td><td></tr>";
					}
					mysqli_close($db);
					?>
				</table>
			</div>

		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/validator.js"></script>
<script>
		function populate(form, data) {
		$.each(data, function(key, value) {
			var $field = $("[name=" + key + "]", form);
			switch ($field.attr("type")) {
				case "radio":
				case "checkbox":
					$field.each(function(index, element) {
						element.checked = $(element).val() == value
					});
					break;
				default:
					$field.val(value);
			}
		});
	}

	//This is to make a table row clickable
	$(".clickableRow").click(function() {
		var rowId = this.id;
		var request = $.getJSON("../ajax/updateusers.php", {id : rowId}, function(data) {
			populate($("#add"), data);
			$("[name=confirmPassword]").val(data.password);
			$("[name=submit]", $("#add")).html("Update");
		});
	});
</script>
</body>
</html>
