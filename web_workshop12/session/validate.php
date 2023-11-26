<?php 
session_start();

include '../backend/connection.php';

$username	= $_POST['username'];
$password	= $_POST['password'];

$data	= mysqli_query($connection,"SELECT * FROM user WHERE username='$username' AND password='$password'");
$fetchy	= $data->fetch_assoc();

$validation = mysqli_num_rows($data);

if($validation > 0){
	if ($fetchy["level"]   == "admin"){ // Level Admin
		$_SESSION['level'] = "admin";
	}elseif ($fetchy["level"] == "mod"){ // Level Mod
		$_SESSION['level']	  = "mod";
	}else { // Level Basic
		$_SESSION['level'] = "basic";
	}
	$_SESSION['id']       = $fetchy["user_id"];
	$_SESSION['nickname'] = $fetchy["nickname"];
	$_SESSION['username'] = $username;
	$_SESSION['status']   = "login";
	header("location:../index.php");
}else{
	header("location:login.php?msg=failed");
}
?>