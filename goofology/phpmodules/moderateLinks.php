<?php
	echo '<p>';
	
	if (!isset($numberOfLinks)) {$numberOfLinks = 10;}
	if (!isset($pageType)) {$pageType = 'reportedLinks';}
	if (!isset($title)) {$title = 'Reported Links';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'moderate';}
	
	require_once('/home/goofology/public_html/phpincludes/printLinkTable.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');
	require_once('/home/goofology/public_html/phpincludes/printLogin.php');
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
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
	else if ($awards[1]!=1) {
		$rank1 = FALSE;
	}
	
	if (!$loggedIn) {
		printLogin();
		return true; //exit();
	}
	if (!$rank1) {
		echo '<div class="contentBorder3">
    <div class="contentBorder2">
      <h1>Moderator\'s Only</h1>
      <div class="contentBorder">
        <div class="linkLightBgBegin" id="link1">
          <p class="normalText">Sorry, but you are not allowed to moderate links. You must receive the &quot;Rank 2&quot; award before you can moderate new site.</p>
          </div>
      </div>
      </div>
      </div>';
	  return true; //exit();
	}
	
	$result = mysql_query("SELECT *  FROM `reportedlinks` ORDER BY `date` ASC 
						   LIMIT 0, $numberOfLinks");
	if(!$line = mysql_fetch_array($result)) {
		printError('Reported Links');
	}
	
	else {
		printModerateLinkTable($line, $result);
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);

	include '/home/goofology/public_html/phpincludes/closedb.php';
	
	echo '</p>
    <p>&nbsp;</p>
    <p>';

	if (!isset($numberOfLinks)) {$numberOfLinks = 10;}
	if (!isset($pageType)) {$pageType = 'newLinks';}
	if (!isset($title)) {$title = 'New Links';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'moderate';}
	
	require_once('/home/goofology/public_html/phpincludes/printLinkTable.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$result = mysql_query("SELECT *  FROM `newlinks` ORDER BY `date` ASC 
						   LIMIT 0, $numberOfLinks");
	if(!$line = mysql_fetch_array($result)) {
		printError('New Links');
	}
	
	else {
		printModerateLinkTable($line, $result);
	}
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType);

	include '/home/goofology/public_html/phpincludes/closedb.php';
	
	echo '</p>';
?>
