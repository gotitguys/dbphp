<?php
	session_start();
	require_once 'util.php';
/*echo "<h1 class='firstpage'>Captain Ana vs. Incredible Esteban</h1>";*/
if ($_SESSION['active']){
$fname = $_SESSION['u_fname'];	
echo "<h2 class='welcome'> Welcome $fname, May the odds be ever in your favor </h2>";
}

?>
