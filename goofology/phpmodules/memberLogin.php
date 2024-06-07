<?php

	if (!isset($mId)) {$mId = 1;}

$newHtml = '
<div class="contentBorder3">
      <div class="contentBorder2">
        <h1>Log in</h1>
        <div class="contentBorder">
          <div class="boldText">
            <form id="login'.$mId.'" name="login'.$mId.'" method="post" action="/phpincludes/processLogIn.php">
            <div class="linkLightBgBegin" id="loginFields1">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder">
              <tr>
                <td><p>';
require_once('/home/goofology/public_html/phpincludes/escapeString.php');

$errorcode=$_GET['liec'];
$codearray = array('Username','Password','Character in Login Information');

require_once('/home/goofology/public_html/phpincludes/strpbrk.php');

if (my_strpbrk($errorcode, '1') && strlen($errorcode)==3) //if a '1' is found in the errorcode
{
	$newHtml .='<ul>';
	for ($i = 0; $i < 3; $i += 1) {
		if ($errorcode[$i] == 1) {
			$newHtml .= '<li class="errorstyle">Invalid '
				. $codearray[$i] . '</li>';
		}
	}
	$newHtml .= '</ul>';
}

$newHtml .= 'Username:</p>
                  <p>
                    <input name="username" type="text" id="username'.$mId.'" class="loginField" />
                  </p>
                  <p>Password:</p>
                  <p>
                    <input name="password" type="password" id="password'.$mId.'" class="loginField" />
                  </p>
                  <p>
                    <label>Remember me</label>
                    :
  <input type="checkbox" name="remember'.$mId.'" id="remember'.$mId.'" />
                  </p>
                  <p>
                    <input type="submit" name="Login'.$mId.'" id="Login'.$mId.'" value="Login" />
                    <input type="reset" name="Reset'.$mId.'" id="Reset'.$mId.'" value="Reset" />
                  </p></td>
              </tr>
            </table>
            </div>
            </form></div>
        </div>
      </div>
    </div>';
	echo $newHtml;
	
	unset($numberOfLinks, $pageType, $title, $mId, $colType, $sort, $dir);
?>