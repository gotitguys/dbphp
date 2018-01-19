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
<h2>Cart Total</h2>
<?php
session_start();
require 'connect.php';
require 'item.php';
  //$pid =$_GET['p_id'];
  //$result= pg_query($link,"SELECT * FROM products WHERE p_id='$pid'");
  //$row = pg_fetch_assoc($result);
   //while($row = pg_fetch_assoc($result)){
//echo $pid;
if(isset($_GET['p_id'])){
   $sql= 'SELECT * FROM products WHERE p_id='.$_GET['p_id'];
   $result= pg_query($link, $sql);
   //if (!$result){
//	echo "error";
  // }
   //$result= pg_query($link,"SELECT * FROM products WHERE p_id=".$_GET['p_id']);
   $row = pg_fetch_assoc($result);
   //$output.=$_GET['p_id'];
   $item = new Item();
   $item->id= $row['p_id'];
   $item->name =$row['p_name'];
   $item->price = $row['s_price'];
   $item->quantity=1;

   //check if product is existing in the cart 
   $index=-1;
   $cart=unserialize(serialize($_SESSION['cart']));
   for($i=0; $i<count($cart);$i++)
        if($cart[$i]->id == $_GET['p_id']){
                $index =(int)$i;
                break;
        }
   if($index ==-1){
        $_SESSION['cart'][]=$item;
   }
   else{
        $cart[$index]->quantity++;
        $_SESSION['cart']=$cart;
        }

}

// Delete product in cart
//$index=(int)$_GET['p_id'] + 1;        
 if (isset($_GET['index'])){
        $cart=unserialize(serialize($_SESSION['cart']));
        unset($cart[$_GET['index']]);
        $cart=array_values($cart);
        $_SESSION['cart'] =$cart;
}
?>

<center><table cellpadding="2" cellspacing="2" border="1"><tr>
<?php
echo '<table cellpadding="2" cellspacing="2" border="1"><tr><th>Option</th>
<th>Id </th>
<th>Name </th>
<th>Price </th>
<th>Quantity </th>
<th>Subtotal </th>
</tr>';
global $cart;
$cart = unserialize(serialize($_SESSION['cart']));
$s = 0;

$index = 0;
for ($i=0;$i<count($cart);$i++){
$s += $cart[$i]->price* $cart[$i]->quantity;
?>
<tr>
<td><a href="cart.php?index=<?php echo $index; ?>"  onclick="return confirm('Are you sure?')">Delete</a></td>
<td><?php echo $cart[$i]->id; ?></td>
<td><?php echo $cart[$i]->name; ?></td>
<td><?php echo $cart[$i]->price; ?></td>
<td><?php echo $cart[$i]->quantity; ?></td>
<td><?php echo $cart[$i]->price * $cart[$i]->quantity; ?> </td>
<?php
echo "</tr>";
        $index++;
        }
?>
<tr>
  <td colspan="5" align="right">Sum  </td>
  <td align="left"><?php echo $s; ?></td>
</tr>
</table>
<br>
<a href="shop.php">Continue Shopping</a>
<br>
<br>
<hr>
<center>
<h2>Shipping </h2>
	<h3>shipping cost: 7.99 </h3> 
<hr>
Tax rate: 7.25%
<br>
Total:
<?php 
global $ship;
	$ship = 7.99;
global $sum;
	$sum = $s;
global $tax;
$tax = .0725;
global $total;
$total = ($sum * $tax) + $sum + $ship;
echo round($total,2);
?>
 
 <br><br>
<form action="thankyou.php">
<button type="submit"> Checkout </button>
</form>
<br>
<br>
<br>
<br>
<!--<a href="orderpdf.php">Continue Shopping</a>-->
</body>
</html>

