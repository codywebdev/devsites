<?

if (opendir('/home/noroth/public_html/includes/dbconnect/')) {
	date_default_timezone_set("US/Central");
	require_once('/home/noroth/public_html/includes/dbconnect/config.php');
	require_once('/home/noroth/public_html/includes/functions.php');
	echo "Begin Product Update.<br />\n";
	
	/*$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `updated` <= ".(time()-60*45)." LIMIT 10;";
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
	}*/
	
	//print_return_array(update_product(get_aws_item_info("B0083PWAPW,B0083Q04IQ,B008SYWFNA,B008GFREAU,B008GFRDL0,B008GFRDZQ,B00AHT9I8Y,B008UC3XX6,B004UL34EY,B009OVJK4I")));
	//print_r(PUBLIC_KEY);
	echo "<br />";
	//print_r(PRIVATE_KEY);
	echo "<br />";
	//print_r(get_aws_item_info("B0083PWAPW,B0083Q04IQ,B008SYWFNA,B008GFREAU,B008GFRDL0,B008GFRDZQ,B00AHT9I8Y,B008UC3XX6,B004UL34EY,B009OVJK4I"));
	print_r(get_aws_item_info("B0083PWAPW"));
	
	echo "End Product Update.<br />\n";
}







/*
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');

echo 'Importing Product Categories';
get_aws_category_items('2956501011','Electronics',10);  //Laptops & Tablets
//get_aws_category_items('565108');  //Laptops
//get_aws_category_items('1232597011');  //Tablets
//get_aws_category_items('3269423011');  //Ultrabooks
//get_aws_category_items('2858603011');  //Chromebooks
//get_aws_category_items('133141011');  //Kindles
echo 'Product Categories Successfully Imported.';
*/

?>