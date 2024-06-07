<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php');
session_start();
error_reporting(E_ERROR);



if ($_GET["override"] == "true" || $_GET['var3'] == "override=true") {
	$OneDayTimestamp = time()-(60*60*24*4000);
	$OneHourTimestamp = time()-(60*60*24*4000);
}
else {
	$OneDayTimestamp = time()-(60*60*24);
	$OneHourTimestamp = time()-(60*60*1);
}



if (substr($_SERVER["PHP_SELF"],1,7) == 'product') {
	//Get input variables from the URL
	$var1 = $_GET['var1'];
	$var2 = $_GET['var2'];
	
	//See if var1 is the ASIN
	if (strlen($var1) == 10 && ctype_alnum($var1)) {
		$asin = $var1;
	}
	//See if var2 is the ASIN
	else if (strlen($var2) == 10 && ctype_alnum($var2)) {
		$asin = $var2;
	}
	else {
		$asin = '';
	}
	
	$product_found = false;
	//If ASIN was found in the URL, then search the database for the item
	if (strlen($asin) == 10) {
		$query = "SELECT * 
				FROM `products` 
				WHERE `products`.`asin` LIKE '".$asin."'
				AND `deleted` = '0'
				AND `priceupdated` > ".($OneDayTimestamp)."
				LIMIT 1";
		$result = mysql_query($query);
		
		//Check to see if the product was found
		if (mysql_num_rows($result) == 0) {
			$product_found = false;
		}
		else {
			$product_found = true;
			$row = mysql_fetch_assoc($result);
		}
	}
}


?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><? 
if (substr($_SERVER["PHP_SELF"],1,7) == 'product') {
	if ($row['customtitle'] == '') echo $row['title']; else echo $row['customtitle'];
	echo ' Review by ';
	echo WEBSITE_NAME;
}
elseif (substr($_SERVER["PHP_SELF"],0,18) == '/special/ipads.php') {
	echo 'iPads - Shopping Guide by ';
	echo WEBSITE_NAME;
}
else {
	echo WEBSITE_NAME.' - '.WEBSITE_TAGLINE; 
}
?></title>
<meta name="description" content="<? echo WEBSITE_DESCRIPTION; ?>" />
<link rel="Shortcut Icon" type="image/x-icon" href="<? echo WEBSITE_ROOT_URL; ?>/favicon.ico">
<link href="<? echo WEBSITE_ROOT_URL; ?>/includes/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<? echo WEBSITE_ROOT_URL; ?>/includes/js/jquery.js"></script>
<script type="text/javascript" src="<? echo WEBSITE_ROOT_URL; ?>/includes/js/main.js"></script>
</head>
<body>
<div id="headerWrapper">
    <div id="logo"><a href="<? echo WEBSITE_ROOT_URL; ?>"><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/logo.png" width="480" height="80" alt="Noroth"></a></div>
    <div id="searchBarWrapper">
        <div id="searchBar">
            <form action="<? echo WEBSITE_ROOT_URL; ?>/search.php" method="get" name="mainSearch">
            <input name="searchField" type="text"><input name="submit" type="submit" value="Search">
            </form>
        </div>
        <div id="topMenu">
            <ul>
            	<li><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/topbar.png" width="450" height="25"></li>
            </ul>
        </div>
    </div>
</div>

<div id="mainWrapper">
    <div id="mainContentWrapper">
        <div id="mainContentFrame">