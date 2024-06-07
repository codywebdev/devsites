<?php
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL ;
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : NULL ;
	$action = isset($_POST['action'])? escapeString($_POST['action']) : NULL ;
	$id = isset($_POST['id'])? escapeString($_POST['id']) : NULL ;
	
	//fetch the record containing the users 'screenname'
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['screenname']) {
		//if screenname not found (not logged in)
		echo 'Please login.';
		return false;
	}
	
	//verify login info
	if (!($screenname==$line['screenname'] && $password==$line['password'] && $_SERVER['REMOTE_ADDR']==$line['ipaddress'])) {
		echo 'Please login.';
		return false;
	}
    
	//get array from database
	$array = unserialize($line['favlinks']);
	
	//add a link to array
	if ($action=='add') {
		if (array_search($id, $array)===false) {
			array_push($array, $id);
		}
	}
	//delete a link from array
	else if ($action=='delete') {
		if (array_search($id, $array)!==false) {
			$key = array_search($id, $array);
			unset($array[$key]);
		}
	}
	
	//make sure all the id's are valid (not deleted from the database)
	$arraysize = count($array);
	for ($i=0; $i < $arraysize; $i++)
	{
		$result = mysql_query("SELECT * FROM `links` WHERE `id` = '$array[$i]'");
		if (!$line = mysql_fetch_array($result)) { //if not in links database
			$result = mysql_query("SELECT * FROM `reportedlinks` WHERE `id` = '$array[$i]'");
			if (!$line = mysql_fetch_array($result)) { //if not in reportedlinks database
				unset($array[$i]);
			}
		}
	}

	
	//generate a new array from old with sequential index
	$newArray=array();
	foreach($array as $a) {
		array_push($newArray, $a);
	}
	
	//turn array into a string
	$string = serialize($newArray);
	
	//upload serialized array to the database
	   mysql_query("UPDATE `members` SET `favlinks` = '$string' 
	   				WHERE `screenname` = '$screenname' LIMIT 1") or die(mysql_error()); 
					
	if ($action=='add') {
		echo 'Link added.';
	}
	else if ($action=='delete') {
		echo 'Link deleted.';
	}
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
	return true;
?>
