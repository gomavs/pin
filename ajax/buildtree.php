<?php
require_once("../includes/dbConnect.php");

/*
$test = 12465;
$data = [];
$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
//$query->bind_param("s", $_GET["part"]);
$query->bind_param("i", $test);
$query->execute();
//$result = $query->get_result()->fetch_object();
$result = $query->get_result();
while (($row = $result->fetch_object()) !== NULL) {
	$data[] = ["id"=>$row->id, "partnumber"=>$row->partnumber, "partdesc"=>$row->partdesc, "parentid"=>$row->parentid];

}
echo json_encode(["tree"=>$data]);*/
//echo json_encode($result);
//$id = $result->id;

//echo $result->id." ".$result->partnumber." ".$result->partdesc;









display_children(1099, 0);

function display_children($category_id, $level){
    // retrieve all children
	$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
	$query->bind_param("i", $category_id);
	$query->execute();
	$result = $query->get_result();
  
    // display each child
	while (($row = $result->fetch_object()) !== NULL ){
        // indent and display the title of this child
       // if you want to save the hierarchy, replace the following line with your code
        echo str_repeat('  ',$level) . $row['partnumber'] . $row['partdesc'] . "<br/>";
        
       // call this function again to display this child's children
       display_children($row['id'], $level+1);
    }
}



?>