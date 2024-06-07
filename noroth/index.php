<?

include 'templates/default/top.php';

?>
<?

include 'includes/php/sidebar_categories.php';

?>
            <div id="featuredProductsTitle">Most Popular Tablets</div>
            <div id="featuredProductsWrapper">
                <div id="featuredProducts">
                     <div id="product_selector_background">
                     </div>
                     <div id="product_selector">
                        		<ul><? 
								
								$productSelectorQuery =   "SELECT * FROM `products` WHERE `priceupdated` > ".($OneDayTimestamp)."
											ORDER BY `salesrank` ASC, (`msrp`/`price`) DESC, RAND() LIMIT 10;";
								$productSelectorResult = mysql_query($productSelectorQuery);
								

								$maxTitleSize = 37;
								$maxBigTitleSize = 80;
								
								
								$productSelector = array();
								for ($i=0;$i<10;$i++) {
									$productSelectorRow = mysql_fetch_assoc($productSelectorResult);
									echo '<li id="selector'.($i+1).'"><a href="'.WEBSITE_ROOT_URL.'/product/'.$productSelectorRow['asin'].'/'.rawurlencode(str_replace(array("/","&","=","\\"),'',$productSelectorRow['title'])).'"><div class="selector_vertical_align">';
										if ($productSelectorRow['customtitle'] != '') {
											if (strlen($productSelectorRow['customtitle'])<$maxTitleSize) echo ($i+1).'. '.$productSelectorRow['customtitle']; else echo ($i+1).'. '.substr($productSelectorRow['customtitle'],0,$maxTitleSize).'...';
										}
										else {
											if (strlen($productSelectorRow['title'])<$maxTitleSize) echo ($i+1).'. '.$productSelectorRow['title']; else echo ($i+1).'. '.substr($productSelectorRow['title'],0,$maxTitleSize).'...';
										}
									echo '</div></a></li>';
								}
								
								
								?>
                                </ul>
                     </div>
                     <ul id="product_slide_wrapper"><? 
								
								$productSelectorQuery =   "SELECT * FROM `products` WHERE `priceupdated` > ".($OneDayTimestamp)."
											ORDER BY `salesrank` ASC, (`msrp`/`price`) DESC, RAND() LIMIT 10;";
								$productSelectorResult = mysql_query($productSelectorQuery);
					 
					 for ($i=0;$i<10;$i++) {
									$productSelectorRow = mysql_fetch_assoc($productSelectorResult);
						echo '                        <li><a href="'.WEBSITE_ROOT_URL.'/product/'.$productSelectorRow['asin'].'/'.rawurlencode(str_replace(array("/","&","=","\\"),'',$productSelectorRow['title'])).'\'">
                        	<div id="product_slide">
                                <div id="product_picture"><img src="';
						$imageArray = unserialize($productSelectorRow['image']); 
						echo $imageArray['URL']; 
						echo '"/></div>
                                <div id="product_name">';
						if ($productSelectorRow['customtitle'] != '') {
							if (strlen($productSelectorRow['customtitle'])<$maxBigTitleSize) {
								echo $productSelectorRow['customtitle']; 
							}
							else {
								echo substr($productSelectorRow['customtitle'],0,$maxBigTitleSize).'...';
							}
						}
						else {
							if (strlen($productSelectorRow['title'])<$maxBigTitleSize) {
								echo $productSelectorRow['title']; 
							}
							else {
								echo substr($productSelectorRow['title'],0,$maxBigTitleSize).'...';
							}
						}
						echo '</div>
                                <div id="product_features">
                                    <ul>';
						$productFeatures = unserialize($productSelectorRow['features']);
						foreach($productFeatures as $feature) {
							echo "\n\t\t\t\t\t\t\t\t\t<li>".$feature.'</li>';
						}
                        echo '
                                    </ul>
                                </div>
                                <div id="price_wrapper">'; 
						if ($productSelectorRow['disabled'] != '0' || $productSelectorRow['updated'] < (time()-(60*60))) {
							echo "\n\t\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Retail:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($productSelectorRow['msrp']/100),2).'</div>';
						}
						elseif ($productSelectorRow['msrp'] > $productSelectorRow['price']) {
							echo "\n\t\t\t\t\t\t\t\t\t\t".'<div id="product_msrp" class="product_price_left">Retail:&nbsp;</div><div id="product_msrp" class="product_price_right">$'.number_format(($productSelectorRow['msrp']/100),2).'</div>';
							echo "\n\t\t\t\t\t\t\t\t\t\t".'<div id="product_save" class="product_price_left">Save:&nbsp;</div><div id="product_save" class="product_price_right">'.number_format(((1-($productSelectorRow['price']/$productSelectorRow['msrp']))*100),0).'%</div>';
							echo "\n\t\t\t\t\t\t\t\t\t\t".'<div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right product_price_total_border">$'.number_format(($productSelectorRow['price']/100),2).'</div>';
						}
						else {
							echo "\n\t\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($productSelectorRow['price']/100),2).'</div>';
						}
						echo '
                                </div>
                            </div>
                        </a></li>'."\n";
					 }
					 ?>
                    </ul>
                </div>
            </div>
            <div id="carouselWrapperTitle">Recent Reviews</div>
            <div id="carouselWrapper">
                <div id="carousel">
                    <div id="slides"> 
                        <ul><?
						
							$query =   "SELECT * FROM `products` WHERE `priceupdated` > ".($OneDayTimestamp)." AND `reviewed` > 0
										ORDER BY `price` ASC, RAND() LIMIT 0, 10;";
							$result = mysql_query($query);
							$row = mysql_fetch_assoc($result);

							for ($i=0;$i<10;$i++) {
								echo "\n\t\t\t\t\t\t\t".'<li><a href="'.WEBSITE_ROOT_URL.'/product/'.rawurlencode($row['asin']).'/'.rawurlencode(str_replace(array("/","&","=","\\"),'',$row['title'])).'\'">'."\n\t\t\t\t\t\t\t\t".'<div id="product_wrapper">';
								echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_image"><img src="';
								$image = unserialize($row['image']); 
								echo $image['URL']; 
								echo '"/></div>';
								echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_name">';
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
								echo '
								</div>
							</a></li>';
								$row = mysql_fetch_assoc($result);
							}
							?>
                        </ul>
                    </div>
                    <div id="buttons">
                        <div id="prev">&lt;&lt;</div>
                        <div id="next">&gt;&gt;</div>
                    </div>
                </div>
            </div>
            <div id="productSearchGridWrapper">
            	<div id="productSearchGridTitle">Today's Best Deals</div>
                <div id="productGrid">
                	<ul>
					<? 
						
							$query =   "SELECT * FROM `products` WHERE `priceupdated` > ".($OneDayTimestamp)." AND `reviewed` > 0 AND `priceupdated` > ".($OneHourTimestamp)."
										ORDER BY (`msrp`/`price`) DESC, `price` ASC, RAND() LIMIT 9;";
							$result = mysql_query($query);
							$row = mysql_fetch_assoc($result);
							
					for ($i=0;$i<9 && $row;$i++) {
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
						$row = mysql_fetch_assoc($result);
					}
						?>

                    </ul>
                </div>
            </div>
<?
include 'templates/default/bottom.php';
?>
