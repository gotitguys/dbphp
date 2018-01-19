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
function getTotalSoldByID($link, $maxID){
	$array = array();
	//for ($x=0; $x < $maxID; $x++){
		//$product =($x+1);
		$sql = "SELECT SUM(qty_sold), p_id FROM contains group by p_id order by p_id";
		$result = pg_query($link, $sql);
		if (!$result) echo "****ERROR****<br/>";
		while($row = pg_fetch_assoc($result)){
			$total = $row["sum"];
			$id = $row["p_id"];
		$array += array_fill($id,1,$total);  
		}
		//$array += array_fill($id,1,$total);  
	//}
		//print_r($array);
	
	return $array;
}
?>

<?php
function getTotalPurchasedByID($link, $maxID){
	$array = array();
	//for ($x=0; $x < $maxID; $x++){
		//$product =($x+1);
		$sql = "SELECT SUM(qty_received), p_id FROM receives group by p_id order by p_id";
		$result = pg_query($link, $sql);
		if (!$result) echo "****ERROR****<br/>";
		while($row = pg_fetch_assoc($result)){
			$total = $row["sum"];
			$id = $row["p_id"];
		$array += array_fill($id,1,$total);  
		}
		//$array += array_fill($id,1,$total);  
	//}
		//print_r($array);
	
	return $array;
}
?>

<?php
function calculateStockByID($totalPurchasedByID, $totalSoldByID, $maxID){
	$array = array();
	$debug = false;
	for ($x=0; $x < $maxID; $x++){
		$index = ($x+1);
		$inStock = $totalPurchasedByID[$index] - $totalSoldByID[$index];
		$array += array_fill($index,1,$inStock);
	
		if($debug){
		echo "<p style='color:orange;'>DEBUG: TPBI ".$index." = ".$totalPurchasedByID[$index]."</p>";
		echo "<p style='color:green;'>DEBUG: TSBI ".$index." = ".$totalSoldByID[$index]."</p>";
		echo "<p style='color:red;'>DEBUG: Difference ".$index." = ".$inStock."</p>";
		}
	}	
	return $array;
}
?>

<?php
function getTotalThresholdByID($threshold, $derivedStockByID, $maxID){
	$count = 0;
	for ($x=0; $x < $maxID; $x++){
		$index = ($x+1);
		if ($derivedStockByID[$index] <= $threshold)
			$count++;
	}	
	return $count;
}
?>


<?php
function getHighTotalThresholdByID($threshold, $derivedStockByID, $maxID){
	$count = 0;
	for ($x=0; $x < $maxID; $x++){
		$index = ($x+1);
		if ($derivedStockByID[$index] >= $threshold)
			$count++;
	}	
	return $count;
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
function getLowestCurrentStock($maxID, $derivedStockByID){
	$lowest = 1000;
	$debug = false;
	//var_dump($derivedStockByID);	

	foreach($derivedStockByID as $value){
		if($debug){
			echo "<p style='color:green;'>".$value."<br></p>";
		}
		if($value < $lowest){
			$lowest = $value;
		}
	}	
	return $lowest;
}
?>

<?php
function getHighestCurrentStock($maxID, $derivedStockByID){
	$highest = -1;
	$debug = false;
	//var_dump($derivedStockByID);	

	foreach($derivedStockByID as $value){
		if($debug){
			echo "<p style='color:green;'>".$value."<br></p>";
		}
		if($value > $highest){
			$highest = $value;
		}
	}	
	return $highest;
}
?>

<?php
function populateLowThreshold($link, $lowThreshold, $derivedStockByID){
	//var_dump($derivedStockByID);
	$array = array();
	$sql = "Select * from products where p_id = ";
	foreach($derivedStockByID as $key => $value){
		//echo "DEBUG: FOREACH ".$value."<br>";
		$sql = "Select * from products where p_id = ".$key;
		$result = pg_query($link,$sql);
		if($value <= $lowThreshold){
			//echo "DEBUG: IF ".$value."<br>";
			while($row = pg_fetch_assoc($result)){
				$name = $row['p_name'];
				$id = $row['p_id'];
				$array += array_fill($id,1,$name);
			}
		}
	}
	//var_dump($array);
	return $array;
}
?>

<?php
function populateHighThreshold($link, $highThreshold, $derivedStockByID){
	//var_dump($derivedStockByID);
	$array = array();
	$sql = "Select * from products where p_id = ";
	foreach($derivedStockByID as $key => $value){
		//echo "DEBUG: FOREACH ".$value."<br>";
		$sql = "Select * from products where p_id = ".$key;
		$result = pg_query($link,$sql);
		if($value >= $highThreshold){
			//echo "DEBUG: IF ".$value."<br>";
			while($row = pg_fetch_assoc($result)){
				$name = $row['p_name'];
				$id = $row['p_id'];
				$array += array_fill($id,1,$name);
			}
		}
	}
	//var_dump($array);
	return $array;
}
?>

<?php
function getMostSoldItemIndex($totalSoldByID){
	
	$max = 0;
	$index = 0;
	$debug = false;

	foreach($totalSoldByID as $key => $value){
		if($debug){
		echo "DEBUG: value = ".$value."<br>";
		}
		if($value > $max){
			$max = $value;
			if($debug){
				echo "DEBUG: key = ".$key."<br>";
			}
			$index = $key;
		}

	}
	//var_dump($index);
	return $index;
}
?>

<?php
function getGroupedPurchasedItem($link){
	$array = array();
	$sql = "Select sum(qty_sold), p_id from contains group by p_id order by p_id";
	$result = pg_query($link,$sql);
	while($row = pg_fetch_assoc($result)){
		$total = $row['max'];
		$id = $row['p_id'];
		$array += array_fill($id,1,$total);
	}
	//var_dump($array);
	return $array;
}
?>

<?php
function getMostSoldProductName($link, $mostSoldItemIndex){
	$name;
	$sql = "Select p_name from products where p_id = ".$mostSoldItemIndex;
	$result = pg_query($link,$sql);
	while($row = pg_fetch_assoc($result)){
		$name = $row['p_name'];
	}
	//var_dump($array);
	return $name;
}
?>

<?php
function getProfitItemsSold($link){
	$array = array();
	$sql = "SELECT SUM(c.qty_sold * (c.s_price - r.p_price )), c.p_id FROM contains as c, receives as r WHERE c.p_id = r.p_id GROUP BY c.p_id order by c.p_id";
	$result = pg_query($link,$sql); 
	while($row = pg_fetch_assoc($result)){
		$total = $row['sum'];
		$id = $row['p_id'];
		$array += array_fill($id,1,$total);
	}
	//var_dump($array);
	return $array;
}
?>

<?php
function getMostProfitItemIndex($profitItemsSold){
	
	$max = 0;
	$index = 0;
	$debug = false;

	foreach($profitItemsSold as $key => $value){
		if($debug){
		echo "DEBUG: value = ".$value."<br>";
		}
		if($value > $max){
			$max = $value;
			if($debug){
				echo "DEBUG: key = ".$key."<br>";
			}
			$index = $key;
		}

	}
	
	//echo "<br>";
	//var_dump($index);
	return $index;
}
?>

<?php
function getMostProfitName($link, $mostProfitItemIndex){
	$name;
	$sql = "Select p_name from products where p_id = ".$mostProfitItemIndex;
	$result = pg_query($link,$sql);
	while($row = pg_fetch_assoc($result)){
		$name = $row['p_name'];
	}
	//var_dump($name);
	return $name;
}
?>

<?php
/*function getQtySoldDesc($link){
	$array = array();
	$sql = "Select sum(qty_sold)";
	$result = pg_query($link,$sql);
	while($row = pg_fetch_assoc($result)){
		$sum = $row['p_name'];
	}
	//var_dump($name);
	return $array;
}*/
?>







