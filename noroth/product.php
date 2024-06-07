<?
include 'templates/default/top.php';
?>
<? 
if ($product_found) {
}
else {
	echo 'Product not found.';
}
?>
<?

include 'includes/php/sidebar_categories.php';

?>
<div id="navBreadCrumbs"><a href="<? echo WEBSITE_ROOT_URL; ?>">Home</a>&nbsp;&gt;&nbsp;<a href="<? echo WEBSITE_ROOT_URL.$_SERVER["REQUEST_URI"]; ?>">Item#: <? echo $row['asin']; ?></a></div>
<div id="bigProductFrameWrapper">
    <div id="bigProductFrame">
    	<div id="main_product_frame_wrapper">
            <div id="picture_frame_wrapper">
                <div id="main_picture"><? echo '<img id="main_picture_unzoomed" src="';
                                    $image = unserialize($row['image']); 
                                    echo $image['URL']; 
                                    echo '"/>'; ?></div>
                <div id="swatch_images_frame">
                    <ul><? 
                    
                    //echo "\n\t\t\t\t\t\t\t\t\t".'<li onMouseOver="changeSwatchImage(this);">'.'<img src="'.$image['URL'].'"/></li>';
                    $productImages = unserialize($row['moreimages']);
                    foreach($productImages as $image) {
                        echo "\n\t\t\t\t\t\t\t\t\t".'<li onMouseOver="changeSwatchImage(this);"><img src="'.$image['URL'].'"/></li>';
                    }
                    
                    ?>
                    </ul>
                </div>
            </div>
            <div id="pricing_frame_wrapper">
                <div id="product_name"><div class="product_name_vertical_align"><? if ($row['customtitle'] == '') echo $row['title']; else echo $row['customtitle']; ?></div></div>
                <div id="product_features">
                    <div class="product_features_vertical_align">
                    <ul><? 
                    
                    $productFeatures = unserialize($row['features']);
                    foreach($productFeatures as $feature) {
                        echo "\n\t\t\t\t\t\t\t\t\t<li>".$feature.'</li>';
                    }
                    
                    ?>
                    </ul>
                    </div>
                </div>
                <div id="price_wrapper">
                <? 
                
                if (($row['msrp']-$row['price']) > 0  && $row['disabled'] == '0') {
                    echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_msrp" class="product_price_left">Retail:&nbsp;</div><div id="product_msrp" class="product_price_right">$';
                    echo number_format(($row['msrp']/100),2); 
                    echo '</div>';
                    echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_save" class="product_price_left">Save:&nbsp;</div><div id="product_save" class="product_price_right">';
                    echo number_format(((1-($row['price']/$row['msrp']))*100),0);
                    echo '%</div>';
                    echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right product_price_total_border">$';
                    echo number_format(($row['price']/100),2);
                    echo '</div>';
					echo '<div id="product_timestamp">as of '.date('g:i a T',$row['updated']).' - <span style="cursor:pointer;" onClick="javascript:alert(\'Product prices and availability are accurate as of the date/time indicated and are subject to change. Any price and availability information displayed on http://amazon.com at the time of purchase will apply to the purchase of this product.\')">[Details]</span></div>';
                }
                elseif ($row['disabled'] == '0') {
                    echo "\n\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($row['price']/100),2).'</div>';
					echo '<div id="product_timestamp">as of '.date('g:i a T',$row['updated']).' - <span style="cursor:pointer;" onClick="javascript:alert(\'Product prices and availability are accurate as of the date/time indicated and are subject to change. Any price and availability information displayed on http://amazon.com at the time of purchase will apply to the purchase of this product.\')">[Details]</span></div>';
                }
				else {
                    echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_msrp" class="product_price_left">Retail:&nbsp;</div><div id="product_msrp" class="product_price_right">$';
                    echo number_format(($row['msrp']/100),2); 
                    echo '</div>';
					//echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_unavailable">Price unavailable. Check Amazon.com for availability.</div>';
				}
                
                ?>
                </div><?
				
						echo '		<div id="product_variations">
										<ul>';
						$itemVariations = unserialize($row['itemvariations']);
						foreach ($itemVariations as $variation) {
								echo '<li>'.$variation.'</li>';
						}
						echo '</ul>
									</div>';
				?>
                <div id="view_on_amazon" class="<? echo 'amazonCenter'; ?>"><a href="<? //echo $row['amazonlink']; ?>"><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/viewOnAmazon.png" width="150" height="75"></a></div>
                
            </div>
        </div>
        <? if ($row['rating'] != '') {
			echo '<div id="rating_frame_wrapper">
        	<div id="product_rating"><img src="'.WEBSITE_ROOT_URL.'/includes/images/norothRating.png" width="140" height="30"><div id="rating_text">'.$row['rating'].'</div>(out of 100)</div>
            <div id="the_good"><h1>The Good:</h1>'.$row['thegood'].'</div>
            <div id="the_bad"><h1>The Bad:</h1>'.$row['thebad'].'</div>
        </div>
        <div id="description_frame_wrapper">
            <img src="'.WEBSITE_ROOT_URL.'/includes/images/norothProductReview.png" width="290" height="30">
			'.$row['customdescription'].'
        </div>';
		}?>
        
        <div id="comments_frame_wrapper">
        <?
			$query = "SELECT *  FROM `".DB_NAME."`.`comments` WHERE `asin` LIKE '".mysql_real_escape_string($row['asin'])."' ORDER BY `comments`.`created` DESC LIMIT 20";
			if ($product_found) $commentResult = mysql_query($query);
			else $commentResult = '';
		?>
        	<div id="comments_frame">
            <img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/userReviews.png" width="175" height="30"><br /><br />
            	<ul>
                	<? 
					if (mysql_num_rows($commentResult) == 0) {
						echo '<li>No Comments.  Be the first to comment about this product!</li>';
					}
					else {
						while ($commentRow = mysql_fetch_assoc($commentResult)) {
							echo '<li>';
							if ($commentRow['rating'] >= 1 && $commentRow['rating'] <= 5) {
								echo '<div class="commentRating">';
								for ($i=0;$i<5;$i++) {
									if ($i < $commentRow['rating']) {
										echo '<img src="'.WEBSITE_ROOT_URL.'/includes/images/star-filled.png" width="16" height="16">';
									}
									else {
										echo '<img src="'.WEBSITE_ROOT_URL.'/includes/images/star-unfilled.png" width="16" height="16">';
									}
								}
								echo '&nbsp;</div>';
							}
							echo '<div class="commentName">'.$commentRow['name'].'</div>';
							//echo '<div class="commentDate">&nbsp;on '.date('F j, Y',$commentRow['created']).'</div>';
							echo '<div class="commentComment">'.$commentRow['comment'].'</div>';
							echo '</li>';
						}
					}
					?>
                </ul>
                <br />
                <hr>
                <h1>What do you think about this product?</h1><br />
                <form name="comments_form" id="comments_form" action="<? echo WEBSITE_ROOT_URL; ?>/process_comment.php" method="post">
                    <label for="name">Name: (optional)</label><br />
                    <input name="name" id="name" type="text"><br />
                    <label for="rating">Rate this product: (optional)</label><br />
                    <select name="rating" id="rating">
                        <option value=""></option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select><br />
                    <label for="comment">Comment or Review:</label><br />
                    <textarea name="comment" id="comment" onkeydown="limitText(this.form.comment,'comments1countdown',3000);" onkeyup="limitText(this.form.comment,'comments1countdown',3000);"></textarea>
                    <div id="commentsCountdownFrame"><span id="comments1countdown">0</span>/3000 characters used.<br /></div>
                    <div id="captchaWrapper">
                    	Security code:<br />
                        <img id="captcha" src="<? echo WEBSITE_ROOT_URL; ?>/includes/captcha/securimage_show.php?<? echo 'rand='.rand(1000,1000000); ?>" alt="CAPTCHA Image" /><br />
                        <a href="#" onclick="document.getElementById('captcha').src = '<? echo WEBSITE_ROOT_URL; ?>/includes/captcha/securimage_show.php?' + Math.random(); return false" style="color:blue;">Reload Image</a><br />
                        Type Security code (picture above):<br />
                        <input type="text" name="captcha_code" size="10" maxlength="6" />
                    </div>
                    <input type="hidden" name="asin" value="<? echo $row['asin']; ?>">
                    <input name="submitButtom" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

<?
include 'templates/default/bottom.php';
?>