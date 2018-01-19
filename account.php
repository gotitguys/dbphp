<!DOCTYPE html>
<html lang="en">


<?php

session_start();
require_once('connect.php');
include 'util.php';
if(! ($_SESSION['active'])){
?>

<head>
<title>CAVIE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
/* Remove the navbar's default rounded borders and increase the bottom margin */ 
.navbar {
        margin-bottom: 50px;
        border-radius: 0;
}

/* Remove the jumbotron's default bottom margin */
.jumbotron {
        min-height: 500px;
        background-image:url('CAIHflop.jpg');
        background-repeat: no-repeat;
        background-size: cover;
position: center;
          margin-bottom: 0;
          /*-webkit-transform: scaleX(-1);
transform: scaleX(-1);*/
}

/* Add a gray background color and some padding to the footer */

footer {
        background-color: #f2f2f2;
padding: 25px;
}

#jumboHeader {
color: red;
display: block;
         font-weight: bold;
         font-size: 68px;
}
</style>
</head>
<body>

<div class="jumbotron">
<div class="container text-center">
<h1 id="jumboHeader">Captain Ana vs. Incredible Esteban</h1>
</div>
</div>
 
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="index.php">Home</a>
</div>  
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a class="navbar-brand" href="shop.php">Products</a></li>
<li><a class="navbar-brand" href="contact.php">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
</ul>
</div>
</div>
</nav>
<h1> Please Login</h1>
<?php } 
else{ 
$result = pg_query($link,"SELECT * FROM customer WHERE customer_id ='1'");
$row = pg_fetch_assoc($result);
?> 
<head>
<title>CAVIE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
/* Remove the navbar's default rounded borders and increase the bottom margin */ 
.navbar {
        margin-bottom: 50px;
        border-radius: 0;
}

/* Remove the jumbotron's default bottom margin */
.jumbotron {
        min-height: 500px;
        background-image:url('CAIHflop.jpg');
        background-repeat: no-repeat;
        background-size: cover;
position: center;
          margin-bottom: 0;
          /*-webkit-transform: scaleX(-1);
transform: scaleX(-1);*/
}

/* Add a gray background color and some padding to the footer */

footer {
        background-color: #f2f2f2;
padding: 25px;
}

#jumboHeader {
color: red;
display: block;
         font-weight: bold;
         font-size: 68px;
}
</style>
</head>
<body>

<div class="jumbotron">
<div class="container text-center">
<h1 id="jumboHeader">Captain Ana vs. Incredible Esteban</h1>
</div>
</div>
 
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="index.php">Home</a>
</div>  
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a class="navbar-brand" href="shop.php">Products</a></li>
<li><a class="navbar-brand" href="contact.php">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
</ul>
</div>
</div>
</nav>
<h1> Welcome <?php echo $row['fname']." ".$row['lname']?> ! </h1>

<div class="container">
  <h2>Personal Information </h2>
<hr> 
 <p>
First Name: <?php echo $row['fname'];	?>
<br>
Middle Initial: <?php echo $row['middle_init'];	?>
<br>
Last Name: <?php echo $row['lname'];	?>
<br>
Email: <?php echo $row['email'];	?>
</p>
  <button type="button">Edit</button>
  </div>
</div>
<?php 
$result2 = pg_query($link,"SELECT * FROM address WHERE customer_id ='1'");
$row2 =pg_fetch_assoc($result2);
?>
<div class="container">
  <h2>shipping Address </h2>
<hr> 
  <p>
 <?php echo $row2['street_num']." ".$row2['street_name'];	?>
<br>
 <?php echo $row2['city'].", ".$row2['state']." ".$row2['zip'];	?>
 </p>
  <button type="button">Edit</button>
  </div>
</div>
<?php 
$result3 = pg_query($link,"SELECT * FROM payment WHERE fname = 'Clark'");
$row3 =pg_fetch_assoc($result3);
?>
<div class="container">
  <h2>Payment Information </h2>
<hr> 
  <p>
Cardholder's Name: <?php echo $row3['fname']." ".$row3['lname'];?>
<br>
 Card Number: ************9328
<br>
Expiration date: <?php echo $row3['expiration']; ?>
<br>
Type: <?php echo $row3['type']; ?>
<br> 
<h4> Billing Address </h4>
 <?php echo $row3['street_num']." ".$row3['street_name'];	?>
<br>
 <?php echo $row3['city'].", ".$row3['state']." ".$row2['zip'];	?>
 </p>
  <button type="button">Edit</button>

<br>
<br>
<br>

  </div>
</div>
<?php 
} 
?>
</body>
</html>
