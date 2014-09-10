<?php
require '../includes/check_login.php';
//require_once '../includes/dbConnect.php';

if (isset( $_POST[ 'submit' ] ) ) {

	$workCenter = $_POST['center'];
	$machineName = $_POST['name'];
	$type = $_POST['type'];
	$active = $_POST['inservice'];
	$id = $_POST["id"];


	if (!empty($id)) {
		$query = $db->prepare("UPDATE workcenter SET inservice = ?, name = ?, type = ?, center = ? WHERE id = ?");
		$query->bind_param("isiii", $active, $machineName, $type, $workCenter, $id);
		$query->execute();
	} else {
		mysqli_query($db,"INSERT INTO workcenter (inservice, name, type, center)
	VALUES ('$active', '$machineName','$type', '$workCenter')");
	}
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
include '../includes/navbar2.php';
?>
<ol class="breadcrumb">
	<li><a href="..">Home</a></li>
	<li><a href="admin.php">Administration</a></li>
	<li class="active">Machines</li>
</ol>
<div class="container-fluid">
	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
	<div class="row">
		<div class="col-md-6">
			<form action="" method="post" id="add">
				<div class="row">
					<div class="col-md-6" name="addmachine"><h3>Add Machine:</h3></div>
				</div>
				<input type="hidden" name="id" value=""/>
				<div class="row">
					<div class="col-md-4"><h4>Work Center Number:</h4></div>
					<div class="col-md-4"><input type="number" class="form-control" name="center" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Machine Name:</h4></div>
					<div class="col-md-4"><input type="text" class="form-control" name="name" placeholder="Required"></div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Machine Type:</h4></div>
					<div class="col-md-4">
						<select class="form-control" name="type">
							<option value="1">Machine Center</option>
							<option value="2">Edgebander</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"><h4>Machine Active:</h4></div>
					<div class="col-md-4">
						<input type="radio" name="inservice" value="1" checked>Yes<br>
						<input type="radio" name="inservice" value="0">NO
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<input name="submit" type="submit" value="Submit" />
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<div class="row">
				<table class="table table-hover">
					<tr>
						<th>id</th>
						<th>Work Center</th>
						<th>Machine</th>
						<th>Type</th>
						<th>Active</th>
					</tr>
					<?php

					$result = mysqli_query($db,"SELECT * FROM workcenter ORDER BY center ASC");

					while($row = mysqli_fetch_array($result)) {
						$mid =  $row['id'];
						$wc = $row['center'];
						$mName = $row['name'];
						$mType = $row['type'];
						$inService = $row['inservice'];
						if ($mType == 1) {
							$mType = "Machining Center";
						}else{
							$mType = "Edgebander";
						}
						if ($inService == 0){
							$inService = "No";
						}else{
							$inService = "Yes";
						}
						echo "<tr class=\"clickableRow\" id=\"$mid\"><td>".$mid."</td><td>".$wc."</td><td>".$mName."</td><td>".$mType."</td><td>".$inService."</td><td></tr>";
					}
					//mysqli_close($db);
					?>
				</table>
			</div>

		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

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
		var request = $.getJSON("../ajax/updatemachines.php", {id : rowId}, function(data) {
			populate($("#add"), data);
			$("[name=submit]", $("#add")).val("Update");
			$("[name=addmachine]", $("#add")).html("<h3>Update Machine:</h3>");
		});
	});

</script>

</body>
</html>
