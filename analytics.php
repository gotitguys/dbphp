<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	require_once('connect.php');
	include 'functions.php';

	$publisher = array();
	$totalSoldByID = array();
	$totalPurchasedByID = array();
	$derivedStockByID = array();
	$lowestCurrentStock;
	$highestestCurrentStock;
	$maxID = getMaxId($link);
	
	//variables for derived stock
	$totalSoldByID = getTotalSoldByID($link, $maxID);
	$totalPurchasedByID = getTotalPurchasedByID($link, $maxID);	
	$derivedStockByID = calculateStockByID($totalPurchasedByID, $totalSoldByID, $maxID);
	$lowestCurrentStock = getLowestCurrentStock($maxID,$derivedStockByID);
	$highestCurrentStock = getHighestCurrentStock($maxID,$derivedStockByID);

	if (isset($_POST['publisher'])){
		print_r($_POST['publisher']);
		$publisher = $_POST['publisher'];
	}

	function showSelection($publisher,$link){
		$elements = count(array_keys($publisher));
		echo "<h2 style='color:red; text-decoration:underline;'>Selected</h2>";
		if(empty($publisher)){
			echo "<p style='color:red;'>No Selection Made<br></p>";
		}

		elseif($publisher[0] == 'All'){
			echo "<p style='color:blue;'>".$publisher[0]."<br></p>";
		}
		
		else{
			foreach($publisher as $value){
				echo "<p style='color:blue;'>".$value."<br></p>";	
			}
		}
	}



?>

<head>
  <title>Analytics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: auto}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <div class="well">	
      <h3>SELECT OPTIONS</h3>
	<form action="analytics.php" method="POST">
	<table>

	  <tr>
	  <td>PROFIT/LOSS OPTIONS</td>
	  </tr>
	  <tr>
	  <td style='color:blue' align='right'>All<input type='checkbox' name='publisher[]' value='All'></td>
  	  </tr>
	  <tr>
	  <td style='color:blue' align='right'>Dark Horse<input type='checkbox' name='publisher[]' value='DARK HORSE'></td>
  	  </tr>
	  <tr>
	  <td style='color:blue' align='right'>DC<input type='checkbox' name='publisher[]' value='DC'></td>
  	  </tr>
	  <tr>
	  <td style='color:blue' align='right'>Marvel<input type='checkbox' name='publisher[]' value='MARVEL'></td>
  	  </tr>

	  <tr>
	  <td>DERIVED STOCK OPTIONS</td>
	  </tr>

	  <tr>
	  <td style="color:red">LOW</td>
	  </tr>

	  <tr>
	    <td><select name='lowthreshold'>
	    <option value="0">	SELECT LOW THRESHOLD </option>	
	    <?php
		$thresholdSelect = 50;
		$x = $lowestCurrentStock;
		while($x <= $highestCurrentStock){
            ?>
			<option name='lowthreshold' value= "<?php echo ($x)?>">
			<?php echo ($x)?>
			</option>
	 	<?php $x++; } ?> 	

	    </select></td>
	    </tr>

	  <tr>
	  <td style="color:blue">HIGH</td>
	  </tr>

	  <tr>
	    <td><select name='highthreshold'>
	    <option value="0">	SELECT HIGH THRESHOLD </option>	
	    <?php
		$thresholdSelect = 50;
		$x = $lowestCurrentStock;
		while($x <= $highestCurrentStock){
            ?>
			<option name='highthreshold' value= "<?php echo ($x)?>">
			<?php echo ($x)?>
			</option>
	 	<?php $x++; } ?> 	

	    </select></td>
	    </tr>

	  <tr>
	  <td><input type='submit' value='Submit Options'></td>
	  </tr>
	</table>
	</form>
      </div>
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center">
      <div class="well">
	<h1>Profit/Loss</h1>
		<hr style='border-top: 1px solid red;'>
	<?php
		showSelection($publisher,$link);
		if(!empty($publisher)){
			$x = 0;
			$query = "";
			$query2 = "";
			$elements = count(array_keys($publisher));
			if($publisher[0] == 'All'){
				$invested = getInvestmentTotal($link);
				$sold = getReturnsTotal($link);
				}
			else{
				foreach($publisher as $value){
					//echo $value."<br>";
					if($x == 0){
						$query = "p.category = '".$value."' and p.p_id = r.p_id"; 
						$query2 = "p.category = '".$value."' and p.p_id = c.p_id"; 
					}
					else {
						 $query .= " or p.category = '".$value."' and p.p_id = r.p_id";
						 $query2 .= " or p.category = '".$value."' and p.p_id = c.p_id";
					}
					$x++; 
				}
				//echo "DEBUG =".$query."<br>";
				$invested = getSelectedInvestmentTotal($link, $query);
				$sold = getSelectedReturnsTotal($link,$query2);
			}
			echo "<table><tr>";	
			echo "<td align='right'>Investment:</td><td align='left'>$".$invested. "</td></tr> ";
			//echo "</tr></table>";
			echo "<tr><td align='right'>Returns:</td><td align='left'>$".$sold."</td></tr>";
			echo "<tr>";
			if ($invested > $sold){
				$amount = $invested - $sold;
				echo "<td align='right'>Loss:</td><td align='left'>$".$amount."</td>";
				} 	
			elseif ($invested < $sold){
				$amount = $sold - $invested;
				echo "<td align='right'>Profit:</td><td align='left'>$".$amount."</td>";
			}
			else echo "<td align='right'>Even:</td><td align='left'>$".$amount."</td>";
			echo "</tr></table>";	
		}
		
	?> 	 
      </div> 	 
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center">
      <div class="well">		 
      <h1>Derived Stock</h1>
	<hr style='border-top: 1px solid red;'>
	    <?php
		//$lowThreshold = 5;
		if(isset($_POST['lowthreshold']) && !empty($_POST['lowthreshold'])){
			$lowThreshold = $_POST['lowthreshold'];
			echo "<p style='color:red' > Low threshold is set to ".$lowThreshold."<br>";
		}
		else {
			$lowThreshold = 5;
			 echo "NO LOW THRESHOLD SELECTED<br>";
			 echo "DEFAULT LOW THRESHOLD = ".$lowThreshold."<br>";
		}
		echo "<h3 style='color:red;'>Lowest derived stock count is ".$lowestCurrentStock."</h3>";
		$totalSoldByID = getTotalSoldByID($link, $maxID);
		//echo "<br>";
		$totalPurchasedByID = getTotalPurchasedByID($link, $maxID);	
		$derivedStockByID = calculateStockByID($totalPurchasedByID, $totalSoldByID, $maxID);
		//var_dump($derivedStockByID);
		$totalThresholdByID = getTotalThresholdByID($lowThreshold, $derivedStockByID, $maxID);
		echo  "<br>Total number of products at or below low threshold = ".$totalThresholdByID."<br>";
		$listOnLow = populateLowThreshold($link, $lowThreshold, $derivedStockByID);
		//var_dump($listOnLow);
		if(!empty($listOnLow)){
			$x = 0;
			echo "<table border='1'>";
			echo "<tr><th align='left'> ITEM </th><th align='center' style='color:red'> COUNT </th><th align='right'> NAME </th></tr>";
			
			foreach($listOnLow as $key => $value){
				echo "<tr><td align='right'>".($x+1).")</td><td align='center'>".$derivedStockByID[$key]."<td align='left'> " .$value."</td></tr>";
				$x++;
			}
			echo "</table>";
		}			 
?>

		<hr style='border-top: 1px solid red;'>
<?php
		//$highThreshold = 20;
		if(isset($_POST['highthreshold']) && !empty($_POST['lowthreshold'])){
			$highThreshold = $_POST['highthreshold'];
			echo "<p style='color:blue' > High threshold is set to ".$highThreshold."<br>";
		}
		else{
			$highThreshold = 20;
			 echo "DEFAULT HIGH THRESHOLD = ".$highThreshold."<br>";
		}

		echo "<h3 style='color:blue;'>Highest derived stock count is ".$highestCurrentStock."</h3>";
		$totalSoldByID = getTotalSoldByID($link, $maxID);
		echo "<br>";
		$totalPurchasedByID = getTotalPurchasedByID($link, $maxID);	
		$derivedStockByID = calculateStockByID($totalPurchasedByID, $totalSoldByID, $maxID);
		$totalHighThresholdByID = getHighTotalThresholdByID($highThreshold, $derivedStockByID, $maxID);
		echo  "<br>Total number of products at or above high threshold = ".$totalHighThresholdByID."<br>"; 
		$listOnHigh = populateHighThreshold($link, $highThreshold, $derivedStockByID);
		//var_dump($listOnLow);
		if(!empty($listOnHigh)){
			$x = 0;
			echo "<table border='1'>";
			echo "<tr><th align='left'> ITEM </th><th align='center' style='color:red'> COUNT </th><th align='right'> NAME </th></tr>";
			
			foreach($listOnHigh as $key => $value){
				echo "<tr><td align='right'>".($x+1).")</td><td align='center'>".$derivedStockByID[$key]."<td align='left'> " .$value."</td></tr>";
				$x++;
			}
			echo "</table>";
		}
		
	    ?>
      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center"> 
      <div class="well">		 
      <h1>Order Data</h1>
		<hr style='border-top: 1px solid red;'>
	<?php
		$mostSoldItemIndex = getMostSoldItemIndex($totalSoldByID);
		$mostSoldProductName = getMostSoldProductName($link, $mostSoldItemIndex);
		echo "<h4 style='color:red;'>MOST SOLD PRODUCT BY QUANTITY</h4>";
		echo $mostSoldProductName." is the most sold comic book with a total of ".$totalSoldByID[$mostSoldItemIndex]." sold.<br>";
		
		//$groupedPurchasedItem = getGroupedPurchasedItem($link);
		//echo "Most purchased item is ".$mostPurchasedItem."<br>";
	?>

		<hr style='border-top: 1px solid red;'>

	<?php
		$profitItemsSold = getProfitItemsSold($link);
		$mostProfitItemIndex = getMostProfitItemIndex($profitItemsSold);
		$mostProfitItemName = getMostProfitName($link,$mostProfitItemIndex);

		echo "<h4 style='color:red;'>MOST SOLD PRODUCT BY PROFIT</h4>";
		echo $mostProfitItemName." is the most profitable comic book with a profit of $".number_format((float)$profitItemsSold[$mostProfitItemIndex],2,".","").".<br>";
		
		//$groupedPurchasedItem = getGroupedPurchasedItem($link);
		//echo "Most purchased item is ".$mostPurchasedItem."<br>";
	?>
      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center"> 
      <div class="well">		 
      <h1>Customer Data</h1>
		<hr style='border-top: 1px solid red;'>
	<?php
		$qtySold = array();
		$orderNum = array();
		$sql = "SELECT SUM(qty_sold), order_num from contains group by order_num order by sum desc";
		$result = pg_query($link, $sql);
		if (!$result) echo "*****ERROR*****<br>";
		$x = 0;
		while($row = pg_fetch_assoc($result)){
			$sum = $row['sum'];
			$order = $row['order_num'];
			$qtySold += array_fill($x,1,$sum); 
			$orderNum += array_fill($x,1,$order); 	
			$x++;
		}
		//var_dump($qtySold);
		//echo "<br><br>";
		//var_dump($orderNum);

		$fname = array();
		$middle = array();
		$lname = array();
		$x=0;
		foreach($orderNum as $value){
		$sql = "SELECT fname, middle_init, lname FROM places as p, customer as c WHERE c.customer_id = p.customer_id and p.order_num =".$value;
		$result = pg_query($link, $sql);
		if (!$result) echo "*****ERROR*****<br>";
		while($row = pg_fetch_assoc($result)){
			$first = $row['fname'];
			$mid = $row['middle_init'];
			$last = $row['lname'];
			$fname += array_fill($x,1,$first); 
			$middle += array_fill($x,1,$mid); 
			$lname += array_fill($x,1,$last); 
		}
			$x++;	
		}
		
		echo "<h4 style='color:red;'>LARGEST 5 ORDERS BY QUANTITY</h4>";
		for($x=0; $x < 5; $x++)
		echo $qtySold[$x]." comics bought by ".$fname[$x]." ".$lname[$x]." <br>";
		//$qtySoldDesc = getQtySoldDesc($link);   
	?>

		<hr style='border-top: 1px solid red;'>
	<?php
		$qtyProfit = array();
		$orderNum = array();
		$sql = "SELECT SUM(qty_sold * (s_price - p_price)), order_num from contains as c, receives as r WHERE c.p_id = r.p_id group by order_num order by sum desc";
		$result = pg_query($link, $sql);
		if (!$result) echo "*****ERROR*****<br>";
		$x = 0;
		while($row = pg_fetch_assoc($result)){
			$sum = $row['sum'];
			$order = $row['order_num'];
			$qtyProfit += array_fill($x,1,$sum); 
			$orderNum += array_fill($x,1,$order); 	
			$x++;
		}
		//var_dump($qtyProfit);
		//echo "<br><br>";
		//var_dump($orderNum);

		$fname = array();
		$middle = array();
		$lname = array();
		$x=0;
		foreach($orderNum as $value){
		$sql = "SELECT fname, middle_init, lname FROM places as p, customer as c WHERE c.customer_id = p.customer_id and p.order_num =".$value;
		$result = pg_query($link, $sql);
		if (!$result) echo "*****ERROR*****<br>";
		while($row = pg_fetch_assoc($result)){
			$first = $row['fname'];
			$mid = $row['middle_init'];
			$last = $row['lname'];
			$fname += array_fill($x,1,$first); 
			$middle += array_fill($x,1,$mid); 
			$lname += array_fill($x,1,$last); 
		}
			$x++;	
		}
		
		echo "<h4 style='color:red;'>LARGEST 5 ORDERS BY PROFIT</h4>";
		for($x=0; $x < 5; $x++)
		//echo $qtySold[$x]." comics bought by ".$fname[$x]." ".$lname[$x]." <br>";
		echo "$".number_format((float)$qtyProfit[$x],2,".","")." ordered by ".$fname[$x]." ".$lname[$x]."<br>";
		//$qtySoldDesc = getQtySoldDesc($link);   
	?>

      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 sidenav">
      <div class="well">
	<form action="analyticsPDF.php" method="POST">
	<table>
	  <tr>
	  <td><input type='submit' value='Generate PDF Report'></td>
	  </tr>
	</table>
	</form>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>

