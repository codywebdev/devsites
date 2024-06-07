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
	require_once('/home/goofology/public_html/phpincludes/checkAwards.php');
	require_once('/home/goofology/public_html/phpincludes/goofVars.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/addFavorite.php');
	
	$prev = isset($_GET['prev'])? escapeString($_GET['prev']) : 'http://www.goofology.com';
	$link = isset($_GET['link'])? escapeString($_GET['link']) : NULL;
	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$id = NULL;
	
	$result = mysql_query("SELECT *  FROM `links` WHERE `url` = 
						  CONVERT(_utf8 '$link' USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());;
		if(!($line = mysql_fetch_array($result))) {//if link is not found
			$link = NULL;
		}
		else {
			$id = $line['id'];
			$newClicked = $line['clicked'] + 1;
		}
	if (!$link) {
		$link = '/linkNotFound.php';
	}
	
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
		if(!($line = mysql_fetch_array($result))) {//if screenname is not found
			$screenname = NULL;
		}
		else if ($id) {//else if $id is not null
			// if user has clicked in last 60 seconds
			if ($line['lastclick']+60 >= time()) {
			}
			else {//update time clicked and add 1 to click count for the member
				$timeClicked = time();
				$newClickCount = $line['clicked'] + 1;
				mysql_query("UPDATE `members` SET `lastclick` = '$timeClicked', `clicked` = '$newClickCount' WHERE `screenname` = '$screenname' LIMIT 1") or die(mysql_error());  
				//increase number of clicks for link
				mysql_query("UPDATE `links` SET `clicked` = '$newClicked' WHERE `id` = $id LIMIT 1") or die(mysql_error());
				//recalculate goofpoints
				calcGP($screenname);
				//check for new awards
				checkAwards($screenname,rand(0,$goofRareLinkFinder));
				//increase clicked count for link
				mysql_query("UPDATE `links` SET `clicked` = '$newClicked' WHERE `id` = '$id' LIMIT 1") or die(mysql_error()); 				
			}
		}
?>

<?php require_once('/home/goofology/public_html/jsincludes/searchBody.js'); ?>
<link href="/cssincludes/goof.css" rel="stylesheet" type="text/css" />
<?php require_once('/home/goofology/public_html/phpincludes/jsphp/popupVoting.php');?>
<script src="/jsincludes/vote.js"></script>
<script src="/jsincludes/report.js"></script>
<script language="javascript">
	function removeFrame() {
		var answer = confirm('Do you want to permanently remove frames?');
		if (answer) {
			popupVoting('disable')
			parent.location = "<?php echo $link; ?>"
		}
		else {
			popupVoting('enable')
			parent.location = "<?php echo $link; ?>"
		}
	}
	
	function closeWindow() {
	window.open('','_parent','');
	window.close();
	}
</script>
</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td width="23%" rowspan="2"><a href="http://www.goofology.com"><img src="/images/gooflogo.png" alt="Goofology.com" width="175" height="75" border="0" longdesc="http://www.goofology.com" /></a></td>
    <td width="80" rowspan="2" align="center" valign="middle" class="greenText" id="addFavorite"><a href="javascript:addFavorite(<?php echo $id; ?>,'addFavorite')" style="color:#35AEFF" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#35AEFF'">Add to Favorite Links</a></td>
    <td align="center" valign="bottom" class="greenText">You are now visiting a site outside of Goofology.com</td>
    <td height="30" align="center" valign="bottom" class="greenText"><?php if ($screenname&&$id){echo 'Vote:';} ?></td>
    <td align="center" valign="bottom" class="greenText">&nbsp;</td>
    <td width="100" height="30" align="center" valign="bottom" class="greenText" id="reportBox"><a href="javascript:reportLink(<?php echo $id; ?>,'reportBox')" style="color:#35AEFF" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#35AEFF'"><?php if($id){echo 'Report';} ?></a></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="greenText"><a href="javascript:parent.location='<?php echo $prev; ?>'" style="color:#35AEFF" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#35AEFF'">Return to Goofology.com</a></td>
    <span id="voteBox"><span><td width="110" height="50" align="center" valign="middle" class="greenText" id="voteBox5"><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="55" height="55" align="center" valign="middle"><?php if ($screenname&&$id){echo '<a href="javascript:voteLink(\'yes\',\''.$id.'\',\'voteBox5\')"><img src="/images/yes.png" alt="Yes" width="25" height="25" border="0" longdesc="Vote Yes" onmouseover="this.className=\'expandVoteImage\'" onmouseout="this.className=\'contractVoteImage\'" /></a>';} ?></td>
          <td width="55" height="55" align="center" valign="middle"><?php if ($screenname&&$id){echo '<a href="javascript:voteLink(\'no\',\''.$id.'\',\'voteBox5\')"><img src="/images/no.png" alt="No" width="25" height="25" border="0" longdesc="Vote No" onmouseover="this.className=\'expandVoteImage\'" onmouseout="this.className=\'contractVoteImage\'" /></a>';} ?></td>
        </tr>
      </table></td>
    <td width="50" align="center" valign="middle" class="greenText" id="voteBox5">&nbsp;</td>
    </span></span>
    <td width="100" height="50" align="center" valign="middle" class="greenText"><a href="javascript:parent.location='<?php echo $link; ?>'" style="color:#35AEFF" onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#35AEFF'">Remove Frame</a></td>
  </tr>
</table>
</body>
</html>
<?php 
	unset($prev, $link, $goodLink); 
	require_once('/home/goofology/public_html/phpincludes/closedb.php');
?>
