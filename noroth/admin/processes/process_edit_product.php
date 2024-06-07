<?
require_once('../../includes/dbconnect/config.php');
require_once('../../includes/functions.php');
session_start();

if ($_SESSION['administrator'] != 'yes' && $_SESSION['ipAddress'] != $_SERVER['REMOTE_ADDR']) {
	header("Location: ".WEBSITE_ROOT_URL."/admin/login.php");
	exit;
}
else {
	$variationsArray = explode(',', htmlentities($_POST['form_itemVariations']));

//update product	
	$query = "UPDATE `".DB_NAME."`.`products` SET `customtitle` = '".mysql_real_escape_string(stripslashes(htmlentities($_POST['form_shortName'])))."', `customdescription` = '".mysql_real_escape_string(stripslashes($_POST['form_customDescription']))."', `rating` = '".mysql_real_escape_string(stripslashes(htmlentities($_POST['form_itemRating'])))."', `thegood` = '".mysql_real_escape_string(stripslashes(htmlentities($_POST['form_itemRatingTheGood'])))."', `thebad` = '".mysql_real_escape_string(stripslashes(htmlentities($_POST['form_itemRatingTheBad'])))."', `itemvariations` = '".mysql_real_escape_string(stripslashes(serialize($variationsArray)))."', `reviewupdated` = '".time()."' WHERE `products`.`asin` LIKE '".mysql_real_escape_string($_POST['form_asin'])."' LIMIT 1;";
	$result = mysql_query($query);

//update reviewed date if needed
	$query = "UPDATE `".DB_NAME."`.`products` SET `reviewed` = '".time()."' WHERE `products`.`asin` LIKE '".mysql_real_escape_string($_POST['form_asin'])."' AND `products`.`reviewed` = '0' LIMIT 1;";
	$result = mysql_query($query);

	header("Location: ".WEBSITE_ROOT_URL."/admin/index.php#".$_POST['form_asin']);
}
?>