<?
/*      $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime = array(); $totalPageLoadTime['start'] = $mtime; 


require_once("../includes/functions.php");
require_once("../includes/config.php");
require_once("../includes/opendb.php");


	$query = 
"SELECT a.`guild`, a.`server`, a.`region` 
FROM `characters` AS a
LEFT JOIN `queryGuilds` AS b on a.`guild`=b.`guild` AND a.`server`=b.`server` AND a.`region`=b.`region`
WHERE (b.`guild` IS NULL AND b.`server` IS NULL AND b.`region` IS NULL) AND a.`guild` != ' '
GROUP BY `guild`
LIMIT 0, 500
";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC); 
	$i = 1;
	
	if (!$row) { echo 'Guild list is up-to-date.  No action taken.'; }
	
	while ($row) {
		$query2 = 
"
INSERT INTO `gearscor_gsdb`.`queryGuilds` (
`id` ,
`guild` ,
`server` ,
`region` ,
`completed` ,
`abandoned` ,
`stopped` ,
`attempts` 
)
VALUES (
NULL , '".mysql_real_escape_string($row['guild'])."', '".mysql_real_escape_string($row['server'])."', '".mysql_real_escape_string($row['region'])."', '0', '0', '', '0'
);
";
		$result2 = mysql_query($query2);
		if ($result2) { echo $i.'. '.$row['guild'].' on '.$row['server'].' in '.$row['region'].' successfully recorded.<br />'; }
		else { echo $i.'. Error:'.$row['guild'].' on '.$row['server'].' in '.$row['region'].' was not recorded.<br />'; }
		$i++;
		$row = mysql_fetch_array($result, MYSQL_ASSOC); 
	}


											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['end'] = ($mtime-$totalPageLoadTime['start']); 
echo '<br />Query ended after '.$totalPageLoadTime['end'].' seconds.';*/
?>