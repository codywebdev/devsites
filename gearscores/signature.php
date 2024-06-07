<?php require_once('/home/gearscores/public_html/includes/layout/tbody.php'); ?>
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
										<td><div class="dropshadow">
                                        	<table class="signatureTable">
                                            	<tr>
                                                	<td align="center" colspan="3" class="signatureTitle">Generate Forum Signature<hr />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="center" colspan="3" class="signatureText">
                                                    <? if (!$sigCharNotFound) { echo '<img src="http://gearscores.com/sigs/'.urlencode($char['name']).'/'.urlencode($char['server']).'/'.$sigRegion.'/1/image.jpg" width="450" height="64" />'; } else echo '<img width="450" height="64" />'; ?><br /><span style="font-size:14px;">(This image will automatically update every 24 hours.)</span><br /><br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="center" colspan="3" class="signatureText">
                                                    BBCode (MMO-Champion, etc):<br />
                                                    <form><textarea name="signature1" cols="40" rows="5"><? if (!$sigCharNotFound) { echo '[url=http://gearscores.com/character.php?n='.urlencode($char['name']).'&s='.urlencode($char['server']).'&r='.$sigRegion.'][img]http://gearscores.com/sigs/'.urlencode($char['name']).'/'.urlencode($char['server']).'/'.$sigRegion.'/1/image.jpg[/img][/url]'; } else echo 'Character not found.'; ?></textarea>
                                                    </form><br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="center" colspan="3" class="signatureText">
                                                    Image Link:<br />
                                                    <form><textarea name="signature1" cols="40" rows="5"><? if (!$sigCharNotFound) { echo 'http://gearscores.com/sigs/'.urlencode($char['name']).'/'.urlencode($char['server']).'/'.$sigRegion.'/1/image.jpg'; } else echo 'Character not found.'; ?></textarea>
                                                    </form><br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td align="center" colspan="3" class="signatureText">
                                                    HTML Code:<br />
                                                    <form><textarea name="signature1" cols="40" rows="5"><? if (!$sigCharNotFound) { echo '<img src="http://gearscores.com/sigs/'.urlencode($char['name']).'/'.urlencode($char['server']).'/'.$sigRegion.'/1/image.jpg" width="450" height="64" />'; } else echo 'Character not found.'; ?></textarea>
                                                    </form><br />
                                                    </td>
                                                </tr>
                                            </table>
                                            </div>
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
<?php require_once('/home/gearscores/public_html/includes/layout/bbody.php'); ?>