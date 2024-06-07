<?php

	require_once('/home/goofology/public_html/phpincludes/printLogin.php');
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$popupVoting = isset($_COOKIE['popupVoting'])? escapeString($_COOKIE['popupVoting']) : 'enabled';
	$loggedIn = true;
	
	// if cookie not found
	if (!$screenname) {
		$loggedIn = false;
	}
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	// find screenname in database
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` = CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line) {
		//if screenname not found (not logged in)
		$loggedIn = false;
	}
	if ($loggedIn) {
		$result = mysql_query("SELECT *  FROM `links` WHERE `screenname` = CONVERT(_utf8 '$screenname' USING latin1) COLLATE latin1_swedish_ci");
		$sitesSubmitted = mysql_num_rows($result);
	}
	
	$gp = $line['goofpoints'];
	$visits = $line['clicked'];
	$votes = $line['voted'];
	$contribution = $line['contribution'];
	$moderated = $line['moderated'];
	
	if ($loggedIn) {
		$result = mysql_query("SELECT *  FROM `members` ORDER BY `goofpoints` DESC");
		//if query has at least 1 row
		if ($line = mysql_fetch_array($result)) {
			$numRows = mysql_num_rows($result);
			//find row of screenname (ranking)
			for ($i=1;$i<$numRows;$i++) {
				if ($line['screenname']===$screenname) {
					break;
				}
				else {
					$line = mysql_fetch_array($result);
				}
			}
		}
	}
	
	$rank = $i;
	
	$newHtml = '
<div class="contentBorder3">
    <div class="contentBorder2">
	<h1>My Stats - '.$screenname.'</h1>
      <div class="contentBorder">
          <div class="linkLightBgBegin" id="link1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder">
              <tr>
                <td colspan="2" align="center" valign="middle"><p class="hugeText">'.$gp.' GP                </p>
                <p class="comicText">Rank: <span class="comicTextColored">'.$rank.'</span></p></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><span class="comicText">Visits: </span><span class="comicTextColored">'.$visits.'</span></td>
                <td align="center" valign="middle"><span class="comicText">Votes: </span><span class="comicTextColored">'.$votes.'</span></td>
              </tr>
			  <tr>
			  	<td align="center" valign="middle" colspan="2"><span class="comicText">Contribution: </span><span class="comicTextColored">'.$contribution.'</span></td>
			  </tr>
			  <tr>
			  	<td align="center" valign="middle" colspan="2"><span class="comicText">Moderation: </span><span class="comicTextColored">'.$moderated.'</span></td>
			  </tr>
			  <tr>
			  	<td align="center" valign="middle" colspan="2"><span class="comicText">Sites Submitted: </span><span class="comicTextColored">'.$sitesSubmitted.'</span></td>
			  </tr>
            </table>
          </div>
          </div>
		  </div>
</div>';
	
	if ($loggedIn) { echo $newHtml; }
	else { printLogin(); }
	/*
	require_once('/home/goofology/public_html/phpincludes/jsphp/popupVoting.php');
	
	$action = ($popupVoting==='disabled')? 'enable' : 'disable';
	echo '<div id="popupVoting"><font class=\'boldText\' style="text-transform:capitalize">'
		.'<a href="javascript:popupVoting(\''.$action.'\')" onclick="switchPopupVoting(\''.$action.'\')">Popup Vote Frame: '
		.ucfirst($popupVoting).'</a>'
		.'</font></div>';
*/
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>