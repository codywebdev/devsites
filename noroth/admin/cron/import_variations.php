<?
require_once('../../includes/dbconnect/config.php');
require_once('../../includes/functions.php');
echo "End Import Variations.<br />\n";

$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `parentNode` = 1";
$result = mysql_query($query);

$asinList = array();
while ($row = mysql_fetch_assoc($result)) {
	$variationsArray = unserialize($row['variations']);
	$variationsArray = $variationsArray[1];
	foreach($variationsArray as $variation) {
		array_push($asinList, $variation['asin']);
	}
}

$asinListSize = sizeof($asinList);
$maxItemsPerRequest=10;
$currentMax = $maxItemsPerRequest-1;
$asinString = '';

for ($i=0;$i<$asinListSize;$i++){
	$asinString .= $asinList[$i];
	if ($i == $currentMax) {
		print_return_array(update_product(get_aws_item_info($asinString)));
		$currentMax += $maxItemsPerRequest;
		$asinString = '';
	}
	if ($asinString != '' && $i<($asinListSize-1)) {
		$asinString .= ',';
	}
}

if ($asinString != '') {
	print_return_array(update_product(get_aws_item_info($asinString)));
}

echo "End Import Variations.<br />\n";
?>