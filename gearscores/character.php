<?php require_once('includes/layout/tbody.php'); ?>
<?php if ($emptyCharSearch || $charNotFoundError) { require_once('index.php'); require_once('includes/layout/bbody.php'); exit(); } ?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_includes'] = ($mtime-$totalPageLoadTime['start']); ?>

            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table width="600" class="mainTable dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="70" rowspan="2" align="center" valign="bottom" style="padding-bottom:6px;"><table>
                        <tr>
                          <td><div class="dropshadow3">
                            <table width="70" border="0" align="center" cellpadding="0" cellspacing="0" class="leftGearTable">
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[0]) == "no item") echo printEmptySlot(0); else echo printItem($Items[0]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[1]) == "no item") echo printEmptySlot(1); else echo printItem($Items[1]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[2]) == "no item") echo printEmptySlot(2); else echo printItem($Items[2]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[14]) == "no item") echo printEmptySlot(14); else echo printItem($Items[14]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[4]) == "no item") echo printEmptySlot(4); else echo printItem($Items[4]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[3]) == "no item") echo printEmptySlot(3); else echo printItem($Items[3]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[18]) == "no item") echo printEmptySlot(18); else echo printItem($Items[18]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[8]) == "no item") echo printEmptySlot(8); else echo printItem($Items[8]); ?></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                      <td align="center" valign="top"><table>
                        <tr>
                          <td><div class="dropshadow4">
                            <table width="410" border="0" cellspacing="0" cellpadding="0" class="charInfo">
                              <tr>
                                <td align="right" valign="top"><table width="400" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="2" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><span class="charInfoPrefix"><? echo $Character["prefix"]; ?></span>
                                          <div class="charInfoName" style="color:<? echo getCharClassColor($character,true); ?>;"><a href="<? echo $armoryLink; ?><? echo 'character/'.rawurlencode($Character["realm"]).'/'.rawurlencode($Character["name"]).'/advanced'; ?>"><? echo $Character["name"]; ?></a></div>
                                          <span class="charInfoSuffix"><? echo ltrim($Character["suffix"],' ,'); ?></span></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><? if (strlen($Character["guildname"]) > 0) echo '<a href="'.$armoryLink.'guild/'.$Character["realm"].'/'.rawurlencode($Character["guildname"]).'/">'; ?>
                                          <span class="charInfoGuild">
                                            <? if (strlen($Character["guildname"]) > 0) echo '&lt;' . $Character["guildname"] . '&gt;'; ?>
                                            </span>
                                          <? if (strlen($Character["guildname"]) > 0) echo '</a>'; ?>
                                          &nbsp;</td>
                                      </tr><? if ($sponsorRank == '1') { echo '
                                      <tr><td colspan="3" align="center" valign="top"><span class="charInfoSponsor"><a href="http://gearscores.com/sponsor.php" onmouseover="$WowheadPower.showTooltip(event, \'Sponsorship comes with any donation of $5 or more to the author of GearScore\')" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();"><img src="images/officialSponsor.png" width="280" height="25" border="0" /></a></span></td></tr>'; } ?>
                                      <tr>
                                        <td width="75" align="right" valign="middle"><img src="<?php echo printRaceIcon($Character); ?>" height="64" width="64" /></td>
                                        <td align="center" valign="middle"><span class="charInfoLevel"><? echo $Character["level"]; ?></span> <span class="charInfoRace"><? echo $Character["race"]; ?></span> <span class="charInfoClass" style="color:<? echo getCharClassColor($character,true); ?>;"><? echo $Character["class"]; ?></span><br />
                                          <span class="charInfoRealmText">Realm: </span><span class="charInfoRealm"><? echo $Character["realm"]; ?></span><br />
                                          <span class="charInfoBGText">Battlegroup: </span><span class="charInfoBG"><? echo $Character["battlegroup"]; ?></span></td>
                                        <td width="70" align="left" valign="middle"><img src="<?php echo printClassIcon($Character); ?>" height="64" width="64" /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><table>
                                          <tr>
                                            <td><div class="dropshadow5">
                                              <table border="0" cellspacing="0" cellpadding="0" class="dropshadow5table gsColorTable">
                                                <tr>
                                                  <td class="rowA" align="center" valign="middle">GearScore</td>
                                                </tr>
                                                <tr>
                                                  <td class="rowB" valign="middle" align="center" style="<? echo getGSColorStyle($curCharGS); ?>"><? echo $curCharGS; ?></td>
                                                </tr>
                                                <? if ($newHighestGS > $curCharGS) echo '                                              <tr>
                                                <td class="rowD" valign="middle" align="center">Highest: <a href="javascript:postToURL(\'http://gearscores.com/character.php\', {\'n\':\''.$Character["name"].'\',\'s\':\''.addslashes($Character["realm"]).'\',\'r\':\''.$region.'\',\'cm\':\'gs\'});"><span style="'.getGSColorStyle($newHighestGS,14,0).'">'.$newHighestGS.'</span></a></td>
                                              </tr>
'; ?>
                                                <tr>
                                                  <td class="rowC" valign="middle" align="center">Avg ilvl: <? echo getAvgItemLevel($Items); ?></td>
                                                </tr>
                                              </table>
                                            </div></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="top"><table><tr><td><a href="<? echo 'http://'; if ($region == 'eu') echo 'eu'; else echo 'www'; echo '.wowarmory.com/character-model-embed.xml?r='.urlencode($Character['realm']).'&cn='.urlencode($Character['name']).'&rhtml=true'; ?>" target="_blank"><img src="http://gearscores.com/images/view3d.png" class="view3dButton" /></a><? /*if ($_SERVER['REMOTE_ADDR'] == '74.197.117.176')*/ echo '&nbsp;&nbsp;&nbsp;<a href="http://gearscores.com/signature.php?n='.urlencode($Character['name']).'&s='.urlencode($Character['realm']).'&r='.$region.'"><img src="http://gearscores.com/images/genSig.png" class="view3dButton" width="139" height="39" /></a>'; ?></td></tr></table>
                                        </td>
                                    </tr>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="center" valign="top"><? echo getTalents($character,$armoryLink); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="50%" align="center" valign="top"><table>
                                      <tr>
                                        <td><div class="dropshadow5"><? echo getHealthManaBars($Bars); ?></div></td>
                                      </tr>
                                    </table></td>
                                    <td width="50%" align="center" valign="top"><table>
                                      <tr>
                                        <td><div class="dropshadow5"><? echo getProfessions($Professions); ?></div></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                      <td width="70" rowspan="2" align="center" valign="bottom" style="padding-bottom:6px;"><table>
                        <tr>
                          <td><div class="dropshadow3">
                            <table width="70" border="0" cellpadding="0" cellspacing="0" class="rightGearTable">
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[9]) == "no item") echo printEmptySlot(9); else echo printItem($Items[9]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[5]) == "no item") echo printEmptySlot(5); else echo printItem($Items[5]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[6]) == "no item") echo printEmptySlot(6); else echo printItem($Items[6]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[7]) == "no item") echo printEmptySlot(7); else echo printItem($Items[7]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[10]) == "no item") echo printEmptySlot(10); else echo printItem($Items[10]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[11]) == "no item") echo printEmptySlot(11); else echo printItem($Items[11]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[12]) == "no item") echo printEmptySlot(12); else echo printItem($Items[12]); ?></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><? if (printItem($Items[13]) == "no item") echo printEmptySlot(13); else echo printItem($Items[13]); ?></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="middle"><table>
                            <tr>
                              <td><div class="dropshadow3">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bottomGearTable">
                                  <tr>
                                    <td width="100" height="70" align="center" valign="middle"><? if (printItem($Items[15]) == "no item") echo printEmptySlot(15); else echo printItem($Items[15]); ?></td>
                                    <td width="100" height="70" align="center" valign="middle"><? if (printItem($Items[16]) == "no item") echo printEmptySlot(16); else echo printItem($Items[16]); ?></td>
                                    <td width="100" height="70" align="center" valign="middle"><? if (printItem($Items[17]) == "no item") echo printEmptySlot(17); else echo printItem($Items[17]); ?></td>
                                  </tr>
                                </table>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="charInfo">
                              <tr>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="statsTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Stats</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Strength:</td>
                                          <td width="50" align="right" valign="middle"><? echo $Stats["strength"]["effective"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Agility:</td>
                                          <td align="right" valign="middle"><? echo $Stats["agility"]["effective"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Stamina:</td>
                                          <td align="right" valign="middle"><? echo $Stats["stamina"]["effective"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Intellect:</td>
                                          <td align="right" valign="middle"><? echo $Stats["intellect"]["effective"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Spirit:</td>
                                          <td align="right" valign="middle"><? echo $Stats["spirit"]["effective"]; ?></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table>
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><div class="dropshadow">
                                        <table width="150" border="0" cellpadding="0" cellspacing="0" class="defenseTable">
                                          <tr class="rowA">
                                            <td colspan="2" align="center" valign="middle">Defense</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td width="100" align="left" valign="middle">Armor:</td>
                                            <td width="50" align="right" valign="middle"><? echo $Stats["armor"]["effective"]; ?></td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Dodge:</td>
                                            <td align="right" valign="middle"><? echo $Defenses["dodge"]["percent"]; ?>%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Parry:</td>
                                            <td align="right" valign="middle"><? echo $Defenses["parry"]["percent"]; ?>%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Block:</td>
                                            <td align="right" valign="middle"><? echo $Defenses["block"]["percent"]; ?>%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Resilience:</td>
                                            <td align="right" valign="middle"><? echo number_format($Defenses["resilience"]["value"]); ?></td>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                  </table></td>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="spellTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Spell</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Bonus Dmg:</td>
                                          <td width="50" align="right" valign="middle"><? echo $Spell["bonusdamage"]["holy"]["value"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Bonus Heal:</td>
                                          <td align="right" valign="middle"><? echo $Spell["bonushealing"]["value"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Hit:</td>
                                          <td align="right" valign="middle"><? echo $Spell["hitrating"]["increasedhitpercent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Crit:</td>
                                          <td align="right" valign="middle"><? echo $Spell["critchance"]["holy"]["percent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Haste:</td>
                                          <td align="right" valign="middle"><? echo $Spell["hasterating"]["hastepercent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Spell Pen:</td>
                                          <td align="right" valign="middle"><? echo $Spell["penetration"]["value"]; ?></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table></td>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="meleeTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Melee</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Atk Power:</td>
                                          <td width="50" align="right" valign="middle"><? echo $Melee["power"]["effective"]; ?></td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Hit:</td>
                                          <td align="right" valign="middle"><? echo $Melee["hitrating"]["increasedhitpercent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Crit:</td>
                                          <td align="right" valign="middle"><? echo $Melee["critchance"]["percent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Haste:</td>
                                          <td align="right" valign="middle"><? echo $Ranged["speed"]["hastepercent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Armor Pen:</td>
                                          <td align="right" valign="middle"><? echo $Melee["hitrating"]["reducedarmorpercent"]; ?>%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Expertise:</td>
                                          <td align="right" valign="middle"><? echo $Melee["expertise"]["value"]; ?></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table>
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><div class="dropshadow">
                                        <table width="150" border="0" cellpadding="0" cellspacing="0" class="rangedTable">
                                          <tr class="rowA">
                                            <td colspan="2" align="center" valign="middle">Ranged</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td width="100" align="left" valign="middle">Atk Power:</td>
                                            <td width="50" align="right" valign="middle"><? echo $Ranged["power"]["effective"]; ?></td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Hit:</td>
                                            <td align="right" valign="middle"><? echo $Ranged["hitrating"]["increasedhitpercent"]; ?>%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Crit</td>
                                            <td align="right" valign="middle"><? echo $Ranged["critchance"]["percent"]; ?>%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Armor Pen:</td>
                                            <td align="right" valign="middle"><? echo $Ranged["hitrating"]["reducedarmorpercent"]; ?>%</td>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                    </tr>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_printstats'] = ($mtime-$totalPageLoadTime['start']); ?>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4" id="charExp1">
                                <table border="0" cellspacing="0" cellpadding="0" class="charInfo" onclick="getRaidExp();">
                                  <tr>
                                    <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td><div class="dropshadow">
                                              <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td colspan="2" align="center" valign="middle" class="busyText">Click here to view raid experience.<br /><img src="images/cauldron.png" width="32" height="32" /></td>
                                                </tr>
                                                </table>
                                            </div></td>
                                          </tr>
                                        </table></td>
                                  </tr>
                                </table>                          
            				</div></td>
                        </tr>
                      </table></td>
                    </tr>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_printexperience'] = ($mtime-$totalPageLoadTime['start']); ?>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4"><? echo getArenaTeams($character, $armoryLink); ?></div></td>
                        </tr>
                      </table></td>
                    </tr>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_printarenas'] = ($mtime-$totalPageLoadTime['start']); ?>
                    <tr>
                      <td colspan="3" align="center" valign="middle">
                      <table><tr><td align="center">
                          <div class="dropshadow4">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="commentsTable">
								<? echo printComments(); ?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_printcomments'] = ($mtime-$totalPageLoadTime['start']); ?>
                          </table>
                          </div>   
                      </td></tr></table><? if ($Character["lastmodified"]) echo '<span class="lastModified">Profile updated: '.$Character["lastmodified"].'.</span><br />'; ?>
                      </td>
                    </tr>
                  </table>
                </div></td>
              </tr>
              <tr>
              </tr>
            </table>
<?php require_once('/home/gearscores/public_html/includes/layout/bbody.php'); ?>