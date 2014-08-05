<?php
require_once 'includes/dbConnect.php';

$result = mysqli_query($db,"SELECT * FROM tempparts ORDER BY part ASC");

while($row = mysqli_fetch_array($result)) {
	$partnumber =  $row['part'];
	$desc = $row['desc'];
	$numberlength = strlen($partnumber);
	if ($numberlength <=5) {
		//mysqli_query($db,"INSERT INTO part (partnumber, partdesc) VALUES ('$partnumber', '$desc')");
		
		mysqli_query($db,"DELETE FROM tempparts WHERE part = '$partnumber'");
	}
	
}
echo "success";

?>