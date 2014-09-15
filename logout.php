<?php
session_start();
$_SESSION = array(); // reset session array
session_destroy();
header("location: login.php");

?>