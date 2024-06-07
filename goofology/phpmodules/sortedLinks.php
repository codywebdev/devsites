<?php
	if (!isset($pageType)) {$pageType = 'browseLinks';}
	if (!isset($title)) {$title = 'Browse Links';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}
	
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'name';
	$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
	$num = isset($_GET['num'])? escapeString($_GET['num']) : 20;
	$page = isset($_GET['page'])? escapeString($_GET['page']) : 1;
	$browse = isset($_GET['browse'])? escapeString($_GET['browse']) : '';
	($page >10000 || $page < 0)? $page=1: $page=$page;
	($num > 50)? $num=50: $num=$num;
	($num < 0)? $num=10: $num=$num;
	$dir = strtoupper($dir);
	if ($sort==='rating') { $sort='(`yes`*`yes`/`no`)'; $dir .= ', (`yes`+`no`) DESC'; }
	else { $sort='`'.$sort.'`'; }
	$offSet = ($page - 1) * $num;
	
	
	require_once('/home/goofology/public_html/phpincludes/printLinkTable.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');

	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$result = mysql_query("SELECT *  FROM `links` WHERE `category` 
						  LIKE CONVERT(_utf8 '%$browse%' USING latin1) 
						  COLLATE latin1_swedish_ci ORDER BY $sort $dir 
						  LIMIT $offSet, $num");
	if(!$line = mysql_fetch_array($result)) {
		$sort = 'name';
		$dir = 'asc';
		$num = 10;
		$result = mysql_query("SELECT *  FROM `links` ORDER BY `$sort` $dir 
							   LIMIT 0, $num");
		if(!$line = mysql_fetch_array($result)) {
			printError();
		}
	}
	
	if($colType=='big') {
		printBigLinkTable($line, $result);
	}
	else if($colType=='small') {
		printSmallLinkTable($line, $result);
	}
	else if($colType=='browse') {
		printBrowseLinkTable($line, $result);
	}
	else {
		printError();
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>