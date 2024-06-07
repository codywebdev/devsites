<?php

	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/basicEncrypt.php';
	
	$cryptEmail=$_GET['a'];
	$cryptString=$_GET['b'];
	$errorcode=$_GET['c'];
	$newPassword=$_POST['password'];
	$newPassword2=$_POST['confpassword'];
	
	//decrypt email
	if ($cryptEmail!='') { $email = decrypt($cryptEmail); }
	//validate form data (except passwords)
	if (!(checkCharactersEmail($email) && checkCharacters($cryptString) 
	      && $email!='' && $cryptString!='' 
		  && ($errorcode==''||$errorcode=='1'||$errorcode=='2'))) {
		echo 'This password recovery page has expired. If you would still like to change your '
			.'password, please click <a href="/lostpassword.php">here.</a>';
			  return false;
	}
	//validate passwords
	if ($newPassword!==$newPassword2) {
		echo '<script language="javascript">'
			.'location.replace("/resetPassword.php?a='
			.$cryptEmail.'&b='.$cryptString.'&c=2")</script>';
		echo 'Passwords do not match, please go back and try again.';
		return false;
	}
	echo '<!--';
	if (!(checkPassword($newPassword) && checkPassword($newPassword2))) {
		echo '-->';
		echo '<script language="javascript">'
			.'location.replace("/resetPassword.php?a='
			.$cryptEmail.'&b='.$cryptString.'&c=1")</script>';
		echo 'Password contains illegal characters, please go back and try again.';
		return false;
	}
	echo '-->';
	
	//find email in database
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
	$match=false;
	//verify cryptString is authentic and created in the last 24 hours
	for ($i=0;$i<24;$i++) {
		$string=$username.$password.$screenname.$email.
				$firstname.$lastname.$dob.$location.mktime($hour-$i, 0, 0, $month, $day, $year);
		$string = sha1($string);
		if ($string===$cryptString) {//if strings are exactly equal
			$match=true;
			break;
		}
	}
	
	$newCryptPassword = sha1($newPassword);
	if ($match) {
		if (mysql_query("UPDATE `members` SET `password` = '$newCryptPassword' 
			WHERE `username` = '$username' LIMIT 1") ) {
			echo 'Your password has been changed. If you would like to login,'
				.' please click <a href="/login.php">here.</a>';
			return true;
		}	
		else {
			echo 'An unknown error occured with your request.';
			return false;
		}
	}
	else {
		echo 'This password recovery page has expired. If you would still like to change your '
			.'password, please click <a href="/lostpassword.php">here.</a>';
			  return false;
	}

	include '/home/goofology/public_html/phpincludes/closedb.php';
?>