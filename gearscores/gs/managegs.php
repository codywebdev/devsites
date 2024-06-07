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
                                        	<table class="sponsorTable">
                                            	<tr>
                                                	<td align="center" colspan="3" class="sponsorTitle">GearScore Sponsors - Administration<hr />
                                                    </td>
                                                </tr>
                                                <? if ($sponsorAddedSuccess != '') { 
													echo '<tr><td align="center" colspan="3" class="'.$sponsorAddedSuccess.'Table">'.$sponsorN.' - '.$sponsorS.' ('.strtoupper($sponsorR).') ';
													if ($sponsorAddedSuccess == 'success') echo 'successfully added.';
													else echo 'not found. <br /><br /><div align="left" style="text-align:left">-check the spelling of the character<br />-check the server and region<br />-character might not be in the database yet*<br /> *(search for the character, then try again)</div>';
													echo '</td></tr><tr><td>&nbsp;</td></tr>'; 
												  } 
												?>
                                                <tr>
                                                	<td align="center" colspan="3" class="sponsorText">
                                                    <table style="border:none;"><tr><td>
                                                    
                                                   <div class="dropshadow">
                                                    
                                                        <form id="addGearscoreSponsor" name="addGearscoreSponsor" method="post" action="http://gearscores.com/gs/managegs.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="mainpageSearch">
                                                            <tr>
                                                                <td align="center" class="rowD" colspan="2">Add a GearScore Sponsor</td></tr><tr>
                                                                <td align="left" class="rowA" colspan="2">
                                                                
                                                                Name: <input type="text" name="sponsorN" id="name3" /> <select onchange="javascript:insertChar('name3',this.options[this.selectedIndex].value);this.selectedIndex=0;"><option SELECTED="true" /><option>ß</option><option>à</option><option>á</option><option>â</option><option>ã</option><option>ä</option><option>å</option><option>æ</option><option>ç</option><option>è</option><option>é</option><option>ê</option><option>ë</option><option>ì</option><option>í</option><option>î</option><option>ï</option><option>ð</option><option>ñ</option><option>ò</option><option>ó</option><option>ô</option><option>õ</option><option>ö</option><option>ø</option><option>ù</option><option>ú</option><option>û</option><option>ü</option><option>ý</option><option>ÿ</option></select>
                                                                </td></tr>
                                                                    <tr>
                                                                    <td align="left" class="rowB region3">Region: <select name="sponsorR" id="region3" onchange="updateRealmList(3,'sponsorS');" class="region3">
                                                                      <? echo selectServer('<option value="us">US</option>
                                                                              <option value="eu">EU</option>', strtoupper($region)); ?>
                                                                    </select></td><td align="left" class="rowB server3">Realm: 
                                                                    <div id="divServer3" style="display:inline;"><select name="sponsorS" id="server3" class="server3">
                                                                      <? echo selectServer(file_get_contents("http://gearscores.com/includes/".$region."realms.php"), $server); ?>
                                                                    </select></div></td></tr><td align="center" colspan="2" class="rowC">
                                                                    <input type="hidden" name="sponsorAction" value="add" />
                                                                    <input type="submit" name="submit" id="submit" value="Add" />
                                                               
                                                                    </td>
                                                               </tr>
            
                                                            </table></form></div>
                                                 	</td></tr></table>
                                                    </td>
                                                </tr>
												<? if ($sponsorRemovedSuccess != '') { 
													echo '<tr><td align="center" colspan="3" class="'.$sponsorRemovedSuccess.'Table">'.$sponsorN.' - '.$sponsorS.' ('.strtoupper($sponsorR).') ';
													if ($sponsorRemovedSuccess == 'success') echo 'successfully removed.';
													else echo 'not found. <br /><br /><div align="left" style="text-align:left">-contact the webmaster if you believe there has been an error.</div>';
													echo '</td></tr><tr><td>&nbsp;</td></tr>'; 
												  } 
												?>
                                                <tr>
                                                	<td align="center" colspan="3" class="sponsorText">
                                                    <table style="border:none;"><tr><td>
                                                    
                                                   <div class="dropshadow">
                                                    <form id="removeGearscoreSponsor" name="removeGearscoreSponsor" method="post" action="http://gearscores.com/gs/managegs.php" style="display:inline;">
                                                    <table border="0" cellspacing="0" cellpadding="0" class="mainpageSearch">
                                                            <tr>
                                                                <td align="center" class="rowD">Remove a GearScore Sponsor</td>
                                                            </tr>
                                                            <tr>
                                                            <td align="center" class="rowB" style="text-align:center;">
                                                    
                                                    
                                                    <? 
													if (sizeof($removeSponsorList) < 1) {
														echo 'No GearScore Sponsors Found.';
													}
													else {
														echo '<select name="sponsorRemove" id="sponsorRemove">';
														$sizeofRemoveSponsorList = sizeof($removeSponsorList);
														for ($i=0;$i<$sizeofRemoveSponsorList;$i++) {
															echo '<option value="'.$removeSponsorList[$i]['name'].'|'.str_replace('\'','\\\'',$removeSponsorList[$i]['server']).'|'.$removeSponsorList[$i]['region'].'">'.$removeSponsorList[$i]['name'].' - '.$removeSponsorList[$i]['server'].' ('.strtoupper($removeSponsorList[$i]['region']).')'.'</option>';
														}
														echo '</select>
															  </td>
														</tr>
														<tr>
															<td align="center" class="rowC">
															<input type="hidden" name="sponsorAction" value="remove" />
															<input type="submit" name="submit" id="submit" value="Remove" />';
													}
													?>
                                                    
                                                    </td>
                                                               </tr>
            
                                                            </table></form>
                                                    </div>
                                                 	</td></tr></table>
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