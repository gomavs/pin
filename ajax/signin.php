<?php
//session_start();
require_once '../includes/dbConnect.php';

//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

//Sanitize the POST values
$useremail = clean($_GET['useremail']);
$password = clean($_GET['userpassword']);
//Input Validations
if($useremail == '') {
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//If there are input validations, redirect back to the login form
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	//header("location: index.php");
	//exit();
}

//Create query
$query = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$query->bind_param("ss", $useremail,$password);
$query->execute();
$result = $query->get_result();

if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

//Check whether the query was successful or not
if($result) {
	if($result->num_rows > 0) {
		//Login Successful
		session_regenerate_id();
		$row = $result->fetch_assoc();
		$_SESSION['LOGGED'] = 1;
		$_SESSION['USER_ID'] = $row['id'];
		$_SESSION['FIRST_NAME'] = $row['firstname'];
		$_SESSION['LAST_NAME'] = $row['lastname'];
		$_SESSION['AUTH_LEVEL'] = $row['authlevel'];
		session_write_close();
		$data = (object)array("logged"=>$_SESSION['LOGGED'], "user_id"=>$_SESSION['USER_ID'], "first_name"=>$_SESSION['FIRST_NAME'], "last_name"=>$_SESSION['LAST_NAME'],"auth_level"=>$_SESSION['AUTH_LEVEL']);
		echo json_encode($data);
		
	}else {
		//Login failed
		$errmsg_arr[] = 'user name and password not found';
		$errflag = true;
		if($errflag) {
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
		}
		$data = (object)array("auth_level"=>0, "logged_in"=>0, "error_code"=>$_SESSION['ERRMSG_ARR']);
		echo json_encode($data);
	}
}else {
	die("Query failed");
}

?>