<?php
// opendb.php
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);
//this next line is to improve support of foreign characters.  Delete it if you have problems with it.
$result = mysql_query("set names 'utf8'");
?>