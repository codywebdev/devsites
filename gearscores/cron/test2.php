<?
require_once("../includes/phparmory/phpArmory.class.php");
require_once("../includes/functions.php");
require_once("../includes/config.php");
require_once("../includes/opendb.php");

$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime = array(); $totalPageLoadTime['start'] = $mtime; 


$query = "SELECT * 
FROM `characters` 
WHERE `id` = 21839
LIMIT 1";
$result = mysql_query($query);
$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
$character = unserialize($row['xmlarray']);

//print_r($character);

$newCharStr = compressCharArray($character);

/*
$query = "UPDATE `gearscor_gsdb`.`characters` 
SET `xmlarray` ='".mysql_real_escape_string($newCharStr)."',
`maxgsarray` ='".mysql_real_escape_string($newCharStr)."',
`spec0array` ='".mysql_real_escape_string($newCharStr)."',
`spec1array` ='".mysql_real_escape_string($newCharStr)."'
WHERE `id` = 21846
LIMIT 1";
$result = mysql_query($query);
*/


$query = "SELECT * 
FROM `characters` 
WHERE `id` = 21846
LIMIT 1";
$result = mysql_query($query);
$row     = mysql_fetch_array($result, MYSQL_ASSOC); 


$xmlArray = $row['xmlarray'];





$newCharArray = array();

$newCharArray = uncompressCharArray($row, $xmlArray);

print_r($newCharArray);




























//$character = unserialize($character);
//echo $newCharStr;
//echo strlen($newCharStr);
//$newCharStr = gzuncompress($newCharStr);
//echo '<br />'.strlen($newCharStr);
//echo '<br />'.$newCharStr;


















//print_r($newCharArray);

$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['end'] = ($mtime-$totalPageLoadTime['start']); 
echo '<br />'.$totalPageLoadTime['end'];
?>