<?php

if(isset($_POST['exam']) && isset($_POST['student'])){
 $exam = $_POST['exam'];
 $student = $_POST['student'];

 require 'connection.php';

 $sql = " SELECT examresults.questionid, bank.question, bank.const, examresults.questionpoints, examresults.answer, examresults.testcasenum, examresults.functionnamescore, examresults.constraintscore, examresults.colonscore, examresults.test1q, examresults.test1a, examresults.test1sa, examresults.test1score,
  examresults.test2q, examresults.test2a, examresults.test2sa, examresults.test2score, examresults.test3q, examresults.test3a, examresults.test3sa, examresults.test3score, examresults.test4q, examresults.test4a, examresults.test4sa, examresults.test4score, examresults.autograde
         from examresults 
         INNER JOIN bank on examresults.questionid = bank.questionid
         where exam = '$exam' AND student = '$student'";
 $response = mysqli_query($conn, $sql);
 if($response != null){

 		$json = array();


 		while ($row = mysqli_fetch_assoc($response) ){
 			$json[] = $row;
 		}
 	}
 	else{
 		$json = array("failed to get answers: " . mysqli_error($conn).'<br>');
 	}
 	mysqli_close($conn);
 	header('Content-Type: application/json');
 	echo json_encode($json);

}
?>