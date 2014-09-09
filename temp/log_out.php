<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['password']);
// kill session variables
$_SESSION = array(); // reset session array
session_destroy();   // destroy session.
if(isset($_GET['page_origin'])){
	$return_page = $_GET['page_origin'];
	header("location:$return_page");
}else{
	header('Location:http://leaguelockers.dimensionsmachine.com/index.php');
}
?>