<?php 
session_start(); // needed for $_SESSION
require_once('connect.php');
include 'util.php';
//include 'lib.php';
$error = "";
// if form is submitted
//   validate all form fields are submitted
//   extract and sanitize form fields
//
//   1) query user's email to make sure there is not
//      an email already in the database 
//      $result = mysqli_query(
//        $link, "SELECT u_email WHERE u_email='$email'");
//
//        //IF EMAIL EXISTS -> ERROR
//        if(!$result) { // result is NULL
//          $error.= "Email already exists! Must use other email";
//          break;
//        }
//
//
//   2) validate passwords match -> if(!strcmp($pass1, $pass2) )
//        
//        //ELSE PASSWORDS DO NOT MATCH -> ERROR
//        $error.="Passwords Do Not Match";
//
//   3) INSERT INTO Users (u_email, u_password, u_fname, u_lname)
//       VALUES('$email', '$pass1', '$fname', '$lname');
//
//   4) Redirect to Login.php
// endif

// if($error!="") 
//  echo $error;

//NOTE:data should be sanitized but don't worry about for database
$email = pg_escape_string($link,htmlentities($_POST['email']));
$pass1 = pg_escape_string($link,htmlentities($_POST['pass1']));
$pass2 = pg_escape_string($link,htmlentities($_POST['pass2']));
$fname = pg_escape_string($link,htmlentities($_POST['fname']));
$lname = pg_escape_string($link,htmlentities($_POST['lname']));
$middle_init = pg_escape_string($link,htmlentities($_POST['middle_init']));
$areaCode = pg_escape_string($link,htmlentities($_POST['areaCode']));
$prefix = pg_escape_string($link,htmlentities($_POST['prefix']));
$suffix = pg_escape_string($link,htmlentities($_POST['suffix']));
//concatenate phone number into 1 ten digit string
$phone = $areaCode . $prefix . $suffix;

/*
$email = pg_escape_literal($link,htmlentities($_POST['email']));
$pass1 = pg_escape_literal($link,htmlentities($_POST['pass1']));
$pass2 = pg_escape_literal($link,htmlentities($_POST['pass2']));
$fname = pg_escape_literal($link,htmlentities($_POST['fname']));
$lname = pg_escape_literal($link,htmlentities($_POST['lname']));
$middle_init = pg_escape_literal($link,htmlentities($_POST['middle_init']));
$phone = pg_escape_literal($link,htmlentities($_POST['phone']));
*/

// DEBUG 
var_dump($_POST);

if(isset($email) && !empty($email) &&
		isset($pass1) && !empty($pass1) ){// && check rest

	// STEP 1
	//   do here
	// STEP 2
	//   do here
	// STEP 3
	//$sql = "INSERT INTO Users (u_email, u_password, u_fname, u_lname)
	//	VALUES('$email', '$pass1', '$fname', '$lname')";
	$sql = "INSERT INTO customer (Customer_id, Fname, Middle_init, Lname, Pword, Email, phone)
		VALUES( DEFAULT, '$fname', '$middle_init','$lname','$pass1', '$email', '$phone')";

	if(pg_query($link, $sql)) { // SUCCESSFULL
		// (set session values in login.php   "suggestion" )
		// redirect to login.php
		//header("Location: home.php");
		echo "SUCCESSFULL REGISTER :) ";
		// $_SESSION['active']= true; // this should be done in login
		// after we've validated a successful
	} else {
		$error.="QUERY Failed";
	}
}
else {
	$error.="Missing Form Fields";
	echo "<script>console.log('hey')</script>";
}

if($error!="")
echo $error."<br>";
?>
<html>
<head>
<title>Register</title>
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
<?php include_once 'right.php' ?>

</div>
<div class="content">
<h2>REGISTER</h3>

<form method='POST' action='register.php'>
First Name <input type='text' name='fname'><br>
Middle Initial <input type='text' name='middle_init'><br>
Last Name <input type='text' name='lname'><br>
Email <input type='email' name='email'><br>
Password <input type='password' name='pass1'><br>
Password Verify <input type='password' name='pass2'><br>
Phone (<input type='tel' size=3 name='areaCode'>)<input type=tel size=3 name='prefix'> - <input type=tel size=4 name='suffix'  > <br>
<input type='submit' value='register'>

</form>
</div>

<div class="footer">
<p class="author"><?php include 'footer.php'?></p>
</div>
</div>  <!-- end wrapper div -->
</body>
</html>	
