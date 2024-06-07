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
											<form id="mainpageSearch" name="mainpageSearch" method="post" action="http://gearscores.com/character.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="mainpageSearch">
												<tr>
													<td align="center" class="rowD" colspan="2">Character Search</td></tr><tr>
													<td align="left" class="rowA" colspan="2">
                                                    
                                                    Name: <input type="text" name="n" id="name3" /> <select onchange="javascript:insertChar('name3',this.options[this.selectedIndex].value);this.selectedIndex=0;"><option SELECTED="true" /><option>ß</option><option>à</option><option>á</option><option>â</option><option>ã</option><option>ä</option><option>å</option><option>æ</option><option>ç</option><option>è</option><option>é</option><option>ê</option><option>ë</option><option>ì</option><option>í</option><option>î</option><option>ï</option><option>ð</option><option>ñ</option><option>ò</option><option>ó</option><option>ô</option><option>õ</option><option>ö</option><option>ø</option><option>ù</option><option>ú</option><option>û</option><option>ü</option><option>ý</option><option>ÿ</option></select>
                                                    </td></td></tr>
                                                        <tr>
                                                        <td align="left" class="rowB region3">Region: <select name="r" id="region3" onchange="updateRealmList(3);" class="region3">
                                                          <? echo selectServer('<option value="us">US</option>
																  <option value="eu">EU</option>', strtoupper($region)); ?>
                                                        </select></td><td align="left" class="rowB server3">Realm: 
                                                        <div id="divServer3" style="display:inline;"><select name="s" id="server3" class="server3">
                                                          <? echo selectServer(file_get_contents("http://gearscores.com/includes/".$region."realms.php"), $server); ?>
                                                        </select></div></td></tr></td><td align="center" colspan="2" class="rowC">
                                                        <input type="submit" name="submit" id="submit" value="Search!" />
                                                   
                                                   		</tr>
                                                   </td>

												</tr></table></form>
										</td></tr></table></div></td>
            <tr><td align="center">
            <!--<table width="300" border="0" cellspacing="0" cellpadding="0" class="errorTable">
              <tr>
                <td align="center" valign="middle" width="20"><img src="http://gearscores.com/images/warn.png" /></td><td align="center" valign="middle"> 
             Cataclysm gear should be showing up correctly now.  If you have any problems, then please report them using the Contact Us link at the bottom of the page.
             </td>
              </tr>
            </table>-->
            </td></tr>
                                    <tr>
                                    	<td colspan="3" style="text-align:center;"><hr /><br /><!--<a href="http://wow.curse.com/downloads/wow-addons/details/gearscore.aspx"><img src="../images/downloadGS.png" width="150" height="44" style="border-style: none" /></a>&nbsp;&nbsp;&nbsp;<a href="http://wow.curse.com/downloads/wow-addons/details/gearscorelite.aspx"><img src="../images/downloadGSL.png" width="150" height="44" style="border-style: none" /></a><br /><br />-->
                                        </td>
                                    </tr>
                                    	<td colspan="3">
                                        <div class="dropshadow">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="featuresText" style="text-align:center;"><h1>GearScore Explained</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="featuresText" style="text-align:left;">
                                                GearScore is a way of calculating how powerful a players gear is based on how Blizzard (the creators of World of Warcraft) itemizes all of the items in the game.  A level 80 sword will have a higher GearScore than a level 50 sword.  A level 80 epic (purple) sword will have a higher GearScore than a level 80 rare (blue) sword.  <br />
        <br />
        Blizzard is constantly releasing new content and even harder raid dungeons for players to explore.  With each new dungeon comes even more powerful items.  Each item in the game has an "item level" (ilvl) attached to it.  The item level describes how powerful that item is compared to other items that fit into the same slot.  So an item level 200 bracer will be more powerful than an item level 100 bracer.<br />
        <br />
        Itemizing is a term that is used to describe how Blizzard adds attribute points to an item usually referred to as an item's "stats".  A mage might want some intellect while a warrior would want strength.  The higher the item level, then the more of an attribute Blizzard can itemize to an item.  So an item level 100 bracer might have 20 strength while an item level 200 bracer might have 50 strength.  So the player with an item level 200 bracer would have a more powerful bracer on their wrist than the player with an item level 100 bracer.<br />
        <br />
        Each equipment slot has a different weighted value to it for attributes.  So an item level 200 bracer might have 50 strength and an item level 200 sword might have 100 strength.  This is what you might expect since a magical sword would be much more vital to a warriors success, than a magical bracer.<br />
        <br />
        Taking in the item level, rarity of an item (uncommon, rare, epic, etc), slot the item is used in, GearScores.com calculates a number that estimates the power of each item, then adds up each item a player is wearing to create a players GearScore.  A player with a GearScore of 6000 would be capable of performing better than an equally skilled player with a GearScore of 5000.  <br />
        <br />
        It is important to understand that the skill level of a player is a very important factor in how well they perform in a raid or dungeon.  A very skilled player with a 5000 GearScore could outperform a much less skilled player that has a higher GearScore.  
        
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
<?php require_once('includes/layout/bbody.php'); ?>