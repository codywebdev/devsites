<?php require_once('includes/layout/tbody.php'); ?>
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
											<form id="registerPage" name="registerPage" method="post" action="http://gearscores.com/includes/processRegistration.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" width="500" class="registerPage">
												<tr>
                                                	<td align="center" class="registerTitle">Register on GearScores.com<br /><hr /></td>
                                                </tr>
                                                <tr>
													<td align="left" class="registerAlias">Alias (forum name):<br /><input name="regAlias" type="text" id="registerAlias" size="15" maxlength="15"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="registerEmail">Email Address:<br /><input name="regEmail" type="text" id="registerEmail" size="15" maxlength="100"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="registerPassword">Password: (Do not use your Battle.net password.)<br /><input name="regPassword" type="password" id="registerPassword" size="15" maxlength="32"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="registerSecurity">  Security code:<br />
  <img id="captcha" src="http://gearscores.com/includes/captcha/securimage_show.php" alt="CAPTCHA Image" /><br />
  <a href="#" onclick="document.getElementById('captcha').src = 'http://gearscores.com/includes/captcha/securimage_show.php?' + Math.random(); return false" style="color:blue;">Reload Image</a><br />
  Type Security code (picture above):<br />
  <input type="text" name="captcha_code" size="10" maxlength="6" /></td>
                                                </tr>
                                                <tr>
													<td align="left" class="registerSubmit"><input type="submit" name="submit1" id="submit1" value="Submit" /><input type="reset" name="reset1" id="reset1" value="Reset" /><br />*all fields are required</td>
                                                </tr>                                                
                                            </table></form>
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