<?php

	include "/home/goofology/public_html/phpincludes/escapeString.php";

	$name=isset($_POST['name'])? escapeString($_POST['name']) : '';
	$oldType=isset($_POST['type'])? escapeString($_POST['type']) : '';
	$description=isset($_POST['description'])? escapeString($_POST['description']) : '';
	$ipaddress=isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
	
	switch ($type) {
		case 'question':
			$type = 'Question';
			break;
		case 'comment':
			$type = 'Comment';
			break;
		case 'suggestion':
			$type = 'Suggestion';
			break;
		case 'report':
			$type = 'Error/Bug';
			break;
		case 'other':
			$type = 'Other';
			break;
		default:
			$type = 'unknown';
			break;
		
	}
	
	$shortDescription = substr($description, 0, 50);
	$name .= ' (' . $ipaddress . ')';
	$to = "support@goofology.com";
	$subject = '<' . $type . '> ' . $shortDescription;
	$from = "no-reply@goofology.com";
	$headers = "From: $type <$from>";
	$message = 'Name: ' . $name . "
Type: " . $type . "
Description: " . $description . "
";
	
/* DISABLE CONTACT FORM - (SPAMMERS) 

	if (mail($to,$subject,$message,$headers)) {
		echo "Your message has been successfully sent to our support team. "
			."We greatly appreciate your feedback! <a href=\"http://www.goofology.com\">Click here to return to Goofology.com</a>";
	}
	else {
		echo 'An error occured when trying to process your request. <a href=\"http://www.goofology.com\">Click here to return to Goofology.com</a>';
	}
	
	*/

?>