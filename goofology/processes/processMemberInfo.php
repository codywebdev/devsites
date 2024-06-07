<?php
	include "/home/goofology/public_html/phpincludes/memberCheck.php";
	include "/home/goofology/public_html/phpincludes/escapeString.php";
   
	$username=isset($_POST['username'])? escapeString($_POST['username']) : '';
	$password=isset($_POST['password'])? escapeString($_POST['password']) : '';
	$screenname=isset($_POST['screenname'])? escapeString($_POST['screenname']) : '';
	$email=isset($_POST['email'])? escapeString($_POST['email']) : '';
	$firstname=isset($_POST['firstname'])? escapeString($_POST['firstname']) : '';
	$lastname=isset($_POST['lastname'])? escapeString($_POST['lastname']) : '';
	$gender=isset($_POST['gender'])? escapeString($_POST['gender']) : '';
	$bmonth=isset($_POST['bmonth'])? escapeString($_POST['bmonth']) : '';
	$bday=isset($_POST['bday'])? escapeString($_POST['bday']) : '';
	$byear=isset($_POST['byear'])? escapeString($_POST['byear']) : '';
	$location=isset($_POST['location'])? escapeString($_POST['location']) : '';
	$agreed=isset($_POST['agreed'])? escapeString($_POST['agreed']) : '';
	$dob= $bmonth.' '.$bday.' '.$byear;
	$newdob= $byear.'-'.$bmonth.'-'.$bday;
	$infoverified= 'false';
	$errorcode= '';
   
	
	//Search a string for any of a set of characters
	function my_strpbrk($haystack, $char_list) { 
		$pos = strcspn($haystack, $char_list);
		
		if ($pos == strlen($haystack))
		  return FALSE;
	
		return substr($haystack, $pos);
	}

	//create an errorcode based on the results of the tests
	//also tests the data for various injection methods
	echo '<!--';
	$errorcode .= (checkUsername($username))? '0' : '1';
	$errorcode .= (checkPassword($password))? '0' : '1';
	$errorcode .= (checkScreenname($screenname))? '0' : '1';
	$errorcode .= (checkEmail($email))? '0' : '1';
	$errorcode .= (checkName($firstname))? '0' : '1';
	$errorcode .= (checkName($lastname))? '0' : '1';
	$errorcode .= (checkGender($gender))? '0' : '1';
	$errorcode .= (checkDOB($dob))? '0' : '1';
	$errorcode .= (checkLocation($location))? '0' : '1';

	//if errorcode does not have a 1 in it (no errors)
	if (!my_strpbrk($errorcode, '1') && strlen($errorcode)==9) {
		$infoverified = 'true';
	}
	echo '-->';
	if ($infoverified=='true' && $agreed=='agreed') {
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
		//create a validation string
		$randString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789'; 
		$max = strlen($randString)-1;
		$validation = '';
		for ($i=0; $i < 15; $i++) { 
			$validation .= $randString{mt_rand(0, $max)}; 
		}
		
		$encryptPassword = sha1($password);
		
		//create a new account in newmembers
		mysql_query("INSERT INTO `newmembers` (`username`, `password`, `screenname`,`firstname`, `lastname`, `location`, `date`, `email`, `dob`, `validation`, `gender`) VALUES ('$username', '$encryptPassword', '$screenname', '$firstname', '$lastname', '$location', NOW(), '$email', '$newdob', '$validation', '$gender')") or die(mysql_error());
		
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
		echo "Your information has been successfully added to our database. "
			."An email has been sent to " . $email . ". "
			."Please check your email for instuctions on how to activate your account.";
	}
	else {
		echo 'An error occured when trying to send an email to ' . $to;
	}
		
		include '/home/goofology/public_html/phpincludes/closedb.php';	
	}
	else
	{ //if the errorcode has a 1 in it, send back to form with errors
		echo '<script language="javascript">
			  location.replace("/signup.php?'
			  .'username=' . $username
			  .'&screenname=' . $screenname
			  .'&email=' . $email
			  .'&firstname=' . $firstname
			  .'&lastname=' . $lastname
			  .'&gender=' . $gender
			  .'&bmonth=' . $bmonth
			  .'&bday=' . $bday
			  .'&byear=' . $byear
			  .'&location=' . $location
			  .'&errorcode=' . $errorcode
			  .'")</script>';
		echo 'Invalid character in request, please go back and try again.';
	}
		
?>