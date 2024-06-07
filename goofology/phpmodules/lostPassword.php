<?php

	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Reset Password</h1><div class="contentBorder"><div class="linkLightBgBegin" id="resetPassword1"><p class="normalText">To retrieve your password, enter the email address registered to your Goofology.com account below. An email will be sent to you with instructions on how to change your password.</p>
<br/><p>';
	
	$errorcode=escapeString($_GET['errorcode']);
	
	if ($errorcode=='1') //if errorcode equals 1
	{
		$newHtml .= '<table width="350" border="0" cellspacing="0" cellpadding="10">'
			.'<tr><td width="350" bgcolor="#CCCCCC" class="errorstyle">'
			.'Email address not found in our database.</td></tr></table>';
	}
	
	$newHtml .= '</p>
<form id="form1" name="form1" method="post" action="/processes/processLostPassword.php">
  <label></label>
  <p>
    <label class="boldText">Email Address:<br/>
    <input type="text" name="email" id="email" class="longEmailField" />
    </label>
  </p><br/>
  <p>
    <label>
    <input type="submit" name="Request Password" id="Request Password" value="Request Password" />
    </label>
  </p>
</form>
<p>&nbsp; </p>
</div></div></div></div>';
	
	echo $newHtml;

?>