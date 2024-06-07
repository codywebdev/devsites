<?
require_once('includes/dbconnect/config.php');
require_once('includes/functions.php');
session_start();

//$itemString = $_GET['var1'];
//$itemArrayExplode = explode(',',$itemString);
$itemArrayExplode = $_POST;
unset($itemArrayExplode['submit_button']);
$itemString = implode(',',$itemArrayExplode);

$verified = true;
foreach ($itemArrayExplode as $itemStringData) {
	if (strlen($itemStringData) != 10 && !is_numeric($itemStringData)) {
		$verified = false;
	}
}

if ($verified) {
	if (modify_cart($itemString)) {
		$_SESSION['addCartMessage'] = 'Your cart was successfully updated.';
	}
	else {
		$_SESSION['addCartMessage'] = 'Unable to update quantity in cart.';
	}
}

header("Location: ".WEBSITE_ROOT_URL."/viewcart.php");

?>