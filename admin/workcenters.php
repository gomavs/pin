<?php
	require '../includes/dbConnect.php';


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Control Panel</title>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>
<body>
<div id="topcontainer" class="clearfix">Time Study</div>
<div id="menubar" class="clearfix">
	<div id="leftmenu">
	<a href="..">Home</a>--> <a href="admin.php">Admin</a>--> Work Centers
	</div>
	<div id="centermenu">
		<a href="users.php">Users</a>
		<a href="parts.php">Parts</a>
	</div>
	<div id="rightmenu">
	
	</div>
</div>
<div id="contentArea">
	<div id="leftSide">
		<form>
			Number: <input type="text" name="number"><br>
			Machine: <input type="text" name="machine"><br>
			Type: <input type="text" name="type"><br>
		</form>
	</div>
	<div id="rightSide">
	
	</div>
</div>

</body>
</html>
