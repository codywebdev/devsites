<?php

	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	require_once('/home/goofology/public_html/phpincludes/printLogin.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/addFavorite.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/signup.php');
	
	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : NULL;
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : NULL;
	$gt = isset($_COOKIE['gt'])? escapeString($_COOKIE['gt']) : NULL;
	$mId = isset($mId)? $mId : 1;
	$loggedIn = TRUE;

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
	
	if (!$loggedIn) {
		printLogin();
		return true; //exit();
	}
	
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` = CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	if(!$line = mysql_fetch_array($result)) {
		printLogin();
		return true; //exit();
	}
	else {
		//Get user info from database
		$goofpoints = $line['goofpoints'];
		$clicked = $line['clicked'];
		$voted = $line['voted'];
		$favlinks = $line['favlinks'];
		$firstname = $line['firstname'];
		$lastname = $line['lastname'];
		$location = $line['location'];
		$date = $line['date'];
		$about = $line['about'];
		$email = $line['email'];
		$gender = $line['gender'];
		$dob = $line['dob'];
	}
	
	$month=date('m');
	$day=date('d');
	$year=date('Y');
	$hour=date('G');
	for ($i=0;$i<6;$i++) {
		$cryptTime = sha1(mktime($hour-$i, 0, 0, $month, $day, $year));
		if ($cryptTime==$gt) {break;}
	}
	if ($i > 4) {
		printLogin();
		return true; //exit();
	}
	
	//Make variables to be used in form
	$dobSplit = preg_split('/[-\s:]+/', $dob);
	$bday = $dobSplit[2];
	$bmonth = $dobSplit[1];
	$byear = $dobSplit[0];
	$dateSplit = preg_split('/[-\s:]+/', $date);
	$joinedDay = $dateSplit[2];
	$joinedMonth = $dateSplit[1];
	$joinedYear = $dateSplit[0];
	$favorites = unserialize($favlinks);
	
	//My account heading
	$newHtml = '    <div class="contentBorder3">
    <div class="contentBorder2">
      <h1>My Account</h1>
      <div class="contentBorder">
        <div class="linkLightBgBegin" id="link1">
          <p>&nbsp;</p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder">
            <tr>
              <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
';


	//Summary heading
	$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="25%" class="outlineParagraphHeadSelected"><h4>Summary:</h4></td>
                  <td width="357" class="outlineParagraphHeadUnselected">&nbsp;</td>
                  <td width="3">&nbsp;</td>
                </tr>
                
              </table>';

	//Summary body
	$newHtml .= '<div class="contentBorder3"><div class="contentBorder2">
                <table width="100%" border="0" cellpadding="0" cellspacing="10" class="outlineParagraph">
                  <tr>
                    <td width="3%" height="10"><p class="comicText">Screen Name: '.$screenname.'</p>
                      <p class="comicText">Goofpoints: '.$goofpoints.'</p>
                      <p class="comicText">Visits: '.$clicked.'</p>
                      <p class="comicText">Votes: '.$voted.'</p>
                      <p class="comicText">Joined: '.$joinedMonth.'/'.$joinedDay.'/'.$joinedYear.'</p></td>
                    </tr>
                </table>
              </div></div>
			  <p class="comicText">&nbsp;</p>';
			 
			  
	//Personal Information heading
	$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%" class="outlineParagraphHeadSelected"><h4>Personal Information:</h4></td>
                    <td width="268" class="outlineParagraphHeadUnselected">&nbsp;</td>
                    <td width="3">&nbsp;</td>
                  </tr>
                </table>';
				
	//Personal Information body
	$newHtml .= '<div class="contentBorder3">
                  <div class="contentBorder2">
                    <table width="100%" border="0" cellpadding="0" cellspacing="10" class="outlineParagraph">
                      <tr>
                        <td width="45%" height="10">';
						
						
						
						
						
						
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/signup.php');
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	

	$newHtml .= '
<form id="personalinformation1'.$mId.'" name="personalinformation1'.$mId.'" method="post" action="/processes/updateMemberInfo.php">
  <table border="0" cellspacing="0" cellpadding="10">
    <tr>
      <td><label><span class="comicText">First Name:</span><br />
        <input name="firstname" type="text" class="longTextField" id="firstname'.$mId.'" onblur="checkValue(this.value,\'firstname\',\'firstname1'.$mId.'\')" value="'.$firstname.'" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="firstname1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="comicText">Last Name:</span><br />
        <input name="lastname" type="text" class="longTextField" id="lastname'.$mId.'" onblur="checkValue(this.value,\'lastname\',\'lastname1'.$mId.'\')" value="'.$lastname.'" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="lastname1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label>
        <span class="comicText">Email:</span><br />
        <input name="email" type="text" class="longTextField" id="email'.$mId.'" onblur="checkValue(this.value,\'email\',\'email1'.$mId.'\')" value="'.$email.'" size="40" maxlength="100" />
      </label></td>
      <td valign="bottom"><span id="email1'.$mId.'">&nbsp;</span></td>
    </tr>
    
    <tr>
      <td><label><span class="comicText">Gender:</span><br />
        <select name="gender" id="gender'.$mId.'" onchange="checkValue(this.value,\'gender\',\'gender1'.$mId.'\')">
          <option value="" ';
		  
		  if (!(strcmp("", $gender))) {$newHtml .= "selected=\"selected\"";} 
		  
		  $newHtml .= '>Please Select...</option>
<option value="male" ';

		  if (!(strcmp("male", $gender))) {$newHtml .= "selected=\"selected\"";} 
		  
		  $newHtml .= '>Male</option>
          <option value="female" ';
		  
		  if (!(strcmp("female", $gender))) {$newHtml .= "selected=\"selected\"";} 
		  
		  $newHtml .= '>Female</option>
        </select>
      </label></td>
      <td valign="bottom"><span id="gender1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="comicText">Date of Birth:</span><br />
        <select name="bmonth" id="bmonth'.$mId.'" 
        		onchange="checkValue(this.value+\' \'+
                    	  document.getElementById(\'bday'.$mId.'\').value+\' \'+
                    	  document.getElementById(\'byear'.$mId.'\').value,\'dob\',\'dob1'.$mId.'\')">
       	  <option selected="selected" value="" ';if (!(strcmp("", $bmonth))) {$newHtml .=  "selected=\"selected\"";} $newHtml .= '>Month</option>
       	  <option value="1" ';if (!(strcmp('01', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>January</option>
       	  <option value="2" ';if (!(strcmp('02', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>February</option>
       	  <option value="3" ';if (!(strcmp('03', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>March</option>
       	  <option value="4" ';if (!(strcmp('04', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>April</option>
       	  <option value="5" ';if (!(strcmp('05', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>May</option>
<option value="6" ';if (!(strcmp('06', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>June</option>
       	  <option value="7" ';if (!(strcmp('07', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>July</option>
       	  <option value="8" ';if (!(strcmp('08', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>August</option>
       	  <option value="9" ';if (!(strcmp('09', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>September</option>
       	  <option value="10" ';if (!(strcmp('10', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>October</option>
       	  <option value="11" ';if (!(strcmp('11', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>November</option>
       	  <option value="12" ';if (!(strcmp('12', $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>December</option>
                        </select>
        <select name="bday" id="bday'.$mId.'" 
        		onchange="checkValue(document.getElementById(\'bmonth'.$mId.'\').value+\' \'+
                    	  this.value+\' \'+
                    	  document.getElementById(\'byear'.$mId.'\').value,\'dob\',\'dob1'.$mId.'\')">
          <option selected="selected" value="" ';if (!(strcmp("", $bday))) {$newHtml .=  "selected=\"selected\"";} $newHtml .= '>Day</option>';
		  
		  for ($i=1;$i<32;$i++) {
		  		$newHtml .= '<option value="'.$i.'" ';
				if (!(strcmp($i, $bday))) {$newHtml .= "selected=\"selected\"";}
				$newHtml .= '>'.$i.'</option>
          		';
		  }

		$newHtml .= '
                        </select>
        <select name="byear" id="byear'.$mId.'" 
        		onchange="checkValue(document.getElementById(\'bmonth'.$mId.'\').value+\' \'+
                    	  document.getElementById(\'bday'.$mId.'\').value+\' \'+
                    	  this.value,\'dob\',\'dob1'.$mId.'\')">
          <option selected="selected" value=""  ';if (!(strcmp("", $byear))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>Year</option>';
		  
		  for ($i=2007;$i>1904;$i--) {
		  	$newHtml .= '<option value="'.$i.'" ';
			if (!(strcmp($i, $byear))) {$newHtml .= "selected=\"selected\"";}
			$newHtml .= '>'.$i.'</option>
            ';
		  }
		$newHtml .= '
        </select>
      </label></td>
      <td valign="bottom"><span id="dob1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="comicText">Do you live in the US?</span><br />
        <select name="location" id="location'.$mId.'" onchange="checkValue(this.value,\'location\',\'location1'.$mId.'\')">
          <option value="" ';if (!(strcmp("", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>Please Select...</option>
          <option value="usa" ';if (!(strcmp("usa", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>Yes</option>
<option value="other" ';if (!(strcmp("other", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>No</option>
        </select>
      </label></td>
      <td valign="bottom"><span id="location1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label></label>
      <input name="Submit'.$mId.'" type="submit" value="Submit" />
      <input type="reset" name="Reset'.$mId.'" id="Reset'.$mId.'" value="Reset" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>';
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
	//Personal Information ending
	$newHtml .= '</td>
                        </tr>
                    </table>
                  </div>
                </div>
                <p class="comicText">&nbsp;</p>';
				
	//About me heading
	$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="25%" class="outlineParagraphHeadSelected"><h4>About Me:</h4></td>
                    <td width="357" class="outlineParagraphHeadUnselected">&nbsp;</td>
                    <td width="3">&nbsp;</td>
                  </tr>
                </table>';
	
	//About me body
	$newHtml .= '<div class="contentBorder3">
                  <div class="contentBorder2">
                    <table width="100%" border="0" cellpadding="0" cellspacing="10" class="outlineParagraph">
                      <tr>
                        <td width="3%" height="10">';
						
	$newHtml .= '<form id="form2'.$mId.'" name="form2'.$mId.'" method="post" action="/processes/updateMemberInfo.php">
                          <label>
                            <textarea name="about" cols="70" rows="10" class="normalText" id="about" onkeyup="checkValue(this.value,\'aboutme\',\'aboutme'.$mId.'\')">'.$about.'</textarea>
                            <br />
                            </label>
                          <p class="comicText">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="comicText">
                                  <tr>
                                    <td width="150" align="left" valign="top">
                                      <input name="Submit2'.$mId.'" type="submit" value="Submit" />
                                      <input type="reset" name="Reset2'.$mId.'" id="Reset2'.$mId.'" value="Reset" /></td>
                                    <td align="left" valign="top"><div id="aboutme'.$mId.'"></div></td>
                                  </tr>
                                </table>
                          </p>
                        </form>';
	
	//About me ending
	$newHtml .= '</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <p class="comicText">&nbsp;</p>';
				
	//Favorite Links heading
	$newHtml .= '<div class="contentBorder3">
                  <div class="contentBorder2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><h1>Favorite Links:</h1></td>
                    </tr>
                </table>
                  <div class="contentBorder">';
	
	//Favorite Links body
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
			$line = mysql_fetch_array($result);
			$newHtml .= '<div class="'.$background.'" id="favorites"'.$i.' onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'">
						  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="comicText">
							<tr>
							  <td valign="middle"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></td>
                          <td width="25%" align="left" valign="middle"><span id="favoritelinksdelete'.$i.$mId.'"><a href="javascript:deleteFavorite('.$line['id'].',\'favoritelinksdelete'.$i.$mId.'\')">Delete</a></span></td>
							  </tr>
						  </table>
						</div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
			$i++;
		} while ($i<count($favorites));
	}
	
	//Favorite Links ending
	$newHtml .= '</div>
				  </div>
                  </div>';
	
	//My account ending
	$newHtml .= '</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  </div>';
	
	echo $newHtml;
	
	include '/home/goofology/public_html/phpincludes/closedb.php';	
?>