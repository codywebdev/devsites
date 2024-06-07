<?php
// opendb.php
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die                      ('This website is down for maintenance.');
mysql_select_db(DB_NAME);
//this next line is to improve support of foreign characters.  Delete it if you have problems with it.
$result = mysql_query("set names '".DB_CHARSET."'");
?>