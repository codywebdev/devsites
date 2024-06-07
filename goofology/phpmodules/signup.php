<?php
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$username=isset($_GET['username'])? escapeString($_GET['username']) : '';
	$screenname=isset($_GET['screenname'])? escapeString($_GET['screenname']) : '';
	$email=isset($_GET['email'])? escapeString($_GET['email']) : '';
	$firstname=isset($_GET['firstname'])? escapeString($_GET['firstname']) : '';
	$lastname=isset($_GET['lastname'])? escapeString($_GET['lastname']) : '';
	$gender=isset($_GET['gender'])? escapeString($_GET['gender']) : '';
	$bmonth=isset($_GET['bmonth'])? escapeString($_GET['bmonth']) : '';
	$bday=isset($_GET['bday'])? escapeString($_GET['bday']) : '';
	$byear=isset($_GET['byear'])? escapeString($_GET['byear']) : '';
	$location=isset($_GET['location'])? escapeString($_GET['location']) : '';
	$errorcode=isset($_GET['errorcode'])? escapeString($_GET['errorcode']) : '';
	$mId=isset($mId)? $mId : 1;

	$newHtml = '
<div class="contentBorder3">
    <div class="contentBorder2">
      <h1>Sign up</h1>
      <div class="contentBorder">
        <div class="linkLightBgBegin" id="link1">
          <table border="0" cellspacing="0" cellpadding="0" class="linkTableBorder">
            <tr>
              <td valign="middle">';
	require_once('/home/goofology/public_html/phpincludes/jsphp/ajax.php');
	require_once('/home/goofology/public_html/phpincludes/jsphp/signup.php');
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
	$codearray = array('Username','Password','Screen Name','Email','First Name',
					   'Last Name','Gender','Date of Birth','Location');
	
	require_once('/home/goofology/public_html/phpincludes/strpbrk.php');
	
	if (my_strpbrk($errorcode, '1') && strlen($errorcode)==9) //if a '1' is found in the errorcode
	{
		$newHtml .= ''
		.'The following errors occured with your request:<ul>';
	//	.'<li class="errorstyle">' . $errorcode[1] . '</li></ul></td></tr></table>';
		for ($i = 0; $i < 9; $i += 1) {
			if ($i==1 && $errorcode[$i]==0) {
				$newHtml .= '<li class="errorstyle">Re-Type Password</li>';
			}
			else if ($errorcode[$i] == 1) {
				$newHtml .= '<li class="errorstyle">Invalid '
					. $codearray[$i] . '</li>';
			}
		}
		$newHtml .= '</ul>';
	}

	$newHtml .= '
<form id="signup1'.$mId.'" name="signup1'.$mId.'" method="post" action="/processes/processMemberInfo.php">
  <table border="0" cellspacing="0" cellpadding="10">
    <tr>
      <td><label>
        <span class="boldText">Username:</span>
        <br />
        <input name="username" type="text" class="longTextField" id="username'.$mId.'" onblur="checkValue(this.value,\'username\',\'username1'.$mId.'\')" value="'.$username.'" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="username1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label>
        <span class="boldText">Password:</span>
        <br />
        <input name="password" type="password" class="longTextField" id="password'.$mId.'" onblur="checkValue(this.value,\'password\',\'password1'.$mId.'\')" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="password1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><p><span class="boldText">Re-type Password:</span></p>
        <p>
            <input name="confpassword" type="password" class="longTextField" id="confpassword'.$mId.'" onblur="checkValue(this.value+\'*\'+document.getElementById(\'password'.$mId.'\').value,\'confpassword\',\'password2'.$mId.'\')" size="40" maxlength="50" />
          </p></td>
      <td valign="bottom"><span id="password2'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><p class="boldText">Screen name:
      </p>
        <p>  
          <input name="screenname" type="text" class="longTextField" id="screenname'.$mId.'" onblur="checkValue(this.value,\'screenname\',\'screenname1'.$mId.'\')" value="'.$screenname.'" size="40" maxlength="50" />
          </p></td>
      <td valign="bottom"><span id="screenname1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label>
        <span class="boldText">Email:</span><br />
        <input name="email" type="text" class="longTextField" id="email'.$mId.'" onblur="checkValue(this.value,\'email\',\'email1'.$mId.'\')" value="'.$email.'" size="40" maxlength="100" />
      </label></td>
      <td valign="bottom"><span id="email1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="boldText">Confirm Email:</span><br />
        <input name="confemail" type="text" class="longTextField" id="confemail'.$mId.'" onblur="checkValue(this.value+\'*goofvar*\'+document.getElementById(\'email'.$mId.'\').value,\'confemail\',\'email2'.$mId.'\')" value="'.$email.'" size="40" maxlength="100" />
      </label></td>
      <td valign="bottom"><span id="email2'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="boldText">First Name:</span><br />
        <input name="firstname" type="text" class="longTextField" id="firstname'.$mId.'" onblur="checkValue(this.value,\'firstname\',\'firstname1'.$mId.'\')" value="'.$firstname.'" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="firstname1'.$mId.'">&nbsp;</span></td>
    </tr>
    <tr>
      <td><label><span class="boldText">Last Name:</span><br />
        <input name="lastname" type="text" class="longTextField" id="lastname'.$mId.'" onblur="checkValue(this.value,\'lastname\',\'lastname1'.$mId.'\')" value="'.$lastname.'" size="40" maxlength="50" />
      </label></td>
      <td valign="bottom"><span id="lastname1'.$mId.'">&nbsp;</span></td>
    </tr>
    
    <tr>
      <td><label><span class="boldText">Gender:</span><br />
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
      <td><label><span class="boldText">Date of Birth:</span><br />
        <select name="bmonth" id="bmonth'.$mId.'" 
        		onchange="checkValue(this.value+\' \'+
                    	  document.getElementById(\'bday'.$mId.'\').value+\' \'+
                    	  document.getElementById(\'byear'.$mId.'\').value,\'dob\',\'dob1'.$mId.'\')">
       	  <option selected="selected" value="" ';if (!(strcmp("", $bmonth))) {$newHtml .=  "selected=\"selected\"";} $newHtml .= '>Month</option>
       	  <option value="1" ';if (!(strcmp(1, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>January</option>
       	  <option value="2" ';if (!(strcmp(2, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>February</option>
       	  <option value="3" ';if (!(strcmp(3, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>March</option>
       	  <option value="4" ';if (!(strcmp(4, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>April</option>
       	  <option value="5" ';if (!(strcmp(5, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>May</option>
<option value="6" ';if (!(strcmp(6, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>June</option>
       	  <option value="7" ';if (!(strcmp(7, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>July</option>
       	  <option value="8" ';if (!(strcmp(8, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>August</option>
       	  <option value="9" ';if (!(strcmp(9, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>September</option>
       	  <option value="10" ';if (!(strcmp(10, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>October</option>
       	  <option value="11" ';if (!(strcmp(11, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>November</option>
       	  <option value="12" ';if (!(strcmp(12, $bmonth))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>December</option>
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
      <td><label><span class="boldText">Do you live in the US?</span><br />
        <select name="location" id="location'.$mId.'" onchange="checkValue(this.value,\'location\',\'location1'.$mId.'\')">
          <option value="" ';if (!(strcmp("", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>Please Select...</option>
          <option value="usa" ';if (!(strcmp("usa", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>Yes</option>
<option value="other" ';if (!(strcmp("other", $location))) {$newHtml .= "selected=\"selected\"";} $newHtml .= '>No</option>
        </select>
      </label>
 </td>
      <td valign="bottom"><span id="location1'.$mId.'">&nbsp;</span></td>
    </tr>
	<tr>
	<td colspan="2">
<p><br />
  <label>
  <input name="agreed" type="checkbox" id="agreed'.$mId.'" value="agreed" />
  </label><font class="boldText">
I have read and agree to the <a href="/tos.php">Terms of Use</a> and <a href="/privacy.php">Privacy Policy</a></font></p><br />	 	</td>
    <tr>
      <td><label></label>
      <input name="Submit" type="submit" value="Submit" />
      <input type="reset" name="Reset" id="Reset" value="Reset" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
                  </td>
              </tr>
            </table>
          </div>
      </div>
      </div>
      </div>
	  ';
	
	echo $newHtml;
?>