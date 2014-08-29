<?php
require_once("../includes/dbConnect.php");
$query = $db->prepare("SELECT id, partnumber, partdesc FROM part WHERE parentid = ?");

$q = "{$_GET["query"]}";
display_children($q, 0);

function display_children($category_id, $level){
	global $query;
	global $return_data;
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();

	echo "<ul>";
    // display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		// indent and display the title of this child
		// if you want to save the hierarchy, replace the following line with your code
		echo "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . "<span>" . $row['partdesc'] ."</span></li>";
		// call this function again to display this child's children
		display_children($row['id'], $level+1);
    }
	echo "</ul>";
}

echo $return_data;
?>
