<?php

if (isset($_POST['topic']) && isset($_POST['difficulty']) && isset($_POST['constr']) && isset($_POST['question']) && isset($_POST['functionname']) && isset($_POST['testcasenum'])){

	$topic = $_POST['topic'];
	$diff = $_POST['difficulty'];
	$const = $_POST['constr'];
	$quest = $_POST['question'];
	$funname = $_POST['functionname'];
	$testnum = $_POST['testcasenum'];
	$tc = $_POST['testcases'];

	require 'connection.php';

	$sql = "SELECT questionID
			from bank
			where topic = '$topic' AND difficulty = '$diff' AND const = '$const' AND question = '$quest' AND functionname = '$funname' AND const = '$constr'";
	$results = mysqli_query($conn, $sql);
	echo mysqli_error($conn);
	$row = mysqli_fetch_array($results);
	if($row != null){
		$response = "This question is already in the bank.";
	}
	else{
		$sql = "INSERT INTO bank( topic, question,difficulty,functionname,testcasenum, const)
				VALUES( '$topic', '$quest', '$diff', '$funname', '$testnum', '$const')";
		if(mysqli_query($conn, $sql)){

			$response = "question added to bank successfully";
			$sql = "SELECT questionID from bank where topic = '$topic' AND difficulty = '$diff' AND const = '$const' AND question = '$quest' AND functionname = '$funname'";
			$results = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($results);
			$questID = $row['questionID'];
			$i = 1;
			while($i<=$testnum){
			 $test = $tc[$i-1];
			 $sql = "INSERT INTO testcases(questionID, testcasenum, testcase) VALUES( '$questID', '$i', '$test')";
			 if(!mysqli_query($conn, $sql)){
			  $response = "failed to add test cases successfully: ".mysqli_error($conn);
			 }
			 $i++;


			}

		}
		else{
			$response = "failed to add question: " . mysqli_error($conn).'<br>';
		}
	  }
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode(array('response'=>$response));

}
?>