<?php
if(isset($_POST['user']) && isset($_POST['pass'])){
	$username = $_POST['user'];
	$password = $_POST['pass'];
 
  require 'connection.php';
	
	$sql = "SELECT * FROM roster WHERE username = '$username' AND password = '$password'";
	$response = mysqli_query($conn, $sql);
	
	$row = mysqli_fetch_array($response);

	if($row != null){
	$role = $row['role'];
	}
	else{
	$role = 'd';
	}
	mysqli_close($conn);
	header('Content-Type: application/json');
	echo json_encode(array('username'=>$username,'role'=>$role));
}
?>