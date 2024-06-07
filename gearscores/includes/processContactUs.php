<?
include("functions.php");
include ("config.php");
include ("opendb.php");

	$name = mysql_real_escape_string(htmlspecialchars(urldecode(isset($_POST["name"])? $_POST["name"] : "")));
	$email = mysql_real_escape_string(htmlspecialchars(urldecode(isset($_POST["email"])? $_POST["email"] : "")));
	$type = mysql_real_escape_string(htmlspecialchars(urldecode(isset($_POST["type"])? $_POST["type"] : "")));
	$description = mysql_real_escape_string(htmlspecialchars(urldecode(isset($_POST["desc"])? $_POST["desc"] : "")));
	$ipaddress=isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';


	$name .= ' (' . $ipaddress . ')';
	$to = "support@gearscores.com";
	$subject = '(' . $type . ') ' . substr($description,0,30);
	$from = "support@gearscores.com";
	$headers = "From: GearScores.com <$from>";
	$message = 'Name: ' . $name . "
Email: " . $email . "
Type: " . $type . "
Description: " . $description . "
";
	
	if (mail($to,$subject,$message,$headers)) {
		echo "Your message has been successfully sent to our support team. "
			."We greatly appreciate your feedback! <a href=\"http://gearscores.com\">Click here to return to GearScores.com</a>";
	}
	else {
		echo 'An unknown error has occured while trying to process your request.  A log has been created and sent to our support team.  We appreciate your patience while we resolve this problem. <a href=\"http://gearscores.com\">Click here to return to GearScores.com</a>';
	}
	
include ("closedb.php");
?>