<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process</title>
</head>

<body>
<?php
	include '/home/goofology/public_html/phpincludes/linkCheck.php';
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
   $name=escapeString($_POST['name']);
   $url=escapeString($_POST['url']);
   $description=escapeString($_POST['description']);
   $category=escapeString($_POST['category']);
   $errorcode='';
   $screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : NULL;
	$loggedIn = TRUE;
	$rank1 = TRUE;
	//fetch the record containing the users 'screenname'
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	$awards = $line['awards'];
	if (!$line['screenname']) {
		//if screenname not found (not logged in)
		$loggedIn = FALSE;
	}
	
	//verify login info
	else if (!($screenname==$line['screenname'] && $password==$line['password'] && $_SERVER['REMOTE_ADDR']==$line['ipaddress'])) {
		$loggedIn = FALSE;
	}
	
	//verify member is allowed to moderate
	else if ($awards[0]!=1) {
		$rank1 = FALSE;
	}
	
	if (!$loggedIn || !$rank1) {
		echo '<script language="javascript">
			  location.replace("/newsite.php'
			  .'")</script>';
		echo 'You are not allowed to submit a new site. You must be a rank 1 member to submit a new site.';
		exit();
	}
   
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
	$errorcode .= (checkName($name))? '0' : '1';
	$errorcode .= (checkUrl($url))? '0' : '1';
	$errorcode .= (checkDescription($description))? '0' : '1';
	$errorcode .= (checkCategory($category))? '0' : '1';
	
	if (!my_strpbrk($errorcode, '1') && strlen($errorcode)==4) {
		$infoverified = 'true';
	}
	echo '-->';

   if ($infoverified=='true') {
	   $reportiplist = 'a:0:{}';
	   
		mysql_query("INSERT INTO `newlinks` (`name`, `url`, `description`, `category`, `screenname`, `date`, `yesiplist`, `noiplist`) VALUES ('$name', '$url', '$description', '$category', '$screenname', now(), 'a:0:{}', 'a:0:{}')") 
					or die(mysql_error());  
	
		print "Your information has been successfully added to the database.";
	   
	   include '/home/goofology/public_html/phpincludes/closedb.php';
   }
   else
   {
		echo '<script language="javascript">
			  location.replace("/newsite.php?'
			  .'name=' . $name
			  .'&url=' . $url
			  .'&description=' . $description
			  .'&category=' . $category
			  .'&errorcode=' . $errorcode
			  .'")</script>';
		echo 'Invalid character in request, please go back and try again.';
	}
?>
</body>
</html>
