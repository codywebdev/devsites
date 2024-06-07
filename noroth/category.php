<?
include 'templates/default/top.php';
?>
<?

	$var1 = $_GET['var1'];
	$var2 = $_GET['var2'];
	$searchTitle = $_GET['var3'];
	if ($searchTitle == '' && $var2 != '') $searchTitle = $var2;
	if ($searchTitle == '' && $var1 != '' && $var1 != 's') $searchTitle = $var1;
	if ($searchTitle == '') $searchTitle = 'Category';

	if ($var1 == 's' && $var2 != '') {
		$query =   "SELECT * FROM `products` WHERE (`asin` LIKE '%".mysql_real_escape_string($var2)."%' OR
                                               `customtitle` LIKE '%".mysql_real_escape_string($var2)."%' OR
                                               `title` LIKE '%".mysql_real_escape_string($var2)."%' OR
                                               `manufacturer` LIKE '%".mysql_real_escape_string($var2)."%') AND
											   `priceupdated` > ".(time()-(60*60*24))." AND
                                               `deleted` = '0' ";
	}
	elseif ($var1 != '') {
		$query =   "SELECT * FROM `products` WHERE (`asin` LIKE '%".mysql_real_escape_string($var1)."%' OR
                                               `title` LIKE '%".mysql_real_escape_string($var1)."%' OR
                                               `customtitle` LIKE '%".mysql_real_escape_string($var1)."%' OR
                                               `manufacturer` LIKE '%".mysql_real_escape_string($var1)."%') AND
											   `priceupdated` > ".(time()-(60*60*24))." AND
                                               `deleted` = '0' ";
	}
	
	
	
	if ($_REQUEST['orderby'] == '') {
		$query .= "ORDER BY `salesrank` ASC, (`msrp`/`price`) DESC, `price` ASC";
	}
	elseif ($_REQUEST['orderby'] == 'name_asc') {
		$query .= "ORDER BY `title` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_GET['orderby'] == 'popularity_asc') {
		$query .= "ORDER BY `title` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_REQUEST['orderby'] == 'price_asc') {
		$query .= "ORDER BY `price` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_REQUEST['orderby'] == 'price_desc') {
		$query .= "ORDER BY `price` DESC, (`msrp`/`price`) DESC";
	}
	elseif ($_GET['orderby'] == 'savings_desc') {
		$query .= "ORDER BY (`msrp`/`price`) DESC, RAND()";
	}
	else {
		$query .= "ORDER BY `salesrank` ASC, (`msrp`/`price`) DESC, `price` ASC";
	}
	
	$query .=  " , RAND() LIMIT 0, 100;";
	$result = mysql_query($query);


	include 'includes/php/sidebar_categories.php';
	
?>
			<div id="bannerTopSearchPage"><? echo $searchTitle; ?></div>
            <div id="navBreadCrumbs"><a href="<? echo WEBSITE_ROOT_URL; ?>">Home</a>&nbsp;&gt;&nbsp;<a href="<? echo WEBSITE_ROOT_URL; ?>">Category</a>&nbsp;&gt;&nbsp;<a href="<? echo WEBSITE_ROOT_URL.$_SERVER["REQUEST_URI"]; ?>"><? echo $searchTitle; ?></a></div>
			<div id="searchSortOrderWrapper">
            	<form id="searchSortOrder1" name="searchSortOrder1" action="<? echo WEBSITE_ROOT_URL.$_SERVER["REQUEST_URI"]; ?>" method="post">
                <label for="orderby">Sort By: </label>
                <select name="orderby" onChange="this.form.submit();">
                    <option value="" >&nbsp;</option>
                    <option value="name_asc"<? if ($_GET['orderby'] == 'popularity_asc' || $_GET['orderby'] == '') echo ' selected="selected"'; ?> >Popularity</option>
                    <option value="name_asc"<? if ($_GET['orderby'] == 'name_asc') echo ' selected="selected"'; ?> >Name A-Z</option>
                    <option value="price_asc"<? if ($_GET['orderby'] == 'price_asc') echo ' selected="selected"'; ?> >Price: low to high</option>
                    <option value="price_desc"<? if ($_GET['orderby'] == 'price_desc') echo ' selected="selected"'; ?> >Price: high to low</option>
                    <option value="savings_desc"<? if ($_GET['orderby'] == 'savings_desc') echo ' selected="selected"'; ?> >Savings: high to low</option>
                </select>
                </form>
            </div>
            <div id="productSearchGridWrapper">
                <div id="productGrid">
                	<ul>
					<? 
					while ($row = mysql_fetch_assoc($result)) {
						echo '
							<li class="grid_cell"><a href="'.WEBSITE_ROOT_URL.'/product/'.rawurlencode($row['asin']).'/'.rawurlencode(str_replace(array("/","&","=","\\"),'',$row['title'])).'\'">
								<div id="product_cell">
									<div id="product_picture"><img src="';
						$image = unserialize($row['image']); 
						echo $image['URL']; 
						echo '"/></div>
									<div id="product_mouseover_background">&nbsp;</div>
									<div id="product_name">';
						$maxCharacters = 40;
						if ($row['customtitle'] != '') {
							if (strlen($row['customtitle']) > $maxCharacters) {
								echo substr($row['customtitle'],0,$maxCharacters).'...';
							}
							else {
								echo $row['customtitle'];
							}
						}
						else {
							if (strlen($row['title']) > $maxCharacters) {
								echo substr($row['title'],0,$maxCharacters).'...';
							}
							else {
								echo $row['title'];
							}
						}
						echo '</div>
							';
						echo '		<div id="product_variations">
										<ul>';
						$itemVariations = unserialize($row['itemvariations']);
						foreach ($itemVariations as $variation) {
								echo '<li>'.$variation.'</li>';
						}
						echo '</ul>
									</div>';
						echo '
									<div id="product_features">
										<ul>';
						$productFeatures = unserialize($row['features']);
						foreach($productFeatures as $feature) {
							echo "\n\t\t\t\t\t\t\t\t\t<li>".$feature.'</li>';
						}
						echo '
										</ul>
									</div>
									<div id="price_wrapper">';
									if ($row['disabled'] != '0' || $row['updated'] < (time()-(60*60))) {
										echo "\n\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Retail:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($row['msrp']/100),2).'</div>';
									}
									elseif (($row['msrp']-$row['price']) > 0) {
										echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_msrp" class="product_price_left">Retail:&nbsp;</div><div id="product_msrp" class="product_price_right">$';
										echo number_format(($row['msrp']/100),2); 
										echo '</div>';
										echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_save" class="product_price_left">Save:&nbsp;</div><div id="product_save" class="product_price_right">';
										echo number_format(((1-($row['price']/$row['msrp']))*100),0);
										echo '%</div>';
										echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right product_price_total_border">$';
										echo number_format(($row['price']/100),2);
										echo '</div>';
									}
									else {
										echo "\n\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($row['price']/100),2).'</div>';
									}
						echo'
									</div>
								</div>
							</a></li>';
					}
						?>

                    </ul>
                </div>
            </div>
<?
include 'templates/default/bottom.php';
?>
