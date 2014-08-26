<?php
require_once 'includes/dbConnect.php';

$return_data = "";
$ul_count = 0;
$last_level = 0;
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
	for($ul_count; $ul_count > 0; $ul_count--){
		$return_data .= "</ul></li>";
	}
	$return_data .= "</ul>";

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
			$return_data .= "<ul><li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . " " . $test ."</span>";
			$ul_count = $ul_count + 1;
			$last_level = $level;
			
		}elseif($level < $last_level){
			$return_data .= "</ul></li><li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . " " . $test ."</span>";
			$ul_count = $ul_count - 1;
			$last_level = $level;
			$test = 0;
		}else{
			if($test == 1){
				$return_data .= "</li>";
				$test = 0;
			}
			$return_data .= "<li id=\"" . $row['id'] . "\">". $row['id'] . " " . $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level . " " . $last_level . " " . $test ."</span></li>";
			//$test = 0;
		}
		//$return_data .= "<li id=\"" . $row['id'] . "\">". $row['partnumber'] . " " . "<span>" . $row['partdesc'] ." " . $row['parentid'] . " " . $level. "</span></li>";
		// call this function again to display this child's children

		display_children($row['id'], $level+1);

	}
	
}

echo $return_data;
?>