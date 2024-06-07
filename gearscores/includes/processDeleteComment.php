<?
include("functions.php");
include ("config.php");
include ("opendb.php");

$output = '';
$deleteSuccess = false;

$name = isset($_COOKIE["loginA"])? $_COOKIE["loginA"] : "";
$email = strtolower(isset($_COOKIE["loginE"])? $_COOKIE["loginE"] : "");
$password = isset($_COOKIE["loginP"])? $_COOKIE["loginP"] : "";
$id = $_POST['id'];
$character = urldecode(isset($_POST["n"])? $_POST["n"] : "");
$server = urldecode(isset($_POST["s"])? $_POST["s"] : "");
$region = urldecode(isset($_POST["r"])? $_POST["r"] : "us");



//make sure user can post
	//find the user
	$query = "	SELECT * 
				FROM `users` 
				WHERE `email` LIKE '".mysql_real_escape_string($email)."'
				LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		//compare the user found to the info submitted
		$userInfo = mysql_fetch_assoc($result);	
		if ($userInfo['alias'] != $name || $userInfo['email'] != $email || $userInfo['password'] != md5($email.'asdf123'.$password) || $userInfo['banned'] != '0') {
			$output .= "**You are not allowed to delete this comment.<br />";
		}
		else {
			$query = "SELECT * 
			FROM `comments` 
			WHERE `id` LIKE '".mysql_real_escape_string($id)."'
			LIMIT 1";
			$result = mysql_query($query);
			if (mysql_num_rows($result) > 0) {
				$query = "DELETE FROM `comments` WHERE `comments`.`id` = ".mysql_real_escape_string($id)." LIMIT 1;";
				$result = mysql_query($query);
				$deleteSuccess = true;
				$output .= 'Comment successfully deleted.  Redirecting to <a href="'.'http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).''.'">'.'http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).''.'</a>';
			}
			else {
				$output .= '**Error, comment not found.  Please log out and back in, and then try again.  If the problem continues, then report the error using the Contact Us link at the bottom of the page.';
			}
		}
	}
	else {
		$output .= '**Error: You are not logged in.';
	}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
if ($deleteSuccess) {
	echo '<meta http-equiv="REFRESH" content="1;url=http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).'">';
}
else {
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
}
?>
<title>Untitled Document</title>
</head>

<body>

<? 
	echo $output;
?>

</body>
</html>