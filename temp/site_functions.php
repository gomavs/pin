<?php
function curPageURL() {//This function returns entire URL
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
return $pageURL;
}

function curPageName() {//This function returns only the page name (ie. some_page.php)
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

if(isset($_POST['sign_in_data::user_id']) || isset($_POST['login'])){//This section is to log a user in from the login bar or the signin page.
	if(isset($_POST['sign_in_data::user_id3'])){
		$user_name = $_POST['sign_in_data::user_id3'];
	}else{
		$user_name = $_POST['sign_in_data::user_id'];
	}
	$user_pw = SHA1($_POST['sign_in_data::user_pw']);
	$qry = "SELECT id, user_pass, site_admin, first_name, fav_link1 FROM users WHERE user_name='$user_name'";
	$rs = $db_object->query($qry);
	$row = $rs->fetchRow(); 
	$user_password = $row['user_pass'];
	if($user_pw == $user_password){
		$timenow = time();
		$qry = "UPDATE users SET last_login = '$timenow' WHERE user_name='$user_name'";
		$update_last_login = $db_object->query($qry);
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['user_name'] = $user_name;
		$_SESSION['user_pass'] = $user_pw;
		$_SESSION['user_site_admin'] = $row['site_admin'];
		$_SESSION['user_first_name'] = $row['first_name'];
		$logged_in = 1;
		$fav_link = $row['fav_link1'];
		$days20 = 60*60*24*20;
		$expire = time() + $days20;
		setcookie('user_id', $user_name, $expire);
		if(empty($fav_link)){
			header("location:locker_room.php");
		}else{
			header("location:$fav_link");
		}
	}else{
		$logged_in = 0;
		header('location:signin.php?error=1');
	}
}

function retrieve_data($data_set,$user_id){
	require 'db_connect.php';
	$qry = "SELECT $data_set FROM users WHERE id='$user_id'";
	$rs = $db_object->query($qry);
	$row = $rs->fetchRow(); 
	$user_data = $row["$data_set"];
	return $user_data;
}

?>