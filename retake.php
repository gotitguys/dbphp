<?php
	session_start();
	require_once('connect.php');
	require 'lib.php';
	require 'utils.php';
	$u_id =($_SESSION['u_id']);
	
	//function jumbalaya(){
		require_once('connect.php');
		echo "DEBUG: in retake function<br>";
		$sql="DELETE FROM Quiz WHERE u_id='$u_id'";
		$obliterate = mysqli_query($link, $sql);
		//if(mysqli_num_rows($obliterate)== 0) 
		//	echo "QUIZ DELETED<br>";
		//else echo"DEBUG: error<br>";
		$sql="SELECT * FROM Quiz WHERE u_id = '$u_id'";
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result)== 0){
			header('location: quiz.php');
		}
	//}
	
	//if (isset($_POST['retake']))
		//jumbalaya();//i suspect i am using keywords, no way this is a keyword
	
	?>