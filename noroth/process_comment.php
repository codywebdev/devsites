<?
require_once('includes/dbconnect/config.php');
require_once('includes/functions.php');
require_once('includes/captcha/securimage.php');
require_once('includes/php/Akismet.class.php');
session_start();


$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
	echo "The security code (captcha) that you entered was incorrect.  Please go back and try again."; 
}
else {
		$asin = htmlspecialchars($_POST['asin']);
		$name = htmlspecialchars($_POST['name']);
		if (sizeof($name) > 32) $name = substr($name, 0, 32);
		if ($name == '') $name = 'Anonymous';
		$rating = $_POST['rating'];
		if ($rating != '' && ($rating < 1 || $rating > 5)) $rating = '';
		$comment = htmlspecialchars($_POST['comment']);
		$comment = str_replace("\n","<br />\n",$comment);
		$ipaddress = $_SERVER['REMOTE_ADDR'];

		$WordPressAPIKey = '4a0c24d5c705';
		$MyBlogURL = 'http://www.example.com/blog/';
		
		$akismet = new Akismet($MyBlogURL ,$WordPressAPIKey);
		$akismet->setCommentAuthor($name);
		$akismet->setCommentContent($comment);
		$akismet->setPermalink('http://www.example.com/blog/alex/someurl/');

		if (!$akismet->isCommentSpam()) {
			if (sizeof($comment) > 0) {
				$query = "INSERT INTO `".DB_NAME."`.`comments` (`id`, `asin`, `name`, `rating`, `comment`, `ipaddress`, `created`) VALUES (NULL, '".mysql_real_escape_string($asin)."', '".mysql_real_escape_string($name)."', '".mysql_real_escape_string($rating)."', '".mysql_real_escape_string($comment)."', '".mysql_real_escape_string($ipaddress)."', '".time()."');";
				$result = mysql_query($query);
			}
		}
	header("Location: ".WEBSITE_ROOT_URL."/product/".$asin."/");
}


?>