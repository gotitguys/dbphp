<?php
	session_start();
	require_once('connect.php');
	//require_once 'lib.php';
	require_once 'util.php';
	//clean all posts
$Q1=htmlspecialchars($_POST['Q1']);//keep these to validate form
$Q2=htmlspecialchars($_POST['Q2']);
$Q3=htmlspecialchars($_POST['Q3']);
$Q4=htmlspecialchars($_POST['Q4']);
$Q5=htmlspecialchars($_POST['Q5']);
$Quiz_No=trim($_POST['quiz_no']);
$Q =array(htmlspecialchars($_POST['Q1']), htmlspecialchars($_POST['Q2']), htmlspecialchars($_POST['Q3']),
 htmlspecialchars($_POST['Q4']), htmlspecialchars($_POST['Q5']));
$filename = "answers.txt";
$inf = fopen($filename, "r") or exit("Unable to open data file.");
$data = fread($inf, filesize($filename));
$fclose = ($inf);
$token = preg_split('/[\t \n,]+/', $data, -1, PREG_SPLIT_NO_EMPTY);
$count = 0;

print_r ($token);
print_r ($Q);
$correct = 0;

for ($i =0; $i < 5; $i++){
	echo "<br>".$token[$i]." and ".$Q[$i];
	$j = $token[$i];
	$k = $Q[$i];
	echo "<br>$j<br>";
	echo "$k<br>";
	/*if (($token[$i] === true && $Q[$i] === true) || ($token[$i] === false && $Q[$i] === false))*/
	if (trim($j) == trim($k))//without trim they would not match, need to sanitize right away
	{
		$correct++;
		echo "$correct<br>";	
	}
}
echo "<br>".$correct. " answered correctly!";
echo "<br>";
$results = $correct. "/5";
echo "final results = $results<br>";
       // $sql = "INSERT INTO Users (u_email, u_password, u_fname, u_lname)
         //   VALUES('$email', '$pass1', '$fname', '$lname')";
$u_id = trim($_SESSION['u_id']);//I think too many quotes is interfering with my insertion query	
echo "u_id = $u_id<br>";
echo "QUIZ NO = $Quiz_No<br>";	 
$sql = "INSERT INTO Quiz (q_no , u_id, q_results) VALUES ('$Quiz_No', '$u_id', '$results')";
if(mysqli_query($link, $sql)) { // SUCCESSFULL
            // (set session values in login.php   "suggestion" )
            // redirect to login.php
            //header("Location: home.php");
    echo "SUCCESSFULL ENTRY TO DATABASE :) ";
	header("Location: quiz.php");
           // $_SESSION['active']= true; // this should be done in login
                                       // after we've validated a successful
    } 
else {
    $error.="QUERY Failed";
	echo "$error<br>";
}
?>





