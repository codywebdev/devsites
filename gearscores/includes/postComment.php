<?php session_start(); ?><?

include("functions.php");
include ("config.php");
include ("opendb.php");
include ('captcha/securimage.php');



$name = isset($_COOKIE["loginA"])? $_COOKIE["loginA"] : "";
$email = strtolower(isset($_COOKIE["loginE"])? $_COOKIE["loginE"] : "");
$password = isset($_COOKIE["loginP"])? $_COOKIE["loginP"] : "";
$comment = htmlspecialchars(isset($_POST["comment"])? $_POST["comment"] : "");
$character = urldecode(isset($_REQUEST["n"])? $_REQUEST["n"] : "");
$server = urldecode(isset($_REQUEST["s"])? $_REQUEST["s"] : "");
$region = urldecode(isset($_REQUEST["r"])? $_REQUEST["r"] : "us");
$special = htmlspecialchars(isset($_POST["special"])? $_POST["special"] : "");
$id = htmlspecialchars(isset($_POST["id"])? $_POST["id"] : "");
$ipaddress = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
if ($region != "us" && $region != "eu") $region = "us";


$errorCode = '';
$passedCode = '';
$passedTest = true;


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
			$errorCode .= "**You are not allowed to post comments.<br />";
			$passedTest = false;
		}
	}

//test comment
if(strlen($comment) < 10 || strlen($comment) > 500) {
	$errorCode .= "**Comment must be between 10-500 characters long.  Please go back and try again.<br />";
	$passedTest = false;
}

//test $special
if ($special == 'edit') {
	
	$query = "SELECT *  FROM `comments` WHERE `email` LIKE '".mysql_real_escape_string($email)."'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$special = 'edit';
	}
}
else $special = 'new';

if ($passedTest) {
	//if editting comment then find old post and edit it
	if ($special == 'edit') {
		$query = "UPDATE `gearscor_gsdb`.`comments` SET `comment` = '".mysql_real_escape_string($comment)."', `time` = '".mysql_real_escape_string(time())."' WHERE `comments`.`id` = ".mysql_real_escape_string($id).";";
	}
	
	//if new comment then insert into database
	else {
		$query = "INSERT INTO `gearscor_gsdb`.`comments` (`id`, `region`, `character`, `realm`, `comment`, `time`, `name`, `email`, `ipaddress`, `yes`, `no`, `reported`) VALUES (NULL, '".mysql_real_escape_string($region)."', '".mysql_real_escape_string($character)."', '".mysql_real_escape_string($server)."', '".mysql_real_escape_string($comment)."', '".mysql_real_escape_string(time())."', '".mysql_real_escape_string($name)."', '".mysql_real_escape_string($email)."', '".$ipaddress."', '', '', '');";
	}
	$result = mysql_query($query);
	if ($result) {
		$passedCode = 'Your comment has been successfully added.  Redirecting back to <a href="http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).'">http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).'</a>.';
	}
	else {
		$errorCode = 'An unknown error has occured.  Please try again. If it continues, then report the problem by using the Contact Us link at the bottom of the page.';
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? 	if ($errorCode == '') echo '<meta http-equiv="REFRESH" content="1;url=http://gearscores.com/character.php?n='.urlencode($character).'&amp;s='.urlencode($server).'&amp;r='.urlencode($region).'">';
	else echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
?>
<title>GearScores.com - Post a Comment</title>

</head>

<body>

<? echo $errorCode.$passedCode; ?>

</body>
</html>