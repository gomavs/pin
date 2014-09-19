<?php
require_once("../includes/dbConnect.php");

$start_time = strtotime($_GET['starttime']);
$end_time = strtotime($_GET['endtime']);
$time_diff = $end_time - $start_time;
if($time_diff < 86400*2){// less than 2 days = hours
	$multiplier = 3600;
	$skip_by = "P1D";
}elseif($time_diff >= 86400*2 && $time_diff < 86400*15){//between 2 days and 15 days = days
	$multiplier = 86400;
	$skip_by = "P1D";
}elseif($time_diff >= 86400*15 && $time_diff < 86400*30){// between 15 days and 1 month = weeks
	$multiplier = 604800 ;
	$skip_by = "P1D";
}elseif($time_diff >= 86400*30 && $time_diff < 86400*365){//between 1 month and 1 year = months
	$multiplier = 2592000;
	$skip_by = "P1D";
}else{//greater than a year = years
	$multiplier = 31536000;
	$skip_by = "P1D";
}
$row_cnt = 0;
$data = [];
$startfrom = date( "Y-m-d", $start_time );
$goto = date("Y-m-d", $end_time);
$begin = new DateTime( $startfrom );
$end = new DateTime( $goto );
$end = $end->modify( '+1 day' ); 

$interval = new DateInterval($skip_by);
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    $start = $date->format("Ymd");
	$start =  strtotime($start);
	$end = $start + $multiplier;
	$query = $db->prepare("SELECT * FROM times WHERE start_time >= ? AND end_time < ? ORDER BY end_time ASC");
	$query->bind_param("ii", $start, $end);
	$query->execute();
	$result = $query->get_result();

	$row_cnt = $result->num_rows;
	$theday = date( "Y-m-d", $start );

	$data[] = (object)array("day"=>$theday, "value"=>$row_cnt);//my first php object :)

}

echo json_encode($data);

?>