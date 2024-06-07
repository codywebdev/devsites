<? 
require_once("/home/gearscores/public_html/includes/functions.php");
require_once ("/home/gearscores/public_html/includes/config.php");
require_once ("/home/gearscores/public_html/includes/opendb.php");


//check to see if the user has supplied an email address
if (isset($_POST['fpemail'])) {
	$fpemail = $_POST['fpemail'];
	if (!isValidEmail($fpemail)) {
		$fpemail = '';
	}
	$query = "	SELECT * 
				FROM `users` 
				WHERE `email` LIKE '".mysql_real_escape_string($fpemail)."'
				LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$userInfo = mysql_fetch_assoc($result);
				$to = $userInfo['email'];
				$subject = "Forgot Password at GearScores.com!";
				$message = 
"Greetings ".$userInfo['alias'].",

Here is the link to reset your password at GearScores.com:
http://gearscores.com/forgotPassword.php?fpreset=".urlencode(substr($userInfo['password'],3,10).$userInfo['id'])."


This is a one-time use password reset.  It will no longer function once you have reset your password.

Best Regards,
The GearScores.com staff";
			
					$from = "no-reply@gearscores.com";
					$headers = "From: GearScores.com <$from>";
					if (!mail($to,$subject,$message,$headers)) {
						//email was unsuccessful
						//what to do about it?
					}
	}
	$forgotPasswordOutput = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
												<tr>
                                                	<td align="center" class="passResetTitle">Forgot Password<hr /></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText">An email was sent to '.$_POST['fpemail'].' with instructions on how to change your password.  If you do not receive an email within the next few minutes, then try submitting your email address again.<br /><br />
													If you should encounter any problems, then please report them by using the Contact Us link at the bottom of the page.</td>
                                                </tr>
                                            </table></form>';
}

//check to see if the user has supplied a password reset string
else if (isset($_GET['fpreset'])) {
	$fpPasscode = substr($_GET['fpreset'],0,10);
	$fpId = substr($_GET['fpreset'],10);
$forgotPasswordOutput = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
												<tr>
                                                	<td align="center" class="passResetTitle">Forgot Password<hr /></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText">Enter your new password below:</td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText">New Password:<br /><input name="fpnewpass" type="password" id="fpnewpass" size="30" maxlength="100"/></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText"><input name="fpPasscode" type="hidden" id="fpPasscode" value="'.$fpPasscode.'" /><input name="fpId" type="hidden" id="fpId" value="'.$fpId.'" /><input type="submit" name="submit2" id="submit2" value="Submit" /></td>
                                                </tr>
                                            </table></form>';	
}

//check to see if the user has supplied a password to a reset string
else if (isset($_POST['fpnewpass'])) {
	//try to reset password
	$fpNewPass = $_POST['fpnewpass'];
	$fpPasscode = $_POST['fpPasscode'];
	$fpId = $_POST['fpId'];
	
	$forgotPasswordOutputError = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
												<tr>
                                                	<td align="center" class="passResetTitle">Forgot Password<hr /></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="regError">There was an error processing your password reset.  That reset link is no longer valid.</td>
                                                </tr>
                                            </table></form>';
	
	$forgotPasswordOutputError2 = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
												<tr>
                                                	<td align="center" class="passResetTitle">Forgot Password<hr /></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="regError">There was an error processing your password reset.  That password you supplied must be between 1-32 characters.</td>
                                                </tr>
                                            </table></form>';	
												
	
	$query = "	SELECT * 
				FROM `users` 
				WHERE `id` LIKE '".mysql_real_escape_string($fpId)."'
				LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$userInfo = mysql_fetch_assoc($result);
		//verify that passcode is correct
		if ($fpPasscode == substr($userInfo['password'],3,10)) {
			//test Password
			if (strlen($fpNewPass) < 1) {
				$forgotPasswordOutput = $forgotPasswordOutputError2;
			}
			else if (strlen($fpNewPass) > 32) {
				$forgotPasswordOutput = $forgotPasswordOutputError2;
			}
			else {
				//if it's correct then change the password
				$query = "UPDATE `gearscor_gsdb`.`users` SET `password` = '".mysql_real_escape_string(md5($userInfo['email'].'asdf123'.md5($fpNewPass)))."' WHERE `users`.`id` = ".$userInfo['id'].";";
				$result = mysql_query($query);
				if ($result) {
					//success
					$forgotPasswordOutput = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
													<tr>
														<td align="center" class="passResetTitle">Forgot Password<hr /></td>
													</tr>
													<tr>
														<td align="center" class="passResetText">Congratulations! Your password has been successfully changed.</td>
													</tr>
													<tr>
														<td align="center" class="passResetText"><a href="http://gearscores.com/character.php">Click here to return to the Character Search page.</a></td>
													</tr>
												</table></form>';
						setcookie('loginA',htmlspecialchars($userInfo['alias']),(time()+60*60*24*30*12),'/','.gearscores.com');
						setcookie('loginE',htmlspecialchars($userInfo['email']),(time()+60*60*24*30*12),'/','.gearscores.com');
						setcookie('loginP',md5($fpNewPass),(time()+60*60*24*30*12),'/','.gearscores.com');
				}
				else {
					$forgotPasswordOutput = $forgotPasswordOutputError;
				}
			}
		}
		else {
		//else display error message
		$forgotPasswordOutput = $forgotPasswordOutputError;
		}
	}
	else {
		$forgotPasswordOutput = $forgotPasswordOutputError;
	}
		
}

//if neither, then allow the user to submit an email to reset with
else {
$forgotPasswordOutput = '<form id="passResetPage" name="passResetPage" method="post" action="http://gearscores.com/forgotPassword.php" style="display:inline;"><table border="0" width="500" cellspacing="15" cellpadding="0" class="passResetPage">
												<tr>
                                                	<td align="center" class="passResetTitle">Forgot Password<hr /></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText">Enter your email address below and a link to reset your password will be sent to that email address:</td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText">Email:<br /><input name="fpemail" type="text" id="fpemail" size="30" maxlength="100"/></td>
                                                </tr>
												<tr>
                                                	<td align="center" class="passResetText"><input type="submit" name="submit2" id="submit2" value="Submit" /></td>
                                                </tr>
                                            </table></form>';
}

?><?php require_once('includes/layout/tbody.php'); ?>
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table class="homeMainTableSlim dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" valign="top">
                      <table border="0" cellspacing="0" cellpadding="0"><tr><td>
                      <div class="dropshadow4">
                          <table border="0" cellspacing="0" cellpadding="0" class="commentsTable">
								                            <tr>
										<td align="center" colspan="3"><table><tr><td>
                                        <div class="dropshadow">
											<? echo $forgotPasswordOutput; ?>
										</td></tr></table></div></td>
									</tr>
                          </table>
                      </div>
                      </td></tr></table>
                      </td>
                    </tr>
                  </table>
                </div></td>
              </tr>
            </table>
<?php require_once('includes/layout/bbody.php'); ?>