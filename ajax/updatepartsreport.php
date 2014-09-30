<?php
require_once("../includes/dbConnect.php");

$q = 1;
$data = [];
$query = $db->prepare("SELECT * FROM times WHERE completed = ?");
$query2 = $db->prepare("SELECT * FROM part WHERE id = ?");
$query3 = $db->prepare("SELECT * FROM part WHERE id = ?");
$query4 = $db->prepare("SELECT * FROM workcenter WHERE id = ?");
$query->bind_param("i", $q);
$query->execute();
$result = $query->get_result();
while (($row = $result->fetch_object()) !== NULL) {
	$start_time = $row->start_time;
	$end_time = $row->end_time;
	$completed_on = date("M d, Y",$end_time);
	$diff = $end_time - $start_time;
	$elapsed_time = date('H:i:s', $diff);
	$query2->bind_param("i", $row->item_id);
	$query2->execute();
	$result2 = $query2->get_result();
	$row2 = $result2->fetch_assoc();
	$query3->bind_param("i", $row2['parentid']);
	$query3->execute();
	$result3 = $query3->get_result();
	$row3 = $result3->fetch_assoc();
	$query4->bind_param("i", $row->machine_id);
	$query4->execute();
	$result4 = $query4->get_result();
	$row4 = $result4->fetch_assoc();
	$work_center = "WC ".$row4['center']." ".$row4['name'];
	echo $work_center;
	$data[] = ["Part Number"=>$row2['partnumber'], "Part Description"=>$row2['partdesc'], "Parent Number"=>$row3['partnumber'], "Machine"=>$work_center, "Date"=>$completed_on, "Time"=>$elapsed_time];
}
echo json_encode($data);


?>