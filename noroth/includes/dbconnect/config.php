<?php

/** The name of the database for WordPress */
define('DB_NAME', 'noroth_amazonian');

/** MySQL database username */
define('DB_USER', 'noroth_amazonian');

/** MySQL database password */
define('DB_PASSWORD', 'G4vJYhS5ST4V');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type.*/
define('DB_COLLATE', '');

require_once('opendb.php');

$query = "SELECT * FROM `options`";
$result = mysql_query($query);
$options = array();

//create an array of global options
while(($options[] = mysql_fetch_assoc($result)) || array_pop($options));

//define the global options
foreach ($options as $option) {
	define($option["option_name"], $option["option_value"]);
}

?>