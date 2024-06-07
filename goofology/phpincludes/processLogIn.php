<?php
error_reporting(0);
	
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/escapeString.php';
	
	$username= isset($_POST['username'])?escapeString($_POST['username']):'';
	$password= isset($_POST['password'])?escapeString($_POST['password']):'';
	$remember= isset($_POST['remember'])?escapeString($_POST['remember']):'';
	$ipaddress=$_SERVER['REMOTE_ADDR'];
	
	//validate form data
	if (!(checkCharactersUsername($username) && checkCharactersUsername($password) && 
	     ($remember==true || $remember ==false))) {
		echo '<script language="javascript">
		     location.replace("/login.php'
			  .'?liec=001")</script>';
		echo 'Invalid character in request, please go back and try again.';
			  return false;
	}
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `username` LIKE CONVERT(_utf8 '$username' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if ($line['username']) 
	{//if username is found
		if ($line['password'] == sha1($password))
		{
			mysql_query("UPDATE `members` SET `ipaddress` = '$ipaddress' 
						WHERE CONVERT(`username` USING utf8) = '$username' LIMIT 1") 
						  or die(mysql_error());
			$screenname=$line['screenname'];
			if ($remember==true){
				$month=date('m');
				$day=date('d');
				$year=date('Y');
				$hour=date('G');
				$cryptTime = sha1(mktime($hour, 0, 0, $month, $day, $year));
				setcookie("gt",$cryptTime,"0","/",".goofology.com");
				setcookie("screenname",$screenname,time()+3600*24*14,"/",".goofology.com");
				setcookie("password",sha1($password),time()+3600*24*14,"/",".goofology.com");
			}
			else {
				$month=date('m');
				$day=date('d');
				$year=date('Y');
				$hour=date('G');
				$cryptTime = sha1(mktime($hour, 0, 0, $month, $day, $year));
				setcookie("gt",$cryptTime,"0","/",".goofology.com");
				setcookie("screenname",$screenname,"0","/",".goofology.com");
				setcookie("password",sha1($password),"0","/",".goofology.com");
			}
				echo '<script language="javascript">
					 location.replace("/index.php?sid='.rand(0,1000)
					  .'")</script>';
				echo 'Login Successful.';
		}
		else
		{
			echo '<script language="javascript">
				 location.replace("/login.php'
				  .'?liec=010")</script>';
			echo 'Invalid Password, please go back and try again.';
		}
	}
	else
	{
		echo '<script language="javascript">
		     location.replace("/login.php'
			  .'?liec=100")</script>';
		echo 'Invalid Username, please go back and try again.';
	}
	
	include '/home/goofology/public_html/phpincludes/closedb.php';


?>