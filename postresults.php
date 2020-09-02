<?php
if(isset($_POST['exam'])){
  $exam = $_POST['exam'];
  require 'connection.php';
  
  $sql = "UPDATE examnames SET posted = '1' where name = '$exam'";
  if(mysqli_query($conn, $sql)){
 	$response = "exam posted successfully";
   }
   else{
   	$response = "failed to post exam results: " . mysqli_error($conn).'<br>';
   }
 mysqli_close($conn);
 header('Content-Type: application/json');
 echo json_encode(array('response'=>$response));
}
?>