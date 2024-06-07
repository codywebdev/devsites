<?php
	if (!isset($pageType)) {$pageType = 'browseLinks';}
	if (!isset($title)) {$title = 'Browse Links';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}
	
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'name';
	$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
	$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
	$page = isset($_GET['page'])? escapeString($_GET['page']) : 1;
	$browse = isset($_GET['browse'])? escapeString($_GET['browse']) : '';
	($page >10000 || $page < 0)? $page=1: $page=$page;
	($num > 50)? $num=50: $num=$num;
	($num < 0)? $num=10: $num=$num;
	$dir = strtoupper($dir);
	if ($sort==='rating') { $sort='(`yes`*`yes`/`no`)'; $dir .= ', (`yes`+`no`) DESC'; }
	else { $sort='`'.$sort.'`'; }
	$offSet = ($page - 1) * $num;
	$errorPrinted = FALSE;
	
	
	require_once('/home/goofology/public_html/phpincludes/printLinkTable.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');

	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	//validate search string
	if (isset($_REQUEST['s'])) {
        if(get_magic_quotes_gpc()) {
            $search = stripslashes($_REQUEST['s']);
        } else {
            $search = $_REQUEST['s'];
        }
	}
	$search = mysql_real_escape_string($search);
		
	$result = mysql_query("SELECT *, MATCH(name,description,screenname) 
					 	  AGAINST ('$search' IN BOOLEAN MODE) 
						  AS relevance FROM links WHERE MATCH(name,description,screenname) 
						  AGAINST ('$search' IN BOOLEAN MODE) 
						  ORDER BY $sort $dir 
						  LIMIT $offSet, $num");
	$numRows = mysql_num_rows($result);

	if(!$line = mysql_fetch_array($result)) {
		$sort = 'name';
		$dir = 'asc';
		$num = 10;
		$result = mysql_query("SELECT *, MATCH(name,description,screenname) 
					 	  AGAINST ('$search' IN BOOLEAN MODE) 
						  AS relevance FROM links WHERE MATCH(name,description,screenname) 
						  AGAINST ('$search' IN BOOLEAN MODE) 
						  ORDER BY $sort $dir 
						  LIMIT $offSet, $num");
		if(!$line = mysql_fetch_array($result)) {
			printError();
			$errorPrinted = TRUE;
		}
	}
	
	if (!$errorPrinted) {
		printSearchLinkTable($line, $result);
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>