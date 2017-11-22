<?php
	session_start();
?>

<html>
<head>
	<title> DATABASE 3420 </title>
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
			<?php include 'right.php' ?>	 
		</div>
		<div class="content">
			<h1 class="firstpage"> Store </h1>
			<p class="gallery"> Buy Stuff Now!!!<p>
			<p class="gallery">Or Ana Will Beat You Up!!!<p>
			<a href='test.php'>Testing connection and reading Customers from database</a>	
			
				
		</div>
		<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
		</div>
		
	</div>
</body>
</html>
