<?php
	session_start();
?>

<html>
<head>
	<title> FINAL CS311 </title>
	<?php 
	//require_once 'lib.php';
	include 'util.php';
	?>
	<!--put into utils.php ?-->
	<!--<link href="index_layout.css" rel="stylesheet" type="text/css" />
	<link href="index_photostyle.css" rel="stylesheet" type="text/css" />
	<link href="index_text.css" rel="stylesheet" type="text/css" />-->
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
			<h1 class="firstpage"> Content </h1>
			<p class="gallery"> Test your logic skills.
			
				
		</div>
		<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
		</div>
		
	</div>
</body>
</html>
