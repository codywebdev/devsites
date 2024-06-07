<?
require_once('includes/dbconnect/config.php');
require_once('includes/functions.php');
session_start();

//Get input variables from the URL
$var1 = $_GET['var1'];

//See if var1 is an ASIN
if (strlen($var1) == 10 && ctype_alnum($var1)) {
	$asin = $var1;
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
			LIMIT 1";
	$result = mysql_query($query);
	
	//Check to see if the product was found
	if (mysql_num_rows($result) == 0) {
		$product_found = false;
	}
	else {
		$product_found = true;
	}
	
	$row = mysql_fetch_assoc($result);
	$amazonLink = $row['amazonlink'];
}

if ($product_found) {
	if (modify_cart($asin.',1')) {
		$_SESSION['addCartMessage'] = 'Item successfully added to your cart.';
	}
	else {
		$_SESSION['addCartMessage'] = 'This item is only available on Amazon.com <a href="'.$amazonLink.'"><img src="http://www.noroth.com/includes/images/viewOnAmazon.png" width="150" height="75"></a>';
	}
}
else {
		$_SESSION['addCartMessage'] = 'Unable to add item to the cart. Please go back and view the item on Amazon.com';
}

header("Location: ".WEBSITE_ROOT_URL."/viewcart.php");

?>