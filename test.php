<?php
require_once 'includes/dbConnect.php';

$return_data = "";
	$last_level = -1;
$test = 15207;
	$query = $db->prepare("SELECT * FROM part WHERE partnumber = ?");
	$query->bind_param("s", $test);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$return_data .= "<ul class = \"tree\"><li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] ." ". "<span>" . $row['partdesc'] ."</span>";
	//$count_rows = $db->prepare("COUNT(*) FROM part WHERE parentid = ?");
	$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
	display_children($row['id'], 1);
	$return_data .= "</li></ul>";

function display_children($category_id, $level){
	global $query;
	global $return_data;
	global $last_level;
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
	// display each child
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		// indent and display the title of this child
		// if you want to save the hierarchy, replace the following line with your code
		if($level > $last_level){
			$return_data .= "<ul><li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . "</span>";
		}
		if($level < $last_level){
		echo "<br>test<br>";
			$return_data .= "</li></ul></li><li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . "</span></li></ul>";
		}
		if($level == $last_level){
			$return_data .= "<li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . "</span></li>";
		}
		//$return_data .= "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level. "</span></li>";
		// call this function again to display this child's children
		
		display_children($row['id'], $level+1);
		$last_level = $level;
	}
	
}

echo $return_data;
?>