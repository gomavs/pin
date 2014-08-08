<?php
require_once("../includes/dbConnect.php");
$query = $db->prepare("SELECT * FROM part WHERE partnumber = ?");
$query->bind_param("s", $_GET["part"]);
$query->execute();
$result = $query->get_result()->fetch_object();
echo json_encode($result);
?>