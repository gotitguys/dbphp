<?php
	session_start();

if ($_SESSION['active']){
echo <<<EOT
<ul>
<li><h2>Menu</h2></li>
<hr>	
<li><a href='index.php'>Home</a></li>
<br>
<li><a href='shop.php'>Shop</a></li>
<br>
<li><a href='contact.php'>Contact</a></li>
<br>
<li><a href='logout.php'>Logout</a></li>
<br>
</ul>
EOT;
}

else{
	echo <<< EOT
<ul>
<li><h2>Menu</h2></li>
<hr>	
<li><a href='index.php'>Home</a></li>	
<br>
<li><a href='login.php'>Login</a></li>
<br>
<li><a href='register.php'>Register</a></li>
<br>
<li><a href ='shop.php'>Shop</a></li>
<br>
<li><a href ='contact.php'>Contact</a></li>
</ul>
EOT;
}

?>
