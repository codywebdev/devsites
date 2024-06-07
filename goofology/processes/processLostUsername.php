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
	$username=$line['username'];
	
	//send an email to the user on how to activate their account
	$to = "$email";
	$subject = "Lost Username";
	$message = "
Greetings $screenname,

Here is the username registered to this email address at Goofology.com.

Username: $username

Best Regards,

The Goofology.com staff
";
	$from = "no-reply@goofology.com";
	$headers = "From: Goofology.com <$from>";
	if (mail($to,$subject,$message,$headers)) {
		echo 'An email has been sent to ' . $email . ' containing your username.';
	}
	else {
		echo 'An error occured when trying to send an email to ' . $to;
	}

	include '/home/goofology/public_html/phpincludes/closedb.php';
?>