<?php
if(isset($_POST['studentid'])){
	require 'connection.php';

  $studentid = $_POST['studentid'];
  $sql = "SELECT name from examnames ORDER BY added DESC LIMIT 1";
  $response = mysqli_query($conn, $sql);
  $line = mysqli_fetch_assoc($response);
  $name = $line['name'];

  $sql = "SELECT * from examresults where student = '$studentid' AND exam = '$name'";
  $response = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($response);
  if($row != null){
   $response = array('examname'=>$name,'response'=>'You cannot retake this test');
  }
  else{
	$sql = "SELECT examquestions.questionid, bank.question, bank.const, examquestions.points
			FROM examquestions
			INNER JOIN bank on examquestions.questionid = bank.questionid
      WHERE examname = '$name'";
	$response = mysqli_query($conn, $sql);
	if($response != null){

		$json = array();


		while ($row = mysqli_fetch_assoc($response) ){
			$json[] = $row;
		}
	}
	else{
		$json = array("Failed to get exam questions: " . mysqli_error($conn).'<br>');
	}
   $response = array('examname'=>$name,'response'=>'200','questions'=>$json);
  }
	mysqli_close($conn);
	header('Content-Type: application/json');
	echo json_encode($response);

  }
?>