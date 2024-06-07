<?

require_once("functions.php");
require_once ("config.php");
require_once ("opendb.php");
require_once ('captcha/securimage.php');

$securimage = new Securimage();

if (isset($_POST['regAlias'])) $regAlias = htmlspecialchars($_POST['regAlias']); else $regAlias = '';
if (isset($_POST['regEmail'])) $regEmail = strtolower($_POST['regEmail']); else $regEmail = '';
if (isset($_POST['regPassword'])) $regPassword = $_POST['regPassword']; else $regPassword = '';
if (isset($_POST['captcha_code'])) $captcha_code = $_POST['captcha_code']; else $captcha_code = '';

$isError = false;
$errorCode = '<td align="center" class="regError">There was an error processing your registration...<br /><ul>';


//test Alias
if (preg_match('/[^a-z_\d]/i',stripslashes($regAlias))) {
	$errorCode .= "<li>Alias can only have letters, numbers, or underscores.</li>";
	$isError = true;
}
if (strlen($regAlias) < 2 || strlen($regAlias) > 15) {
	$errorCode .= "<li>Alias must be between 2-15 characters long.</li>";
	$isError = true;
}

//test Email
$newStr = preg_replace('/\//','', $regEmail);
if (preg_match('/[^a-z@!#%`_\/$*?^{}|~.-\d]/i',$newStr)) {
	$errorCode .= "<li>Email address contains irregular characters.</li>";
	$isError = true;
}
if (!isValidEmail($regEmail)) {
	$errorCode .= "<li>Email address is not recognized.</li>";
	$isError = true;
}
if (strlen($regEmail) < 5 || strlen($regEmail) > 100) {
	$errorCode .= "<li>Email must be between 5-100 characters long.</li>";
	$isError = true;
}


//test Password
if (strlen($regPassword) < 1) {
	$errorCode .= "<li>Please type a password.</li>";
	$isError = true;
}
if (strlen($regPassword) > 32) {
	$errorCode .= "<li>Password cannot be longer than 32 characters.</li>";
	$isError = true;
}

//test captcha
if ($securimage->check($_POST['captcha_code']) == false) {
	$errorCode .= "<li>Invalid security answer. (Hint: Reload the Security Image.)</li>";
	$isError = true;
}


if (!$isError) {
	//make sure the address hasn't been used already
	$query = "	SELECT * 
				FROM `users` 
				WHERE `email` LIKE '".$regEmail."'
				LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
			$errorCode .= "<li>Sorry, that email address has already been used.  Did you forget your password?</li>";
			$isError = true;
	}
	else {
			//insert the user into the database
			$query = "INSERT INTO `gearscor_gsdb`.`users` (`id`, `email`, `password`, `alias`, `ipaddress`, `joined`, `lastlogin`, `rank`, `rankexpires`, `banned`) VALUES (NULL, '".mysql_real_escape_string($regEmail)."', '".mysql_real_escape_string(md5($regEmail.'asdf123'.md5($regPassword)))."', '".mysql_real_escape_string($regAlias)."', '".mysql_real_escape_string($_SERVER['REMOTE_ADDR'])."', '".mysql_real_escape_string(time())."', '".mysql_real_escape_string(time())."', '".mysql_real_escape_string(0)."', '".mysql_real_escape_string(0)."', '".mysql_real_escape_string(0)."');";
			$result = mysql_query($query);
			if ($result) {
				//if successful, then send an email to the user
				$to = "$regEmail";
				$subject = "Thank you for registering at GearScores.com!";
				$message = 
"Greetings $regAlias,

Thank you for registering at GearScores.com!

Benefits of becoming a member:

You are now able to post comments on user profiles!  
In order to prevent misuse of commenting, users are limited to posting 1 comment on each character page.  You can always edit or delete your comment if you would like.  You are welcome to comment on as many character pages as you wish.  

Also, keep in mind that comments are monitored by our Admins.  Our Admins have the ability to ban users to abuse comments.  In general the rules of commenting on GearScores.com are similar to the rules of posting on the general World of Warcraft forums.  If it would get you banned on the official WoW forums, then it would probably get you banned here also.

Now that the rules are out of the way, please feel free to browse and use our site to your heart's content.  If you should encounter any problems or would just like to provide feedback, then please leave us a message at http://gearscores.com/contactUs.php 

We are here to serve you!

Best Regards,
The GearScores.com staff";
			
					$from = "no-reply@gearscores.com";
					$headers = "From: GearScores.com <$from>";
					if (!mail($to,$subject,$message,$headers)) {
						//email was unsuccessful
						//what to do about it?
					}
					
					//log the user in, now that they are registered
					setcookie('loginA',htmlspecialchars($regAlias),(time()+60*60*24*30*12),'/','.gearscores.com');
					setcookie('loginE',htmlspecialchars($regEmail),(time()+60*60*24*30*12),'/','.gearscores.com');
					setcookie('loginP',md5($regPassword),(time()+60*60*24*30*12),'/','.gearscores.com');
			}
			else {
				//unable to insert the user into the database
				$errorCode .= "<li>An unknown error has occured.  Please check your information.  If everything looks good then try again later.  If the problem persists, then use the Contact Us link at the bottom of this page to report the error.</li>";
				$isError = true;
			}
	}
}

$errorCode .= '</ul>Please go back and try again.</td>';
?><?php require_once('layout/tbody.php'); ?>
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table class="homeMainTable dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" valign="top">
                      <table border="0" cellspacing="0" cellpadding="0"><tr><td>
                      <div class="dropshadow4">
                          <table border="0" cellspacing="0" cellpadding="0" class="commentsTable">
								                            <tr>
										<td align="center" colspan="3"><table><tr><td>
                                        <div class="dropshadow">
											<table border="0" cellspacing="0" cellpadding="0" width="500" class="registerFinishPage">
												<tr>
                                                	<? 
													if ($isError) {
														echo $errorCode;
													}
													else {
														echo '<td align="center" class="finishTitle">Thank you for registering!
                                                    
                                                    <br /><br />A confirmation email has been sent to '.$regEmail.'. 
                                                    
                                                    <br /><br /><a href="http://gearscores.com/character.php">Click here to return to the Character Search page.</a>
                                                    
                                                    <br /><br /><img src="http://gearscores.com/images/cheer.png" width="250" height="200" /></td>';
													} ?>
                                                </tr>                                               
                                            </table>
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
<?php require_once('layout/bbody.php'); ?>