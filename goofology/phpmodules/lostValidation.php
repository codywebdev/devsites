<?php

	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Lost Validation Code</h1><div class="contentBorder"><div class="linkLightBgBegin" id="resetPassword1"><p class="normalText">To retrieve your validation code, enter the email address for your Goofology.com account below. Your validation code will be sent to your email address.</p>
<br/><p>';
	
	$errorcode=escapeString($_GET['errorcode']);
	
	if ($errorcode=='1') //if errorcode equals 1
	{
		$newHtml .= '<table width="350" border="0" cellspacing="0" cellpadding="10">'
			.'<tr><td width="350" bgcolor="#CCCCCC" class="errorstyle">'
			.'Email address not found in our database.</td></tr></table>';
	}
	
	$newHtml .= '</p>
<form id="form1" name="form1" method="post" action="/processes/processLostValidation.php">
  <label></label>
  <p>
    <label class="boldText">Email Address:<br/>
    <input type="text" name="email" id="email" class="longEmailField" />
    </label>
  </p><br/>
  <p>
    <label>
    <input type="submit" name="Request Validation" id="Request Validation" value="Request Validation" />
    </label>
  </p>
</form>
<p>&nbsp; </p>
</div></div></div></div>';
	
	echo $newHtml;

?>