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
										<td align="center" colspan="3">
                                        <table><tr><td>
                                        <div class="dropshadow">
											<form id="contactUs" name="contactUs" method="post" action="http://gearscores.com/includes/processContactUs.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="contactUs">
                                                <tr>
                                                    <td align="center" class="rowA">Contact Us<hr />
                                                    </td>
                                                </tr>
												<tr>
													<td align="left" class="rowB">
                                                    Name: (optional)<br />
                                                    <input type="text" name="name" id="contactUs_name" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="left" class="rowC">Email: (optional)<br />
                                                    <input name="email" type="text" id="contactUs_email" maxlength="100" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="left" class="rowD">Comment/Bug Report<br />
                                                    <input type="radio" name="type" value="Comment" id="contactUs_type1" checked="checked" /> Comment &nbsp;<input type="radio" name="type" value="Bug_Report" id="contactUs_type2" /> Report a Bug
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="left" class="rowE">Description:<span id="comments1countdown">0</span>/1000 characters used.<br />
                                                    <textarea name="desc" id="contactUs_desc" cols="45" rows="5"  onKeyDown="limitText(this.form.contactUs_desc,'comments1countdown',1000);" 
onKeyUp="limitText(this.form.contactUs_desc,'comments1countdown',1000);"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" colspan="2" class="rowF">
                                                        <input type="submit" name="submit" id="contactUs_submit" value="Send" />
                                                    </td>
                                                </tr>
											</table></form>
                                        </div>
										</td></tr></table>
                                        </td>
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