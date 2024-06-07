<?php

	if (!isset($pageType)) {$pageType = 'submitsite';}
	if (!isset($title)) {$title = 'Submit New Site';}
	if (!isset($mId)) {$mId = 1;}
	if (!isset($colType)) {$colType = 'big';}

	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/newLink.php');
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	require_once('/home/goofology/public_html/phpincludes/printLogin.php');

	$newHtml = '    <div class="contentBorder3">
    <div class="contentBorder2">
      <h1>'.$title.'</h1>
      <div class="contentBorder">
        <div class="linkLightBgBegin" id="link1">
          <p class="style2">';
		  

	$errorcode=$_GET['errorcode'];
	$codearray = array('Name','URL','Description','Category');
	
		require_once('/home/goofology/public_html/phpincludes/strpbrk.php');
	
	if (my_strpbrk($errorcode, '1') && strlen($errorcode)==4) //if a '1' is found in the errorcode
	{
		$newHtml .= '<table width="350" border="0" cellspacing="0" cellpadding="10"><tr>'
		.'<td width="350" bgcolor="#CCCCCC"><span class="errorheadstyle">'
		.'The following errors occured with your request:</span><br />';
	//	.'<li class="errorstyle">' . $errorcode[1] . '</li></ul></td></tr></table>';
		for ($i = 0; $i < 4; $i += 1) {
			if ($errorcode[$i] == 1) {
				$newHtml .= '<div class="errorstyle">Invalid '
					. $codearray[$i] . '</div>';
			}
		}
		$newHtml .= '</ul></td></tr></table>';
	}
	
	$newHtml .= '          </p>
          <form id="form1" name="form1" method="post" action="/processes/processNewLink.php">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td width="263"><p class="comicText">Name:
                  </p>
                  <p>
                    <input name="name" type="text" class="loginField" id="name" onblur="checkNewLinkValue(this.value,\'name\',\'name1'.$pageType.$mId.'\')" value="'.escapeString($_GET['name']).'" size="40" maxlength="50" />
                    </p></td>
                <td width="165" align="left" valign="bottom"><span id="name1'.$pageType.$mId.'"></span></td>
              </tr>
              <tr>
                <td><p class="comicText">URL:
                  </p>
                  <p>
                    <input name="url" type="text" class="loginField" id="url" onblur="checkNewLinkValue(this.value,\'url\',\'url1'.$pageType.$mId.'\')" value="'.escapeString($_GET['url']).'" size="40" />
                    </p></td>
                <td align="left" valign="bottom"><span id="url1'.$pageType.$mId.'"></span></td>
              </tr>
              <tr>
                <td><p class="comicText">Description:
                  </p>
                  <p>
                    <textarea name="description" cols="40" rows="5" class="longDescriptionField" id="description" onkeyup="checkNewLinkValue(this.value,\'description\',\'desc1'.$pageType.$mId.'\')">'.escapeString($_GET['description']).'</textarea>
                    </p></td>
                <td align="left" valign="middle"><span id="desc1'.$pageType.$mId.'"></span></td>
              </tr>
              <tr>
                <td><label><span class="comicText">Category:</span><br />
                  <select name="category" id="category" onchange="checkNewLinkValue(this.value,\'category\',\'cat1'.$pageType.$mId.'\')">
                    <option selected="selected" value="" ';
	if (!(strcmp("", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Select...</option>
                    <option value="Fun Stuff" ';
	if (!(strcmp("Fun Stuff", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Fun Stuff</option>
                    <option value="Humor" ';
	if (!(strcmp("Humor", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Humor</option>
                    <option value="Games" ';
	if (!(strcmp("Games", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Games</option>
                    <option value="Quizzes & Trivia" ';
	if (!(strcmp("Quizzes & Trivia", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Quizzes &amp; Trivia</option>
                    <option value="Weird" ';
	if (!(strcmp("Weird", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Weird</option>
                    <option value="Music & Sound" ';
	if (!(strcmp("Music & Sound", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Music &amp; Sound</option>
                    <option value="Love & Romance" ';
	if (!(strcmp("Love & Romance", escapeString($_GET['category'])))) {$newHtml .= "selected=\"selected\"";} 
	$newHtml .= '>Love &amp; Romance</option>
                  </select>
                </label></td>
                <td align="left" valign="bottom"><span id="cat1'.$pageType.$mId.'"></span></td>
              </tr>
            </table>
            <p>&nbsp;</p>
            <p>
                <label>
                <input type="submit" name="Submit" id="Submit" value="Submit" />
                              </label>
                        <label>
                        <input type="reset" name="Reset" id="Reset" value="Reset" />
                    </label>
            </p>
          </form>
          <p>&nbsp;</p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder">
            <tr>
              <td valign="middle">                </td>
              </tr>
            </table>
          </div>
      </div>
      </div>
	  </div>
';
	
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
	else if ($awards[0]!=1) {
		$rank1 = FALSE;
	}
	
	if (!$loggedIn) {
		printLogin();
		exit();
	}
	if (!$rank1) {
		$newHtml = '<div class="contentBorder3">
    <div class="contentBorder2">
      <h1>Goof\'s Only</h1>
      <div class="contentBorder">
        <div class="linkLightBgBegin" id="link1">
          <p class="normalText">Sorry, but you are not allowed to submit new links. You must receive the &quot;Rank 1&quot; award before you can submit a new site.</p>
          </div>
      </div>
      </div>
      </div>';
	}
	
	echo $newHtml;
	unset($pageType, $title, $mId, $colType);
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>