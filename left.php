<?php
	session_start();

if ($_SESSION['active']){
echo <<<EOT
<ul>
<li><h2>Menu</h2></li>
<hr>	
<li><a href='index.php'>Home</a></li>
<li><a href='quiz.php'>Quiz</a></li>
<li><a href='profile.php'>Profile</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul>
EOT;
}

else{
	echo <<< EOT
<ul>
<li><h2>Menu</h2></li>
<hr>	
<li><a href='index.php'>Home</a></li>	
<li><a href='login.php'>Login</a></li>
<li><a href='register.php'>Register</a></li>
<li><a href ='products.php'>Products</a></li>
</ul>
EOT;
}

?>
