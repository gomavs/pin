<?php
require_once 'includes/dbConnect.php';
$return_data = "";
if(isset($_POST["partnumber"])){
	$ul_count = 0;
	$last_level = 0;
	$query = $db->prepare("SELECT * FROM part WHERE partnumber = ?");
	$query->bind_param("s", $_POST["partnumber"]);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$return_data .= "<ul class = \"tree\"><li class=\"items\" id=\"" . $row['id'] . "\">". $row['partnumber'] ." ". "<span>" . $row['partdesc'] ."</span>";
	$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
	display_children($row['id'], 1);
	for($ul_count; $ul_count > 0; $ul_count--){
		$return_data .= "</ul></li>";
	}
	$return_data .= "</ul>";
}
function display_children($category_id, $level){
	global $query;
	global $return_data;
	global $ul_count;
	global $last_level;
	$test = 0;
	$only_child = 0;
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
	// display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		// indent and display the title of this child
		// if you want to save the hierarchy, replace the following line with your code
		if($level > $last_level){
			$test = 1;
			$return_data .= "<ul  class = \"sub\"><li class=\"items	\" id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] . "</span>";
			$ul_count = $ul_count + 1;
			$last_level = $level;
			
		}elseif($level < $last_level){
			$return_data .= "</ul></li><li class=\"items\" id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] . "</span>";
			$ul_count = $ul_count - 1;
			$last_level = $level;
			$test = 0;
		}else{
			if($test == 1){
				$return_data .= "</li>";
				$test = 0;
			}
			$return_data .= "<li class=\"items\" id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] . "</span></li>";
			//$test = 0;
		}
		//$return_data .= "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level. "</span></li>";
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
				<!--
				<ul>
					<li class="current">menu1<span>menu1</span></li>
					<li><a href="#b">menu2</a>
						<ul class="sub">
							<li>sub2a<span>sub2a</span></li>
							<li><a href="#bb">sub2b</a></li>
							<li>sub2c<span>sub2c</span>
								<ul class="sub">
									<li><a href="#ba">sub2c1</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="#c">menu3</a></li>
					<li><a href="#d">menu4</a>
						<ul class="sub">
							<li><a href="#da">sub4</a></li>
							<li><a href="#db">sub4b</a></li>
						</ul>
					</li>
				</ul>
				-->
				<?php echo $return_data; ?>
			</div>
			<div class="col-md-6">
				<div class="row">
					<table class="table table-hover tabletimes">
						<tr>
							<th width=20%>Work Center</th>
							<th width=20%>Machine</th>
							<th width=20%>Date</th>
							<th width=20%>Time</th>
							<th width=20%>Action</th>
						</tr>
						<?php
						$result = mysqli_query($db,"SELECT * FROM timestudy.workcenter WHERE type = 1 ORDER BY center ASC");
						$machine_list = [];
						while($row = mysqli_fetch_array($result)) {
							$mid =  $row['id'];
							$wc = $row['center'];
							$mName = $row['name'];
							$machine_list[] = [$mid];
							echo "<tr id=\"machine-$mid\"><td>".$wc."</td><td>".$mName."</td><td class =\"study_date\"></td><td class=\"elapsed_time\"></td><td class =\"do_action\"></td></tr>";
						}
						
						//mysqli_close($db);
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
		window.machine_list = <?php echo json_encode($machine_list); ?>;
		//$(".tree li:has(ul)").addClass("parent").click(function(event) {
		$(".tree li:has(ul)").addClass("parent").click(function(event) {
			
			$(this).toggleClass("open");
			event.stopPropagation();
		});
		
		$(function() {
			$('ul.sub').hide();
			$("li:has(.sub)").click(function() {
				$("ul", this).toggle('slow');
			});
			$("li").click(function(event) {
				event.stopPropagation();
			});
		});
		
		$(function(){
			$('#autocomplete').autocomplete({
				serviceUrl:"ajax/search.php",
				onSelect: function(suggestion) {
					console.log(suggestion);
				}
			});
		});
			$(".items").click(function() {
				var rowId = this.id;
				var request = $.getJSON("ajax/gettimes.php", {id : rowId}, function(data) {
					console.log(data);
					
					var start_button = "<button type=\"button\" class=\"btn btn-success btn-xs\">Start</button>";
					$.each(machine_list, function(k, v){
						$("#machine-" + v + " td.study_date").html(" ");
						$("#machine-" + v + " td.elapsed_time").html(" ");
						$("#machine-" + v + " td.do_action").html(start_button);
					});
					
					$.each(data, function(key, value) {
					
						var a = new Date(value.start_time*1000);
						var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
						var year = a.getFullYear();
						var month = months[a.getMonth() - 1];
						var date = a.getDate();
						var timeDiff = value.end_time - value.start_time;
						var seconds = Math.round(timeDiff % 60);
						timeDiff = Math.floor(timeDiff / 60);
						var minutes = Math.round(timeDiff % 60);
						timeDiff = Math.floor(timeDiff / 60);
						var hours = Math.round(timeDiff % 24);
						timeDiff = Math.floor(timeDiff / 24);
						var days = timeDiff;
						//var elapsed_time = days + " days, " + hours + ":" + minutes + ":" + seconds;
						if(!value.end_time){
							var elapsed_time = " ";
						}else{
							var elapsed_time = hours + "hr " + minutes + "m " + seconds + "s";
						}
						if(value.start_time > 0 && !value.end_time){
							var action_button = "<button type=\"button\" class=\"btn btn-danger btn-xs\">Stop</button>";
						} else if(!value.start_time){
							var action_button = "<button type=\"button\" class=\"btn btn-success btn-xs\">Start</button>";
						}else{
							var action_button = "<button type=\"button\" class=\"btn btn-Warning btn-xs\">Reset</button>";
						}
						
						$("#machine-" + value.machine_id + " td.study_date").html(month + " " + date + ", " + year);
						$("#machine-" + value.machine_id + " td.elapsed_time").html(elapsed_time);
						$("#machine-" + value.machine_id + " td.do_action").html(action_button);
					});
					
				});
			});
	</script>
</body>
</html>