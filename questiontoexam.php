<?php
if (isset($_POST['examname']) &&  isset($_POST['questionID']) && isset($_POST['points'])){
	$name = $_POST['examname'];
	$qid = $_POST['questionID'];
	$points = $_POST['points'];

	require 'connection.php';

  $sql = "SELECT * from examnames where name = '$name'";
	$response = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($response);
  if($row == null){
    $sql = "INSERT examnames(name) VALUES ('$name')";
    mysqli_query($conn, $sql);
  }
	$sql = "INSERT INTO examquestions(examname, questionid, points) VALUES('$name', '$qid', '$points')";
	if(mysqli_query($conn, $sql)){
		$response = "200";
	}
	else{
		$response = "001" . mysqli_error($conn).'<br>';
	}
	mysqli_close($conn);
	header('Content-Type: application/json');
	echo json_encode(array('response'=>$response));
}
?>