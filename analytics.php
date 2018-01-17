<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
	require_once('connect.php');
	include 'functions.php';
	echo "testing<br/>";
	//function profitLoss(){

	//variables
	//$invested;
	//$returns = 0;
	$publisher = array();

	if (isset($_POST['publisher']))	{
		print_r($_POST['publisher']);
		$publisher = $_POST['publisher'];
		$elements = count(array_keys($publisher));
		echo "<br>";
		echo $elements ."<br>";
		
		foreach($publisher as $value){
			echo "DEBUG: ".$value;
		}
	}
	/*if (isset($_POST['all']) || isset($_POST['DarkHorse']) ||
		isset($_POST['DC']) || isset($_POST['Marvel'])){*/
	if (isset($_POST['all'])){
		$yo = profitLoss($link);
		echo $yo;
		//return;
	}
//}

	
	function showSelection($publisher,$link){
			$elements = count(array_keys($publisher));
			echo "<h2 style='color:red; text-decoration:underline;'>Selected </h2>";
			if(empty($publisher)){
				echo "<p style='color:red;'>Nothing Selected<br></p>";
			}
			elseif($publisher[0]=='All'){
				echo "<p style='color:red;'>".$publisher[0]."<br></p>";
				//showResults($link);
				$invested = getInvestmentTotal($link);
			}
			else{
				foreach($publisher as $value){
				echo "<p style='color:red;'>".$value."<br></p>";
				}
			}
	}

	function profits($link){
	require_once('connect.php');
	//include 'functions.php';
		echo "DEBUG: in profit function<br/>";
		echo "<form method='post' action='analytics.php'>
		<table>
		<tr>
		<td style ='color:blue;'><input type='checkbox' value='All'>ALL PUBLISHERS</td>
		</tr>
		<tr>
		<td style ='color:blue;'><input type='checkbox' value='DarkHorse'>DARK HORSE</td>
		</tr>
		<tr>
		<td style ='color:blue;'><input type='checkbox' value='DC'>DC</td>
		</tr>
		<tr>
		<td style ='color:blue;'><input type='checkbox' value='Marvel'>MARVEL</td>
		</tr>
		<tr>
		<td style ='color:blue;'><input type='submit' value='Submit'></td>
		</tr>
		</table>";
		/*$invested = getInvestmentTotal($link);
		echo "Invested: $invested <br/>";
		$sold = getReturnsTotal($link);
		echo "Returns: $sold <br/>";
		if ($invested > $sold){
			$amount = $invested - $sold;
			echo "Loss : $$amount<br/>";
		} 	
		elseif ($invested < $sold){
			$amount = $sold - $invested;
			echo "Profit : $$amount <br/>";
		}
		else echo "Even : $0 <br/>";*/ 	

	}
	
	function showResults($link){
		$invested = getInvestmentTotal($link);
		echo "Invested: $invested <br/>";
		$sold = getReturnsTotal($link);
		echo "Returns: $sold <br/>";
		if ($invested > $sold){
			$amount = $invested - $sold;
			echo "Loss : $$amount<br/>";
		} 	
		elseif ($invested < $sold){
			$amount = $sold - $invested;
			echo "Profit : $$amount <br/>";
		}
		else echo "Even : $0 <br/>"; 
	}	
	//include 'util.php';
?>
<head>
  <title>Analysis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
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
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>
        <li><a href="#">Geo</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Logo</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Dashboard</a></li>
        <li><a href="#section2">Age</a></li>
        <li><a href="#section3">Gender</a></li>
        <li><a href="#section3">Geo</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Some text..</p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Derived Stock</h4>
            <?php
		$maxID = getMaxId($link);
		//echo "BACK FROM FUNCTION CALL<br/>";
		//echo "TEST: maxid = $maxID <br />";
		//$totalPurchased = array();
		$totalPurchased = getTotalPurchased($link,$maxID);
		//print_r($totalPurchased);
		$totalSold = getTotalSold($link,$maxID);
		//print_r($totalSold);
		$derivedStock = calculateStock($totalPurchased, $totalSold, $maxID);
		$threshold = 5;
		$needsAttention = analyzeStock($derivedStock, $maxID, $threshold);
		if ($needsAttention) echo "STOCK LOW<br/>";
		else echo "STOCK OK<br/>";
		//print_r($derivedStock);
	    ?> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Profit/Loss</h4>
		<form method="post" action="analytics.php">
		<table>
		<tr>
		<td style='color:blue;'><input type='checkbox' name='publisher[]' value='All' >All</td>
		</tr>
		<tr>
		<td style='color:blue;'><input type='checkbox' name='publisher[]' value='DARK HORSE' >DarkHorse</td>
		</tr>
		<tr>
		<td style='color:blue;'><input type='checkbox' name='publisher[]' value='DC' >DC</td>
		</tr>
		<tr>
		<td style='color:blue;'><input type='checkbox' name='publisher[]' value='MARVEL' >Marvel</td>
		</tr>
		<tr>
		<td style ='color:blue;'><input type='submit' value='Submit'></td>
		</tr>
		</table>
		</form>
	    <?php //profits();?>
            <?php
		showSelection($publisher,$link);
		//showResults($link);	
		//$invested = getInvestmentTotal($link);
		if(!empty($publisher)){
			//echo "Investment: ".$invested. "<br/>";
			$x = 0;
			$query = "";
			$query2 = "";
			$elements = count(array_keys($publisher));
			//echo "DEBUG: array count = ".$elements."<br>";
			if($publisher[0] == 'All'){
				$invested = getInvestmentTotal($link);
				//echo "Investment: ".$invested. "<br/>";
				$sold = getReturnsTotal($link);
				//echo "Returns: $sold <br/>";
				/*if ($invested > $sold){
					$amount = $invested - $sold;
					echo "Loss : $$amount<br/>";
				} 	
				elseif ($invested < $sold){
					$amount = $sold - $invested;
					echo "Profit : $$amount <br/>";
				}
				else echo "Even : $0 <br/>";*/	
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
				//echo "Investment: ".$invested. "<br/>";
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
				//echo "Profit : $$amount <br/>";
			}
			else echo "<td align='right'>Even:</td><td align='left'>$".$amount."</td>";
			//else echo "Even : $0 <br/>";	
			echo "</tr></table>";	
		}
		/*$sold = getReturnsTotal($link);
		echo "Returns: $sold <br/>";
		if ($invested > $sold){
			$amount = $invested - $sold;
			echo "Loss : $$amount<br/>";
		} 	
		elseif ($invested < $sold){
			$amount = $sold - $invested;
			echo "Profit : $$amount <br/>";
		}
		else echo "Even : $0 <br/>";*/	
	    ?> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Sessions</h4>
            <p>10 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Bounce</h4>
            <p>30%</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>

