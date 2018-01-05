<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once('connect.php');
include 'util.php';
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
      <a class="navbar-brand" href="index.php">HOME</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="shop.php">Products</a></li>
        <li><a href="#">Deals</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary" >
        <div class="panel-heading">Captain America</div>
        <div class="panel-body"><img src="productphotos/captainamerica.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price: 
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Incredible Hulk</div>
        <div class="panel-body"><img src="productphotos/incrediblehulk.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">price: 
	<button onclick="myFunction()" style="right">add to cart </button>
      	</div>
      </div>
	</div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Deadpool</div>
        <div class="panel-body"><img src="productphotos/deadpool.jpeg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price: 
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Wonder Woman</div>
        <div class="panel-body"><img src="productphotos/wonderwoman.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price: 
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Flash</div>
        <div class="panel-body"><img src="productphotos/flash.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price:
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Batman</div>
        <div class="panel-body"><img src="productphotos/batman.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price: 
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>

  </div>
</div><br>


<div class="container">    
  <div class="row">
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Dragon Age</div>
        <div class="panel-body"><img src="productphotos/dragonage.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>


    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">HellBoy</div>
        <div class="panel-body"><img src="productphotos/hellboy.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price:
	<button onclick="myFunction()" style="right">add to cart </button>
      </div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Conan</div>
        <div class="panel-body"><img src="productphotos/conan.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Price:
	<button onclick="myFunction()" style="right">add to cart </button></div>
      </div>
    </div>

</div>
</div><br><br>

<footer class="container-fluid text-center">
  <p>&copy CAVIE</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>


