<?php
require_once("../includes/dbConnect.php");
if(isset($_GET['id']) && isset($_GET['machine'])){
	$item_id = $_GET["id"];
	$mid = $_GET["machine"];
	$completed = 1;
	$query = $db->prepare("UPDATE times SET completed = ? WHERE item_id = ? AND machine_id = ?");
	$query->bind_param("iii", $completed, $item_id, $mid);
	$query->execute();

}
?>