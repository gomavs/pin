<?php
require_once 'includes/dbConnect.php';

$default = ini_get('max_execution_time');
set_time_limit(300);

$result = mysqli_query($db,"SELECT * FROM tempparts ORDER BY part ASC");
$i = 0;
while($row = mysqli_fetch_array($result)) {
	$partnumber =  $row['part'];
	$desc = $row['desc'];
	$numberlength = strlen($partnumber);
	if ($numberlength <= 5) {
		echo $partnumber."<br>";
		mysqli_query($db,"INSERT INTO part (partnumber, partdesc) VALUES ('$partnumber', '$desc')");
		$i++;
	/*}
	else{
		$cutnumber = mb_strcut($partnumber,0,5);
		$result2 = mysqli_query($db,"SELECT id FROM part WHERE partnumber = '$cutnumber'");
		$row2 = mysqli_fetch_assoc($result2);
		$id = $row2['id'];
		if(!empty ($id)){
			mysqli_query($db,"INSERT INTO part (partnumber, partdesc, parentid) VALUES ('$partnumber', '$desc', '$id')");

		}else{

			mysqli_query($db,"INSERT INTO part (partnumber, partdesc) VALUES ('$partnumber', '$desc')");
		}*/


		//mysqli_query($db,"DELETE FROM tempparts WHERE part = '$partnumber'");
	}
}
echo $i." inserted into database.<br>";

set_time_limit($default);
?>