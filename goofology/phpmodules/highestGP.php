<?php
	if (!isset($numberOfMembers)) {$numberOfMembers = 5;}
	if (!isset($pageType)) {$pageType = 'highestGP';}
	if (!isset($title)) {$title = 'Highest GP';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}
	
	require_once('/home/goofology/public_html/phpincludes/printMemberTable.php'); 
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$result = mysql_query("SELECT *  FROM `members` ORDER BY `goofpoints` DESC 
						   LIMIT 0, $numberOfMembers");
	if(!$line = mysql_fetch_array($result)) {
		printMemberError();
	}
	

	if($colType=='big') {
		printBigMemberTable($line, $result);
	}
	else if($colType=='small') {
		printSmallMemberTable($line, $result);
	}
	else {
		printMemberError();
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>