<?php
	session_start();
	require_once 'util.php';
	require_once('connect.php');
	$u_id =($_SESSION['u_id']);	
?>	

<html>
<head>
	<title> QUIZ </title>
</head>

<body>
	<div class="wrapper">
		<!--<img src="jollyroger_lowcontrast.jpg" alt="Jolly Roger" width='1200px' height='800px' />-->
		<div class="header">
			<?php include 'header.php' ?>	
		</div>
		<div class="lmenu">
			<?php include 'left.php' ?>
		</div>
		<div class="rmenu">
			 
		</div>
		<div class="content">
			<?php
				//$u_id =($_SESSION['u_id']);
				$sql="SELECT * FROM Quiz WHERE u_id = '$u_id'";
				$result = mysqli_query($link, $sql);
				if(mysqli_num_rows($result)!= 0){
					$stored ="";
					while($row = mysqli_fetch_assoc($result)){
						$stored = $row['q_results'];
					}
						echo "<h1> Quiz Result: $stored <br>";
						include('retake_button.html'); 
				}
				else{include 'quiz1.html';}
			?>
			<!--<h1 class="firstpage"> QUIZ </h1>
			<p class="gallery"> Relevant Form-->	
		</div>
		<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
		</div>
		
	</div>
</body>
</html>