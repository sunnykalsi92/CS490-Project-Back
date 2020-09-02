<?php
if (isset($_POST['questionID'])){
	$qid = $_POST['questionID'];
	require 'connection.php';

	$sql = "SELECT functionname,testcasenum, const FROM bank WHERE questionID = '$qid'";
	$response = mysqli_query($conn, $sql);
	if($response != null){

		$json = array();
		$row = mysqli_fetch_assoc($response);
		$first = $row;


        $sql = "SELECT testcase FROM testcases WHERE questionID = '$qid'";
	    $response = mysqli_query($conn, $sql);
      $second = '';
        while($row = mysqli_fetch_assoc($response)){
	    	$second[] =  $row;
	    
      }
		$json[] = $first + array('testcases'=>$second);


	}
	else{
		$json = array("failed to get question: " . mysqli_error($conn).'<br>');
	}
	mysqli_close($conn);
			header('Content-Type: application/json');
	echo json_encode($json);
}
?>