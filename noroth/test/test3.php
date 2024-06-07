<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');

   $query = "
       SELECT *,
          MATCH(`customtitle`, `customdescription`) AGAINST ('ipads' IN BOOLEAN MODE) AS score 
          FROM products 
       WHERE MATCH(`customtitle`, `customdescription`) AGAINST ('ipads' IN BOOLEAN MODE)";
	
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			echo $row['asin'].$row['customtitle']."<br />\n";
		}
	}
	else {
		echo 'error';
		echo mysql_error();
	}
	


?>