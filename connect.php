<?php



$link = pg_connect("host='localhost' port='5433' user='gradebook' password='c3m4p2s' dbname='gradebook'");

echo "<h1>test database connection</h1>";

if(!$link) {
	echo '<h1>could not make a database connection</h1>';
}

else {
	echo '<h1>database connection successful</h1>';
}

?>
