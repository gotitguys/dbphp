<!-- 
File: lib.php
Purpose: Set of variables and functions used by multiple scripts (library)
To do's: Nothing (you may add/modify items if you'd like though)
-->

<?php
/* 
    sets cookie to HTTP-Only and inaccessible to other 
    scripting lang. prevent XSS attacks
*/
ini_set("session.cookie_secure",1);
ini_set("session.cookie_httponly", 1);
ini_set("session.use_only_cookies",1);

/* 
    This function will redirect to the home page if the user is 
    not logged in. You should not need to modify this function
    except for location to 'home' page
*/
function redirect_if_offline() {
    session_start();

    // Destroy session and redirect to home page if not logged in
    if (!isset($_SESSION['active'])) {
      setcookie(session_name(),"",-1,"/");
      $_SESSION = array();
      session_destroy();
      header("location: index.php");  // <-might have to change location
    }
}

function get_date(){
	return date('m/d/Y-h:ia');
}
?>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />    

<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
	<link href="index_layout.css" rel="stylesheet" type="text/css" />
	<!--<link href="index_photostyle.css" rel="stylesheet" type="text/css" />-->
	<link href="index_text.css" rel="stylesheet" type="text/css" />

<!-- INCLUDE STYLE .css -->
