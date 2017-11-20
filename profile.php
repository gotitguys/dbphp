<?php 
session_start();
//require_once "lib.php";
require_once "util.php";
require_once 'connect.php';

//$current = mysqli_real_escape_string($link,htmlentities($_POST['current_password']));
//$new1 = mysqli_real_escape_string($link,htmlentities($_POST['new_password1']));
//$new1 = mysqli_real_escape_string($link,htmlentities($_POST['new_password2']));
$current_stored = $_SESSION['u_password'];
$current = htmlspecialchars($_POST['current_password']);
$u_id =$_SESSION['u_id'];
$new_password_match = true;
$password_updated = false;
if(isset($current) && !empty($current)){
	if($current != $current_stored)
	echo "You must enter your current password<br>";

	$new1 = htmlspecialchars($_POST['new_password1']);
	$new2 = htmlspecialchars($_POST['new_password2']);
	// only processes form information if the submit button has been clicked
	//if (isset($_POST['submit'])) { 
	if(isset($new1) && !empty($new1) &&
    isset($new2) && !empty($new2) ){
	if($new1 != $new2){
		$new_password_match = false;
		//echo "please make sure new password and confirmation are the same<br>";
	}
	else{
		$sql = "UPDATE Users SET u_password = '$new1' WHERE u_id = '$u_id'";
		if(mysqli_query($link, $sql)){
			$password_updated = true;
			//echo "Password updated<br>";
		}
	}

    //validate form data is not empty
    //
    //sanitize form data into variables
    //
	}   //INSERT INTO Users VALUES 
}
?>

<html>
<head>
<title>Profile</title>
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
    <div class='content'>

<h1>Profile</h1>
<?php
	//echo "$_SESSION['u_id']<br>";
	$email = $_SESSION['u_email'];
	$_SESSION['u_password'];
	
	$first = $_SESSION['u_fname'];
	$last = $_SESSION['u_lname'];
	echo "<h3>First Name: $first</h3>";
	echo "<h3>Last Name : $last</h3>";
	echo "<h3>Email     : $email </h3>";
?>
<?php if(!$new_password_match){
	echo "<h2>New Passwords do not match each other, try again</h2>";
}
	if($password_updated){
		echo "<h2> Password updated successfuly</h2>";
	}
?>
<p>
	<form action="profile.php" method="post">
	    Enter Current Password: <input name="current_password" type="password" /><br>
	    Enter New Password:     <input name="new_password1" type="password" /><br>
	    Confirm New Password:   <input name="new_password2" type="password" /><br>
	    <input name="submit" type="submit" value="Reset Password" />
	</form>
</p>
<!--<a href="logout.php">Log out</a>-->


    </div>  <!-- end main div -->
	<div class="footer">
			<h2><class="author"><?php include 'footer.php'?></h2>
	</div>
 </div>  <!-- end wrapper div -->
</body>
</html>
