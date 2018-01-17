<?php
//session_start();
require_once('connect.php');
//include 'util.php';
?>

<?php
function getMaxId($link){
	$result = pg_query($link, "SELECT MAX(p_id) AS max FROM products");
	if (!$result) echo "****ERROR****<br/>";
	while($row = pg_fetch_assoc($result)) {
  		$index = $row["max"];
  	}
	//echo "HELLO THERE - IN FUCTION CALL!<br />";
	//echo "".$index."<br />";
	return $index;
}
?>

<?php
function getTotalPurchased($link,$maxID){
	$array = array();
	for ($x=0; $x < $maxID; $x++){
		$product =($x+1);
		$sql = "SELECT SUM(qty_received) as total FROM receives where p_id = $product";
		$result = pg_query($link, $sql);
		if (!$result) echo "****ERROR****<br/>";
		while($row = pg_fetch_assoc($result)){
			$total = $row["total"];
		}
		$array += array_fill($x,1,$total);  
	}
	return $array;
}
?>

<?php
function getTotalSold($link,$maxID){
	$array = array();
	for ($x=0; $x < $maxID; $x++){
		$product =($x+1);
		$sql = "SELECT SUM(qty_sold) as total FROM contains where p_id = $product";
		$result = pg_query($link, $sql);
		if (!$result) echo "****ERROR****<br/>";
		while($row = pg_fetch_assoc($result)){
			$total = $row["total"];
		}
		$array += array_fill($x,1,$total);  
	}
	return $array;
}
?>

<?php
function calculateStock($totalPurchased, $totalSold, $maxID){
	$array = array();
	for ($x=0; $x < $maxID; $x++){
		$inStock = $totalPurchased[$x] - $totalSold[$x];
		$array += array_fill($x,1,$inStock);
	}	
	return $array;
}
?>

<?php
function analyzeStock($derivedStock, $maxID, $threshold){
	//maybe pass in custom threshold as a parameter
	//$threshold = 5;
	for ($x=0; $x < $maxID; $x++){
		if($derivedStock[$x] < $threshold) return true;
	}	
	return false;
}
?>

<?php
function getInvestmentTotal($link){	
	$sql =  "SELECT sum(p_price * qty_received) AS investment FROM receives";
	$result = pg_query($link, $sql);
	if (!$result) echo "****ERROR****<br/>";
	while($row = pg_fetch_assoc($result)) {
  		$index = $row["investment"];
  	}
	//echo "HELLO THERE - IN FUCTION CALL!<br />";
	//echo "".$index."<br />";
	return $index;
}
?>

<?php
function getSelectedInvestmentTotal($link,$query){	
	$sql =  "SELECT sum(r.p_price * r.qty_received) AS investment FROM receives as r, products as p WHERE ";
	$sql .=$query;
	$result = pg_query($link, $sql);
	if (!$result) echo "****ERROR****<br/>";
	while($row = pg_fetch_assoc($result)) {
  		$index = $row["investment"];
  	}
	//echo "HELLO THERE - IN FUCTION CALL!<br />";
	//echo "".$index."<br />";
	return $index;
}
?>

<?php
function getReturnsTotal($link){	
	$sql =  "SELECT sum(s_price * qty_sold) AS return FROM contains";
	$result = pg_query($link, $sql);
	if (!$result) echo "****ERROR****<br/>";
	while($row = pg_fetch_assoc($result)) {
  		$index = $row["return"];
  	}
	//echo "HELLO THERE - IN FUCTION CALL!<br />";
	//echo "".$index."<br />";
	return $index;
}
?>

<?php
function getSelectedReturnsTotal($link,$query2){	
	$sql =  "SELECT sum(c.s_price * c.qty_sold) AS return FROM contains as c, products as p WHERE ";
	$sql .=$query2;
	$result = pg_query($link, $sql);
	if (!$result) echo "****ERROR****<br/>";
	while($row = pg_fetch_assoc($result)) {
  		$index = $row["return"];
  	}
	return $index;
}
?>

<?php
/*function profitLoss($link){
	$test = "In profit loss function<br/>";
	return $test;
}*/


?>
