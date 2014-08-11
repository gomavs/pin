<?php
require_once("../includes/dbConnect.php");
$test = 12465;
$data = [];
$query = $db->prepare("SELECT * FROM part WHERE parentid = ?");
//$query->bind_param("s", $_GET["part"]);
$query->bind_param("i", $test);
$query->execute();
//$result = $query->get_result()->fetch_object();
$result = $query->get_result();
while (($row = $result->fetch_object()) !== NULL) {
	$data[] = ["data"=>$row->id, "value"=>$row->partnumber];

}
echo json_encode(["suggestions"=>$data]);
//echo json_encode($result);
//$id = $result->id;

//echo $result->id." ".$result->partnumber." ".$result->partdesc;

?>