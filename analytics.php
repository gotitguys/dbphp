<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	require_once('connect.php');
	include 'functions.php';

	$publisher = array();

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
	    <td><select name='threshold'>
	    <option value="0">	SELECT THRESHOLD </option>	
	    <?php
		$thresholdSelect = 50;
		$x = 0;
		while($x < $thresholdSelect){
            ?>
			<option name='threshold' value= "<?php echo ($x+1)?>">
			<?php echo ($x+1)?>
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
      <h1>DERIVED STOCK</h1>
	    <?php
		$threshold = 5;
		//print_r($_POST['threshold']);
		$threshold = ($_POST['threshold']);
		if(isset($_POST['threshold'])){
			$threshold = $_POST['threshold'];
			echo "DEBUG: threshold is set to ".$threshold."<br>";
		}
		else echo "DEFAULT THRESHOLD = ".$threshold."<br>";
		$maxID = getMaxId($link);
		$
		//echo "BACK FROM FUNCTION CALL<br/>";
		//echo "TEST: maxid = $maxID <br />";
		//$totalPurchased = array();
		//$totalSoldByID = array();
		//$totalSoldByID = array();
		//var_dump($totalSoldByID);
		$totalSoldByID = getTotalSoldByID($link, $maxID);
		//print_r($totalSoldByID);
		echo "<br>";
		//$totalPurchasedByID = array();
		$totalPurchasedByID = getTotalPurchasedByID($link, $maxID);	
		//print_r($totalPurchasedByID);
		$derivedStockByID = calculateStockByID($totalPurchasedByID, $totalSoldByID, $maxID);
		//print_r($derivedStockByID);
		$totalThresholdByID = getTotalThresholdByID($threshold, $derivedStockByID, $maxID);
		echo  "<br>Total Below or at Threshold = ".$totalThresholdByID."<br>"; 
		
	    ?>
      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center"> 
      <div class="well">		 
      <h1>ORDER DATA</h1>
      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 text-center"> 
      <div class="well">		 
      <h1>CUSTOMER DATA</h1>
      </div>	
    </div>

<!-- SHOWING DIVS FOR MY SANITY -->

    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>

