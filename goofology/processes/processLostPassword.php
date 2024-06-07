<?php

	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/basicEncrypt.php';

	$email=$_POST['email'];
	
	//validate form data
	if (!(checkCharactersEmail($email) && $email!='')) {
		echo '<script language="javascript">'
			.'location.replace("/lostpassword.php?errorcode=1")</script>';
		echo 'Invalid character in request, please go back and try again.';
			  return false;
	}
	
	//find email address in database
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `email` LIKE CONVERT(_utf8 '$email' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['email']) {//if email is not found
		//check newmembers table to see if account hasn't been activated yet
		$result = mysql_query("SELECT *  FROM `newmembers` 
							  WHERE `email` LIKE CONVERT(_utf8 '$email' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
		$line = mysql_fetch_array($result);
		if (!$line['email']) {//if email is not found
			echo '<script language="javascript">'
				.'location.replace("/lostpassword.php?errorcode=1")</script>';
			echo 'Invalid character in request, please go back and try again.';
				  return false;
		}
		else {//member has not activated their account yet
			echo 'Your account has not been activated yet. If you would like '
				.'instructions on how to activate your account, please click '
				.'<a href="/lostvalidation.php">here.</a>';
				return false;
		}
	}
	
	//gather variables for the string to be encrypted
	$username=$line['username'];
	$password=$line['password'];
	$screenname=$line['screenname'];
	$email=$line['email'];
	$firstname=$line['firstname'];
	$lastname=$line['lastname'];
	$dob=$line['dob'];
	$location=$line['location'];
	//get timestamp to append to the string to be encrypted
	$month=date('m');
	$day=date('d');
	$year=date('Y');
	$hour=date('G');
	//make string to be encrypted
	$string=$username.$password.$screenname.$email.
			$firstname.$lastname.$dob.$location.mktime($hour, 0, 0, $month, $day, $year);
	//encrypt string
	$cryptString = sha1($string);
	//encrypt email
	$cryptEmail = encrypt($email);
	
	//send an email to the user on how to activate their account
	$to = "$email";
	$subject = "Lost Password";
	$message = "
Greetings $screenname,

Please use the following link to reset your password for your Goofology.com membership account.  For your security, this link will expire in 24 hours. In addition, you can only use this link to reset your password one time.  After you have changed your password, you will no longer be able to use this link to change your password again.

http://www.goofology.com/resetPassword.php?a=$cryptEmail&b=$cryptString

If the link above appears broken or fails to work for any reason, try requesting a new password reset link from the following page.

http://www.goofology.com/lostpassword.php


Best Regards,

The Goofology.com staff
";
	$from = "no-reply@goofology.com";
	$headers = "From: Goofology.com <$from>";
	if (mail($to,$subject,$message,$headers)) {
		echo 'An email has been sent to ' . $email . ' with instructions on how to change '
			.'your password. The link in the email to change your password will expire '
			.'in 24 hours.';
	}
	else {
		echo 'An error occured when trying to send an email to ' . $to;
	}

	include '/home/goofology/public_html/phpincludes/closedb.php';
?>