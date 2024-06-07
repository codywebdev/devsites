<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');
session_start();

if ($_SESSION['administrator'] != 'yes' && $_SESSION['ipAddress'] != $_SERVER['REMOTE_ADDR']) {
	header("Location: ".WEBSITE_ROOT_URL."/admin/login.php");
	exit;
}
?><?
include ($_SERVER['DOCUMENT_ROOT'] . '/templates/default/top.php');
?>
<?
//Get input variables from the URL
$asin = $_GET['asin'];

if ($asin == '') {
	$asin = 'B0083PWAPW';
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
		$row = mysql_fetch_assoc($result);
	}
}
?>
<?

include '../includes/php/sidebar_categories.php';

?>
<? 
if ($product_found) {
}
else {
	echo 'Product not found.';
}
?>
<link href="<? echo WEBSITE_ROOT_URL; ?>/includes/css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<? echo WEBSITE_ROOT_URL; ?>/includes/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// General options
	theme : "advanced",
	skin : "o2k7",
	skin_variant : "silver",
	mode : "textareas",
	plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    width: "100%",
    height: "400"
});
</script>
<form name="editProduct" id="editProduct" action="processes/process_edit_product.php" method="post">
<div id="navBreadCrumbs"><a href="<? echo WEBSITE_ROOT_URL.'/admin/'; ?>">Home</a>&nbsp;&gt;&nbsp;<a href="<? echo $row['amazonlink']; ?>">Item#: <? echo $row['asin']; ?></a></div>
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
                <div id="product_name"><div class="product_name_vertical_align"><input name="form_shortName" id="form_shortName" type="text" value="<? if ($row['customtitle'] != '') echo $row['customtitle']; else echo $row['title']; ?>"></div></div>
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
                }
                elseif ($row['disabled'] == '0') {
                    echo "\n\t\t\t\t\t\t\t\t\t".'<br /><div id="product_price" class="product_price_left">Price:&nbsp;</div><div id="product_price" class="product_price_right">$'.number_format(($row['price']/100),2).'</div>';
                }
				else {
                    echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_msrp" class="product_price_left">Retail:&nbsp;</div><div id="product_msrp" class="product_price_right">$';
                    echo number_format(($row['msrp']/100),2); 
                    echo '</div>';
					echo "\n\t\t\t\t\t\t\t\t\t".'<div id="product_unavailable">This product is only available on Amazon.com</div>';
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
                <div id="itemVariations">Tab Delimited List of Variations:<br /><input name="form_itemVariations" id="form_itemVariations" type="text" value="<? 
				$variationsArray = unserialize($row['itemvariations']); 
				$i=0;
				foreach ($variationsArray as $variation) {
					if ($i > 0) echo ',';
					echo $variation;
					$i++;
				}
				?>"></div>
            </div>
        </div>
        <div id="rating_frame_wrapper">
        	<div id="product_rating"><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/norothRating.png" width="140" height="30"><div id="rating_text"><input name="form_itemRating" id="form_itemRating" type="text" value="<? echo $row['rating']; ?>" /></div></div>
            <div id="the_good"><h1>The Good:</h1><input name="form_itemRatingTheGood" id="form_itemRatingTheGood" type="text" value="<? echo $row['thegood']; ?>" /></div>
            <div id="the_bad"><h1>The Bad:</h1><input name="form_itemRatingTheBad" id="form_itemRatingTheBad" type="text" value="<? echo $row['thebad']; ?>" /></div>
        </div>
        <div id="description_frame_wrapper"><h1><? echo WEBSITE_NAME; ?> Product Review</h1><br />
       	  <textarea name="form_customDescription" id="form_customDescription"><? echo $row['customdescription']; ?></textarea>
            <input name="form_asin" type="hidden" id="form_asin" value="<? echo $_GET['asin']; ?>">
        </div>
        <div id="reviews_frame_wrapper">
        </div>
        <div id="comments_frame_wrapper">
        <?
			$query = "SELECT *  FROM `".DB_NAME."`.`comments` WHERE `asin` LIKE '".mysql_real_escape_string($row['asin'])."' ORDER BY `comments`.`created` DESC LIMIT 20";
			$commentResult = mysql_query($query);
		?>
        	<div id="comments_frame">
            <h1>User Reviews</h1><br />
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
							echo '<div class="commentDate">&nbsp;on '.date('F j, Y',$commentRow['created']).'</div>';
							echo '<div class="commentComment">'.$commentRow['comment'].'</div>';
							echo '</li>';
						}
					}
					?>
                </ul>
            </div>
        </div>
    </div>
</div>
</form>
<?
include ($_SERVER['DOCUMENT_ROOT'] . '/templates/default/bottom.php');
?>