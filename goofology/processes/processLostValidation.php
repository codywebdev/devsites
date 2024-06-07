<?php

	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/basicEncrypt.php';

	$email=$_POST['email'];
	
	//validate form data
	if (!(checkCharactersEmail($email) && $email!='')) {
		echo '<script language="javascript">'
			.'location.replace("/lostvalidation.php?errorcode=1")</script>';
		echo 'Invalid character in request, please go back and try again.';
			  return false;
	}
	
	//find email address in database
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result = mysql_query("SELECT *  FROM `newmembers` 
						  WHERE `email` LIKE CONVERT(_utf8 '$email' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['email']) {//if email is not found
		//check members table to see if account already been activated
		$result = mysql_query("SELECT *  FROM `members` 
							  WHERE `email` LIKE CONVERT(_utf8 '$email' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
		$line = mysql_fetch_array($result);
		if (!$line['email']) {//if email is not found
			echo '<script language="javascript">'
				.'location.replace("/lostvalidation.php?errorcode=1")</script>';
			echo 'Invalid character in request, please go back and try again.';
				  return false;
		}
		else {//member has already activated their account
			echo 'Your account has already been activated, if you would like to login '
				.'now then please click '
				.'<a href="/lostvalidation.php">here.</a>';
				return false;
		}
	}
	$screenname=$line['screenname'];
	$email=$line['email'];
	$validation=$line['validation'];
	
	//send an email to the user on how to activate their account
	$to = "$email";
	$subject = "Activate your account";
	$message = "
Greetings $screenname,

Thank you for signing up to become a Goofology.com member!  Please follow the link below to confirm your email address and activate your membership account at Goofology.com.

http://www.goofology.com/processValidation.php?email=$email&validation=$validation

If the link above appears broken or fails to work for any reason, try visiting the page below.

http://www.goofology.com/validate.php

Registered Email: $email

Validation Code: $validation


Best Regards,

The Goofology.com staff
";
	$from = "no-reply@goofology.com";
	$headers = "From: Goofology.com <$from>";
	if (mail($to,$subject,$message,$headers)) {
		echo 'An email has been sent to ' . $email . ' containing your validation code.';
	}
	else {
		echo 'An error occured when trying to send an email to ' . $to;
	}

	include '/home/goofology/public_html/phpincludes/closedb.php';
?>