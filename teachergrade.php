<?php

if(isset($_POST['exam']) && isset($_POST['student']) && isset($_POST['questionid']) &&isset($_POST['functionnamec']) && 
   isset($_POST['test1c']) && isset($_POST['test2c']) && isset($_POST['teachergrade']) && isset($_POST['comment']) && isset($_POST['testcasenum'])){
 $exam = $_POST['exam'];
 $student = $_POST['student'];
 $qid = $_POST['questionid'];
 $fnc = $_POST['functionnamec'];
 $t1c = $_POST['test1c'];
 $t2c = $_POST['test2c'];
 $tgrade = $_POST['teachergrade'];
 $comment = $_POST['comment'];
 $testnum = $_POST['testcasenum'];
 $constc = $_POST['constraintc'];
 $colonc = $_POST['colonscorec'];
 
 require 'connection.php';
 if($testnum == 4){
   $t3c = $_POST['test3c'];
   $t4c = $_POST['test4c'];
   $sql = "UPDATE examresults SET functionnameC = '$fnc', constraintC = '$constc', colonC = '$colonc', test1c = '$t1c', test2c = '$t2c', test3c = '$t3c', test4c = '$t4c', teachergrade = $tgrade, comment = '$comment' WHERE exam = '$exam' AND student = '$student' AND questionid = ' $qid'";
 }
 else if ($testnum == 3){
   $t3c = $_POST['test3c'];
   $sql = "UPDATE examresults SET functionnameC = '$fnc', constraintC = '$constc', colonC = '$colonc', test1c = '$t1c', test2c = '$t2c', test3c = '$t3c',  teachergrade = $tgrade, comment = '$comment' WHERE exam = '$exam' AND student = '$student' AND questionid = ' $qid'";
 }
 else{
   $sql = "UPDATE examresults SET functionnameC = '$fnc', constraintC = '$constc', colonC = '$colonc', test1c = '$t1c', test2c = '$t2c', teachergrade = $tgrade, comment = '$comment' WHERE exam = '$exam' AND student = '$student' AND questionid = ' $qid'";
 
 }
   
 if(mysqli_query($conn, $sql)){
 	$response = "200";
 }
 else{
 	$response = "failed to update score: " . mysqli_error($conn).'<br>';
 }
 mysqli_close($conn);
 header('Content-Type: application/json');
 echo json_encode(array('response'=>$response));
}
?>