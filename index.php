<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>pin Time Study</title>
<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
<div id="topcontainer" class="clearfix">Time Study</div>
<div id="menubar" class="clearfix">
	<div id="leftmenu">
	Home
	</div>
	<div id="centermenu">
		<a href="admin/admin.php">Admin Control Panel</a>
	</div>
	<div id="rightmenu">
	
	</div>
</div>
<div id="infobar" class="clearfix">
  <div id="leftside">
    <form action="find_parent.php">
    <div id="toprowparent">Parent Search:</div>
    <div id="toprowinput"><input type="text" name="parent_number" placeholder="Parent Number" autofocus required></div>
    </form>
  </div>
  <div id="rightside">
    <div id="toprowheader">Work Center</div>
    <div id="toprowheader">Machine</div>
    <div id="toprowheader">Time</div>
  </div>
</div>
<div id="datacontainer">
  <div id="datatree"></div>
  <div id="data"></div>
</div>

<a href="admin">
	<div class="clickMe">
		Click Me
	</div>
</a>
<a href="admin" class="btn"><img src="images/admin_icon.jpg" height="32" width="33"/></a>
<a id="admin" href="admin" title="Admin"><span>Admin</span></a> 

</body>
</html>
