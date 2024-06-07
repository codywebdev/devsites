<?php
	if (!isset($numberOfLinks)) {$numberOfLinks = 10;}
	if (!isset($pageType)) {$pageType = 'newestLinks';}
	if (!isset($title)) {$title = 'Newest Links';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}
	
	require_once('/home/goofology/public_html/phpincludes/printLinkTable.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$result = mysql_query("SELECT *  FROM `links` ORDER BY `date` DESC 
						   LIMIT 0, $numberOfLinks");
	if(!$line = mysql_fetch_array($result)) {
		printError();
	}
	
	if($colType=='big') {
		printBigLinkTable($line, $result);
	}
	else if($colType=='small') {
		printSmallLinkTable($line, $result);
	}
	else {
		printError();
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);

	include '/home/goofology/public_html/phpincludes/closedb.php';
?>