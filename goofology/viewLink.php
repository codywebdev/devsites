<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Goofology.com - Outside Link</title>
<?php 
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	require_once('/home/goofology/public_html/phpincludes/config.php');
	require_once('/home/goofology/public_html/phpincludes/opendb.php');
	require_once('/home/goofology/public_html/phpincludes/calcGP.php');
	
	$prev = isset($_GET['prev'])? escapeString($_GET['prev']) : 'http://www.goofology.com';
	$link = isset($_GET['link'])? escapeString($_GET['link']) : NULL;

	$result = mysql_query("SELECT *  FROM `links` WHERE `url` = 
						  CONVERT(_utf8 '$link' USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());;
		if(!($line = mysql_fetch_array($result))) {//if link is not found
			$link = NULL;
		}
	if (!$link) {
		$link = '/linkNotFound.php';
	}
	
	require_once('/home/goofology/public_html/phpincludes/closedb.php');
?>
</head>

<FRAMESET rows="85,100%" cols="*" framespacing="0" frameborder="no" border="0">
      <FRAME src="/phpincludes/votingFrame.php?link=<?php echo urlencode($link); ?>&amp;prev=<?php echo urlencode($prev); ?>" scrolling="no">
      <FRAME src="<?php echo $link; ?>">
  <NOFRAMES>
      <P>Your browser does not support frames.
  </NOFRAMES>
</FRAMESET>
</html>
