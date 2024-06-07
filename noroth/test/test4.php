<?
if (opendir('/home/noroth/public_html/includes/dbconnect/')) {
	require_once('/home/noroth/public_html/includes/dbconnect/config.php');
	require_once('/home/noroth/public_html/includes/functions.php');
	echo "Begin Product Update.<br />\n";
	
	$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `updated` <= ".(time()-60*45).";";
	$result = mysql_query($query);
	
	$asinList = array();
	while ($row = mysql_fetch_assoc($result)) {
		array_push($asinList, $row['asin']);
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
	
	echo "End Product Update.<br />\n";
}
?>