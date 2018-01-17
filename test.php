<!DOCTYPE html>
<html lang ="en">
<?php
session_start();
require_once('connect.php');
include 'util.php';
?>

<?php
$result = " ";
 
echo "<h1> TESTING DATABASE USING CUSTOMERS </h1>";
$result = pg_query($link, "SELECT * FROM customer");

if(!$result){
	echo "An error occurred with query.\n";
	exit;
}
else{
	echo "Query successful.<br />";
}

echo "<hr />";

echo "Display query results<br />";

while($row = pg_fetch_assoc($result)) {
	echo $row['fname']." ".$row['middle_init']." ".$row['lname']." ".$row['email']." ".$row['phone']." ".$row['order_num'];
	echo "<br />"; 
}

echo "<hr />";

echo "Display query results in a table<br />";

//HTML TABLE
$result = pg_query($link, "SELECT * FROM customer");
echo "<table border = '1'><tr><th>First Name</th><th>Middle</th><th>Last Name</th><th>email</th><th>Phone</th><th>Order #</th></tr>";

while($row = pg_fetch_assoc($result)) {
	echo "<tr>";
	echo "<td>" . $row['fname'] . "</td>";
	echo "<td>" . $row['middle_init'] . "</td>";
	echo "<td>" . $row['lname'] . "</td>";
	echo "<td>" . $row['email'] . "</td>";
	echo "<td>" . $row['phone'] . "</td>";
	echo "<td>" . $row['order_num'] . "</td>";
	echo "</tr>";
}

echo "</table>";



//not sure if I should close here, but will for now
//pg_close($link);

?>

</html>
