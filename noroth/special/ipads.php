<?
include '../templates/default/top.php';
?>
<?


	$searchField = 'ipad';
	$searchTitle = 'iPads';
	if ($searchTitle == '') $searchTitle = $searchField;

	/*$query =   "SELECT * FROM `products` WHERE (`asin` LIKE '%".mysql_real_escape_string($searchField)."%' OR
                                               `title` LIKE '%".mysql_real_escape_string($searchField)."%' OR
                                               `customtitle` LIKE '%".mysql_real_escape_string($searchField)."%' OR
                                               `manufacturer` LIKE '%".mysql_real_escape_string($searchField)."%' OR
                                               `customdescription` LIKE '%".mysql_real_escape_string($searchField)."%' OR
                                               `features` LIKE '%".mysql_real_escape_string($searchField)."%') AND
											   `priceupdated` > ".(time()-(60*60*24))." AND
                                               `deleted` = '0' ";*/

	/*$query = "
				SELECT *,
				MATCH(`asin`, `manufacturer`, `customtitle`) AGAINST ('%".mysql_real_escape_string($searchField)."%' IN BOOLEAN MODE) AS score 
				FROM `products`
				WHERE MATCH(`asin`, `manufacturer`, `customtitle`) AGAINST ('%".mysql_real_escape_string($searchField)."%' IN BOOLEAN MODE)";*/

	$query = "
				SELECT *
				FROM `products`
				WHERE MATCH(`asin`, `manufacturer`, `customtitle`) AGAINST ('*".mysql_real_escape_string($searchField)."*' IN BOOLEAN MODE)";

	if ($_GET['orderby'] == '') {
		$query .= "ORDER BY `salesrank` ASC, (`msrp`/`price`) DESC, `price` ASC";
	}
	elseif ($_GET['orderby'] == 'name_asc') {
		$query .= "ORDER BY `title` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_GET['orderby'] == 'popularity_asc') {
		$query .= "ORDER BY `title` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_GET['orderby'] == 'price_asc') {
		$query .= "ORDER BY `price` ASC, (`msrp`/`price`) DESC";
	}
	elseif ($_GET['orderby'] == 'price_desc') {
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

	include '../includes/php/sidebar_categories.php';

?>
			<div id="bannerTopSpecialPageImage"><a href="http://www.amazon.com/s/?_encoding=UTF8&sort=popularity-rank&keywords=ipad&tag=norothcom-20&linkCode=ur2&bbn=172282&qid=1358794702&camp=1789&creative=390957&rh=n%3A172282%2Ck%3Aipad%2Cp_4%3AApple"><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/ipad_topbar.png" width="800" height="200"></a></div>
            <div id="bannerTopSpecialPageDescription"><h1>iPads - Shopping Guide by <? echo WEBSITE_NAME; ?></h1><p>Before you can buy an iPad, you must first know which iPad is best for you.  The Apple iPad has been out for years, and all of the different models of iPads can best be described by the generation in which they were released.  Consumers were first able to buy iPads in April 2010.  This is the first generation of iPad.  It was a pioneering step by Apple.  Many industry experts doubted that there was even enough demand for a large tablet to satisfy the production costs.  Luckily the experts were wrong and the tablet market was born!</br></br>

About a year after the first iPad was released, Apple came out with their next version of the iPad called the iPad 2.  By this time, everyone understood what was so great about tablets and it took off to become one of the bestselling tablets ever.  Users could download games, download apps for the iPad, and even surf the internet during their downtime.  The iPad forever changed the way we look at consumer electronics.</br></br>

The current generation of iPad is the 4th generation.  Many people simply refer to this iPad as “the new iPad”.  The retail price of the iPad 4th generation starts at around $500.  Shortly after the iPad 4th generation was released came the iPad Mini.  The iPad Mini is designed for people that want a tablet larger than an iPhone, but smaller than the iPad.  Another advantage of the iPad Mini is that the price of the iPad Mini is lower than the iPad.  The iPad Mini starts out at around $400.  You can find iPad Mini’s on our website, along with expert reviews.  So what are you waiting for?!  Go ahead shop our site to find the best iPad personalized to your tastes.
</p></div>
            <div id="bannerTopSearchPage"><? echo $searchTitle; ?></div>
			<div id="searchSortOrderWrapper">
            	<form id="searchSortOrder1" name="searchSortOrder1" action="ipads.php" method="get">
                <input name="searchField" type="hidden" value="<? echo str_replace('"','\"',$_GET['searchField']); ?>">
                <label for="orderby">Sort By: </label>
                <select name="orderby" onChange="this.form.submit();">
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
						echo '</div>';
						echo '		<div id="product_variations">
										<ul>';
						$itemVariations = unserialize($row['itemvariations']);
						foreach ($itemVariations as $variation) {
								echo '<li>'.$variation.'</li>';
						}
						echo '</ul>
									</div>';
						
						echo'			<div id="product_features">
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
include '../templates/default/bottom.php';
?>
