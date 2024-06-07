<?php
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include '/home/goofology/public_html/phpincludes/goofVars.php';
	include '/home/goofology/public_html/phpincludes/escapeString.php';
	
	function printError() {
		echo 'Report Failed';
		exit();
	}
	
	if(isset($_POST['id'])) {
		$id = escapeString($_POST['id']);
	}
	else {
		printError();
	}
	
	$result = mysql_query("SELECT *  FROM `links` WHERE `id` = $id LIMIT 0, 10");
	if(!$line = mysql_fetch_array($result)) {
		printError();
	}
	
	//retrieve ipaddress list and check to see if ip address has already reported this
	$iparray = array();
	$iparray = unserialize($line['reportiplist']);
	$curIP = $_SERVER['REMOTE_ADDR'];
	//search for a match in the array, if there is no match, then insert new IP address
	if (array_search($curIP, $iparray)===false) {
			array_push($iparray, $curIP);
	}
	
	//if ip list has max number of reports then send link to reportedlinks table
	if (count($iparray) >= $goofMaxReports) {
		//send link to reportedlinks table and delete record
		$name=$line['name'];
		$url=$line['url'];
		$description=addslashes($line['description']);
		$category=$line['category'];
		$username=$line['username'];
		$clicked=$line['clicked'];
		$date=$line['date'];
		$yes=$line['yes'];
		$no=$line['no'];
		mysql_query("INSERT INTO `reportedlinks` (`id`, `name`, `url`, `description`, `category`, `username`, `clicked`, `date`, `yes`, `no`, `yesiplist`, `noiplist`) VALUES ('$id', '$name', '$url', '$description', '$category', '$username', '$clicked', '$date', '$yes', '$no', 'a:0:{}', 'a:0:{}')") or printError();
		
		//delete the old entry from the links table
		mysql_query("DELETE FROM `links` WHERE `id` = '$id' LIMIT 1") or printError();
	}
	else {
		//return the new iparray to the link record in links table
		$ipstring = serialize($iparray);
		mysql_query("UPDATE `links` SET `reportiplist` = '$ipstring' 
	   				WHERE `id` = '$id' LIMIT 1") or printError(); 
	}/**/
	
	echo 'Link Reported';
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>
