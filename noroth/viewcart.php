<?
include 'templates/default/top.php';
?>
<div id="navBreadCrumbs"><a href="<? echo WEBSITE_ROOT_URL; ?>">Home</a>&nbsp;&gt;&nbsp;<a href="<? echo WEBSITE_ROOT_URL.'/viewcart.php'; ?>">View Cart</a></div>
<?

$cartContents = get_cart_contents();

if ($_SESSION['addCartMessage'] != '') {
	echo '<div id="updateCartMessageFrame" class="';
		if ($_SESSION['addCartMessage'] == 'Your cart was successfully updated.' || $_SESSION['addCartMessage'] == 'Item successfully added to your cart.') {
			echo 'success' ;
		}
		else {
			echo 'failure' ;
		}
	echo '">'.$_SESSION['addCartMessage'].'</div>';
}

$_SESSION['addCartMessage'] = '';

?>
<div id="bigCartTableWrapper">
    <h1>Shopping Cart</h1>
	<div id="bigCartTable">
    	<?
		
		if ($cartContents && is_array($cartContents['CartItems'])) {
			$cartItems = array();
			//Break the cart contents into items
			//Check to see if there is 1 item in the cart
			if ($cartContents['CartItems']['CartItem']['CartItemId']) {
				$cartItems[0] = $cartContents['CartItems']['CartItem'];
			}
			//Multiple items in the cart
			else {
				$cartItems = $cartContents['CartItems']['CartItem'];
			}
			
			echo '<form id="shopping_cart_display" name="shopping_cart_display" method="post" action="modifycart.php">
			<div id="product_remove_title">Remove</div>
			<div id="product_quantity_title">Quantity</div>
			<div id="product_price_title">Price</div>
			<ul>';
			
			$i=1;
			$retailPrice = 0;
			$savingsTotal = 0;
			foreach ($cartItems as $item) {
				
				$query = "SELECT * 
						FROM `products` 
						WHERE `products`.`asin` LIKE '".mysql_real_escape_string($item['ASIN'])."'
						LIMIT 1";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				
				$retailPrice += $row['msrp']*$item['Quantity'];
				$savingsTotal += ($row['msrp']-$item['Price']['Amount'])*$item['Quantity'];
				echo '
				<li>
					<div id="product_photo"><div class="cartCenter"><img src="';
				$image = unserialize($row['image']); 
				echo $image['URL']; 
				echo '"/></div></div>
					<div id="product_name"><div class="cartCenter"><a href="'.WEBSITE_ROOT_URL.'/product/'.$item['ASIN'].'/">'.$item['Title'].'</a></div></div>
					<div id="product_price"><div class="cartCenter">'.$item['Price']['FormattedPrice'].'</div></div>
					<div id="product_quantity"><div class="cartCenter"><input name="asin'.$i.'" id="cart_asin'.$i.'" type="hidden" value="'.$item['ASIN'].'"><input name="quantity'.$i.'" id="cart_quantity'.$i.'" type="text" value="'.$item['Quantity'].'" size="3" maxlength="3"></div></div>
					<div id="product_remove"><div class="cartCenter"><img src="'.WEBSITE_ROOT_URL.'/includes/images/delete.png" width="24" height="24" onClick="removeCartItem('.$i.')"></div></div>
				</li>';
				$i++;
			}
			
			echo '
			</ul>
			<div id="update_quantity"><input name="submit_button" type="submit" value="Update Quantity"></div>';
			if ($savingsTotal > 0) {
				echo '
				<div id="subtotal_msrp">$'.number_format(($retailPrice/100),2).'</div>
				<div id="subtotal_msrp_title">Retail:</div>
				<div id="subtotal_savings">'.number_format(((1-(($retailPrice-$savingsTotal)/$retailPrice))*100),0).'%</div>
				<div id="subtotal_savings_title">Savings:</div>
				<div id="subtotal_price" class="product_price_total_border">'.$cartContents['CartItems']['SubTotal']['FormattedPrice'].'</div>
				<div id="subtotal_price_title">Subtotal:</div>
				';
			}
			else {
				echo '
				<div id="subtotal_price">'.$cartContents['CartItems']['SubTotal']['FormattedPrice'].'</div>
				<div id="subtotal_price_title">Subtotal:</div>
				';
			}
			echo '<div id="checkout_button"><a href="'.$cartContents['PurchaseURL'].'"><img src="'.WEBSITE_ROOT_URL.'/includes/images/checkout.png" width="200" height="90"></a></div>
			</form>';
		}
		else {
			echo '<div id="no_items_message"><div class="cartCenter">Your cart is empty.</div></div>';
		}

		
        
        ?>
    	
        
    </div>
</div>
<?
include 'templates/default/bottom.php';
?>