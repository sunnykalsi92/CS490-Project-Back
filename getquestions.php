<?php
if (isset($_POST['topic']) && isset($_POST['difficulty']) && isset($_POST['keyword'])){
	$topic = $_POST['topic'];
	$diff = $_POST['difficulty'];
  $key = $_POST['keyword'];
  if($topic == 'all'){
    $topic = '';
  }
  if($diff == 'all'){
   $diff = '';
  }
	require 'connection.php';

	$sql = "SELECT questionID, question, const FROM bank WHERE topic LIKE '%$topic%' AND difficulty LIKE '%$diff%' AND question LIKE '%$key%'";
	$response = mysqli_query($conn, $sql);
	if($response != null){

		$json = array();


		while ($row = mysqli_fetch_assoc($response) ){
			$json[] = $row;
		}
	}
	else{
		$json = array("failed to get topics: " . mysqli_error($conn).'<br>');
	}
	mysqli_close($conn);
			header('Content-Type: application/json');
	echo json_encode($json);
}
?>