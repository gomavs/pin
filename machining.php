<?php
require_once 'includes/dbConnect.php';

$return_data = "";
if(isset($_POST["partnumber"])){
	$query = $db->prepare("SELECT * FROM part WHERE partnumber = ?");
	$query->bind_param("s", $_POST["partnumber"]);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$return_data .= "<ul class = \"tree\"><li id=\"" . $row['id'] . "\">". $row['partnumber'] . "<span>" . $row['partdesc'] ."</span></li>";
	//$count_rows = $db->prepare("COUNT(*) FROM part WHERE parentid = ?");
	$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
	display_children($row['id'], 0);
	$return_data .= "</ul>";
}
function display_children($category_id, $level){
	global $query;
	global $return_data;
	$return_data .= "<ul>";
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
	// display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		// indent and display the title of this child
		// if you want to save the hierarchy, replace the following line with your code
		$return_data .= "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . "<span>" . $row['partdesc'] ."</span></li>";
		// call this function again to display this child's children
		display_children($row['id'], $level+1);
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
			<div class="col-md-6">
				<div class="row">
					<form method = "POST">
					<div class="col-md-4"><label>Part Number:</label></div>
					<div class="col-md-5"><input type="text" class="form-control" name="partnumber" id="autocomplete" autofocus placeholder="Enter part number"><input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/></div>
					</form>
				</div>
				<!--<div class="tree-holder"><?php //echo $return_data; ?></div>-->
				<ul class = "tree">
					<li>Thing 1 <span>This is a test</span></li>
					<li>Thing 2 <span>This is a test</span>
						<ul>
							<li>Thing 2 sub1<span>Another test</span></li>
							<li>Thing 2 sub2<span>Another test</span></li>
							<li>Thing 2 sub3<span>Another test</span>
								<ul>
									<li>another thing<span>Last test</span></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>Thing 3 <span>This is a test</span></li>
				</ul>
			</div>
			<div class="col-md-6">
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

							echo "<tr class=\"clickableRow\" id=\"$mid\"><td>".$wc."</td><td>".$mName."</td><td></td><td></td></tr>";
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
		/*
		$("#autocomplete").click(thing);
		
		$(document).keypress(function(e) {
			if(e.which == 13) {
				thing();
			}
		});
		
		function thing() {
			var test = $("#autocomplete").val();
			//alert(test);
			test = 1099;
			var request = $.get("ajax/buildtree.php", {query : test}, function(data) {

				$(".tree-holder").html(data);
			});


			//json.forEach(function(obj) { console.log(obj.id); });

		}
		*/
		$(function(){
			$('#autocomplete').autocomplete({
				serviceUrl:"ajax/search.php",
				onSelect: function(suggestion) {
					console.log(suggestion);
				}
			});
		});

	</script>
</body>
</html>