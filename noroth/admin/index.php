<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');
session_start();

if ($_SESSION['administrator'] != 'yes' && $_SESSION['ipAddress'] != $_SERVER['REMOTE_ADDR']) {
	header("Location: ".WEBSITE_ROOT_URL."/admin/login.php");
	exit;
}
?><?

$asin = $_REQUEST['asin'];
$action = $_REQUEST['action'];
$actionVar1 = $_REQUEST['actionVar1'];
$customTitle = $_REQUEST['customTitle'];

?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><? echo WEBSITE_NAME; ?> - Administration</title>
</head>
<body>
<p><a href="index.php">Refresh Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="lists.php">Manage Lists</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="categories.php">Manage Categories</a></p>
Add a new product by ASIN:<br />
<form id="form1" name="form1" method="post" action="index.php">
  <input type="text" name="asin" id="asin" />
  <input type="hidden" name="action" id="action" value="add" />
  <input type="submit" name="Submit" id="Submit" value="Submit" />
</form>
<br />
<br />
<?

if ($action=='add') {
	$item = get_aws_item_info($asin);
	$updateMessage = update_product($item);
}
else if ($action=='remove') {
	$query = "UPDATE `".DB_NAME."`.`products` SET `deleted` = '1' WHERE `products`.`asin` LIKE '".mysql_real_escape_string($asin)."' LIMIT 1;";
	$result = mysql_query($query);
}
else if ($action=='customTitle') {
	$query = "UPDATE `".DB_NAME."`.`products` SET `customtitle` = '".mysql_real_escape_string($customTitle)."' WHERE `products`.`asin` LIKE '".mysql_real_escape_string($asin)."' LIMIT 1;";
	$result = mysql_query($query);
}
print_r($updateMessage);
echo "<br />\n";

$query = "SELECT * 
		FROM `products` 
		WHERE `deleted` = '0'
		AND `parentNode` = '0'
		ORDER BY `salesrank` ASC";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

echo 'Products: <br />
';
echo '<table width="1000" border="1">';
$rowNumber = 1;
while ($row) {
	echo '<tr><td>';
		echo $rowNumber;
		
		echo '</td><td style=\'text-align:"center"\'><a name="'.$row['asin'].'" id="'.$row['asin'].'"></a>';
		$imageArray= unserialize($row['image']);
		echo '<img src="'.$imageArray['URL'].'" height="100" />';
		
		echo '</td><td><a href="'.WEBSITE_ROOT_URL.'/product/'.$row['asin'].'/">';
		echo ($row['customtitle'] == ''? $row['title'] : $row['customtitle']).'<br />';
		
		echo '</a></td><td>';
		echo $row['asin'];
		
		echo '</td><td>';
		echo '<img src="http://noroth.com/includes/images/';
		if ($row['customtitle'] != '' && $row['itemvariations'] != '' && $row['rating'] != '' && $row['thegood'] != '' && $row['thebad'] != '' && $row['customdescription'] != '') echo 'check' ; else echo 'delete';
		echo '.png" width="48" height="48">';
		
		echo '</td><td>';
		echo $row['salesrank'];
		
		/*echo '</td><td>';
		echo 'Parent: '.$row['parentNode'];
		
		echo '</td><td>';
		echo $row['parentAsin'];*/
		
		echo '</td><td>';
		echo '$'.number_format($row['price']/100,2);
		
		echo '</td><td>';
		echo '<a href="edit_product.php?asin='.$row['asin'].'">[Edit]</a>';
		
		//echo '</td><td>';
		//echo '<a href="index.php?action=remove&asin='.$row['asin'].'">[Remove]</a>';
				
	echo '</td></tr>';
	
	$row = mysql_fetch_assoc($result);
	$rowNumber += 1;
}
echo '</table>';

echo '<br />
<br />
<br />
<br />
';

/*
$query = "SELECT * 
		FROM `products` 
		WHERE `deleted` = '0'
		AND `parentNode` = '1'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

echo 'Parent Nodes: <br />
';
echo '<table width="1000" border="1">';
while ($row) {
	echo '<tr><td style=\'text-align:"center"\'>';
		$imageArray= unserialize($row['image']);
		echo '<img src="'.$imageArray['URL'].'" height="100" />';
		
		echo '</td><td>';
		echo $row['title'];
		
		echo '</td><td>';
		echo $row['asin'];
		
		echo '</td><td>';
		echo $row['parentNode'];
		
		echo '</td><td>';
		echo '$'.number_format($row['price']/100,2);
		
		echo '</td><td>';
		echo '<a href="index.php?action=remove&asin='.$row['asin'].'">[Remove]</a>';
		
	echo '</td></tr>';
	
	$row = mysql_fetch_assoc($result);
}
echo '</table>';
*/

?>
</body>
</html>
