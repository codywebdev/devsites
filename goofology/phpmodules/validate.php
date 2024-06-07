<?php

	require_once('/home/goofology/public_html/phpincludes/escapeString.php');

	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Activate Your Account</h1><div class="contentBorder"><div class="linkLightBgBegin" id="resetPassword1"><p class="normalText">Enter your email address and the validation code you received in the email into the form below to activate your account.</p>
<br/><p>';
	
	$newHtml .= '</p>
<form id="form1" name="form1" method="post" action="/processes/processValidation.php">
  <label></label>
  <p>
    <label class="boldText">Email Address:<br/>
    <input type="text" name="email" id="email" class="longEmailField" />
    </label>
  </p>
  <p>
    <label class="boldText">Validation Code:<br/>
    <input type="text" name="validation" id="validation" class="longEmailField" />
    </label>
  </p><br/>
  <p>
    <label>
    <input type="submit" name="Activate Account" id="Activate Account" value="Activate Account" />
    </label>
  </p>
</form>
<p>&nbsp; </p>
</div></div></div></div>';
	
	echo $newHtml;

?>