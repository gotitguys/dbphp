
<?php
session_start();
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
	echo "HELLO THERE- IN FUCTION CALL!<br />";
	echo "".$index."<br />";
	return $index;
}
?>


