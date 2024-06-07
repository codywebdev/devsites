<?
require_once("/home/gearscores/public_html/includes/phparmory/phpArmory.class.php");
require_once("/home/gearscores/public_html/includes/functions.php");
require_once ("/home/gearscores/public_html/includes/config.php");
require_once ("/home/gearscores/public_html/includes/opendb.php");

	if (isset($_POST['n'])) $name = urldecode($_POST['n']); else $name = '';
	if (isset($_POST['s'])) $server = urldecode($_POST['s']); else $server = '';
	if (isset($_POST['r'])) $region = urldecode($_POST['r']); else $region = 'us';
	if ($region != "us" && $region != "eu") $region = "us";
	

	$armory = new phpArmory5();
	$armory->setArea($region);
	$charExp = $armory->getCharacterRaidData($name, $server); // returns an associative array of character raid experience info
	
	//begin exp table xml table headings
	$expHtml = '<table border="0" cellspacing="0" cellpadding="0" class="charInfo"><tr><td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0"><tr><td><div class="dropshadow"><table border="0" cellspacing="0" cellpadding="3"> <tr> <th class="raidExp">Raid Experience</th> <th class="raidExpTitle">10</th> <th class="raidExpTitle"> <img src="images/skull.png" style="width: 0.9em; height: 0.9em" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,\'Heroic\',\'Inv_misc_bone_skull_02\');"> 10</th> <th class="raidExpTitle">25</th> <th class="raidExpTitle"> <img src="images/skull.png" style="width: 0.9em; height: 0.9em" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,\'Heroic\',\'Inv_misc_bone_skull_02\');"> 25</th> </tr>';
	
	
	
	
	
	
	
	
	
	//Ruby Sanctum
	//10m
	$PointsReq10m = 45;
	$Points10m = ($charExp['category']['statistic'][230]['quantity']*5);
	if ($charExp['category']['statistic'][230]['quantity'] > 0 || $charExp['category']['statistic'][231]['quantity'] > 0) $Points10m += 30;
	//10h
	$PointsReq10h = 45;
	$Points10h = ($charExp['category']['statistic'][231]['quantity']*5);
	if ($charExp['category']['statistic'][231]['quantity'] > 0) $Points10h += 30;
	$Points10m += $Points10h;
	//25m
	$PointsReq25m = 45;
	$Points25m = ($charExp['category']['statistic'][232]['quantity']*5);
	if ($charExp['category']['statistic'][232]['quantity'] > 0 || $charExp['category']['statistic'][233]['quantity'] > 0) $Points25m += 30;
	//25h
	$PointsReq25h = 45;
	$Points25h = ($charExp['category']['statistic'][233]['quantity']*5);
	if ($charExp['category']['statistic'][233]['quantity'] > 0) $Points25h += 30;
	$Points25m += $Points25h;
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][230]['quantity'].'</td><td>Halion kills</td></tr></table>"';
	$Points10hTooltip = '"'.$Points10h.' / '.$PointsReq10h.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][231]['quantity'].'</td><td>Halion kills</td></tr></table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][232]['quantity'].'</td><td>Halion kills</td></tr></table>"';
	$Points25hTooltip = '"'.$Points25h.' / '.$PointsReq25h.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][233]['quantity'].'</td><td>Halion kills</td></tr></table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">The Ruby Sanctum</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10hTooltip).',\'\');" class="'.((floor(min(($Points10h/$PointsReq10h),1)*100) > 50)? ((floor(min(($Points10h/$PointsReq10h),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10h/$PointsReq10h),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25hTooltip).',\'\');" class="'.((floor(min(($Points25h/$PointsReq25h),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25h/$PointsReq25h),1)*100).'%</td> </tr>';
	
	
	
	
	
	
	
	
	
	
	//Icecrown Citadel
	//10m
	$PointsReq10m = 195;
	$Points10m = min($charExp['category']['statistic'][188]['quantity']*1,10) + //gunship
				 min($charExp['category']['statistic'][180]['quantity']*1,10) + //marrowgar
				 ($charExp['category']['statistic'][196]['quantity']*1) + 		//festergut
				 min($charExp['category']['statistic'][192]['quantity']*1,10) + //deathbringer
				 min($charExp['category']['statistic'][184]['quantity']*1,10) +	//deathwhisper
				 ($charExp['category']['statistic'][204]['quantity']*2) + 		//blood prince
				 ($charExp['category']['statistic'][208]['quantity']*2) + 		//dreamwalker
				 ($charExp['category']['statistic'][200]['quantity']*2) + 		//rotface
				 ($charExp['category']['statistic'][212]['quantity']*5) + 		//putricide
				 ($charExp['category']['statistic'][216]['quantity']*5) + 		//lana'thel
				 ($charExp['category']['statistic'][220]['quantity']*5) + 		//sindragosa
				 ($charExp['category']['statistic'][224]['quantity']*30);		//lich king
	if ($charExp['category']['statistic'][224]['quantity'] > 0 || $charExp['category']['statistic'][225]['quantity'] > 0) $Points10m += 45;
	//10h
	$PointsReq10h = 125;
	$Points10h = min($charExp['category']['statistic'][189]['quantity']*1,5) + 	//gunship
				 min($charExp['category']['statistic'][181]['quantity']*1,5) + 	//marrowgar
				 ($charExp['category']['statistic'][197]['quantity']*2) + 		//festergut
				 ($charExp['category']['statistic'][193]['quantity']*2) + 		//deathbringer
				 ($charExp['category']['statistic'][185]['quantity']*5) +		//deathwhisper
				 min($charExp['category']['statistic'][205]['quantity']*1,5) + 	//blood prince
				 ($charExp['category']['statistic'][209]['quantity']*2) + 		//dreamwalker
				 min($charExp['category']['statistic'][201]['quantity']*1,5) + 	//rotface
				 ($charExp['category']['statistic'][213]['quantity']*5) + 		//putricide
				 ($charExp['category']['statistic'][217]['quantity']*5) + 		//lana'thel
				 ($charExp['category']['statistic'][221]['quantity']*7) + 		//sindragosa
				 ($charExp['category']['statistic'][225]['quantity']*15);		//lich king
	if ($charExp['category']['statistic'][225]['quantity'] > 0) $Points10h += 45;
	$Points10m += $Points10h;
	//25m
	$PointsReq25m = 195;
	$Points25m = min($charExp['category']['statistic'][190]['quantity']*1,10) + //gunship
				 min($charExp['category']['statistic'][182]['quantity']*1,10) + //marrowgar
				 ($charExp['category']['statistic'][198]['quantity']*1) + 		//festergut
				 min($charExp['category']['statistic'][194]['quantity']*1,10) + //deathbringer
				 min($charExp['category']['statistic'][186]['quantity']*1,10) +	//deathwhisper
				 ($charExp['category']['statistic'][206]['quantity']*2) + 		//blood prince
				 ($charExp['category']['statistic'][210]['quantity']*2) + 		//dreamwalker
				 ($charExp['category']['statistic'][202]['quantity']*2) + 		//rotface
				 ($charExp['category']['statistic'][214]['quantity']*5) + 		//putricide
				 ($charExp['category']['statistic'][218]['quantity']*5) + 		//lana'thel
				 ($charExp['category']['statistic'][222]['quantity']*5) + 		//sindragosa
				 ($charExp['category']['statistic'][226]['quantity']*30);		//lich king
	if ($charExp['category']['statistic'][226]['quantity'] > 0 || $charExp['category']['statistic'][227]['quantity'] > 0) $Points25m += 45;
	//25h
	$PointsReq25h = 125;
	$Points25h = min($charExp['category']['statistic'][191]['quantity']*1,5) + 	//gunship
				 min($charExp['category']['statistic'][183]['quantity']*1,5) + 	//marrowgar
				 ($charExp['category']['statistic'][199]['quantity']*2) + 		//festergut
				 ($charExp['category']['statistic'][195]['quantity']*2) + 		//deathbringer
				 ($charExp['category']['statistic'][187]['quantity']*5) +		//deathwhisper
				 min($charExp['category']['statistic'][207]['quantity']*1,5) + 	//blood prince
				 ($charExp['category']['statistic'][211]['quantity']*2) + 		//dreamwalker
				 min($charExp['category']['statistic'][203]['quantity']*1,5) + 	//rotface
				 ($charExp['category']['statistic'][215]['quantity']*5) + 		//putricide
				 ($charExp['category']['statistic'][219]['quantity']*2) + 		//lana'thel
				 ($charExp['category']['statistic'][223]['quantity']*7) + 		//sindragosa
				 ($charExp['category']['statistic'][227]['quantity']*15);		//lich king
	if ($charExp['category']['statistic'][227]['quantity'] > 0) $Points25h += 45;
	$Points25m += $Points25h;
	//echo $Points10m.'/'.$PointsReq10m.'<br />'.$Points10h.'/'.$PointsReq10h.'<br />'.$Points25m.'/'.$PointsReq25m.'<br />'.$Points25h.'/'.$PointsReq25h.'<br />';
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][180]['quantity'].'</td><td>Lord Marrowgar kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][184]['quantity'].'</td><td>Lady Deathwhisper kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][188]['quantity'].'</td><td>Gunship Battle victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][192]['quantity'].'</td><td>Deathbringer Saurfang kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][196]['quantity'].'</td><td>Festergut kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][200]['quantity'].'</td><td>Rotface kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][212]['quantity'].'</td><td>Professor Putricide kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][204]['quantity'].'</td><td>Blood Prince Council kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][216]['quantity'].'</td><td>Blood Queen Lana\'thel kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][208]['quantity'].'</td><td>Valithria Dreamwalker rescues</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][220]['quantity'].'</td><td>Sindragosa kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][224]['quantity'].'</td><td>Victories over the Lich King</td></tr>'.
						'</table>"';
	$Points10hTooltip = '"'.$Points10h.' / '.$PointsReq10h.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][181]['quantity'].'</td><td>Lord Marrowgar kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][185]['quantity'].'</td><td>Lady Deathwhisper kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][189]['quantity'].'</td><td>Gunship Battle victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][193]['quantity'].'</td><td>Deathbringer Saurfang kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][197]['quantity'].'</td><td>Festergut kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][201]['quantity'].'</td><td>Rotface kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][213]['quantity'].'</td><td>Professor Putricide kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][205]['quantity'].'</td><td>Blood Prince Council kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][217]['quantity'].'</td><td>Blood Queen Lana\'thel kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][209]['quantity'].'</td><td>Valithria Dreamwalker rescues</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][221]['quantity'].'</td><td>Sindragosa kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][225]['quantity'].'</td><td>Victories over the Lich King</td></tr>'.
						'</table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][182]['quantity'].'</td><td>Lord Marrowgar kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][186]['quantity'].'</td><td>Lady Deathwhisper kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][190]['quantity'].'</td><td>Gunship Battle victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][194]['quantity'].'</td><td>Deathbringer Saurfang kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][198]['quantity'].'</td><td>Festergut kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][202]['quantity'].'</td><td>Rotface kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][214]['quantity'].'</td><td>Professor Putricide kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][206]['quantity'].'</td><td>Blood Prince Council kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][218]['quantity'].'</td><td>Blood Queen Lana\'thel kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][210]['quantity'].'</td><td>Valithria Dreamwalker rescues</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][222]['quantity'].'</td><td>Sindragosa kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][226]['quantity'].'</td><td>Victories over the Lich King</td></tr>'.
						'</table>"';
	$Points25hTooltip = '"'.$Points25h.' / '.$PointsReq25h.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][183]['quantity'].'</td><td>Lord Marrowgar kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][187]['quantity'].'</td><td>Lady Deathwhisper kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][191]['quantity'].'</td><td>Gunship Battle victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][195]['quantity'].'</td><td>Deathbringer Saurfang kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][199]['quantity'].'</td><td>Festergut kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][203]['quantity'].'</td><td>Rotface kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][215]['quantity'].'</td><td>Professor Putricide kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][207]['quantity'].'</td><td>Blood Prince Council kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][219]['quantity'].'</td><td>Blood Queen Lana\'thel kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][211]['quantity'].'</td><td>Valithria Dreamwalker rescues</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][223]['quantity'].'</td><td>Sindragosa kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][227]['quantity'].'</td><td>Victories over the Lich King</td></tr>'.
						'</table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Icecrown Citadel</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10hTooltip).',\'\');" class="'.((floor(min(($Points10h/$PointsReq10h),1)*100) > 50)? ((floor(min(($Points10h/$PointsReq10h),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10h/$PointsReq10h),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25hTooltip).',\'\');" class="'.((floor(min(($Points25h/$PointsReq25h),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25h/$PointsReq25h),1)*100).'%</td> </tr>';








	
	
	
	//Trial of the Crusader
	//10m
	$PointsReq10m = 40;
	$Points10m = ($charExp['category']['statistic'][142]['quantity']*1) + //beasts
				 ($charExp['category']['statistic'][146]['quantity']*2) + //jaraxxus
				 ($charExp['category']['statistic'][150]['quantity']*3) + 		//faction champs
				 ($charExp['category']['statistic'][154]['quantity']*4) + //val'kyr twins
				 ($charExp['category']['statistic'][158]['quantity']*10);	//anub'arak (completion)
	if ($charExp['category']['statistic'][158]['quantity'] > 0 || $charExp['category']['statistic'][159]['quantity'] > 0) $Points10m += 10;
	//10h
	$PointsReq10h = 50;
	$Points10h = ($charExp['category']['statistic'][143]['quantity']*1) + //beasts
				 ($charExp['category']['statistic'][147]['quantity']*2) + //jaraxxus
				 ($charExp['category']['statistic'][151]['quantity']*3) + 		//faction champs
				 ($charExp['category']['statistic'][155]['quantity']*4) + //val'kyr twins
				 ($charExp['category']['statistic'][159]['quantity']*10);	//anub'arak (completion)
	if ($charExp['category']['statistic'][159]['quantity'] > 0) $Points10h += 30;
	$Points10m += $Points10h;
	//25m
	$PointsReq25m = 40;
	$Points25m = ($charExp['category']['statistic'][144]['quantity']*1) + //beasts
				 ($charExp['category']['statistic'][148]['quantity']*2) + //jaraxxus
				 ($charExp['category']['statistic'][152]['quantity']*3) + 		//faction champs
				 ($charExp['category']['statistic'][156]['quantity']*4) + //val'kyr twins
				 ($charExp['category']['statistic'][160]['quantity']*10);	//anub'arak (completion)
	if ($charExp['category']['statistic'][160]['quantity'] > 0 || $charExp['category']['statistic'][161]['quantity'] > 0) $Points25m += 10;
	//25h
	$PointsReq25h = 50;
	$Points25h = ($charExp['category']['statistic'][145]['quantity']*1) + //beasts
				 ($charExp['category']['statistic'][149]['quantity']*2) + //jaraxxus
				 ($charExp['category']['statistic'][153]['quantity']*3) + 		//faction champs
				 ($charExp['category']['statistic'][157]['quantity']*4) + //val'kyr twins
				 ($charExp['category']['statistic'][161]['quantity']*10);	//anub'arak (completion)
	if ($charExp['category']['statistic'][161]['quantity'] > 0) $Points25h += 30;
	$Points25m += $Points25h;
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][142]['quantity'].'</td><td>Victories over the Beasts of Northrend</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][146]['quantity'].'</td><td>Lord Jaraxxus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][150]['quantity'].'</td><td>Victories over the Faction Champions</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][154]['quantity'].'</td><td>Val\'kyr Twins kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][158]['quantity'].'</td><td>Times completed the Trial of the Crusader</td></tr>'.
						'</table>"';
	$Points10hTooltip = '"'.$Points10h.' / '.$PointsReq10h.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][143]['quantity'].'</td><td>Victories over the Beasts of Northrend</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][147]['quantity'].'</td><td>Lord Jaraxxus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][151]['quantity'].'</td><td>Victories over the Faction Champions</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][155]['quantity'].'</td><td>Val\'kyr Twins kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][159]['quantity'].'</td><td>Times completed the Trial of the Crusader</td></tr>'.
						'</table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][144]['quantity'].'</td><td>Victories over the Beasts of Northrend</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][148]['quantity'].'</td><td>Lord Jaraxxus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][152]['quantity'].'</td><td>Victories over the Faction Champions</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][156]['quantity'].'</td><td>Val\'kyr Twins kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][160]['quantity'].'</td><td>Times completed the Trial of the Crusader</td></tr>'.
						'</table>"';
	$Points25hTooltip = '"'.$Points25h.' / '.$PointsReq25h.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][145]['quantity'].'</td><td>Victories over the Beasts of Northrend</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][149]['quantity'].'</td><td>Lord Jaraxxus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][153]['quantity'].'</td><td>Victories over the Faction Champions</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][157]['quantity'].'</td><td>Val\'kyr Twins kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][161]['quantity'].'</td><td>Times completed the Trial of the Crusader</td></tr>'.
						'</table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Trial of the Crusader</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10hTooltip).',\'\');" class="'.((floor(min(($Points10h/$PointsReq10h),1)*100) > 50)? ((floor(min(($Points10h/$PointsReq10h),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10h/$PointsReq10h),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25hTooltip).',\'\');" class="'.((floor(min(($Points25h/$PointsReq25h),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25h/$PointsReq25h),1)*100).'%</td> </tr>';





	
	
	
	//Ulduar
	//10m
	$PointsReq10m = 140;
	$Points10m = ($charExp['category']['statistic'][97]['quantity']*1) + 		//razorscale
				 ($charExp['category']['statistic'][102]['quantity']*1) + 		//auriaya
				 ($charExp['category']['statistic'][101]['quantity']*1) + 		//kologarn
				 ($charExp['category']['statistic'][98]['quantity']*1) +	 	//ignis
				 ($charExp['category']['statistic'][96]['quantity']*1) +		//flame leviathan
				 ($charExp['category']['statistic'][99]['quantity']*2) + 		//xt-002
				 ($charExp['category']['statistic'][100]['quantity']*3) + 		//assembly of iron
				 ($charExp['category']['statistic'][103]['quantity']*5) + 		//hodir
				 ($charExp['category']['statistic'][104]['quantity']*5) + 		//thorim
				 ($charExp['category']['statistic'][106]['quantity']*5) + 		//mimiron
				 ($charExp['category']['statistic'][105]['quantity']*5) + 		//freya
				 ($charExp['category']['statistic'][107]['quantity']*10) + 		//general vezax
				 ($charExp['category']['statistic'][109]['quantity']*15) + 		//algalon
				 ($charExp['category']['statistic'][108]['quantity']*15);		//yogg'saron
	if ($charExp['category']['statistic'][108]['quantity'] > 0) $Points10m += 30;
	//25m
	$PointsReq25m = 140;
	$Points25m = ($charExp['category']['statistic'][111]['quantity']*1) + 		//razorscale
				 ($charExp['category']['statistic'][116]['quantity']*1) + 		//auriaya
				 ($charExp['category']['statistic'][115]['quantity']*1) + 		//kologarn
				 ($charExp['category']['statistic'][112]['quantity']*1) +	 	//ignis
				 ($charExp['category']['statistic'][110]['quantity']*1) +		//flame leviathan
				 ($charExp['category']['statistic'][113]['quantity']*2) + 		//xt-002
				 ($charExp['category']['statistic'][114]['quantity']*3) + 		//assembly of iron
				 ($charExp['category']['statistic'][117]['quantity']*5) + 		//hodir
				 ($charExp['category']['statistic'][118]['quantity']*5) + 		//thorim
				 ($charExp['category']['statistic'][120]['quantity']*5) + 		//mimiron
				 ($charExp['category']['statistic'][119]['quantity']*5) + 		//freya
				 ($charExp['category']['statistic'][121]['quantity']*10) + 		//general vezax
				 ($charExp['category']['statistic'][123]['quantity']*15) + 		//algalon
				 ($charExp['category']['statistic'][122]['quantity']*15);		//yogg'saron
	if ($charExp['category']['statistic'][122]['quantity'] > 0) $Points25m += 30;
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][96]['quantity'].'</td><td>Flame Leviathan kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][97]['quantity'].'</td><td>Razorscale kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][98]['quantity'].'</td><td>Ignis the Furnace Master kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][99]['quantity'].'</td><td>XT-002 Deconstructor kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][100]['quantity'].'</td><td>Assembly of Iron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][101]['quantity'].'</td><td>Kologarn kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][102]['quantity'].'</td><td>Auriaya kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][103]['quantity'].'</td><td>Hodir victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][104]['quantity'].'</td><td>Thorim victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][105]['quantity'].'</td><td>Freya victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][106]['quantity'].'</td><td>Mimiron victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][107]['quantity'].'</td><td>General Vezax kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][108]['quantity'].'</td><td>Yogg-Saron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][109]['quantity'].'</td><td>Algalon the Observer kills</td></tr>'.
						'</table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][110]['quantity'].'</td><td>Flame Leviathan kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][111]['quantity'].'</td><td>Razorscale kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][112]['quantity'].'</td><td>Ignis the Furnace Master kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][113]['quantity'].'</td><td>XT-002 Deconstructor kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][114]['quantity'].'</td><td>Assembly of Iron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][115]['quantity'].'</td><td>Kologarn kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][116]['quantity'].'</td><td>Auriaya kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][117]['quantity'].'</td><td>Hodir victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][118]['quantity'].'</td><td>Thorim victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][119]['quantity'].'</td><td>Freya victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][120]['quantity'].'</td><td>Mimiron victories</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][121]['quantity'].'</td><td>General Vezax kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][122]['quantity'].'</td><td>Yogg-Saron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][123]['quantity'].'</td><td>Algalon the Observer kills</td></tr>'.
						'</table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Ulduar</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';



	
	
	
	
	//Onyxia's Lair
	//10m
	$PointsReq10m = 10;
	$Points10m = ($charExp['category']['statistic'][8]['quantity']*10);
	//25m
	$PointsReq25m = 10;
	$Points25m = ($charExp['category']['statistic'][8]['quantity']*10);
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][8]['quantity'].'</td><td>Onyxia kills (10 and 25-Player)</td></tr></table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][8]['quantity'].'</td><td>Onyxia kills (10 and 25-Player)</td></tr></table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Onyxia\'s Lair</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';
	
	
	
	
	
	
	
	
	
	
	
	
	//Vault of Archavon
	//10m
	$PointsReq10m = 30;
	$Points10m = min($charExp['category']['statistic'][124]['quantity']*1,5) + 		//emalon
				 min($charExp['category']['statistic'][94]['quantity']*1,5) + 		//archavon
				 min($charExp['category']['statistic'][162]['quantity']*1,5) + 		//koralon
				 ($charExp['category']['statistic'][228]['quantity']*30);	 		//toravon
	//25m
	$PointsReq25m = 30;
	$Points25m = min($charExp['category']['statistic'][125]['quantity']*1,5) + 		//emalon
				 min($charExp['category']['statistic'][95]['quantity']*1,5) + 		//archavon
				 min($charExp['category']['statistic'][163]['quantity']*1,5) + 		//koralon
				 ($charExp['category']['statistic'][229]['quantity']*30);	 		//toravon
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][94]['quantity'].'</td><td>Archavon the Stone Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][124]['quantity'].'</td><td>Emalon the Storm Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][162]['quantity'].'</td><td>Koralon the Flame Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][228]['quantity'].'</td><td>Toravon the Ice Watcher kills</td></tr>'.
						'</table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][95]['quantity'].'</td><td>Archavon the Stone Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][125]['quantity'].'</td><td>Emalon the Storm Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][163]['quantity'].'</td><td>Koralon the Flame Watcher kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][229]['quantity'].'</td><td>Toravon the Ice Watcher kills</td></tr>'.
						'</table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Vault of Archavon</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';
	
	
	
	
	
	
	
	
	
	
	
	//Sartharion
	//10m
	$PointsReq10m = 10;
	$Points10m = ($charExp['category']['statistic'][90]['quantity']*10);
	//25m
	$PointsReq25m = 10;
	$Points25m = ($charExp['category']['statistic'][91]['quantity']*10);
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][90]['quantity'].'</td><td>Sartharion kills</td></tr></table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][91]['quantity'].'</td><td>Sartharion kills</td></tr></table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Sartharion</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';
	
	
	
	
	
	
	
	
	
	
	//Malygos
	//10m
	$PointsReq10m = 10;
	$Points10m = ($charExp['category']['statistic'][92]['quantity']*10);
	//25m
	$PointsReq25m = 10;
	$Points25m = ($charExp['category']['statistic'][93]['quantity']*10);
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][92]['quantity'].'</td><td>Malygos kills</td></tr></table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table><tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][93]['quantity'].'</td><td>Malygos kills</td></tr></table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Malygos</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';
	
	
	
	//Naxxramas
	//10m
	$PointsReq10m = 130;
	$Points10m = ($charExp['category']['statistic'][59]['quantity']*2) + 		//anub'rekhan
				 ($charExp['category']['statistic'][60]['quantity']*2) + 		//gluth
				 ($charExp['category']['statistic'][61]['quantity']*2) + 		//gothik
				 ($charExp['category']['statistic'][62]['quantity']*2) +	 	//grand widow
				 ($charExp['category']['statistic'][63]['quantity']*1) +		//grobbulus
				 ($charExp['category']['statistic'][64]['quantity']*2) + 		//heigan
				 ($charExp['category']['statistic'][65]['quantity']*6) + 		//four horsemen
				 ($charExp['category']['statistic'][66]['quantity']*2) + 		//razuvious
				 ($charExp['category']['statistic'][67]['quantity']*6) + 		//loatheb
				 ($charExp['category']['statistic'][68]['quantity']*6) + 		//maexxna
				 ($charExp['category']['statistic'][69]['quantity']*2) + 		//noth
				 ($charExp['category']['statistic'][70]['quantity']*1) + 		//patchwerk
				 ($charExp['category']['statistic'][71]['quantity']*6) + 		//thaddius
				 ($charExp['category']['statistic'][72]['quantity']*10) + 		//sapphiron
				 ($charExp['category']['statistic'][73]['quantity']*15);		//kel'thuzad
	if ($charExp['category']['statistic'][73]['quantity'] > 0) $Points10m += 65;
	//25m
	$PointsReq25m = 130;
	$Points25m = ($charExp['category']['statistic'][75]['quantity']*2) + 		//anub'rekhan
				 ($charExp['category']['statistic'][76]['quantity']*2) + 		//gluth
				 ($charExp['category']['statistic'][77]['quantity']*2) + 		//gothik
				 ($charExp['category']['statistic'][78]['quantity']*2) +	 	//grand widow
				 ($charExp['category']['statistic'][79]['quantity']*1) +		//grobbulus
				 ($charExp['category']['statistic'][80]['quantity']*2) + 		//heigan
				 ($charExp['category']['statistic'][81]['quantity']*6) + 		//four horsemen
				 ($charExp['category']['statistic'][82]['quantity']*2) + 		//razuvious
				 ($charExp['category']['statistic'][83]['quantity']*6) + 		//loatheb
				 ($charExp['category']['statistic'][84]['quantity']*6) + 		//maexxna
				 ($charExp['category']['statistic'][85]['quantity']*2) + 		//noth
				 ($charExp['category']['statistic'][86]['quantity']*1) + 		//patchwerk
				 ($charExp['category']['statistic'][87]['quantity']*6) + 		//thaddius
				 ($charExp['category']['statistic'][88]['quantity']*10) + 		//sapphiron
				 ($charExp['category']['statistic'][89]['quantity']*15);		//kel'thuzad
	if ($charExp['category']['statistic'][89]['quantity'] > 0) $Points25m += 70;
	//tooltips
	$Points10mTooltip = '"'.$Points10m.' / '.$PointsReq10m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][59]['quantity'].'</td><td>Anub\'Rekhan kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][60]['quantity'].'</td><td>Gluth kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][61]['quantity'].'</td><td>Gothik the Harvester kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][62]['quantity'].'</td><td>Grand Widow Faerlina kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][63]['quantity'].'</td><td>Grobbulus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][64]['quantity'].'</td><td>Heigan the Unclean kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][65]['quantity'].'</td><td>Four Horsemen kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][66]['quantity'].'</td><td>Instructor Razuvious kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][67]['quantity'].'</td><td>Loatheb kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][68]['quantity'].'</td><td>Maexxna kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][69]['quantity'].'</td><td>Noth the Plaguebringer kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][70]['quantity'].'</td><td>Patchwerk kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][71]['quantity'].'</td><td>Thaddius kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][72]['quantity'].'</td><td>Sapphiron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][73]['quantity'].'</td><td>Kel\'Thuzad kills</td></tr>'.
						'</table>"';
	$Points25mTooltip = '"'.$Points25m.' / '.$PointsReq25m.'<br/><table>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][75]['quantity'].'</td><td>Anub\'Rekhan kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][76]['quantity'].'</td><td>Gluth kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][77]['quantity'].'</td><td>Gothik the Harvester kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][78]['quantity'].'</td><td>Grand Widow Faerlina kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][79]['quantity'].'</td><td>Grobbulus kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][80]['quantity'].'</td><td>Heigan the Unclean kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][81]['quantity'].'</td><td>Four Horsemen kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][82]['quantity'].'</td><td>Instructor Razuvious kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][83]['quantity'].'</td><td>Loatheb kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][84]['quantity'].'</td><td>Maexxna kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][85]['quantity'].'</td><td>Noth the Plaguebringer kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][86]['quantity'].'</td><td>Patchwerk kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][87]['quantity'].'</td><td>Thaddius kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][88]['quantity'].'</td><td>Sapphiron kills</td></tr>'.
						'<tr><td align=\'right\' style=\'padding-right: 4px\'>'.$charExp['category']['statistic'][89]['quantity'].'</td><td>Kel\'Thuzad kills</td></tr>'.
						'</table>"';
	//html
	$expHtml .= '<tr> <td class="raidName">Naxxramas</td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points10mTooltip).',\'\');" class="'.((floor(min(($Points10m/$PointsReq10m),1)*100) > 50)? ((floor(min(($Points10m/$PointsReq10m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points10m/$PointsReq10m),1)*100).'%</td> <td></td> <td align="right" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,'.htmlspecialchars($Points25mTooltip).',\'\');" class="'.((floor(min(($Points25m/$PointsReq25m),1)*100) > 50)? ((floor(min(($Points25m/$PointsReq25m),1)*100) >= 100)? 'green' : 'orange' ) : 'red' ).'RaidExp">'.floor(min(($Points25m/$PointsReq25m),1)*100).'%</td> <td></td> </tr>';
	
	
	//end exp table html
	$expHtml .= '</table></div></td></tr></table></td></tr></table>';
	
	echo $expHtml;


require_once ("/home/gearscores/public_html/includes/closedb.php");
?>