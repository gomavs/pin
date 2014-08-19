<?php
require_once("../includes/dbConnect.php");
$query = $db->prepare("SELECT id, partnumber, partdesc FROM part WHERE parentid = ?");

$q = "{$_GET["query"]}";
$data = [];
display_children($q, 0);

function display_children($category_id, $level){
	global $query;
	global $return_data;
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
	//echo "<ul>";
	$return_data .= "<ul>";
    // display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		// indent and display the title of this child
		// if you want to save the hierarchy, replace the following line with your code
		//echo str_repeat('  ',$level) . "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . "<span>" . $row['partdesc'] ."</span></li>";
		$return_data .= "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . "<span>" . $row['partdesc'] ."</span></li>";
		// $data[] = $row;
		// call this function again to display this child's children
		display_children($row['id'], $level+1);
    }
	//echo "</ul>";
	$return_data .= "</ul>";
}

echo $return_data;
?>
