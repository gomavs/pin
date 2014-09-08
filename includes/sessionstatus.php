<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	$_SESSION['SESS_MEMBER_ID'] = "";
	$_SESSION['SESS_FIRST_NAME'] = "";
	$_SESSION['SESS_LAST_NAME'] = "";
	$_SESSION['SESS_AUTH_LEVEL'] = "";
}
?>