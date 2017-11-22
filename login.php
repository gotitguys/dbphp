<!--
File: login.php
Purpose: Authenticate the member 
To do's:
- Validate the user's credentials
- Set a flag in $_SESSION to true if login is successful, otherwise just echo 
  an error message (Initialize the 'active' session variable)
- Redirect user to home if they are already logged in
-->

<?php 
session_start();
include 'util.php';
//include 'lib.php';
function login() {
/******************************************************
 Write code to authenticate the user here and redirect 
 to the store if successful. Create a session variable 
 called 'active' and set to true (see lib.php). 
 Redirect the user to homepage once authenticated
 *****************************************************/
 require_once 'connect.php';
$fname = htmlspecialchars($_POST['user']);
$pword = htmlspecialchars($_POST['pass']);
$sql = "SELECT * FROM Users WHERE u_fname = '$fname' AND u_password = '$pword'";
$search = pg_query($link, $sql);
if(pg_num_rows($search)==0)
{
	echo "redirect to register";
	header('location: register.php');
}
else
{
	//echo "<div class='content'>";
	//echo "logged in set up session variables";
	$_SESSION['active']= true; // this should be done in login
                                       // after we've validated a successful
	while ($row = pg_fetch_assoc($search)){
	$_SESSION['u_id'] = $row['u_id'];
	$_SESSION['u_email'] = $row['u_email'];
	$_SESSION['u_password'] = $row['u_password'];
	$_SESSION['u_fname'] = $row['u_fname'];
	$_SESSION['u_lname'] = $row['u_lname'];
	header('location: quiz.php');
	}
	// DEBUG 
	//var_dump($_SESSION);
	echo "</div>";								   
}	

}

function redirect_if_active() {
/******************************************************
 Write code that redirects the user to homepage if they 
 are already logged in
 *****************************************************/
 /*if($_SESSION['active'])
	 header("location: quiz.php");*/
}

//redirect_if_active(){

// only processes login information if the submit button has been clicked
	if (isset($_POST['submit'])) 
		login();


?>

<html>
<head>
<title>Log in</title>
<?php 
	//require_once 'lib.php';
	require_once 'util.php';	
	?>
</head>
<body>
<div class='wrapper' >
	<div class="header">
			<?php include 'header.php' ?>	
	</div>
	<div class='lmenu' >
      <?php include_once 'left.php' ?>
	</div>
	<div class="rmenu">
			
	</div>
	<div class="content">
	<h2>
	Login
	</h2>
	<p>
	<form action="login.php" method="post">
	    Username: <input name="user" type="text" /><br>
	    Password: <input name="pass" type="password" />
	    <input name="submit" type="submit" value="Login" />
	</form>
	</p>
	<!--<a href="logout.php">Log out</a>-->


    </div>  <!-- end main div -->
	<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
	</div>
 </div>  <!-- end wrapper div -->
</body>
</html>
