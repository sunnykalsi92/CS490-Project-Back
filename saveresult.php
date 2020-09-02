<?php

if(isset($_POST['exam']) && isset($_POST['qpoints']) && isset($_POST['student']) && isset($_POST['questionid']) && isset($_POST['answer'])
	&& isset($_POST['testcasenum']) && isset($_POST['functionnamescore']) && isset($_POST['testCaseGrades']) && isset($_POST['autograde']) 
  && isset($_POST['testcaseq']) && isset($_POST['testcasea']) && isset($_POST['testcaser'])){

 $exam = $_POST['exam'];
 $student = $_POST['student'];
 $qid = $_POST['questionid'];
 $answer = $_POST['answer'];
 $funname = $_POST['functionnamescore'];
 $tc = $_POST['testCaseGrades'];
 $t1 = $tc[0];
 $t2 = $tc[1];
 $tq = $_POST['testcaseq'];
 $ta = $_POST['testcasea'];
 $tr = $_POST['testcaser'];
 $agrade = $_POST['autograde'];
 $points = $_POST['qpoints'];
 $testnum = $_POST['testcasenum'];
 $conscore = $_POST['constraintscore'];
 $colonscore = $_POST['colonscore'];
 
 $tq1 = $tq[0];
 $tq2 = $tq[1];
 $ta1 = $ta[0];
 $ta2 = $ta[1];
 $tr1 = $tr[0];
 $tr2 = $tr[1];
 
 
 require 'connection.php';
 if($testnum == 4){
 	$t4 = $tc[3];
 	$t3 = $tc[2];
  $tq3 = $tq[2];
  $tq4 = $tq[3];
  $ta3 = $ta[2];
  $ta4 = $ta[3];
  $tr3 = $tr[2];
  $tr4 = $tr[3];
 	$sql = "INSERT examresults(exam, student, questionid, questionpoints, answer, testcasenum, constraintscore, colonscore, functionnamescore, test1q, test1a, test1sa, test2q, test2a, test2sa, test3q, test3a, test3sa, test4q, test4a, test4sa, test1score, test2score, test3score, test4score, autograde) VALUES ('$exam', '$student',
     '$qid', '$points', '$answer', '$testnum', $conscore, $colonscore, '$funname', '$tq1', '$ta1', '$tr1', '$tq2', '$ta2', '$tr2', '$tq3', '$ta3', '$tr3', '$tq4', '$ta4', '$tr4', '$t1', '$t2', '$t3', '$t4', '$agrade')";
 }
 else if ($testnum == 3){
 	$t3 = $tc[2];
  $tq3 = $tq[2];
  $ta3 = $ta[2];
  $tr3 = $tr[2];
 	$sql = "INSERT examresults(exam, student, questionid, questionpoints, answer, testcasenum, constraintscore, colonscore, functionnamescore, test1q, test1a, test1sa, test2q, test2a, test2sa, test3q, test3a, test3sa, test1score, test2score, test3score, autograde) VALUES ('$exam', '$student',
      '$qid', '$points', '$answer', '$testnum', $conscore, $colonscore, '$funname', '$tq1', '$ta1', '$tr1', '$tq2', '$ta2', '$tr2', '$tq3', '$ta3', '$tr3', '$t1', '$t2', '$t3','$agrade')";
 }
 else{
 	$sql = "INSERT examresults(exam, student, questionid, questionpoints, answer, testcasenum, constraintscore, colonscore, functionnamescore, test1q, test1a, test1sa, test2q, test2a, test2sa, test1score, test2score, autograde) VALUES ('$exam', '$student',
      '$qid', '$points', '$answer', '$testnum', $conscore, $colonscore, '$funname', '$tq1', '$ta1', '$tr1', '$tq2', '$ta2', '$tr2', '$t1', '$t2', '$agrade')";
 }

 if(mysqli_query($conn, $sql)){
 	$response = "stored successfully";
 }
 else{
 	$response = "failed to save result: " . mysqli_error($conn).'<br>';
 }
 mysqli_close($conn);
 header('Content-Type: application/json');
 echo json_encode(array('response'=>$response));
}
?>