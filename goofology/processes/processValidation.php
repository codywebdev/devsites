<?php
	
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

   $email=escapeString($_REQUEST['email']);
   $validation=escapeString($_REQUEST['validation']);
   
   	//validate form data
	if (!(checkCharactersEmail($email) && checkCharacters($validation))) {
		echo '<script language="javascript">
		     location.replace("/login.php'
			  .'")</script>';
		echo 'Invalid character in request, please go back and try again.';
			  return false;
	}

   
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result = mysql_query("SELECT *  FROM `newmembers` 
						  WHERE `email` LIKE CONVERT(_utf8 '$email' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if ($line['email']) 
	{//if email is found
		if ($line['validation'] == $validation)
		{
			$username = $line['username'];
			$password = $line['password'];
			$screenname = $line['screenname'];
			$firstname = $line['firstname'];
			$lastname = $line['lastname'];
			$location = $line['location'];
			$gender = $line['gender'];
			$date = $line['date'];
			$email = $line['email'];
			$dob = $line['dob'];
			$favlinks = 'a:0:{}';
			
			mysql_query("INSERT INTO `members` (`username`, `password`, `screenname`,`favlinks`,`firstname`, `lastname`, `location`, `date`, `email`, `dob`, `gender`) VALUES ('$username', '$password', '$screenname', '$favlinks', '$firstname', '$lastname', '$location', NOW(), '$email', '$dob', '$gender')") or die(mysql_error());
			
			mysql_query("DELETE FROM `newmembers` WHERE CONVERT(`username` USING utf8) = '$username' LIMIT 1") or die(mysql_error());
			
			echo 'Your account has been successfully activated! <a href="http://www.goofology.com">Click here to return to Goofology.com</a>';
		}
		else
		{
			echo 'Invalid Activation Code.';
		}
	}
	else
	{
		echo 'That email address was not found. Either you have already activated your account, or you mistyped your email address. If you have already validated your account, then <a href="/login.php">click here to log in.</a> Otherwise, go back and try again.';
	}
	
	include '/home/goofology/public_html/phpincludes/closedb.php';


?>