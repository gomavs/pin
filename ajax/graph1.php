<?php
require_once("../includes/dbConnect.php");

$start_time = $_GET['starttime'];
$end_time = $_GET['endtime'];
$time_diff = $end_time - $start_time;
if($time_diff <= 86400)[
	
}elseif($time_diff <= 86400 && $time_diff <= 86000*2){

{

$data = [];
$startfrom = date( "Y-m-d", $start_time );
$goto = date("Y-m-d", $end_time);
$begin = new DateTime( $startfrom );
$end = new DateTime( $goto );
$end = $end->modify( '+1 day' ); 

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    $test = $date->format("Ymd");
	echo strtotime($test). "<br>";
	
	
	
}





////////////////////////////////////////////////////////////////////////////////
/*

$query = $db->prepare("SELECT * FROM times WHERE start_time >= ? AND end_time < ? ORDER BY end_time ASC");
$query->bind_param("ii", $start_time, $end_time);
$query->execute();
$result = $query->get_result();
while (($row = $result->fetch_object()) !== NULL) {
	for(
	
	
}
echo json_encode($data);
*/
?>