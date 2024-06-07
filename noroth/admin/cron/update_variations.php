<?
if (opendir('/home/noroth/public_html/includes/dbconnect/')) {
	require_once('/home/noroth/public_html/includes/dbconnect/config.php');
	require_once('/home/noroth/public_html/includes/functions.php');
	echo "Begin Product Variations Update.<br />\n";
	
	//Find all products that have parents but don't have an item variations array
	$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `parentAsin` <> '' AND `itemvariations` = '' AND `parentNode` <> '1' AND `deleted` <> '1';";
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
		$itemVariations = array();
		echo $row['asin'].' '.$row['parentAsin'];
		//Find the products parent in the database
		$query2 = "SELECT * FROM `".DB_NAME."`.`products` WHERE `asin` LIKE '".$row['parentAsin']."';";
		$result2 = mysql_query($query2);
		if (!(mysql_num_rows($result2) > 0)) {
			//If parent wasn't found then insert the parent into the database
				print_r(update_product(get_aws_item_info($row['parentAsin'])));
				//update_product(get_aws_item_info($row['parentAsin']));
				//print_r(get_aws_item_info($row['parentAsin']));
			//Try the query again
			$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `asin` LIKE '".$row['parentAsin']."';";
			$result2 = mysql_query($query);
		}
		
		if (mysql_num_rows($result2) > 0) {
			//If parent is found
			$row2 = mysql_fetch_assoc($result2);
			echo ' '.$row2['asin'];
			$parentVariationsArray = unserialize($row2['variations']);
			//Turn the array into a multidimensional array if there is only 1 variation
			if ($parentVariationsArray[1]['asin']) {
				$newParentVariationsArray = array();
				$newParentVariationsArray[0] = $parentVariationsArray[0];
				$newParentVariationsArray[1][0] = $parentVariationsArray[1];
				$parentVariationsArray = $newParentVariationsArray;
			}
			//Find the product in the parent's variations array
			foreach($parentVariationsArray[1] as $childVariations) {
				if ($childVariations['asin']==$row['asin']) {
					//If item found then create the item variations array
					unset($childVariations['asin']);
					foreach($childVariations as $variation) {
						if (is_array($variation)) {
							array_push($itemVariations,$variation['Value']);
						}
						else {
							array_push($itemVariations,$variation);
						}
					}
				}
			}
		}
		echo ' ';
		echo serialize($itemVariations);
		echo "<br />\n";
		$query3 = "UPDATE `".DB_NAME."`.`products` SET `itemvariations` = '".mysql_real_escape_string(serialize($itemVariations))."' WHERE `products`.`asin` LIKE '".mysql_real_escape_string($row['asin'])."';";
		$result3 = mysql_query($query3);
	}
	
	$query4 = "UPDATE `".DB_NAME."`.`products` SET `itemvariations` = '".mysql_real_escape_string('a:0:{}')."' WHERE `products`.`itemvariations` = '';";
	$result4 = mysql_query($query4);
	
	echo "End Product Variations Update.<br />\n";
}
?>