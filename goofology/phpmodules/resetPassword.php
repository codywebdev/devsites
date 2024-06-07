<?php

	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/signup.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/checkNewPassword.php');
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/basicEncrypt.php';
	
	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Reset Password</h1><div class="contentBorder"><div class="linkLightBgBegin" id="resetPassword1">';
	$endHtml = '</div></div></div></div>';
	
	$cryptEmail=escapeString($_GET['a']);
	$cryptString=escapeString($_GET['b']);
	$errorcode=escapeString($_GET['c']);
	
	//decrypt email
	if ($cryptEmail!='') { $email = decrypt($cryptEmail); }
	//validate form data
	if (!(checkCharactersEmail($email) && checkCharacters($cryptString) 
	      && $email!='' && $cryptString!='' 
		  && ($errorcode==''||$errorcode=='1'||$errorcode=='2'))) {
		$newHtml .= '<p class="normalText">This password recovery page has expired. If you would still like to change your '
			.'password, please click <a href="/lostpassword.php">here.</a></p>';
			$newHtml .= $endHtml;
			echo $newHtml;
			  return false;
	}
	
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
			$newHtml .= '<script language="javascript">'
				.'location.replace("/lostpassword.php?errorcode=1")</script>';
			$newHtml .= '<p class="normalText">Invalid character in request, please go back and try again.</p>';
				$newHtml .= $endHtml;
				echo $newHtml;
				  return false;
		}
		else {//member has not activated their account yet
			$newHtml .= '<p class="normalText">Your account has not been activated yet. If you would like '
				.'instructions on how to activate your account, please click '
				.'<a href="/lostvalidation.php">here.</a></p>';
				$newHtml .= $endHtml;
				echo $newHtml;
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
	
	if ($match) {
		$newHtml .= '<p class="normalText">Please type your new desired password in the fields below and press "Change Password" to set your new password.</p><br/><p>';
		
			if ($errorcode=='1') //if errorcode equals 1
			{
				$newHtml .= '<table width="350" border="0" cellspacing="0" cellpadding="10">'
					.'<tr><td width="350" bgcolor="#CCCCCC" class="errorstyle">'
					.'Invalid password.</td></tr></table>';
			}
			else if ($errorcode=='2') //if errorcode equals 2
			{
				$newHtml .= '<table width="350" border="0" cellspacing="0" cellpadding="10">'
					.'<tr><td width="350" bgcolor="#CCCCCC" class="errorstyle">'
					."Password's do not match.</td></tr></table>";
			}
		
		$newHtml .= '</p>'
			.'<form id="form1" name="form1" method="post" '
			.'action="/processes/processResetPassword.php?a='.$cryptEmail.'&b='.$cryptString 
			.'"><label></label>'
			.'<table width="100%" border="0" cellpadding="10" cellspacing="0">'
			.'<tr><td width="250"><p class="boldText">New password:<br/>'
			.'<input name="password" type="password" id="password" class="loginField" maxlength="50"'
			.' onblur="checkValue(this.value,\'password\',\'password1\')" />'
			.'</p></td><td><span id="password1">&nbsp;</span></td>'
			.'</tr><tr><td width="250"><p class="boldText">Confirm password:<br/>'
			.'<input name="confpassword"'
			.' type="password" id="confpassword" class="loginField" maxlength="50" '
			.'onblur="checkNewPassword()" /></p></td><td><span id="password2">'
			.'&nbsp;</span></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>'
			.'<input type="submit" name="Submit" id="Submit"'
			.' value="Change Password" /></td><td>&nbsp;</td></tr></table></form>';
	}
	else {
		$newHtml .= '<p class="normalText">This password recovery page has expired. If you would still like to change your '
			.'password, please click <a href="/lostpassword.php">here.</a></p>';
				$newHtml .= $endHtml;
				echo $newHtml;
			  return false;
	}

	$newHtml .= $endHtml;
	echo $newHtml;

	include '/home/goofology/public_html/phpincludes/closedb.php';

?>