<?php
if (isset($_POST['query'])){
	
	if($_POST['query'] == 'gettopics'){
		require 'connection.php';

		$sql = "SELECT DISTINCT topic from bank";
		$response = mysqli_query($conn, $sql);
		if($response != null){

			$json = array();

			while ($row = mysqli_fetch_assoc($response) ){
				$json[] = $row['topic'];
			}
		}
		else{
			$json = array("failed to get topics: " . mysqli_error($conn).'<br>');
		}
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode($json);
	}
	else if($_POST['query'] == 'getexamnames'){
		require 'connection.php';
		$sql = "SELECT name from examnames";
		$response = mysqli_query($conn, $sql);
		if($response != null){

			$json = array();


			while ($row = mysqli_fetch_assoc($response) ){
				$json[] = $row['name'];
			}
		}
		else{
			$json = array("failed to get exam names: " . mysqli_error($conn).'<br>');
		}
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode($json);
	}
		else if($_POST['query'] == 'getstudentids'){
		require 'connection.php';
		$sql = "SELECT username from roster where role = 's'";
		$response = mysqli_query($conn, $sql);
		if($response != null){

			$json = array();


			while ($row = mysqli_fetch_assoc($response) ){
				$json[] = $row['username'];
			}
		}
		else{
			$json = array("failed to get studentids: " . mysqli_error($conn).'<br>');
		}
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode($json);
	}
   else if($_POST['query'] == 'getposted'){
		require 'connection.php';
		$sql = "SELECT name from examnames where posted = 1";
		$response = mysqli_query($conn, $sql);
		if($response != null){

			$json = array();


			while ($row = mysqli_fetch_assoc($response) ){
				$json[] = $row['name'];
			}
		}
		else{
			$json = array("failed to get examnames: " . mysqli_error($conn).'<br>');
		}
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode($json);
	}
   else if($_POST['query'] == 'getnotposted'){
		require 'connection.php';
		$sql = "SELECT name from examnames where posted = 0";
		$response = mysqli_query($conn, $sql);
		if($response != null){

			$json = array();


			while ($row = mysqli_fetch_assoc($response) ){
				$json[] = $row['name'];
			}
		}
		else{
			$json = array("failed to get examnames: " . mysqli_error($conn).'<br>');
		}
		mysqli_close($conn);
		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
?>