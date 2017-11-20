<?php 
require_once 'util.php';
// Destroys the session and deletes the cookie from the web browser
session_start();
$_SESSION = array();
setcookie(session_name(),"",-1,"/");
session_destroy();
if($_SESSION['active']!= true);
header("location: index.php");
?>
<html>
<head>
</head>

<body>
<div class='wrapper' >
	<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
	</div>
	<div class="rmenu">
			
	</div>
	<div class="header">
			<?php include 'header.php' ?>	
	</div>
   <div class='lmenu' >
      <?php include_once 'left.php' ?>
   </div>
      <div class='content'>
      
You are now logged out.<br />
<!--<a href=".">Browse</a>-->

    </div>  <!-- end main div -->
 </div>  <!-- end wrapper div -->
</body>
</html>
