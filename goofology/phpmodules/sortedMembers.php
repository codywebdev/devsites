<?php
	if (!isset($pageType)) {$pageType = 'highestGP';}
	if (!isset($title)) {$title = 'Highest GP';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}
	
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'screenname';
	$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
	$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
	($num > 50)? $num=50: $num=$num;
	($num < 0)? $num=10: $num=$num;
	$dir = strtoupper($dir);
	$offSet = ($page - 1) * $num;
	
	require_once('/home/goofology/public_html/phpincludes/printMemberTable.php'); 
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$result = mysql_query("SELECT *  FROM `members` ORDER BY `$sort` $dir 
						   LIMIT $offSet, $num");
	if(!$line = mysql_fetch_array($result)) {
		$sort = 'screenname';
		$dir = 'asc';
		$num = 10;
		$result = mysql_query("SELECT *  FROM `members` ORDER BY `$sort` $dir 
							   LIMIT 0, $num");
		if(!$line = mysql_fetch_array($result)) {
			printMemberError();
		}
	}
	

	if($colType=='big') {
		printBigMemberTable($line, $result);
	}
	else if($colType=='small') {
		printSmallMemberTable($line, $result);
	}
	else if($colType=='browse') {
		printBrowseMemberTable($line, $result);
	}
	else {
		printMemberError();
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType, $sort, $dir);
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>