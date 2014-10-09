<?php
require '../includes/check_login.php';


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
	<li><a href="index.php">Home</a></li>
	<li class="active">Machining</li>
</ol>
<div class="container-fluid">
	<!-- Stack the columns on mobile by making one full-width and the other half-width -->
	<div class="row">
		<div class="col-md-12 main">
			<h2 class="page-header">Part Time Studies</h2>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-12">
			<form method = "POST">
			<div class="col-md-2"><label>Part Number:</label></div>
			<div class="col-md-3"><input type="text" class="form-control" name="partnumber" id="autocomplete" autofocus placeholder="Enter part number"><input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/></div>
			</form>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>

	$(function(){
		$('#autocomplete').autocomplete({
			serviceUrl:"../ajax/search.php",
			onSelect: function(suggestion) {
			}
		});
	});
	
</script>
</body>
</html>