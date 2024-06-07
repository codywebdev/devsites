<?php
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include "/home/goofology/public_html/phpincludes/memberCheck.php";
	include "/home/goofology/public_html/phpincludes/escapeString.php";
   
	$screenname=isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$password=isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : NULL;
	$email=isset($_POST['email'])? escapeString($_POST['email']) : NULL;
	$firstname=isset($_POST['firstname'])? escapeString($_POST['firstname']) : NULL;
	$lastname=isset($_POST['lastname'])? escapeString($_POST['lastname']) : NULL;
	$gender=isset($_POST['gender'])? escapeString($_POST['gender']) : NULL;
	$bmonth=isset($_POST['bmonth'])? escapeString($_POST['bmonth']) : NULL;
	$bday=isset($_POST['bday'])? escapeString($_POST['bday']) : NULL;
	$byear=isset($_POST['byear'])? escapeString($_POST['byear']) : NULL;
	$location=isset($_POST['location'])? escapeString($_POST['location']) : NULL;
	$about=isset($_POST['about'])? escapeString($_POST['about']) : NULL;
	$ipaddress=$_SERVER['REMOTE_ADDR'];
	$dob= $bmonth.' '.$bday.' '.$byear;
	$newdob= $byear.'-'.$bmonth.'-'.$bday;
	
	function printError() {
		echo '<HTML><HEAD>'
			.'<META HTTP-EQUIV="refresh" CONTENT="5;URL=http://www.goofology.com/myAccount.php">'
			.'</HEAD><BODY>There was an error with your request. Redirecting to <a href="'
			.'http://www.goofology.com/myAccount.php">'
			.'http://www.goofology.com/myAccount.php</a>.</BODY></HTML>';
		exit();
	}
	
	//verify user is logged in and within the last 3 hours
	$result = mysql_query("SELECT *  FROM `members` WHERE `screenname` = CONVERT(_utf8 '$screenname' USING latin1) COLLATE latin1_swedish_ci");
	//verify username, password, and ipaddress
	if ((!$line = mysql_fetch_array($result)) || $password != $line['password'] || $ipaddress != $line['ipaddress']) {
		printError();
	}
	
	$month=date('m');
	$day=date('d');
	$year=date('Y');
	$hour=date('G');
	for ($i=0;$i<6;$i++) {
		$cryptTime = sha1(mktime($hour-$i, 0, 0, $month, $day, $year));
		if ($cryptTime==$gt) {break;}
	}
	if ($i > 4) {
		printError();
	}
   
	if ($firstname && $lastname && $email && $gender && $bmonth && $bday && $byear && $location) {
		//verify information is valid
		echo '<!--';
		if(!( checkName($firstname)&&checkName($lastname)&&checkEmail($email)&&checkDOB($dob)&&checkLocation($location) )) {
			echo '-->';
			printError();
		}
		echo '-->';
		//update information in users profile
		$id = $line['id'];
		mysql_query("UPDATE `members` SET `firstname` = '$firstname', `lastname` = '$lastname', `location` = '$location', `email` = '$email', `dob` = '$newdob', `gender` = '$gender' WHERE `id` = $id LIMIT 1") or die(mysql_error());
		echo '<HTML><HEAD>'
			.'<META HTTP-EQUIV="refresh" CONTENT="5;URL=http://www.goofology.com/myAccount.php">'
			.'</HEAD><BODY>Your profile has been successfully updated. Redirecting to <a href="'
			.'http://www.goofology.com/myAccount.php">'
			.'http://www.goofology.com/myAccount.php</a>.</BODY></HTML>';
	}
	
	else if ($about) {
		//verify information is valid
		echo '<!--';
		if (!(checkAboutme($about))) {
			echo '-->';
			printError();
		}
		echo '-->';
		//update information in users profile
		$id = $line['id'];
		mysql_query("UPDATE `members` SET `about` = '$about' WHERE `id` = $id LIMIT 1");
		echo '<HTML><HEAD>'
			.'<META HTTP-EQUIV="refresh" CONTENT="5;URL=http://www.goofology.com/myAccount.php">'
			.'</HEAD><BODY>Your profile has been successfully updated. Redirecting to <a href="'
			.'http://www.goofology.com/myAccount.php">'
			.'http://www.goofology.com/myAccount.php</a>.</BODY></HTML>';
	}
	
	else {
		printError();
	}
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>