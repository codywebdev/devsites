<?php
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/linkexpcont.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/report.php');

	$screenname = isset($_GET['screenname'])? escapeString($_GET['screenname']) : NULL;
	
	function printError() {
		$screenname = isset($_GET['screenname'])? escapeString($_GET['screenname']) : NULL;
		echo 'The profile for "'.$screenname.'" was not found.';
		exit();
	}
	
	//find screenname in members database
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` = CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	if(!$line = mysql_fetch_array($result)) {
		printError();
	}
	else {//gather variables to be used in the profile
		$goofpoints = $line['goofpoints'];
		$clicked = $line['clicked'];
		$voted = $line['voted'];
		$contribution = $line['contribution'];
		$moderated = $line['moderated'];
		$favlinks = $line['favlinks'];
		$date = $line['date'];
		$awards = $line['awards'];
		$lastvote = $line['lastvote'];
		$lastclick = $line['lastclick'];
		$about = $line['about'];
		$favorites = unserialize($favlinks);
		$dateSplit = preg_split('/[-\s:]+/', $date);
		$joined = $dateSplit[1].'/'.$dateSplit[2].'/'.$dateSplit[0];
		$lastAction = ($lastclick>$lastvote)? $lastclick : $lastvote;
		$lastOnline = date('m/d/Y',$lastAction);
		
		$result = mysql_query("SELECT *  FROM `links` WHERE `screenname` = CONVERT(_utf8 '$screenname' USING latin1) COLLATE latin1_swedish_ci");
		$sitesSubmitted = mysql_num_rows($result);
	}

	//title heading
	
	$newHtml = '<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" class="profileBorder">
  <tr>
    <td width="25" height="25" background="images/profiletl.png">&nbsp;</td>
    <td background="images/profilet.png">&nbsp;</td>
    <td width="25" height="25" background="images/profiletr.png">&nbsp;</td>
  </tr>
  <tr>
    <td background="images/profilel.png">&nbsp;</td>
    <td align="center" valign="middle"><table align="center" class="profileHeading">
      <tr>
        <td height="65" align="center" valign="middle">';
	
	//title body
	if ($awards[1]==1) { $newHtml .= 'Goofologist '; }
	else if ($awards[0]==1) { $newHtml .= 'Goof '; }
	$newHtml .= $screenname;
	
	//awards heading
	
	$newHtml .= '</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle"></td>
          <td colspan="3" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="middle"><p class="comicText">Awards:</p>
              <div class="contentBorder3">
              <div class="contentBorder2">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="profileAwards">
                  <tr>
                    <td width="20" height="20">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="20" height="20">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="50" align="center" valign="middle">';
	
	//awards body
	if ($awards[0]==1) {
	$newHtml .= '<a href="/awards/rank1.php" target="_blank"><img src="images/rank1.png" alt="Rank 1" width="50" height="50" border="0" longdesc="Rank 1" /></a>';
	}
	if ($awards[1]==1) {
		$newHtml .= '<a href="/awards/rank2.php" target="_blank"><img src="images/rank2.png" alt="Rank 2" width="50" height="50" border="0" longdesc="Rank 2" /></a>';
	}
	if ($awards[2]==1) {
		$newHtml .= '<a href="/awards/eliteModerator.php" target="_blank"><img src="images/eliteModerator.png" alt="Elite Moderator" width="50" height="50" border="0" longdesc="Elite Moderator" /></a>';
	}
	if ($awards[3]==1) {
		$newHtml .= '<a href="/awards/expertGoof.php" target="_blank"><img src="images/expertGoof.png" alt="Expert Goof" width="50" height="50" border="0" longdesc="Expert Goof" /></a>';
	}
	if ($awards[4]==1) {
		$newHtml .= '<a href="/awards/fantasticVoter.php" target="_blank"><img src="images/fantasticVoter.png" alt="Fantastic Voter" width="50" height="50" border="0" longdesc="Fantastic Voter" /></a>';
	}
	if ($awards[5]==1) {
		$newHtml .= '<a href="/awards/supremeGoofologist.php" target="_blank"><img src="images/supremeGoofologist.png" alt="Supreme Goofologist" width="50" height="50" border="0" longdesc="Supreme Goofologist" /></a>';
	}
	if ($awards[6]==1) {
		$newHtml .= '<a href="/awards/rareLinkFinder.php" target="_blank"><img src="images/rareLinkFinder.png" alt="Rare Link Finder" width="50" height="50" border="0" longdesc="Rare Link Finder" /></a>';
	}
	
	//my stats heading
	
	$newHtml .= '</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="20">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td height="20">&nbsp;</td>
                  </tr>
                </table>                </div></div></td>
            </tr>
          </table></td>
          <td align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td width="5%" rowspan="2" align="center" valign="middle">&nbsp;</td>
          <td width="42%" align="center" valign="middle"><p>&nbsp;</p>
            <table width="225" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"><span class="comicText">My Stats: </span>
                    <div class="contentBorder3">
                      <div class="contentBorder2">
                        <div class="profileMystats" id="mystats1">';
	
	//my stats body
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
	
	$rank = $i;
	$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2" align="center" valign="middle"><p class="hugeText">'.$goofpoints.' GP                </p>
                  <p class="comicText">Rank: <span class="comicTextColored">'.$rank.'</span></p></td>
              </tr>
            <tr>
              <td align="center" valign="middle"><span class="comicText">Visits: </span><span class="comicTextColored">'.$clicked.'</span></td>
                  <td align="center" valign="middle"><span class="comicText">Votes: </span><span class="comicTextColored">'.$voted.'</span></td>
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
            <tr>
              <td colspan="2" align="center" valign="middle"><span class="comicText">Joined:</span> <span class="comicTextColored">'.$joined.'</span></td>
              </tr>
            <tr>
              <td colspan="2" align="center" valign="middle"><span class="comicText">Last Online:</span> <span class="comicTextColored">'.$lastOnline.'</span></td>
              </tr>
            </table>';
	
	//favorites heading
	
	$newHtml .= '
                        </div>
                      </div>
                    </div><p>&nbsp;</p></td>
              </tr>
            </table>
            <p>&nbsp;</p></td>
          <td width="5%" align="center" valign="top">&nbsp;</td>
          <td width="42%" rowspan="2" align="center" valign="top"><p>&nbsp;</p><p>&nbsp;</p>';
	
	//favorite links body
	$newHtml .= '<div class="contentBorder3">
                  <div class="contentBorder2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><h1>Favorite Links:</h1></td>
                    </tr>
                </table>
                  <div class="contentBorder">';
			   
	$background = 'linkLightBgBegin';
	$highlight = 'linkHighlightBgBegin';
	$i = 0;
	if ($favlinks=='a:0:{}') {
		$newHtml .= '<div class="linkLightBgBegin">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="comicText">
                        <tr>
                          <td valign="middle">You do not have any favorite links yet.</td>
                          </tr>
                      </table>
                    </div>';
	}
	else {
		do {
			$result = mysql_query("SELECT *  FROM `links` WHERE `id` = $favorites[$i]");
			if (!$line = mysql_fetch_array($result)) {
				do {
					$i++;
					$result = mysql_query("SELECT *  FROM `links` WHERE `id` = $favorites[$i]");
				} while (!($line = mysql_fetch_array($result)) && $i<count($favorites));
			}
			$description = substr($line['description'], 0, (35-strlen($line['name'])));
			if (strlen($description)==(35-strlen($line['name']))) {$description .= '...';}
					   
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font><font class="normalText"> - '.$description.'</font></td><td width="50" align="right" valign="top"><font class="boldText"><a href="javascript:expandLink(\''.$line['id'].'\',\'link'.$mId.$pageType.$line['id'].'\',\''.urlencode($_SERVER["REQUEST_URI"]).'\',35)" class="boldTextSmall">More[+]</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
			$i++;
		} while ($i<count($favorites));
	}
	
	$newHtml .= '</div>
				  </div>
                  </div>';
	
	//about me heading
	
	$newHtml .= '            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"></td>
              </tr>
            </table></td>
          <td width="5%" align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"><p class="comicText">About me:</p>
              <div class="contentBorder3">
              <div class="contentBorder2">';
	
	//about me body
	$newHtml .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="profileAboutme">
                  <tr>
                    <td width="20" height="20" align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                    <td width="20" height="20" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top">'.$about.'</td>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="20" align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top">&nbsp;</td>
                    <td height="20" align="left" valign="top">&nbsp;</td>
                  </tr>
                </table>';
	
	//ending
	
	$newHtml .= '                </div></div></td>
          <td width="5%" align="left" valign="middle">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="middle">&nbsp;</td>
          <td height="20" align="left" valign="middle">&nbsp;</td>
          <td align="left" valign="middle">&nbsp;</td>
          <td align="right" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
    </table>      </td>
    <td background="images/profiler.png">&nbsp;</td>
  </tr>
  <tr>
    <td width="25" height="25" background="images/profilebl.png">&nbsp;</td>
    <td background="images/profileb.png">&nbsp;</td>
    <td width="25" height="25" background="images/profilebr.png">&nbsp;</td>
  </tr>
</table>';
	
	echo $newHtml;
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>