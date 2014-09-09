<?php
session_start();
require_once 'dbConnect.php';

if (!isset($_SESSION['user_email']) || !isset($_SESSION['user_pass'])) {
	$logged_in = 0;
	header('location:login.php');
	
} else {
	// remember, $_SESSION['password'] will be encrypted.
    if(!get_magic_quotes_gpc()) {
        $_SESSION['user_email'] = addslashes($_SESSION['user_email']);
    }
    // addslashes to session user_email before using in a query.

	$query = $db->prepare("SELECT * FROM users WHERE email = ?");
	$query->bind_param("s", $_SESSION['user_email']);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	$num_rows = $result->num_rows;
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
	}	
	
	if($num_rows != 1) {
        $logged_in = 0;
        unset($_SESSION['user_email']);
        unset($_SESSION['user_pass']);
        // kill incorrect session variables.
    }
	$user_password = stripslashes($row['password']);
	$active = $row['active'];
	if ($active == 1) {
		if($_SESSION['user_pass'] == $user_password){
			$_SESSION['user_pass'] = $user_password;
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_first_name'] = $row['firstname'];
			$_SESSION['user_last_name'] = $row['lastname'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['user_auth_level'] = $row['authlevel'];
			$_SESSION['logged'] = 1;
			$logged_in = 1;
		}else{
			$logged_in = 0;
			unset($_SESSION['user_email']);
			unset($_SESSION['password']);
			header('location:login.php');
		}
	}
}

// clean up
unset($row['password']);

$_SESSION['user_email'] = stripslashes($_SESSION['user_email']);


?>