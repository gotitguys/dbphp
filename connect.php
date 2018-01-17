<?php



$link = pg_connect("host='localhost' port='5433' user='store' password='store' dbname='store'");

//echo "<h1>test database connection</h1>";

if(!$link) {
	echo '<h1>could not make a database connection</h1>';
}

else {
//	echo '<h1>database connection successful</h1>';
}

?>
