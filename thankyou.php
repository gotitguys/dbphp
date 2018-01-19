 <!DOCTYPE html>
<html lang ="en"
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
table {
width: 40%;
height: 40px;

}
tr:nth-child(even) {background-color: #f2f2f2;}


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
<center>
<h1> Thank You For your Order</h1>
<a href="orderpdf.php">Receipt</a>


</body>
</html>
