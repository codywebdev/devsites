<?
if (opendir('/home/noroth/public_html/includes/dbconnect/')) {
	require_once('/home/noroth/public_html/includes/dbconnect/config.php');
	require_once('/home/noroth/public_html/includes/functions.php');
	
	echo "Begin Import Categories.<br />\n";
	
	$query = "SELECT * FROM `lists` WHERE `listType` LIKE 'all_categories' AND `name` LIKE 'categories_list'";
	$category_list_result = mysql_query($query);
	$row = mysql_fetch_assoc($category_list_result);
	$categoryList = unserialize($row['description']);
	
	foreach($categoryList as $category) {
		echo 'Importing the top 100 '.$category['categoryDescription'].'<br />
		';
		get_aws_category_items($category['categoryId'],$category['categoryName']);
	}
	
	echo "End Import Categories.<br />\n";
}
?>