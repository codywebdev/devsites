<?
/*      $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime = array(); $totalPageLoadTime['start'] = $mtime; 


require_once("../includes/functions.php");
require_once("../includes/config.php");
require_once("../includes/opendb.php");


	$query = 
"SELECT a.`name`, a.`region` 
FROM `characters` AS a
LEFT JOIN `queryNames` AS b on a.`name`=b.`name` AND a.`region`=b.`region`
WHERE (b.`name` IS NULL AND b.`region` IS NULL)
GROUP BY `name`
LIMIT 0, 5000
";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC); 
	$i = 1;
	
	if (!$row) { echo 'Name list is up-to-date.  No action taken.'; }
	
	while ($row) {
		$query2 = 
"
INSERT INTO `gearscor_gsdb`.`queryNames` (
`id` ,
`name` ,
`region` ,
`completed` ,
`abandoned` ,
`stopped` ,
`attempts` 
)
VALUES (
NULL , '".mysql_real_escape_string($row['name'])."', '".mysql_real_escape_string($row['region'])."', '0', '0', '', '0'
);
";
		$result2 = mysql_query($query2);
		if ($result2) { echo $i.'. '.$row['name'].' in '.$row['region'].' successfully recorded.<br />'; }
		else { echo $i.'. Error:'.$row['name'].' in '.$row['region'].' was not recorded.<br />'; }
		$i++;
		$row = mysql_fetch_array($result, MYSQL_ASSOC); 
	}


											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['end'] = ($mtime-$totalPageLoadTime['start']); 
echo '<br />Query ended after '.$totalPageLoadTime['end'].' seconds.';*/
?>