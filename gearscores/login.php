<? 
require_once("/home/gearscores/public_html/includes/functions.php");
require_once ("/home/gearscores/public_html/includes/config.php");
require_once ("/home/gearscores/public_html/includes/opendb.php");


$loginOutput = '';

//check to see if the user is currently logged in
if (isset($_COOKIE['loginA'])) {
	$loginOutput = '<table border="0" width="500" cellspacing="15" cellpadding="0" class="loginPage">
												<tr>
                                                	<td align="center" class="loginTitle">You are already logged in as '.$_COOKIE['loginA'].'.</td>
                                                </tr>
												<tr>
                                                	<td align="center" class="loginTitle"><a href="http://gearscores.com/logout.php">If you would like to log out, then click here.</a></td>
                                                </tr>
                                            </table>';
}

//if user is not logged in, check to see if they submitted login info
else if (isset($_POST['loginE'])) {
	$postE = strtolower($_POST['loginE']);
	$postP = $_POST['loginP'];
	
	$loginErrorOutput = '<form id="loginPage" name="loginPage" method="post" action="http://gearscores.com/login.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="loginPage">
												<tr>
                                                	<td align="center" class="regError">Unable to log you in.  Invalid Email or Password.</td>
                                                </tr>
												<tr>
                                                	<td align="center" class="loginTitle"><br />Login:<br /></td>
                                                </tr>
                                                <tr>
													<td align="left" class="loginEmail">Email:<br /><input name="loginE" type="text" id="loginE" size="15" maxlength="100"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="loginPassword">Password:<br /><input name="loginP" type="password" id="loginP" size="15" maxlength="32"/></td>
                                                </tr>
                                                <tr>
													<td align="center" class="loginSubmit"><br /><input type="submit" name="submit1" id="submit1" value="Submit" /><input type="reset" name="reset1" id="reset1" value="Reset" /></td>
                                                </tr>  
												<tr>
													<td align="left" class="loginLinks"><a href="http://gearscores.com/register.php"><br />New User? - Click here to Register</a><br />
													<a href="http://gearscores.com/forgotPassword.php">Forgot your Password? - Click Here</a></td>
                                                </tr>                                               
                                            </table></form>';
	
	//find the user
	$query = "	SELECT * 
				FROM `users` 
				WHERE `email` LIKE '".mysql_real_escape_string($postE)."'
				LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		//compare the user found to the info submitted
		$userInfo = mysql_fetch_assoc($result);	
		if (md5($postE.'asdf123'.md5($postP)) == $userInfo['password']) {
			//success
					setcookie('loginA',htmlspecialchars($userInfo['alias']),(time()+60*60*24*30*12),'/','.gearscores.com');
					setcookie('loginE',htmlspecialchars($userInfo['email']),(time()+60*60*24*30*12),'/','.gearscores.com');
					setcookie('loginP',md5($postP),(time()+60*60*24*30*12),'/','.gearscores.com');
			$loginOutput = '<table border="0" width="500" cellspacing="15" cellpadding="0" class="loginPage">
														<tr>
															<td align="center" class="loginTitle">You have successfully logged in as '.$userInfo['alias'].'.</td>
														</tr>
														<tr>
															<td align="center" class="loginTitle"><a href="http://gearscores.com/character.php">Click here to return to the Character Search page.</a></td>
														</tr>
													</table>';
		}
		else {
			//failure
			$loginOutput = $loginErrorOutput;
		}
	}
	else $loginOutput = $loginErrorOutput;	
}

//if no login info, then display login form
else {
	$loginOutput = '<form id="loginPage" name="loginPage" method="post" action="http://gearscores.com/login.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="loginPage">
												<tr>
                                                	<td align="center" class="loginTitle">Login:<br /></td>
                                                </tr>
                                                <tr>
													<td align="left" class="loginEmail">Email:<br /><input name="loginE" type="text" id="loginE" size="15" maxlength="100"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="loginPassword">Password:<br /><input name="loginP" type="password" id="loginP" size="15" maxlength="32"/></td>
                                                </tr>
                                                <tr>
													<td align="center" class="loginSubmit"><br /><input type="submit" name="submit1" id="submit1" value="Submit" /><input type="reset" name="reset1" id="reset1" value="Reset" /></td>
												</tr>
												<tr>
													<td align="left" class="loginLinks"><a href="http://gearscores.com/register.php"><br />New User? - Click here to Register</a><br />
													<a href="http://gearscores.com/forgotPassword.php">Forgot your Password? - Click Here</a></td>
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
											<? echo $loginOutput; ?>
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