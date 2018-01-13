<!DOCTYPE html>
<html lang = "en">

<?php
session_start();
require_once('connect.php');
//require_once 'connect.php';
include 'util.php';
?>

<head>
<title>Check Stock</title>

</head>

<?php
echo "<h1> TESTING DATABASE USING RECEIVES AND CONTAINS</h1>";
$result = pg_query($link, "SELECT * FROM receives");

//$result = pg_query($link, "SELECT COUNT(*) FROM receives");
if(!$result){
	echo "An error occurred with query.\n";
	exit;
}
else{
	echo "Query successful.<br />";
}

$rowCount = pg_num_rows($result);

echo $rowCount . " rows in RECEIVES table.\n";
$totalReceived = array();


echo "<hr />";

$result = pg_query($link, "SELECT * FROM contains");
$rowCount = pg_num_rows($result);
echo $rowCount . " rows in CONTAINS table.<br />";

$result = pg_query($link, "SELECT MAX(p_id) AS max FROM contains");
while($row = pg_fetch_assoc($result)) {
  $index = $row["max"];
  //echo "Highest pid: $index<br />";
  }
  echo "Highest pid: $index<br />";

echo "<hr />";

echo "<h3>Filling contains array for quantity sold</h3>";
$totalSold = array();
$x = 0;
for ($x=0; $x < $index; $x++){
$product =($x+1);
$result = pg_query($link, "SELECT sum(qty_sold) as total FROM contains where p_id = $product");
while($row = pg_fetch_assoc($result)) {
  $total = $row["total"];
  //echo "Highest pid: $index<br />";
  }
  echo "total count of p_id $product: $total<br />";
  $totalSold += array_fill($x,1,$total);
}
echo "Check array<br />";
print_r($totalSold);

echo "<hr />";

echo "<h3>Filling contains array for quantity purchased</h3>";
$totalPurchased = array();
$x = 0;
for ($x=0; $x < $index; $x++){
$product =($x+1);
$result = pg_query($link, "SELECT sum(qty_received) as total FROM receives where p_id = $product");
while($row = pg_fetch_assoc($result)) {
  $total = $row["total"];
  //echo "Highest pid: $index<br />";
  }
  echo "total count of p_id $product: $total<br />";
  $totalPurchased += array_fill($x,1,$total);
}
echo "Check array<br />";
print_r($totalPurchased);

echo "<hr />";

echo "<h3>Derived stock</h3>";

$derivedStock = array();
for ($x=0; $x < $index; $x++){
	$product =($x+1);
	$inStock = $totalPurchased[$x] - $totalSold[$x];
 	echo "total stock of p_id $product: $inStock<br />";
	$derivedStock += array_fill($x,1,$inStock);
}
echo "Check array<br />";
print_r($derivedStock);

//trying to add according to pid; ie derived values
/*
$totalReceived = array();
$count = 1;
$result = pg_query($link, "SELECT * FROM contains");
for($x = 0; $x < $index; $x++){
	$totalReceived($x) = 0;
	while($row = pg_fetch_assoc($result)) {
		if($row['p_id'] == $count){
			$totalReceived($x) += $row['qty_sold'];
		}
	}
	$count++;
}
*/
echo "<hr />";

/*echo "Display query results<br />";

  while($row = pg_fetch_assoc($result)) {
  echo $row['qty_recieved']." ".$row['datee']." ".$row['p_price']." ".$row['po_id']." ".$row['p_id'];
  echo "<br />"; 
  }

  echo "<hr />";*/
/*
   echo "Display query results in a table<br />";

//HTML TABLE
$result = pg_query($link, "SELECT * FROM receives");
echo "<table border = '1'><tr><th>Qty Received</th><th>Date</th><th>Purchase Price</th><th>Purchase Order</th><th>Product ID</th></tr>";

while($row = pg_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['qty_received'] . "</td>";
echo "<td>" . $row['datee'] . "</td>";
echo "<td>" . $row['p_price'] . "</td>";
echo "<td>" . $row['po_id'] . "</td>";
echo "<td>" . $row['p_id'] . "</td>";
echo "</tr>";

}

echo "</table>";


$result = pg_query($link, "SELECT * FROM contains");
echo "<table border = '1'><tr><th>Qty Sold</th><th>Date</th><th>Sale Price</th><th>Order Number</th><th>Product ID</th></tr>";

while($row = pg_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['qty_sold'] . "</td>";
echo "<td>" . $row['date_sold'] . "</td>";
echo "<td>" . $row['s_price'] . "</td>";
echo "<td>" . $row['order_num'] . "</td>";
echo "<td>" . $row['p_id'] . "</td>";
echo "</tr>";

}

echo "</table>";
 */

$result = pg_query($link, "SELECT * FROM contains AS c , receives AS r WHERE c.p_id = r.p_id");
echo "<table border = '1'><tr><th>Qty Sold</th><th>Date</th><th>Sale Price</th><th>Order Number</th><th>Qty Received</th><th>Date</th><th>Purchase Price</th><th>Purchase Order</th><th>Product ID</th></tr>";

while($row = pg_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>" . $row['qty_sold'] . "</td>";
	echo "<td>" . $row['date_sold'] . "</td>";
	echo "<td>" . $row['s_price'] . "</td>";
	echo "<td>" . $row['order_num'] . "</td>";
	echo "<td>" . $row['qty_received'] . "</td>";
	echo "<td>" . $row['datee'] . "</td>";
	echo "<td>" . $row['p_price'] . "</td>";
	echo "<td>" . $row['po_id'] . "</td>";
	echo "<td>" . $row['p_id'] . "</td>";
	echo "</tr>";

}

echo "</table>";
$rowCount = pg_num_rows($result);
echo $rowCount . " rows in CONTAINS AND RECEIVES table where PID is equal.\n";
//not sure if I should close here, but will for now
pg_close($link);

?>
</html>

