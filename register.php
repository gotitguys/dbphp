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


//$email = mysqli_real_escape_string($link,htmlentities($_POST['email']));
//$pass1 = mysqli_real_escape_string($link,htmlentities($_POST['pass1']));
//$pass2 = mysqli_real_escape_string($link,htmlentities($_POST['pass2']));
//$fname = mysqli_real_escape_string($link,htmlentities($_POST['fname']));
//$lname = mysqli_real_escape_string($link,htmlentities($_POST['lname']));

// DEBUG 
var_dump($_POST);

if(isset($email) && !empty($email) &&
    isset($pass1) && !empty($pass1) ){// && check rest

        // STEP 1
        //   do here
        // STEP 2
        //   do here
        // STEP 3
        $sql = "INSERT INTO Users (u_email, u_password, u_fname, u_lname)
            VALUES('$email', '$pass1', '$fname', '$lname')";

        if(mysqli_query($link, $sql)) { // SUCCESSFULL
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
			
	</div>
	<div class="content">
	<h2>REGISTER</h3>

<form method='POST' action='register.php'>
First Name <input type='text' name='fname'><br>
Last Name <input type='text' name='lname'><br>
Email <input type='email' name='email'><br>
Password <input type='password' name='pass1'><br>
Password Verify <input type='password' name='pass2'><br>
<input type='submit' value='register'>
	
</form>
	</div>
	
	<div class="footer">
			<p class="author"><?php include 'footer.php'?></p>
	</div>
 </div>  <!-- end wrapper div -->
</body>
</html>	
