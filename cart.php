<!DOCTYPE html>
<html lang="en">
<style>
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

body{
  background:#f2f3f4;
  font-size:62%;
  font-family:'Arial', sans-serif;
  min-width:320px;
}
h1,
h2,
h3,
h4,
h5,
h6{
  font-weight:500;
}
img{
  max-width:100%;
}
#wrap{
  width:80%;
  margin:20px auto;
}
#cart_layout_1{
  color:#808080;
}
#cart_layout_1 h1{
 font-size:3.6em;
 line-height:.5;
}
#cart_layout_1 .cart_info{
  border-top:2px solid #ccc;
  width:100%;
  padding:1em;
  height:270px;
  max-height:300px;
  border-bottom:2px solid #ccc;
}
#cart_layout_1 .cart_info .product{
  display:block;
  float:left;
  width:30%;
}
#cart_layout_1 .cart_info .product img{
  max-height:270px;
}
#cart_layout_1 .cart_info .product_info{
  display:block;
  float:left;
  width:10%;
  margin-left:5%;
  position:relative;
  height:100%;
}
#cart_layout_1 .cart_info .product_info span{
  font-size:1.6em;
  color:#292929;
  display:block;
  font-weight:700;
}
.center{
  height:30%;
  position:absolute;
  top:0;bottom:0;left:0;right:0;
  margin:auto;
}
#cart_layout_1 .cart_info .details{
  width:50%;
  margin-left:5%;
  float:left;
  height:100%;
}
#cart_layout_1 .cart_info .details .qty,
#cart_layout_1 .cart_info .details .price,
#cart_layout_1 .cart_info .details .remove{
  display:block;
  position:relative;
  height:100%;
  width:30%;
  float:left;
  text-align:center;
}
#cart_layout_1 .cart_info .details .qty span{
  font-size:1.8em;
  color:#292929;
}
#cart_layout_1 .cart_info .details .qty input{
  width:40px;
  height:40px;
  border:1px solid #ccc;
  border-radius:3px;
}
#cart_layout_1 .cart_info .details .price{
  font-size:1.8em;
  color:#292929;
  bottom:-10px;
}
#cart_layout_1 .cart_info .details .hidden{
  display:none;
}
#cart_layout_1 .cart_info .details .remove{
  font-size:4.3em;
  float:right;
}
#cart_layout_1 .complete_cart{
  width:100%;
}
#cart_layout_1 .complete_cart .updated{
  width:50%;
  float:left;
}
#cart_layout_1 .complete_cart .updated .shipping{
  border-bottom:2px solid #ccc;
  height:auto;
  float:left;
  width:100%;
}
#cart_layout_1 .complete_cart .updated .shipping h2{
  font-size:2.6em;
  margin-top:-2px;
  margin-bottom:0;
}
#cart_layout_1 .complete_cart .updated .shipping .state{
  width: 30%;
  float:left;
  max-width:120px;
  height: 30px;
  overflow: hidden;
  background: url('https://i.imgur.com/10e9Roz.png') no-repeat right #FFF;
  border: 1px solid #ccc;
  border-radius:3px;
  margin:15px 0px;
  display:inline-block;
}
#cart_layout_1 .complete_cart .updated .shipping .state select{
  background: transparent;
  display:block;
  width: 268px;
  padding: 5px;
  font-size: 1.5em;
  line-height: 1;
  border: 0;
  border-radius:0;
  height: 30px;
  -webkit-appearance: none;
}
#cart_layout_1 .complete_cart .updated .shipping .zip{
  display:inline-block;
  float:left;
  width:30%;
  margin-left:5%;
}
#cart_layout_1 .complete_cart .updated .shipping .zip input{
  height:30px;
  width:100%;
  margin:15px 0px;
  border:1px solid #ccc;
  border-radius:3px;
  padding-left:5px;
}
#cart_layout_1 .complete_cart .updated .shipping .calc{
  width:30%;
  display:inline-block;
  float:left;
  margin-top;15px;
  margin-left:4%;
}
.button{
  margin-top:15px;
  background:#ffc04d;
  height:35px;
  display:block;
  color:#FFF;
  text-align:center;
  padding:5px;
  text-decoration:none;
  font-size:2em;
  box-sizing:border-box;
  border-radius:3px;
}
#cart_layout_1 .complete_cart .updated .coupon{
  width:100%;
  float:left;
  margin-bottom:10px;
}
#cart_layout_1 .complete_cart .updated .coupon h2{
  font-size:1.6em;
  display:inline-block;
  float:left;
  width:30%;
}
#cart_layout_1 .complete_cart .updated .coupon input{
 display:inline-block;
 float:left;
 margin-top:10px;
 margin-left:10px;
 width:30%;
 height:30px;
 border-radius:3px;
 border: 1px solid #ccc;
}
#cart_layout_1 .complete_cart{
  float:left;
  width:100%;
  border-bottom:5px solid #ccc;
}
#cart_layout_1 .complete_cart .updated .coupon .update{
 width:30%;
  display:inline-block;
  margin-top:10px;
  margin-left:15px;
  float:left;
}
#cart_layout_1 .complete_cart .checkout{
  width:50%;
  float:left;
  margin-left:0;
}
#cart_layout_1 .complete_cart .checkout .total{
  width:50%;
  float:left;
  position:relative;
  text-align:center;
}
#cart_layout_1 .complete_cart .checkout h2{
  display:inline-block;
  font-size:2.5em;
  font-weight:500;
  margin-top:0;
  margin-bottom;0;
}
#cart_layout_1 .complete_cart .checkout .sub{
  display:block;
  font-size:1.2em;
  margin-top:-25px;
  
}
#cart_layout_1 .complete_cart .subtotal{
  font-size:3em;
  width:40%;
  float:left;
  text-align:center;
}
#cart_layout_1 .complete_cart .bfb{
  width:100%;
  float:left;
  position:relative;
}
#cart_layout_1 .mobile{
  display:none;
}
#cart_layout_1 .complete_cart .bfb .button{
  width:50%;
  display:block;
  margin:15px auto;
  position:absolute;
  top:45px;
  left:25%;
}
@media (max-width:800px){
  #cart_layout_1 .complete_cart .updated{
     width:65%;
  }
  #cart_layout_1 .complete_cart .checkout{
    width:35%; 
  }
}
@media (max-width:600px){
  #cart_layout_1 .cart_info .product{
    width:100%;
  }
  #cart_layout_1 .updated{
    display:none;
  }
  #cart_layout_1 .mobile{
    display:block;
  }
   #cart_layout_1 .cart_info{
     display:block;
     width:100%;
     height:auto;
     padding:0;
     margin:0;
   }
  #cart_layout_1 .cart_info .product_info{
    width:100%;
    margin-left:0;
    border-bottom:2px solid #ccc;
    margin-bottom:10px;
  }
   #cart_layout_1 .cart_info .product_info span{
     display:inline-block;
     margin:5px;
   }
  #cart_layout_1 .cart_info .center{
    position:initial;
  }
  #cart_layout_1 .cart_info .details{
     width:100%;
    margin:0;
  }
   #cart_layout_1 .cart_info .details .qty{
     width:50%;
     float:right;
   }
  #cart_layout_1 .cart_info .details .price{
    width:50%;
    text-align:center;
  }
  #cart_layout_1 .cart_info .details .remove{
    width:100%;
    border-top:2px solid #ccc;
    margin-top:10px;
    border-bottom:5px solid #ccc;
  }
   #cart_layout_1 .cart_info .details .remove .hidden{
     display:inline-block;
     font-size:.5em;
     float:left;
     margin-top:15px;
   }
   #cart_layout_1 .cart_info .details .remove i{
     float:right;
     margin-right:10%;
     margin-top:5px;
     margin-bottom:5px;
   }
  #cart_layout_1 .complete_cart{
    float:right;
  }
   #cart_layout_1 .complete_cart .updated{
    float:left;
     width:100%;
   }
  #cart_layout_1 .complete_cart .updated .shipping .state{
    width:100%;
    max-width:320px;
    display:block;
    margin-left: auto;
    margin-right:auto;
  }
  #cart_layout_1 .complete_cart .updated .shipping .state select{
  }
  #cart_layout_1 .complete_cart .updated .shipping .zip{
    width:100%;
    max-width:300px;
    margin-left:0;
  }
    #cart_layout_1 .complete_cart .checkout{
      width:100%;      
    }
    
 #cart_layout_1 .complete_cart .updated .shipping .calc{
   width:100%;
   margin:0;
   margin-bottom:10px;
 } #cart_layout_1 .complete_cart .updated .coupon h2{
   width:100%;
 }
  #cart_layout_1 .complete_cart .updated .coupon input{
    width:100%;
    margin-left:0;
  }
   #cart_layout_1 .complete_cart .updated .coupon .button{
     width:100%;
     margin:0;
     margin-top:10px;
   }
  #cart_layout_1 .checkout{
    float:left;
    border-bottom:5px solid #ccc;
  }
  #cart_layout_1 .complete_cart .bfb .button {
  width: 100%;
    position:initial;
    float:left;
  }
</style>


<?php
session_start();
require 'connect.php';
require 'item.php';
$result="";
$result= pg_query($link,"SELECT * FROM product WHERE products.id=".$_GET['id']);
$product = pg_fetch_assoc($result);
if(isset($_GET['id'])){
$item = new Item();
$item->id= $product->id;
$item->name =$product->name;
$item->price = $product->price;
$item->quality=1;

$index =-1;
$cart = unserialize(serialize($_SESSION['cart']));
for($i=0; $i<count($cart);$i++)
	if($cart[$i]->id==$_GET['id']){
	$index = $i;
	break;
	}
if ($index==-1)
	$_SESSION['cart'][]=$item;
else{
	$cart[$index]->quantity++;
	$_SESSION['cart'] = $cart;
}
}

?>
<table cellpadding="2" cellspacing="2" border="1">
<tr>
<th> Option</th>
<th> Id</th>
<th> Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Sub Total</th>
</tr>
<?php
$cart =unserialize(serialize($_SESSION['cart']));
$s = 0;

for ($i=0;$i<count($cart);$i++){
$s += $cart[$i]->price* $cart[$i]->quantity;
?>
<tr>
<td><a href="" onclick="return confirm('Are you sure?')">Delete</a></td>
<td><?php echo $cart[$i]->id; ?></td>
<td><?php echo $cart[$i]->name; ?></td>
<td><?php echo $cart[$i]->price; ?></td>
<td><?php echo $cart[$i]->quantity; ?></td>
<td><?php echo $cart[$i]->price * $cart[$i]->quantity; ?> </td>
</tr>
<?php
}
?>
<tr>
	<td colspan="4" align="right">Sum</td>
	<td align="left"><?php echo $s ?></td>
</tr>
</table>


<head>
<title>CAVIE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<body>
  <div id="wrap">
    <div id="cart_layout_1">
      <h1>Shopping Cart</h1>
      <div class="cart_info">
        <div class="product">
          <img src="https://i.imgur.com/b59w7Io.jpg"/>
        </div>
        <div class="product_info">
          <div class="center">
            <span>Skull Shirt</span><span>Yellow</span><span>Small</span>
          </div>
        </div>
        <div class="details">
          <div class="qty">
            <div class="center">
            <span>QTY:</span><input type="text"></input>
          </div>
          </div>
          <div class="price">
            <div class="center">
            <span>$24.99</span>
            </div>
          </div>
          <div class="remove">
            <div class="center">
              <span class="hidden">Remove</span><i class="fa fa-times-circle fa-4"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="complete_cart">
        <div class="updated">
        <div class="shipping">
          <h2>Shipping Estimate</h2>
          <div class="state">
            <select id="state">
                   <option value = "1">Alabama</option>
                   <option value = "2">Alaska</option>
                   <option value = "3">Arizona</option>
                   <option value = "4">Etc.</option>
                 </select>
          </div>
          <div class="zip">
            <input type="text"></input>
          </div>
          <div class="calc">
            <a class="button" href="#">Calculate</a>
          </div>
        </div>
        <div class="coupon">
          <h2>Coupon Code</h2>
          <input id="code"></input>
        <a class="button update">Update Cart</a>
        </div>
        </div>
        <div class="checkout">
          <div class="total">
          <h2>Subtotal:</h2>
          <span class="sub">
            <small>Excluding Tax and Shipping</small>
          </span>
          </div>
          <span class="subtotal">
            $24.99
          </span>
          <div class="bfb">
            <a class="button" href="#">Checkout</a>
          </div>
        </div>
         <div class="updated mobile">
        <div class="shipping">
          <h2>Shipping Estimate</h2>
          <div class="state">
            <select id="state">
                   <option value = "1">Alabama</option>
                   <option value = "2">Alaska</option>
                   <option value = "3">Arizona</option>
                   <option value = "4">Etc.</option>
                 </select>
          </div>
          <div class="zip">
            <input type="text"></input>
          </div>
          <div class="calc">
            <a class="button" href="#">Calculate</a>
          </div>
        </div>
        <div class="coupon">
          <h2>Coupon Code</h2>
          <input id="code"></input>
        <a class="button update">Update Cart</a>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>

</script>
</html>

