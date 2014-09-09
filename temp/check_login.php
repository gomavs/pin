<?php
/* check login script, included in db_connect.php. */
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_pass'])) {
	$logged_in = 0;
	return;
} else {
	// remember, $_SESSION['password'] will be encrypted.
    if(!get_magic_quotes_gpc()) {
        $_SESSION['user_name'] = addslashes($_SESSION['user_pass']);
    }
    // addslashes to session user_name before using in a query.

	$qry = "SELECT id, user_pass, site_admin, first_name, activate FROM users WHERE user_name = '".$_SESSION['user_name']."'";
    $pass = $db_object->query($qry);
	if(DB::isError($pass) || $pass->numRows() != 1) {
        $logged_in = 0;
        unset($_SESSION['user_name']);
        unset($_SESSION['user_pass']);
        // kill incorrect session variables.
    }
	$db_pass = $pass->fetchRow();
	$active = $db_pass['activate'];
	$user_password = $db_pass['user_pass'];
	$db_pass['user_pass'] = stripslashes($db_pass['user_pass']);
	
	if ($active == Null) {
	
		if($_SESSION['user_pass'] == $db_pass['user_pass']){
			$_SESSION['user_id'] = $db_pass['id'];
			$_SESSION['user_name'] = $_SESSION['user_name'];
			$_SESSION['user_pass'] = $db_pass['user_pass'];
			$_SESSION['user_site_admin'] = $db_pass['site_admin'];
			$_SESSION['user_first_name'] = $db_pass['first_name'];
			$logged_in = 1;
	
		}else{
			$logged_in = 0;
			unset($_SESSION['user_name']);
			unset($_SESSION['password']);
			
			
			header('location:signin.php');
		}
	}else{
		$logged_in = 0;
		header('location:activate.php');
	}
}

// clean up
unset($db_pass['pass_word']);

$_SESSION['user_name'] = stripslashes($_SESSION['user_name']);


?>