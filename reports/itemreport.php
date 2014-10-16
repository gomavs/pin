<?php
require '../includes/check_login.php';
$build_table= "";
$search_value = "";
if(isset($_POST["partnumber"])){
	$ul_count = 0;
	$last_level = 0;
	$search_value = $_POST["partnumber"];
	$data = [];
	$query = $db->prepare("SELECT * FROM part WHERE partnumber = ?");
	$query->bind_param("s", $_POST["partnumber"]);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
	$query->bind_param("i", $row['id']);
	$query->execute();
	$result = $query->get_result();
	$row_cnt = $result->num_rows;
	if($row_cnt > 0){
		echo "test";
	}else{
		echo "test2";
		$completed = 1;
		$query2 = $db->prepare("SELECT * FROM times WHERE item_id = ? AND completed = ? ORDER BY end_time ASC");
		$query2->bind_param("ii", $row['id'], $completed);
		$query2->execute();
		$result = $query2->get_result();
	/*	while (($row2 = $result->fetch_object()) !== NULL) {
			
			$data[] = ["Part Number"=>$row2['partnumber'], "Part Description"=>$row2['partdesc'], "Parent Number"=>$row3['partnumber'], "Work Center"=>$row4['center'], "Machine"=>$row4['name'], "Date"=>$completed_on, "Time"=>$elapsed_time];
		}*/
	}
	
	//display_children($row['id'], 1);
	

$build_table= "<table id=\"table_id\" class=\"display\"><thead>";
$build_table.= "<tr><th>Part Number</th><th>Part Description</th><th>Parent Number</th><th>Work Center</th><th>Machine</th><th>Date</th><th>Time</th></tr>";					
$build_table.= "</thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>";	

}
/*
function display_children($category_id, $level){
	global $query;
	global $query2;
	global $return_data;
	global $ul_count;
	global $last_level;
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
	// display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		$query2->bind_param("i", $row['id']);
		$query2->execute();
		$result2 = $query2->get_result();
		$row_cnt = $result2->num_rows;
		if($level > $last_level){
			if($row_cnt > 0){
				$return_data .= "<ul  class=\"sub\"><li class=\"momma\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span>";
			}else{
				$return_data .= "<ul  class=\"sub\"><li class=\"items\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span></li>";
			}
			$ul_count = $ul_count + 1;
		}elseif($level < $last_level){
			$return_data .= "</ul></li>";
			if($row_cnt >0){
				$return_data .= "<li class=\"momma\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span>";
			}else{
				$return_data .= "<li class=\"items\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span></li>";
			}
			$ul_count = $ul_count - 1;
		}else{
			if($row_cnt >0){
				$return_data .= "<li class=\"momma\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span>";
			}else{
				$return_data .= "<li class=\"items\" id=\"".$row['id']."\">".$row['partnumber']." "."<span>".$row['partdesc']."</span></li>";
			}
		}
		$last_level = $level;
		// call this function again to display this child's children
		display_children($row['id'], $level+1);
	}
}*/
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
	<li><a href="..\index.php">Home</a></li>
	<li><a href="index.php">Reports</a></li>
	<li class="active">Part Times</li>
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
	<div class="row">
		<div class="col-md-12">
			<?php echo $build_table; ?>
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