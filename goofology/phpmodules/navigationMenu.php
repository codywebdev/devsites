<?php


	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : NULL;
	$isLoggedIn = FALSE;
	$isRank1 = FALSE;
	$isRank2 = FALSE;
	
	//fetch the record containing the users 'screenname'
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci");
	$line = mysql_fetch_array($result);
	$awards = $line['awards'];
	
	//verify login info
	if (!($screenname==$line['screenname'] && $password==$line['password'] && $_SERVER['REMOTE_ADDR']==$line['ipaddress'])) {
		$isLoggedIn = FALSE;
	}
	
	
	//check if member is allowed to moderate
	else if ($awards[1]==1) {
		$isRank2 = TRUE;
		$isRank1 = TRUE;
		$isLoggedIn = TRUE;
	}
	
	//check if member is allowed to submit links
	else if ($awards[0]==1) {
		$isRank1 = TRUE;
		$isLoggedIn = TRUE;
	}	

	require_once('/home/goofology/public_html/phpincludes/jsphp/navigationMenu.php');
	
	echo '<div class="contentBorder3">
                  <div class="contentBorder2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><h1>Navigation Menu</h1></td>
                  </tr>
                </table>
                  <div class="contentBorder">
                    <div class="linkLightBgBegin" id="menutitle1" onmouseover="this.className=\'linkHighlightBgBegin\'" onmouseout="this.className=\'linkLightBgBegin\'">
                      <p class="menuTitle"><a href="http://www.goofology.com">Home </a></p>
                    </div>
                    <div class="linkDarkBg" id="menutitle2" onmouseover="this.className=\'linkHighlightBg\'" onmouseout="this.className=\'linkDarkBg\'">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)">My Account</a></span></td>
                          <td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td>
                        </tr>
                      </table>
                    </div>'
					//insert "Members Only" tab if member is Rank1 or higher
					//or else, don't insert anything here
					.($isRank1?'                    
					<div class="linkLightBg" id="menutitle3" onmouseover="this.className=\'linkHighlightBg\'" onmouseout="this.className=\'linkLightBg\'">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;expand&quot;)">Members Only</a></span></td>
                          <td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td>
                        </tr>
                      </table>
                    </div>':'').'
                    <div class="'.($isRank1?'linkDarkBg':'linkLightBg').'" id="menutitle4" onmouseover="this.className=\'linkHighlightBg\'" onmouseout="this.className=\''.($isRank1?'linkDarkBg':'linkLightBg').'\'">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)">Browse Links</a></span></td>
                          <td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td>
                        </tr>
                      </table>
                    </div>
                    <div class="'.($isRank1?'linkLightBg':'linkDarkBg').'" id="menutitle5" onmouseover="this.className=\'linkHighlightBg\'" onmouseout="this.className=\''.($isRank1?'linkLightBg':'linkDarkBg').'\'">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)">Support</a></span></td>
                          <td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td>
                        </tr>
                      </table>
                    </div>
                  </div>
				  </div>
</div>';

	include '/home/goofology/public_html/phpincludes/closedb.php';

?>