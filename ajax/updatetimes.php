<?php
require_once("../includes/dbConnect.php");
if(isset($_GET['id']) && isset($_GET['machine'])){
	$timenow = time();
	$item_id = $_GET["id"];
	$mid = $_GET["machine"];
	$query = $db->prepare("UPDATE times SET end_time = ? WHERE item_id = ? AND machine_id = ?");
	$query->bind_param("iii", $timenow, $item_id, $mid);
	$query->execute();
	
	$query = $db->prepare("SELECT * FROM times WHERE item_id = ? AND machine_id = ?");
	$query->bind_param("ii", $item_id, $machine_id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$start_time = $row['start_time'];
	//$data[] = ["start_time"=>$timenow, "end_time"=>$timenow];
	//echo json_encode($data);
	echo $start_time;
	echo "test";
}
?>