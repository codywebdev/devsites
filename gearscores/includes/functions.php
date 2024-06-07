<?php require_once('calcGearscore.php'); ?>
<?php 


function printItem($Item = array())
{
	global $Professions;
	global $Items;
	$html = '';
	$colorCode = "9d9d9d";
switch ($Item["rarity"]) {
		case "0":
			$colorCode = "9d9d9d";
			break;
		case "1":
			$colorCode = "ffffff";
			break;
		case "2":
			$colorCode = "1eff00";
			break;
		case "3":
			$colorCode = "0070dd";
			break;
		case "4":
			$colorCode = "a335ee";
			break;
		case "5":
			$colorCode = "ff8000";
			break;
		case "6":
			$colorCode = "e6cc80";
			break;
		case "7":
			$colorCode = "e6cc80";
			break;
	}
	$sock = '';
	if (($Professions["0"]["name"] == "Blacksmithing" && $Professions["0"]["value"] >= 400) || ($Professions["1"]["name"] == "Blacksmithing" && $Professions["1"]["value"] >= 400) || ($Professions["name"] == "Blacksmithing" && $Professions["value"] >= 400)) 
		if (($Item["slot"]==9) || ($Item["slot"]==8)) 
			if ($Item["gem0id"] != "") {
				$sock = "&amp;sock";
			}
			
	if ($Item["slot"]==5 && $Item["gem0id"] != "")
		$sock = "&amp;sock";
	
	if(!empty($Item)) {
		$html = '<div class="gearIcon"><a href="http://www.wowhead.com/?item=' . $Item["id"] . '" rel="gems='.$Item["gem0id"].':'.$Item["gem1id"].':'.$Item["gem2id"].'&amp;ench='.$Item["permanentenchant"].$sock.'';
		
			//add the pieces string to show item pieces on tooltips
			$html .= '&pcs=';
			foreach ($Items as $piece){
				$html .= $piece["id"] . ':';
			}
			$html = substr($html,0,-1);
		
		$html .= '"><img src="http://static.wowhead.com/images/wow/icons/large/'.$Item["icon"].'.jpg" class="gearIconPic" style="border-color: #'.$colorCode.';" /><div class="ilvlText">'.$Item["level"].'</div></a></div>';
		return $html;
	}
	else return 'no item';
}

function printEmptySlot($s) {
	return '<img src="http://gearscores.com/images/slots/Slot'.$s.'.png" />';
}

function getItemsArray($Item)
{
	if (!is_array($Item)) $Item = array();
	if ($Item["id"] != '') { $singleItem[0] = $Item; $Item = $singleItem; }  //only 1 item
	$newItem = array();
	$slot = '';
	$sizeofItem = sizeof($Item);
	for ($i=0; $i<$sizeofItem; $i++) {
		$slot = $Item[$i]["slot"];
		$newItem[$slot] = $Item[$i];
		$slot = '';
	}
	return $newItem;
}


function printRaceIcon($Character = array()) {
	$iconPath = "";
	switch ($Character["race"] . $Character["gender"]) {
		case "Human" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_human-male.png";
			break;
		case "Human" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_human-female.png";
			break;
		case "Dwarf" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_dwarf-male.png";
			break;
		case "Dwarf" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_dwarf-female.png";
			break;
		case "Gnome" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_gnome-male.png";
			break;
		case "Gnome" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_gnome-female.png";
			break;
		case "Night Elf" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_nightelf-male.png";
			break;
		case "Night Elf" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_nightelf-female.png";
			break;
		case "Draenei" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_draenei-male.png";
			break;
		case "Draenei" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_draenei-female.png";
			break;
		case "Worgen" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/IconLarge_Worgen_Male.gif";
			break;
		case "Worgen" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/IconLarge_Worgen_Female.gif";
			break;
		case "Orc" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_orc-male.png";
			break;
		case "Orc" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_orc-female.png";
			break;
		case "Undead" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_undead-male.png";
			break;
		case "Undead" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_undead-female.png";
			break;
		case "Troll" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_troll-male.png";
			break;
		case "Troll" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_troll-female.png";
			break;
		case "Tauren" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_tauren-male.png";
			break;
		case "Tauren" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_tauren-female.png";
			break;
		case "Blood Elf" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_bloodelf-male.png";
			break;
		case "Blood Elf" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/Ui-charactercreate-races_bloodelf-female.png";
			break;
		case "Goblin" . "Male":
			$iconPath = "http://gearscores.com/images/icons/race/IconLarge_Goblin_Male.gif";
			break;
		case "Goblin" . "Female":
			$iconPath = "http://gearscores.com/images/icons/race/IconLarge_Goblin_Female.gif";
			break;
	}
	return $iconPath;
}



function printClassIcon($Character = array()) {
	$iconPath = "";
	switch ($Character["class"]) {
		case "Druid":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Druid.png";
			break;
		case "Hunter":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Hunter.png";
			break;
		case "Mage":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Mage.png";
			break;
		case "Paladin":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Paladin.png";
			break;
		case "Priest":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Priest.png";
			break;
		case "Rogue":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Rogue.png";
			break;
		case "Shaman":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Shaman.png";
			break;
		case "Warlock":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Warlock.png";
			break;
		case "Warrior":
			$iconPath = "http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Warrior.png";
			break;
		case "Death Knight":
			$iconPath = "http://gearscores.com/images/icons/class/deathknight_icon.png";
			break;
	}
	return $iconPath;
}

function getActiveTalentSpec($Talents = array(), $url = false) {  //if second parameter is entered, then function will return a url parameter to the current talent spec
	$spec = "";
	$activeSpec = "0";
	$dualSpec = true;
	if ($Talents["0"]["active"]==1) $spec = $Talents["0"]["prim"]; 
	else if ($Talents["1"]["active"]==1) { $spec = $Talents["1"]["prim"]; $activeSpec = "1"; }
	else { //not dual-spec
			$dualSpec = false;
			if ($Talents["prim"] != "") $spec = $Talents["prim"]; //must have talents chosen
			else $spec = "No Talents";
	}
	if ($url) { 
		if ($dualSpec == true) {
			if ($Talents[$activeSpec]["group"] == "1")
				return 'primary';
			else
				return 'secondary';
		}
		else return 'primary';
	}
	else return $spec;
}

function getActiveTalentDist($Talents = array()) {
	$dist = "";
	if ($Talents["0"]["active"]==1) $dist = $Talents["0"]["treeone"].'/'.$Talents["0"]["treetwo"].'/'.$Talents["0"]["treethree"]; 
	else if ($Talents["1"]["active"]==1) $dist = $Talents["1"]["treeone"].'/'.$Talents["1"]["treetwo"].'/'.$Talents["1"]["treethree"];
	else {//not dual-spec
			if ($Talents["prim"] != "") $dist = $Talents["treeone"].'/'.$Talents["treetwo"].'/'.$Talents["treethree"]; //must have talents chosen
			else $dist = "0/0/0";
	}	
	return $dist;
}

function getAltTalentSpec($Talents = array(), $url = false) {
	$spec = "";
	$activeSpec = "0";
	$dualSpec = true;
	if ($Talents["0"]["active"]==1) { $spec = $Talents["1"]["prim"];  $activeSpec = "1"; }
	else if ($Talents["1"]["active"]==1) $spec = $Talents["0"]["prim"];
	
	if ($url) { 
		if ($dualSpec == true) {
			if ($Talents[$activeSpec]["group"] == "1")
				return 'primary';
			else
				return 'secondary';
		}
		else return 'primary';
	}
	else return $spec;
}

function getAltTalentDist($Talents = array()) {
	$dist = "";
	if ($Talents["0"]["active"]==1) $dist = $Talents["1"]["treeone"].'/'.$Talents["1"]["treetwo"].'/'.$Talents["1"]["treethree"]; 
	else if ($Talents["1"]["active"]==1) $dist = $Talents["0"]["treeone"].'/'.$Talents["0"]["treetwo"].'/'.$Talents["0"]["treethree"];
	
	return $dist;
}

function getTalents($character = array(),$armoryLink = "") {
	global $spec0ArrayCached, $spec1ArrayCached, $region;
	$Talents = $character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"];
	$Character = $character["characterinfo"]["character"];
	$output = "";
	
	$cachedLink = "";
	if ($Talents["1"]["active"]==1 && $spec0ArrayCached==true) {
		$cachedLink = '<a href="javascript:postToURL(\'http://gearscores.com/character.php\', {\'n\':\''.$Character["name"].'\',\'s\':\''.addslashes($Character["realm"]).'\',\'r\':\''.$region.'\',\'cm\':\'0\'});">Inactive - (View)</a>';
	}
	else if ($Talents["0"]["active"]==1 && $spec1ArrayCached==true) {
		$cachedLink = '<a href="javascript:postToURL(\'http://gearscores.com/character.php\', {\'n\':\''.$Character["name"].'\',\'s\':\''.addslashes($Character["realm"]).'\',\'r\':\''.$region.'\',\'cm\':\'1\'});">Inactive - (View)</a>';
	}
	else $cachedLink = "Inactive";
	
	
	if ($Talents[0]["prim"]=='') {	//not dual spec
		$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="100%" align="center" valign="top"><table><tr><td><div class="dropshadow"><table width="150" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					  <td align="center" valign="middle" class="activeTalentRowA">Talents</td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowB"><a href="'.$armoryLink.'character/'.$Character["realm"].'/'.rawurlencode($Character["name"]).'/talent/'.getActiveTalentSpec($Talents,true).'">';
		$output .= getActiveTalentSpec($Talents); 
		$output .= '</a></td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowC"><a href="">';
		$output .= getActiveTalentDist($Talents); 
		$output .= '</a></td>
					</tr>
				  </table></div></td></tr></table></td>
				</td>
			  </tr>
			</table>';
	}
	else {  //dual spec
		$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" align="center" valign="top"><table><tr><td><div class="dropshadow"><table width="150" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					  <td align="center" valign="middle" class="activeTalentRowA">Active</td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowB"><a href="'.$armoryLink.'character/'.$Character["realm"].'/'.rawurlencode($Character["name"]).'/talent/'.getActiveTalentSpec($Talents,true).'">';
		$output .= getActiveTalentSpec($Talents); 
		$output .= '</a></td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowC"><a href="'.$armoryLink.'character/'.$Character["realm"].'/'.rawurlencode($Character["name"]).'/talent/'.getActiveTalentSpec($Talents,true).'">';
		$output .= getActiveTalentDist($Talents); 
		$output .= '</a></td>
					</tr>
				  </table></div></td></tr></table></td>
				<td width="50%" align="center" valign="top"><table>
				  <tr>
					<td><div class="dropshadow">
					  <table width="150" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowA">'.$cachedLink.'</td>
						</tr>
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowB"><a href="'.$armoryLink.'character/'.$Character["realm"].'/'.rawurlencode($Character["name"]).'/talent/'.getAltTalentSpec($Talents,true).'">';
		$output .= getAltTalentSpec($Talents);
		$output .= '</a></td>
						</tr>
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowC"><a href="'.$armoryLink.'character/'.$Character["realm"].'/'.rawurlencode($Character["name"]).'/talent/'.getAltTalentSpec($Talents,true).'">';
		$output .= getAltTalentDist($Talents);
		$output .= '</a></td>
						</tr>
					  </table>
					</div></td>
				  </tr>
				</table></td>
			  </tr>
			</table>';
	}
	return $output;
}

function getProfessions($Professions = array()) {
	$output = '<table class="dropshadow5table mainProfTable"><tr><td align="center" valign="middle">';
	if ($Professions["0"]["name"] != "") {
		$output .= '<table><tr><td class="rowA">'.$Professions["0"]["name"].'</td></tr><tr><td class="profBarTable"><div class="profBar" style="width:'.floor(($Professions["0"]["value"]/$Professions["0"]["max"])*100).'px;"><div class="profBarText">'.$Professions["0"]["value"].'/'.$Professions["0"]["max"].'</div></div></td></tr></table>';
	}
	else if ($Professions["name"] != "") {
		$output .= '<table><tr><td class="rowA">'.$Professions["name"].'</td></tr><tr><td class="profBarTable"><div class="profBar" style="width:'.floor(($Professions["value"]/$Professions["max"])*100).'px;"><div class="profBarText">'.$Professions["value"].'/'.$Professions["max"].'</div></div></td></tr></table>';
	}
	else $output .= '<div class="noProfessions">No Professions.</div>';
	if ($Professions["0"]["name"] != "" && $Professions["1"]["name"] != "") {
		$output .= '<table><tr><td class="rowA">'.$Professions["1"]["name"].'</td></tr><tr><td class="profBarTable"><div class="profBar" style="width:'.floor(($Professions["1"]["value"]/$Professions["1"]["max"])*100).'px;"><div class="profBarText">'.$Professions["1"]["value"].'/'.$Professions["1"]["max"].'</div></div></td></tr></table>';	
	}
	$output .= '</td></tr></table>';
	return $output;
}

function getHealthManaBars($Bars = array()) {
	$color = "";
	$tColor = "";
	$output = '<table class="dropshadow5table mainHealthTable"><tr><td align="center" valign="middle">';
	$output .= '<table><tr><td class="rowA">Health</td></tr>';
	$output .= '<tr><td class="healthBarTable">'.$Bars["health"]["effective"].'</td></tr><tr><td class="rowA">'; 
	switch ($Bars["secondbar"]["type"]) {
		case 'm': 
			$output .= 'Mana'; $color = "#0000FF"; $tColor = "white"; break;
		case 'r':
			$output .= 'Rage'; $color = "#FF0000"; $tColor = "white"; break;
		case 'e':
			$output .= 'Energy'; $color = "#FFFF00"; $tColor = "black"; break;
		case 'p':
			$output .= 'Runic Power'; $color = "#00D1FF"; $tColor = "black"; break;
		} 
	$output .= '</td></tr><tr><td class="manaBarTable" style="background-color:'.$color.';color:'.$tColor.';">'.$Bars["secondbar"]["effective"].'</td></tr></table>'; 
	$output .= '</td></tr></table>';
	return $output;
}

function getGSColorStyle($gearscore,$fontSize = "26",$maxIncrease = 10) {
	$red = "";
	$green = "";
	$blue = "";
	$bgcolor = "";
	$gsColor1 = "";
	$gsColor2 = "";
	
	$gsColor = array();
	
	/*
	//original Gearscore colors
	$gsColor["0"]["GS"] = 0; $gsColor["0"]["R"] = 140; $gsColor["0"]["G"] = 140; $gsColor["0"]["B"] = 140;
	$gsColor["1"]["GS"] = 1000; $gsColor["1"]["R"] = 255; $gsColor["1"]["G"] = 255; $gsColor["1"]["B"] = 255;
	$gsColor["2"]["GS"] = 2000; $gsColor["2"]["R"] = 30; $gsColor["2"]["G"] = 255; $gsColor["2"]["B"] = 0;
	$gsColor["3"]["GS"] = 3000; $gsColor["3"]["R"] = 0; $gsColor["3"]["G"] = 127; $gsColor["3"]["B"] = 255;
	$gsColor["4"]["GS"] = 4000; $gsColor["4"]["R"] = 176; $gsColor["4"]["G"] = 71; $gsColor["4"]["B"] = 247;
	$gsColor["5"]["GS"] = 5000; $gsColor["5"]["R"] = 240; $gsColor["5"]["G"] = 120; $gsColor["5"]["B"] = 0;
	$gsColor["6"]["GS"] = 6000; $gsColor["6"]["R"] = 240; $gsColor["6"]["G"] = 35; $gsColor["6"]["B"] = 47;*/
	
	//updated colors for better web display
	$gsColor["0"]["GS"] = 0; $gsColor["0"]["R"] = 140; $gsColor["0"]["G"] = 140; $gsColor["0"]["B"] = 140;
	$gsColor["1"]["GS"] = 1000; $gsColor["1"]["R"] = 255; $gsColor["1"]["G"] = 255; $gsColor["1"]["B"] = 255;
	$gsColor["2"]["GS"] = 2000; $gsColor["2"]["R"] = 0; $gsColor["2"]["G"] = 220; $gsColor["2"]["B"] = 0;
	$gsColor["3"]["GS"] = 3000; $gsColor["3"]["R"] = 0; $gsColor["3"]["G"] = 0; $gsColor["3"]["B"] = 255;
	$gsColor["4"]["GS"] = 4000; $gsColor["4"]["R"] = 163; $gsColor["4"]["G"] = 53; $gsColor["4"]["B"] = 238;
	$gsColor["5"]["GS"] = 5000; $gsColor["5"]["R"] = 240; $gsColor["5"]["G"] = 120; $gsColor["5"]["B"] = 60;
	$gsColor["6"]["GS"] = 6000; $gsColor["6"]["R"] = 255; $gsColor["6"]["G"] = 0; $gsColor["6"]["B"] = 0;
	
	
	//make sure the gearscre is within the array range
	if ($gearscore <= $gsColor["0"]["GS"]) $gearscore = $gsColor["0"]["GS"];
	else if ($gearscore >= $gsColor["6"]["GS"]) $gearscore = $gsColor["6"]["GS"];
	
	
	for ($i=0;$i<=6;$i++) {
		if ($gearscore <= $gsColor[$i]["GS"]) {
			if ($i==0) {
				$gsColor1 = $gsColor[$i];
				$gsColor2 = $gsColor[($i+1)];
				break;
			}
			else {
				$gsColor1 = $gsColor[($i-1)];
				$gsColor2 = $gsColor[$i];
				break;
			}
		}
	}
	
	$redDecValue = (((($gsColor2["R"] - $gsColor1["R"]) / ($gsColor2["GS"] - $gsColor1["GS"])) * ($gearscore - $gsColor1["GS"])) + $gsColor1["R"]);
	$greenDecValue = (((($gsColor2["G"] - $gsColor1["G"]) / ($gsColor2["GS"] - $gsColor1["GS"])) * ($gearscore - $gsColor1["GS"])) + $gsColor1["G"]);
	$blueDecValue = (((($gsColor2["B"] - $gsColor1["B"]) / ($gsColor2["GS"] - $gsColor1["GS"])) * ($gearscore - $gsColor1["GS"])) + $gsColor1["B"]);
	
	//$gsColor1 = $gsColor["0"];
	
	$red = strtoupper(($redDecValue < 16)? "0". dechex($redDecValue) : dechex($redDecValue));
	$green = strtoupper(($greenDecValue < 16)? "0". dechex($greenDecValue) : dechex($greenDecValue));
	$blue = strtoupper(($blueDecValue < 16)? "0". dechex($blueDecValue) : dechex($blueDecValue));
	
	//calculator font size
	if ($gearscore > $gsColor["5"]["GS"]) {
		$fontSize += floor(((($gearscore - $gsColor["5"]["GS"]) / ($gsColor2["GS"] - $gsColor1["GS"])) * $maxIncrease));
	}
	
	//if less than 1500 GS then put a black backround
	if($gearscore < ($gsColor["2"]["GS"] - (($gsColor["2"]["GS"] - $gsColor["1"]["GS"])/2))) $bgcolor = "background-color:black;";
	return 'color:#'.$red.$green.$blue.';'.$bgcolor.'font-size:'.$fontSize.'px;';
}

function getCharClassColor($character = array(), $readable = false, $classN = '') {  //readable font will alter the color slightly to make it readable on light parchment background
	$classColor = "";
	$safeColor = "";
	$className = $character["characterinfo"]["character"]["class"]? $character["characterinfo"]["character"]["class"] : $classN;
	switch ($className) {
		case "Death Knight": $classColor = '#C41F3B'; $safeColor = '#C41F3B'; break;
		case "Druid": $classColor = '#FF7D0A'; $safeColor = '#DF6A00'; break;
		case "Hunter": $classColor = '#ABD473'; $safeColor = '#00A800'; break;
		case "Mage": $classColor = '#69CCF0'; $safeColor = '#1CAFE8'; break;
		case "Paladin": $classColor = '#F58CBA'; $safeColor = '#F0579C'; break;
		case "Priest": $classColor = '#FFFFFF'; $safeColor = '#FFFFFF'; break;
		case "Rogue": $classColor = '#FFF569'; $safeColor = '#FFF569'; break;
		case "Shaman": $classColor = '#2459FF'; $safeColor = '#2459FF'; break;
		case "Warlock": $classColor = '#9482C9'; $safeColor = '#9482C9'; break;
		case "Warrior": $classColor = '#C79C6E'; $safeColor = '#B78246'; break;
		default: $classColor = '#000000';
	}
	if ($readable) 
		return $safeColor;
	else
		return $classColor;
}

function getArenaTeams($character = array(), $armoryLink) {	
	$Character = $character["characterinfo"]["character"];
	$maxWidth = 600;
	$teams = 0;
	
	if ($Character["arenateams"]["arenateam"]["size"] != "") { //just 1 arena team
		$teams = 1;
		$teamSize = $Character["arenateams"]["arenateam"]["size"];
		$output =  '<table width="200" border="0" cellspacing="0" cellpadding="0" class="charInfo">
              <tr>
                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td><div class="dropshadow">
						  <table width="150" border="0" cellpadding="0" cellspacing="0" class="arenaTeamTable">
							<tr class="rowA" style="background-color:#'.substr($Character["arenateams"]["arenateam"]["emblem"]["background"],2,6).';color:#'.substr($Character["arenateams"]["arenateam"]["emblem"]["iconcolor"],2,6).';">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"]["url"].'">';
		$output .= $Character["arenateams"]["arenateam"]["name"]; 
		$output .= '</a></td>
							</tr>
							<tr class="rowB">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"]["url"].'">';
		$output .= $Character["arenateams"]["arenateam"]["rating"];
		$output .= '</a></td>
							</tr>
							<tr class="rowC">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"]["url"].'"><span class="teamSizeText">'.$teamSize.'v'.$teamSize.'</span></a></td>
							</tr>
							</table>
						</div></td>
					  </tr>
					</table></td>
              </tr>
            </table>';
	}
	else if ($Character["arenateams"]["arenateam"]["0"]["size"] != "") { //2 or 3 arena teams
		$teams = 2;
		if ($Character["arenateams"]["arenateam"]["2"]["size"] != "") $teams = 3; //3 arena teams
		
		
		$output =  '<table width="'.($teams*200).'" border="0" cellspacing="0" cellpadding="0" class="charInfo">
              <tr>';
		$team2v2 = false;
		$team3v3 = false;
		$team5v5 = false;
		for ($i=0;$i<$teams;$i++) {		
		//prevent duplicates teams of the same size (blizzard bug)
		if ($Character["arenateams"]["arenateam"][$i]["size"]=="") { break; }
		if ($Character["arenateams"]["arenateam"][$i]["size"]==$Character["arenateams"]["arenateam"][$i+1]["size"]) { $teams++; continue; }
		if (!$team2v2 && $Character["arenateams"]["arenateam"][$i]["size"]=="2") { $team2v2 = true; }
		else if ($team2v2 && $Character["arenateams"]["arenateam"][$i]["size"]=="2") { $teams++; continue; }
		if (!$team3v3 && $Character["arenateams"]["arenateam"][$i]["size"]=="3") { $team3v3 = true; }
		else if ($team3v3 && $Character["arenateams"]["arenateam"][$i]["size"]=="3") { $teams++; continue; }
		if (!$team5v5 && $Character["arenateams"]["arenateam"][$i]["size"]=="5") { $team5v5 = true; }
		else if ($team5v5 && $Character["arenateams"]["arenateam"][$i]["size"]=="5") { $teams++; continue; }
			
		$teamSize = $Character["arenateams"]["arenateam"][$i]["size"];
		$output .= '<td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td><div class="dropshadow">
						  <table width="150" border="0" cellpadding="0" cellspacing="0" class="arenaTeamTable">
							<tr class="rowA" style="background-color:#'.substr($Character["arenateams"]["arenateam"]["emblem"][$i]["background"],2,6).';color:#'.substr($Character["arenateams"]["arenateam"]["emblem"][$i]["iconcolor"],2,6).';">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"][$i]["url"].'">';
		$output .= $Character["arenateams"]["arenateam"][$i]["name"]; 
		$output .= '</a></td>
							</tr>
							<tr class="rowB">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"][$i]["url"].'">';
		$output .= $Character["arenateams"]["arenateam"][$i]["rating"];
		$output .= '</a></td>
							</tr>
							<tr class="rowC">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="'.$armoryLink.'team-info.xml?'.$Character["arenateams"]["arenateam"][$i]["url"].'"><span class="teamSizeText">'.$teamSize.'v'.$teamSize.'</span></a></td>
							</tr>
							</table>
						</div></td>
					  </tr>
					</table></td>
					';
		}
		$output .= '</tr>
            </table>';
	}
	else { //no arena teams
		$teams = 0;
		$output =  '<table width="200" border="0" cellspacing="0" cellpadding="0" class="charInfo">
              <tr>
                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td><div class="dropshadow">
						  <table width="150" border="0" cellpadding="0" cellspacing="0" class="arenaTeamTable">
							<tr class="rowA">
							  <td width="150" colspan="2" align="center" valign="middle">';
		$output .= "No Arena Teams."; 
		$output .= '</td>
							</tr>
							</table>
						</div></td>
					  </tr>
					</table></td>
              </tr>
            </table>';
	}
	return $output;
}

function getAvgItemLevel($Items = array()) {
	$avgIlvl = "0";
	$totalIlvl = "0";
	$numItems = "0";
	$sizeofItems = sizeof($Items);
	for ($i=0;$i<$sizeofItems;$i++) {
		if ($Items[$i]["slot"] != "3" && $Items[$i]["slot"] != "18" && $Items[$i]["level"] != "")  {
			$totalIlvl += $Items[$i]["level"];
			$numItems++;
		}
	}
	
	if ($numItems > "0") {
		$avgIlvl = floor(($totalIlvl / $numItems));
	}
	
	return $avgIlvl;
}

function selectServer($string, $server) {
	//$server = str_replace('\'','\\\'',$server); // preg_replace('/\'/','\\\'',$server);
	$newString = "";
	$newString = str_replace('>'.$server.'<', ' selected="selected">'.$server.'<', $string); //  preg_replace('/>'.$server.'</', ' selected="selected">'.$server.'<', $string);
	//$newString = preg_replace('/value="'.$server.'"/', 'value="'.$server.'" selected="selected"', $string);
	$newString = stripslashes($newString);
	return $newString;
}

function getSpecList($className) {
	$specList = '';
	switch ($className) {
		case 'deathknight':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Blood">Blood</option><option value="Frost">Frost</option><option value="Unholy">Unholy</option></select>';
			break;
    case 'druid':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Balance">Balance</option><option value="Feral Combat">Feral Combat</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'hunter':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Beast Mastery">Beast Mastery</option><option value="Marksmanship">Marksmanship</option><option value="Survival">Survival</option></select>';
			break;
    case 'mage':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arcane">Arcane</option><option value="Fire">Fire</option><option value="Frost">Frost</option></select>';
			break;
    case 'paladin':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Holy">Holy</option><option value="Protection">Protection</option><option value="Retribution">Retribution</option></select>';
			break;
    case 'priest':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Discipline">Discipline</option><option value="Holy">Holy</option><option value="Shadow">Shadow</option></select>';
			break;
    case 'rogue':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Assassination">Assassination</option><option value="Combat">Combat</option><option value="Subtlety">Subtlety</option></select>';
			break;
    case 'shaman':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Elemental">Elemental</option><option value="Enhancement">Enhancement</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'warlock':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Affliction">Affliction</option><option value="Demonology">Demonology</option><option value="Destruction">Destruction</option></select>';
			break;
    case 'warrior':
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arms">Arms</option><option value="Fury">Fury</option><option value="Protection">Protection</option></select>';
			break;
	default:
			$specList = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option></select>';
			break;
	}
	return $specList;
}



function checkBrowserVersion() {
		$browser = get_browser(null, true);	
		$badBrowser = true;
											
		if ($browser['browser'] == 'IE' && $browser['version'] >= 7) $badBrowser = false;	
		if ($browser['browser'] == 'Firefox' && $browser['version'] >= 3) $badBrowser = false;	
		if ($browser['browser'] == 'Opera' && $browser['version'] >= 9) $badBrowser = false;		
		if ($browser['browser'] == 'Chrome' && $browser['version'] >= 4) $badBrowser = false;	
		if ($browser['browser'] == 'Safari' && $browser['version'] >= 4) $badBrowser = false;	
		if ($browser['version'] == 0 || $browser['version'] == '') $badBrowser = false; //new browsers are unrecognized	
	
		if ($badBrowser) echo '		<tr>
		<td colspan="5" align="center" valign="middle">';
		if ($badBrowser) echo '<table width="500" border="0" cellspacing="0" cellpadding="0" class="errorTable">
		  <tr>
			<td align="center" valign="middle" width="20"><img src="http://gearscores.com/images/warn.png" /></td><td align="center" valign="middle">'; 
		 if ($badBrowser) { echo 'This website may not display correctly with your browser. Please upgrade to the latest version to receive the full benefit this website has to offer.<br /><a href="http://www.mozilla.com/firefox/">Firefox</a> <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Internet Explorer</a> <a href="http://www.opera.com/download/">Opera</a> <a href="http://www.apple.com/safari/download/">Safari</a> <a href="http://www.google.com/chrome">Chrome</a>'; } 
		 if ($badBrowser) echo '</td>
		  </tr>
		</table>';
		if ($badBrowser) echo '</td>
		</tr>';
}


function printComments() {
	global $Comments, $Character, $region;
	$output = '';
	$goodComments = array();
	$Reported = array();
	
	
	$editComment = array();
	
	
	
	$commentsFormLoggedOut = '</td></tr><tr><td><hr />
<table width="550" border="0" cellspacing="0" cellpadding="0" align="left" class="loginPage">
<tr>
<td align="center" class="commentTitle">Log In to Leave a Comment</td>
</tr>
<tr>
<td align="center"><form id="loginPage" name="loginPage" method="post" action="http://gearscores.com/login.php" style="display:inline;">
													<table><tr><td align="left" class="loginEmail"><br />Email:<br /><input name="loginE" type="text" id="loginE" size="15" maxlength="100"/></td>
                                                </tr>
                                                <tr>
													<td align="left" class="loginPassword">Password:<br /><input name="loginP" type="password" id="loginP" size="15" maxlength="32"/></td>
                                                </tr>
                                                <tr>
													<td align="center" class="loginSubmit"><br /><input type="submit" name="submit1" id="submit1" value="Submit" /><input type="reset" name="reset1" id="reset1" value="Reset" /></td>
												</tr>
												<tr>
													<td align="left" class="loginLinks"><a href="http://gearscores.com/register.php"><br />New User? - Click here to Register</a><br />
													<a href="http://gearscores.com/forgotPassword.php">Forgot your Password? - Click Here</a></td></tr></table></form></td>
</tr>
</table>';
	
	
	$commentsFormLoggedInBlank = '</td></tr><tr><td><hr />
<table width="550" border="0" cellspacing="0" cellpadding="0" align="left">
<tr>
<td align="center" class="commentTitle">Leave a Comment</td>
</tr>
<tr>
<td align="center"><form id="comments1" name="comments1" method="post" action="http://gearscores.com/includes/postComment.php">
<span class="commentComment"><br />
  Comment: &nbsp;&nbsp;&nbsp;&nbsp;<span id="comments1countdown">0</span>/500 characters used.<br />
  <label>
    <textarea name="comment" id="comments1comment" cols="45" rows="5"  onKeyDown="limitText(this.form.comments1comment,\'comments1countdown\',500);" 
onKeyUp="limitText(this.form.comments1comment,\'comments1countdown\',500);"></textarea>
  </label></span>
  <br /><br />
  <input type="hidden" name="n" value="'.$Character["name"].'">
  <input type="hidden" name="s" value="'.$Character["realm"].'">
  <input type="hidden" name="r" value="'.$region.'">
  <input type="submit" name="button" id="button" value="Submit" />
  <input type="reset" name="reset" id="reset" value="Reset" />
  <br />
</form></td>
</tr>
</table>';	
	
	
	
	$commentsForm = '';
	
	$sizeofComments = sizeof($Comments);
	for ($i=0;$i<$sizeofComments;$i++) {
		$Reported = unserialize($Comments[$i]['reported']);
		if (!(sizeof($Reported) >= 3 && sizeof($Reported) >= (2*sizeof(unserialize($Comments[$i]['yes']))))) {
			if (!(sizeof(unserialize($Comments[$i]['yes'])) - sizeof(unserialize($Comments[$i]['no'])) <= -10)) $goodComments[] = $Comments[$i];
		}
	}
	if (sizeof($goodComments)<1) {
		$output .= '                            <tr>
									<td>
										<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td><div class="noComments">No Comments</div></td>
											</tr>
											'.(isset($_COOKIE['loginA'])? $commentsFormLoggedInBlank : $commentsFormLoggedOut).'
										</table>
									</td>
								</tr>
	';
	}
	else {
		$sizeofGoodComments = sizeof($goodComments);
		for ($i=0;$i<$sizeofGoodComments;$i++) {
			if ((sizeof(unserialize($goodComments[$i]['yes']))+sizeof(unserialize($goodComments[$i]['no']))) > 6) {
				$rating = ceil(sizeof(unserialize($goodComments[$i]['yes']))-sizeof(unserialize($goodComments[$i]['no'])));
			}
			else {
				$rating = min(3,max(1,sizeof(unserialize($goodComments[$i]['yes']))));
			}
			if ($rating >= 0) $rating = '+'.$rating;
			if ($rating >= 20) $color = 'epic';
			else if ($rating >= 10) $color = 'superior';
			else if ($rating > 0) $color = 'uncommon';
			else $color = 'trash';
			
			$output .= '                            <tr>
										<td>
										<div class="dropshadow">
											<table width="550" border="0" cellspacing="0" cellpadding="0" class="innerCommentsTable">
												<tr>
													<td align="left" class="rowA '.$color.'"><b>'.$goodComments[$i]['name'].'</b> (User:'.(substr(md5($goodComments[$i]['email']),0,8)).') on '.date('F j, Y',$goodComments[$i]['time']).'</td>
													<td align="right" class="rowA '.$color.'"><b>Rating '.$rating.'</b> <span id="comment'.$goodComments[$i]['id'].'"><a href="javascript:voteComment(\''.$goodComments[$i]['id'].'\',\'yes\',\'comment'.$goodComments[$i]['id'].'\');">[+]</a> <a href="javascript:voteComment(\''.$goodComments[$i]['id'].'\',\'no\',\'comment'.$goodComments[$i]['id'].'\');">[-]</a> <a href="javascript:voteComment(\''.$goodComments[$i]['id'].'\',\'report\',\'comment'.$goodComments[$i]['id'].'\');">Report</a></span></td>
												</tr>
												<tr>
													<td align="left" class="rowB '.$color.'" colspan="2">'.$goodComments[$i]['comment'].'</td>
												</tr>';
												
			if ($goodComments[$i]['email'] == $_COOKIE['loginE']) {
				$output .= '<tr><td align="left" class="rowC"><a href="#postComment">Edit Comment [&#10003;]</a></td><td align="right" class="rowC"><a href="http://gearscores.com/includes/deleteComment.php?id='.$goodComments[$i]['id'].'&amp;n='.$Character["name"].'&amp;s='.$Character["realm"].'&amp;r='.$region.'">Delete Comment [X]</a></td></tr>';
					$commentsForm = '</td></tr><tr><td><hr />
				<a name="postComment"></a><table width="550" border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
				<td align="center" class="commentTitle">Edit your comment</td>
				</tr>
				<tr>
				<td align="center"><form id="comments1" name="comments1" method="post" action="http://gearscores.com/includes/postComment.php">
				<span class="commentComment"><br />
				  Comment: &nbsp;&nbsp;&nbsp;&nbsp;<span id="comments1countdown">0</span>/500 characters used.<br />
				  <label>
					<textarea name="comment" id="comments1comment" cols="45" rows="5"  onKeyDown="limitText(this.form.comments1comment,\'comments1countdown\',500);" 
				onKeyUp="limitText(this.form.comments1comment,\'comments1countdown\',500);">'.$goodComments[$i]['comment'].'</textarea>
				  </label></span>
				  <br /><br />
				  <input type="hidden" name="n" value="'.$Character["name"].'">
				  <input type="hidden" name="s" value="'.$Character["realm"].'">
				  <input type="hidden" name="r" value="'.$region.'">
				  <input type="hidden" name="id" value="'.$goodComments[$i]['id'].'">
				  <input type="hidden" name="special" value="edit">
				  <input type="submit" name="button" id="button" value="Submit" />
				  <input type="reset" name="reset" id="reset" value="Reset" />
				  <br />
				</form></td>
				</tr>
				</table>
				';
			}

			$output .= '</table>
										</div>
										';
			if ($goodComments[($i+1)]['comment'] == '') $output .= (isset($_COOKIE['loginA'])? (($commentsForm == '')? $commentsFormLoggedInBlank : $commentsForm) : $commentsFormLoggedOut);
			$output .= '
										</td>
									</tr>
		';
		}
	}
	
	return $output;
}


function isValidEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
	  $isValid = false;
   }
   else
   {
	  $domain = substr($email, $atIndex+1);
	  $local = substr($email, 0, $atIndex);
	  $localLen = strlen($local);
	  $domainLen = strlen($domain);
	  if ($localLen < 1 || $localLen > 64)
	  {
		 // local part length exceeded
		 $isValid = false;
	  }
	  else if ($domainLen < 1 || $domainLen > 255)
	  {
		 // domain part length exceeded
		 $isValid = false;
	  }
	  else if ($local[0] == '.' || $local[$localLen-1] == '.')
	  {
		 // local part starts or ends with '.'
		 $isValid = false;
	  }
	  else if (preg_match('/\\.\\./', $local))
	  {
		 // local part has two consecutive dots
		 $isValid = false;
	  }
	  else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
	  {
		 // character not valid in domain part
		 $isValid = false;
	  }
	  else if (preg_match('/\\.\\./', $domain))
	  {
		 // domain part has two consecutive dots
		 $isValid = false;
	  }
	  else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
				 str_replace("\\\\","",$local)))
	  {
		 // character not valid in local part unless 
		 // local part is quoted
		 if (!preg_match('/^"(\\\\"|[^"])+"$/',
			 str_replace("\\\\","",$local)))
		 {
			$isValid = false;
		 }
	  }
	  if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
	  {
		 // domain not found in DNS
		 $isValid = false;
	  }
   }
   return $isValid;
}

function waitInQueue($maxWaitTime = 20, $waitTime = 2) {
	$result = false;
	$i=0;
	
	while (!$result && $i < ($maxWaitTime/$waitTime)) {
		$curTime = microtime(true);
		$query = "SELECT `time` FROM `queryQueue` WHERE `id` =1 LIMIT 1";
		$result = mysql_query($query);
		$row =  mysql_fetch_assoc($result);
		$queryTime = $row['time'];
		
		if ($curTime <= ($queryTime+$waitTime)) {
			usleep((($queryTime+$waitTime)-$curTime)*1000000);
		}
		
		usleep(rand(10,50)*1000); //wait .001 - .005 seconds
		$newTime = microtime(true);
		$query = "UPDATE `gearscor_gsdb`.`queryQueue` SET `time` = '".$newTime."' WHERE `queryQueue`.`time` = '".$queryTime."' AND `id` =1 LIMIT 1";
		$result = mysql_query($query);
		$query = "SELECT `time` FROM `queryQueue` WHERE `time` = '".$newTime."' AND `id` =1 LIMIT 1";
		$result = mysql_query($query);
		$result =  mysql_num_rows($result);
		$i++;
	}
	if ($i < ($maxWaitTime/$waitTime)) return true;
	else return false;
}

function waitInQueue2($maxWaitTime = 20, $waitTime = 2) {
	$result = false;
	$i=0;
	
	while (!$result && $i < ($maxWaitTime/$waitTime)) {
		$curTime = microtime(true);
		$query = "SELECT * FROM `queryQueue` ORDER BY `time` ASC LIMIT 1";
		$result = mysql_query($query);
		$row =  mysql_fetch_assoc($result);
		$queryTime = $row['time'];
		$queryId = $row['id'];
		$queryIpAddress = $row['ip'];
		
		if ($curTime <= ($queryTime+$waitTime)) {
			usleep((($queryTime+$waitTime)-$curTime)*1000000);
		}
		
		usleep(rand(10,50)*1000); //wait .001 - .005 seconds
		$newTime = microtime(true);
		$query = "UPDATE `gearscor_gsdb`.`queryQueue` SET `time` = '".$newTime."' WHERE `queryQueue`.`time` = '".$queryTime."' AND `id` ='".$queryId."' LIMIT 1";
		$result = mysql_query($query);
		$query = "SELECT * FROM `queryQueue` WHERE `time` = '".$newTime."' AND `id` ='".$queryId."' LIMIT 1";
		$result = mysql_query($query);
		$result =  mysql_num_rows($result);
		$i++;
		//echo $newTime.'<br />';
	}
	if ($i < ($maxWaitTime/$waitTime)) return $queryIpAddress;
	else return false;
}

function multimplode($spacer,$array) 
    {
    if (!is_array($array))
        {
        return($array);
        }    
    if (empty($spacer))
        {
        return(multimplode('	',$array)); 
        }
    else
        {
        $trenn=$spacer;
        while (list($key,$val) = each($array))
            {
            if (is_array($val)) 
                {
                $array[$key]=multimplode($spacer,$val);
                }
            }
        $array=implode($trenn,$array);
        return($array);
        }
    }


function updateWowItem($wowItem, $insertNewItem = FALSE) {
			if ($insertNewItem) {
				$wowItemSql = "INSERT INTO `gearscor_gsdb`.`items` (`id` ,`name` ,`level` ,`icon` ,`rarity` ,`slot` ,`str` ,`agi` ,`sta` ,`int` ,`spi` ,`block` ,`blockvalue` ,`dodge` ,`parry` ,`resilience` ,`armorpen` ,`expertise` ,`defense` ,`attackpower` ,`crit` ,`tohit` ,`haste` ,`arcaneres` ,`frostres` ,`fireres` ,`shadowres` ,`spellpen` ,`spellpow` ,`manareg` ,`sockets` ,`updated` ) VALUES (";
				$wowItemSql .= "'".$wowItem['item']['id']."', ";
				$wowItemSql .= "'".mysql_real_escape_string($wowItem['item']['name'])."', ";
				$wowItemSql .= "'".$wowItem['item']['level']."', ";
				$wowItemSql .= "'".mysql_real_escape_string(strtolower($wowItem['item']['icon'][1]))."', ";
				$wowItemSql .= "'".$wowItem['item']['quality'][0]['id']."', ";
				$wowItemSql .= "'".$wowItem['item']['json']['slot']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['str']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['agi']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['sta']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['int']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['spi']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['blockrtng']."', ";  //block
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['block']."', ";  //blockvalue
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['dodgertng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['parryrtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['resirtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['armorpenrtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['exprtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['defrtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['atkpwr']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['critstrkrtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['hitrtng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['hastertng']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['arcres']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['frores']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['firres']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['shares']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['splpen']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['splpwr']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['manargn']."', ";
				$wowItemSql .= "'".$wowItem['item']['jsonequip']['nsockets']."', ";
				$wowItemSql .= "'".time()."' )";
				$wowItemSql .= ";";
			}
			else {
				$wowItemSql = "UPDATE `gearscor_gsdb`.`items` SET ";
				$wowItemSql .= "`id` = '".$wowItem['item']['id']."', ";
				$wowItemSql .= "`name` = '".mysql_real_escape_string($wowItem['item']['name'])."', ";
				$wowItemSql .= "`level` = '".$wowItem['item']['level']."', ";
				$wowItemSql .= "`icon` = '".mysql_real_escape_string(strtolower($wowItem['item']['icon'][1]))."', ";
				$wowItemSql .= "`rarity` = '".$wowItem['item']['quality'][0]['id']."', ";
				$wowItemSql .= "`slot` = '".$wowItem['item']['json']['slot']."', ";
				$wowItemSql .= "`str` = '".$wowItem['item']['jsonequip']['str']."', ";
				$wowItemSql .= "`agi` = '".$wowItem['item']['jsonequip']['agi']."', ";
				$wowItemSql .= "`sta` = '".$wowItem['item']['jsonequip']['sta']."', ";
				$wowItemSql .= "`int` = '".$wowItem['item']['jsonequip']['int']."', ";
				$wowItemSql .= "`spi` = '".$wowItem['item']['jsonequip']['spi']."', ";
				$wowItemSql .= "`block` = '".$wowItem['item']['jsonequip']['blockrtng']."', ";  //block
				$wowItemSql .= "`blockvalue` = '".$wowItem['item']['jsonequip']['block']."', ";  //blockvalue
				$wowItemSql .= "`dodge` = '".$wowItem['item']['jsonequip']['dodgertng']."', ";
				$wowItemSql .= "`parry` = '".$wowItem['item']['jsonequip']['parryrtng']."', ";
				$wowItemSql .= "`resilience` = '".$wowItem['item']['jsonequip']['resirtng']."', ";
				$wowItemSql .= "`armorpen` = '".$wowItem['item']['jsonequip']['armorpenrtng']."', ";
				$wowItemSql .= "`expertise` = '".$wowItem['item']['jsonequip']['exprtng']."', ";
				$wowItemSql .= "`defense` = '".$wowItem['item']['jsonequip']['defrtng']."', ";
				$wowItemSql .= "`attackpower` = '".$wowItem['item']['jsonequip']['atkpwr']."', ";
				$wowItemSql .= "`crit` = '".$wowItem['item']['jsonequip']['critstrkrtng']."', ";
				$wowItemSql .= "`tohit` = '".$wowItem['item']['jsonequip']['hitrtng']."', ";
				$wowItemSql .= "`haste` = '".$wowItem['item']['jsonequip']['hastertng']."', ";
				$wowItemSql .= "`arcaneres` = '".$wowItem['item']['jsonequip']['arcres']."', ";
				$wowItemSql .= "`frostres` = '".$wowItem['item']['jsonequip']['frores']."', ";
				$wowItemSql .= "`fireres` = '".$wowItem['item']['jsonequip']['firres']."', ";
				$wowItemSql .= "`shadowres` = '".$wowItem['item']['jsonequip']['shares']."', ";
				$wowItemSql .= "`spellpen` = '".$wowItem['item']['jsonequip']['splpen']."', ";
				$wowItemSql .= "`spellpow` = '".$wowItem['item']['jsonequip']['splpwr']."', ";
				$wowItemSql .= "`manareg` = '".$wowItem['item']['jsonequip']['manargn']."', ";
				$wowItemSql .= "`sockets` = '".$wowItem['item']['jsonequip']['nsockets']."', ";
				$wowItemSql .= "`updated` = '".time()."' ";
				$wowItemSql .= "WHERE `id` = '".$wowItem['item']['id']."' LIMIT 1;";
			}
			$result = mysql_query($wowItemSql);
}

function compressCharArray($character = array()) {
	$newCharArray = array();
	
	$arenaTeamsArrayCompensator = 0;
	if (sizeof($character['characterinfo']['character']['arenateams']['arenateam']['members']) > 0) $arenaTeamsArrayCompensator++;
	
	$newCharArray['gsvars']['numTalents'] = 0;
	$newCharArray['gsvars']['numProfessions'] = 0;
	$newCharArray['gsvars']['numArenas'] = 0;		
	
	$newCharArray['characterinfo']['character']['battlegroup'] = $character['characterinfo']['character']['battlegroup'] ;
	$newCharArray['characterinfo']['character']['gender'] = $character['characterinfo']['character']['gender'] ;
	$newCharArray['characterinfo']['character']['lastmodified'] = $character['characterinfo']['character']['lastmodified'] ;
	$newCharArray['characterinfo']['character']['prefix'] = $character['characterinfo']['character']['prefix'] ;
	$newCharArray['characterinfo']['character']['suffix'] = $character['characterinfo']['character']['suffix'] ;
	   
	if ($character['characterinfo']['character']['arenateams']['arenateam']['name']!="") {
		$newCharArray['gsvars']['numArenas'] = 1;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['name'] = $character['characterinfo']['character']['arenateams']['arenateam']['name'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['ranking'] = $character['characterinfo']['character']['arenateams']['arenateam']['ranking'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['rating'] = $character['characterinfo']['character']['arenateams']['arenateam']['rating'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['seasongamesplayed'] = $character['characterinfo']['character']['arenateams']['arenateam']['seasongamesplayed'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['seasongameswon'] = $character['characterinfo']['character']['arenateams']['arenateam']['seasongameswon'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['size'] = $character['characterinfo']['character']['arenateams']['arenateam']['size'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['background'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem']['background'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['bordercolor'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem']['bordercolor'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['borderstyle'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem']['borderstyle'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconcolor'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconcolor'] ;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconstyle'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconstyle'] ;
	}
	else if ($character['characterinfo']['character']['arenateams']['arenateam'][0]['name']!="") {
		$sizeofCharacter = sizeof($character['characterinfo']['character']['arenateams']['arenateam']);
		for ($i=0;$i<($sizeofCharacter-1-$arenaTeamsArrayCompensator);$i++) {  
			$newCharArray['gsvars']['numArenas'] = ($i+1);	
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['name'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['name'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['ranking'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['ranking'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['rating'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['rating'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['seasongamesplayed'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['seasongamesplayed'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['seasongameswon'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['seasongameswon'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$i]['size'] = $character['characterinfo']['character']['arenateams']['arenateam'][$i]['size'] ;
		}
		$sizeofCharacter = sizeof($character['characterinfo']['character']['arenateams']['arenateam']);
		for ($i=0;$i<($sizeofCharacter-1-$arenaTeamsArrayCompensator);$i++) { 
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['background'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['background'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['bordercolor'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['bordercolor'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['borderstyle'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['borderstyle'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['iconcolor'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['iconcolor'] ;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['iconstyle'] = $character['characterinfo']['character']['arenateams']['arenateam']['emblem'][$i]['iconstyle'] ;
		}
	}
	   
	if ($character['characterinfo']['charactertab']['talentspecs']['talentspec'][0]["prim"]!='' || $character['characterinfo']['charactertab']['talentspecs']['talentspec'][1]["prim"]!='') {
		for ($i=0;$i<2;$i++) {  
			$newCharArray['gsvars']['numTalents'] = ($i+1);
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['active'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['active'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['group'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['group'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['prim'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['prim'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treeone'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treeone'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treethree'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treethree'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treetwo'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec'][$i]['treetwo'] ;
		}   
	}
	else if ($character['characterinfo']['charactertab']['talentspecs']['talentspec']["prim"]!='') {
			$newCharArray['gsvars']['numTalents'] = 1;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['active'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['active'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['group'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['group'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['prim'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['prim'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treeone'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['treeone'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treethree'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['treethree'] ;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treetwo'] = $character['characterinfo']['charactertab']['talentspecs']['talentspec']['treetwo'] ;
	}
	  
	if ($character['characterinfo']['charactertab']['professions']['skill'][0]["name"] != "") {
		for ($i=0;$i<2;$i++) { 
			$newCharArray['gsvars']['numProfessions'] = ($i+1);
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$i]['id'] = $character['characterinfo']['charactertab']['professions']['skill'][$i]['id'] ;
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$i]['max'] = $character['characterinfo']['charactertab']['professions']['skill'][$i]['max'];
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$i]['name'] = $character['characterinfo']['charactertab']['professions']['skill'][$i]['name'] ;
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$i]['value'] = $character['characterinfo']['charactertab']['professions']['skill'][$i]['value'] ;
		}   
	}
	else if ($character['characterinfo']['charactertab']['professions']['skill']["name"] != "") {
			$newCharArray['gsvars']['numProfessions'] = 1;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['id'] = $character['characterinfo']['charactertab']['professions']['skill']['id'] ;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['max'] = $character['characterinfo']['charactertab']['professions']['skill']['max'];
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['name'] = $character['characterinfo']['charactertab']['professions']['skill']['name'] ;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['value'] = $character['characterinfo']['charactertab']['professions']['skill']['value'] ;
	}
	   
	$newCharArray['characterinfo']['charactertab']['characterbars']['health']['effective'] = $character['characterinfo']['charactertab']['characterbars']['health']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['casting'] = $character['characterinfo']['charactertab']['characterbars']['secondbar']['casting'] ;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['effective'] = $character['characterinfo']['charactertab']['characterbars']['secondbar']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['notcasting'] = $character['characterinfo']['charactertab']['characterbars']['secondbar']['notcasting'] ;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['type'] = $character['characterinfo']['charactertab']['characterbars']['secondbar']['type'] ;
	   
	$newCharArray['characterinfo']['charactertab']['basestats']['strength']['effective'] = $character['characterinfo']['charactertab']['basestats']['strength']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['basestats']['agility']['effective'] = $character['characterinfo']['charactertab']['basestats']['agility']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['basestats']['stamina']['effective'] = $character['characterinfo']['charactertab']['basestats']['stamina']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['basestats']['intellect']['effective'] = $character['characterinfo']['charactertab']['basestats']['intellect']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['basestats']['spirit']['effective'] = $character['characterinfo']['charactertab']['basestats']['spirit']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['basestats']['armor']['effective'] = $character['characterinfo']['charactertab']['basestats']['armor']['effective'] ;
	   
	$newCharArray['characterinfo']['charactertab']['melee']['power']['effective'] = $character['characterinfo']['charactertab']['melee']['power']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['melee']['hitrating']['increasedhitpercent'] = $character['characterinfo']['charactertab']['melee']['hitrating']['increasedhitpercent'] ;
	$newCharArray['characterinfo']['charactertab']['melee']['hitrating']['reducedarmorpercent'] = $character['characterinfo']['charactertab']['melee']['hitrating']['reducedarmorpercent'] ;
	$newCharArray['characterinfo']['charactertab']['melee']['critchance']['percent'] = $character['characterinfo']['charactertab']['melee']['critchance']['percent'] ;
	$newCharArray['characterinfo']['charactertab']['melee']['expertise']['value'] = $character['characterinfo']['charactertab']['melee']['expertise']['value'] ;
	   
	$newCharArray['characterinfo']['charactertab']['ranged']['power']['effective'] = $character['characterinfo']['charactertab']['ranged']['power']['effective'] ;
	$newCharArray['characterinfo']['charactertab']['ranged']['speed']['hastepercent'] = $character['characterinfo']['charactertab']['ranged']['speed']['hastepercent'] ;
	$newCharArray['characterinfo']['charactertab']['ranged']['hitrating']['increasedhitpercent'] = $character['characterinfo']['charactertab']['ranged']['hitrating']['increasedhitpercent'] ;
	$newCharArray['characterinfo']['charactertab']['ranged']['hitrating']['reducedarmorpercent'] = $character['characterinfo']['charactertab']['ranged']['hitrating']['reducedarmorpercent'] ;
	$newCharArray['characterinfo']['charactertab']['ranged']['critchance']['percent'] = $character['characterinfo']['charactertab']['ranged']['critchance']['percent'] ;
	   
	$newCharArray['characterinfo']['charactertab']['spell']['bonusdamage']['holy']['value'] = $character['characterinfo']['charactertab']['spell']['bonusdamage']['holy']['value'] ;
	$newCharArray['characterinfo']['charactertab']['spell']['bonushealing']['value'] = $character['characterinfo']['charactertab']['spell']['bonushealing']['value'] ;
	$newCharArray['characterinfo']['charactertab']['spell']['hitrating']['increasedhitpercent'] = $character['characterinfo']['charactertab']['spell']['hitrating']['increasedhitpercent'] ;
	$newCharArray['characterinfo']['charactertab']['spell']['critchance']['holy']['percent'] = $character['characterinfo']['charactertab']['spell']['critchance']['holy']['percent'] ;
	$newCharArray['characterinfo']['charactertab']['spell']['hasterating']['hastepercent'] = $character['characterinfo']['charactertab']['spell']['hasterating']['hastepercent'] ;
	$newCharArray['characterinfo']['charactertab']['spell']["manaregen"]["notcasting"] = $character['characterinfo']['charactertab']['spell']["manaregen"]["notcasting"] ;
	$newCharArray['characterinfo']['charactertab']['spell']["penetration"]["value"] = $character['characterinfo']['charactertab']['spell']["penetration"]["value"] ;
	   
	$newCharArray['characterinfo']['charactertab']['defenses']['defense']['value'] = $character['characterinfo']['charactertab']['defenses']['defense']['value'] ;
	$newCharArray['characterinfo']['charactertab']['defenses']['dodge']['percent'] = $character['characterinfo']['charactertab']['defenses']['dodge']['percent'] ;
	$newCharArray['characterinfo']['charactertab']['defenses']['parry']['percent'] = $character['characterinfo']['charactertab']['defenses']['parry']['percent'] ;
	$newCharArray['characterinfo']['charactertab']['defenses']['block']['percent'] = $character['characterinfo']['charactertab']['defenses']['block']['percent'] ;
	$newCharArray['characterinfo']['charactertab']['defenses']['resilience']['value'] = $character['characterinfo']['charactertab']['defenses']['resilience']['value'] ;
	   
	if ($character['characterinfo']['charactertab']['items']['item']['id'] != '') { //only 1 item
		$singleItem[0] = $character['characterinfo']['charactertab']['items']['item'];
		unset($character['characterinfo']['charactertab']['items']['item']);
		$character['characterinfo']['charactertab']['items']['item'] = $singleItem;
	}
	$sizeofCharacter = sizeof($character['characterinfo']['charactertab']['items']['item']);
	for ($i=0;$i<$sizeofCharacter;$i++) {   
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['gem0id'] = $character['characterinfo']['charactertab']['items']['item'][$i]['gem0id'] ;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['gem1id'] = $character['characterinfo']['charactertab']['items']['item'][$i]['gem1id'] ;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['gem2id'] = $character['characterinfo']['charactertab']['items']['item'][$i]['gem2id'] ;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['id'] = $character['characterinfo']['charactertab']['items']['item'][$i]['id'] ;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['permanentenchant'] = $character['characterinfo']['charactertab']['items']['item'][$i]['permanentenchant'] ;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$i]['slot'] = $character['characterinfo']['charactertab']['items']['item'][$i]['slot'] ;
		//search for item in database
		//----------begin item update
			if ($_SERVER['REMOTE_ADDR'] == '129.118.122.72' && $character['characterinfo']['charactertab']['items']['item'][$i]['id'] > 0) 		
			{
			$query = "SELECT `id`, `updated` FROM `items` WHERE `id` = '".mysql_real_escape_string($character['characterinfo']['charactertab']['items']['item'][$i]['id'])."' LIMIT 1";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC); 
			//if found the check to see if it needs to be updated
			if ($row['id'] > 0) {
				//if it's over 2 weeks old then update
				if ($row['updated'] < (time()-(60*60*24*7*2))) {
					$wowItem = getXmlAsArray(file_get_contents('http://www.wowhead.com/item='.$character['characterinfo']['charactertab']['items']['item'][$i]['id'].'&xml'));
					$wowItem['item']['json'] = json_decode('{'.$wowItem['item']['json'].'}',TRUE);
					$wowItem['item']['jsonequip'] = json_decode('{'.$wowItem['item']['jsonequip'].'}',TRUE);
					updateWowItem($wowItem);
				}
			}
			//else insert it into database
			else {
				$wowItem = getXmlAsArray(file_get_contents('http://www.wowhead.com/item='.$character['characterinfo']['charactertab']['items']['item'][$i]['id'].'&xml'));
				$wowItem['item']['json'] = json_decode('{'.$wowItem['item']['json'].'}',TRUE);
				$wowItem['item']['jsonequip'] = json_decode('{'.$wowItem['item']['jsonequip'].'}',TRUE);
				updateWowItem($wowItem,TRUE);
			} 
		//-----------end item update
		}
	}
	$newCharStr = multimplode('	',$newCharArray);
	//$newCharStr = preg_replace('/\.00/','',$newCharStr);
	$newCharStr = gzcompress($newCharStr,9);
	return $newCharStr;
}

    /**
     * Converts an XML string into an associative array, duplicating the XML structure.
     * @access      protected
     * @param       string      $xmlData                The XML data string to convert.
     * @param       bool        $includeTopTag          Whether or not the topmost XML tag should be included in the array. The default value for this is FALSE.
     * @param       bool        $lowerCaseTags          Whether or not tags should be set to lower case. Default value for this parameter is TRUE.
     * @return      array       $result                 An associative array duplicating the XML structure.
     */
    function getXmlAsArray($xmlData, $includeTopTag = FALSE, $lowerCaseTags = TRUE) {

        $xmlArray = array();

        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $xmlData, $vals, $index);
        xml_parser_free($parser);

        $temp = $depth = array();

        foreach ($vals as $value) {

            switch ($value['type']) {

                case 'open':
                case 'complete':
                    array_push($depth, $value['tag']);
                    $p = join('::', $depth);
                    if ($lowerCaseTags) {

                        $p = strtolower($p);
                        if (is_array($value['attributes']))
                            $value['attributes'] = array_change_key_case($value['attributes']);

                    }

                    $data = ( $value['attributes'] ? array($value['attributes']) : array());
                    $data = ( trim($value['value']) ? array_merge($data, array($value['value'])) : $data);

                    if ($temp[$p]) {

                        $temp[$p] = array_merge($temp[$p], $data);

                    } else {

                        $temp[$p] = $data;

                    }

                    if ($value['type']=='complete') {

                        array_pop($depth);

                    }
                    break;

                case 'close':
                    array_pop($depth);
                break;

            }  // switch

        } // foreach

        if (!$includeTopTag) {

            unset($temp["page"]);

        }

        foreach ($temp as $key => $value) {

            if (count($value)==1) {

                $value = reset($value);

            }

            $levels = explode('::', $key);
            $num_levels = count($levels);

            if ($num_levels==1) {

                $xmlArray[$levels[0]] = $value;

            } else {

                $pointer = &$xmlArray;
                for ($i=0; $i<$num_levels; $i++) {

                    if ( !isset( $pointer[$levels[$i]] ) ) {

                        $pointer[$levels[$i]] = array();

                    }

                $pointer = &$pointer[$levels[$i]];

                } // for

            $pointer = $value;

            } // if

        } // foreach

        return ($includeTopTag ? $xmlArray : reset($xmlArray));

    }

function uncompressCharArray($row = array(), $xmlArray = array()) {
	$xmlArray = gzuncompress($xmlArray);
	$xmlArray = explode('	',$xmlArray);
	$i=3;
	$newCharArray['characterinfo']['character']['battlegroup'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['character']['charurl'] = 'r='.urlencode($row['server']).'&cn='.urlencode($row['name']);
	$newCharArray['characterinfo']['character']['class'] = $row['class'];
	switch ($row['race']) {
		case 'Draenei':
		case 'Dwarf':
		case 'Gnome':
		case 'Human':
		case 'Night Elf':
		case 'Worgen':
			$newCharArray['characterinfo']['character']['faction'] = 'Alliance';
			break;
		default:
			$newCharArray['characterinfo']['character']['faction'] = 'Horde';
	}
	$newCharArray['characterinfo']['character']['gender'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['character']['guildname'] = $row['guild'];
	$newCharArray['characterinfo']['character']['guildurl'] = (($row['guild'] != '')? 'r='.urlencode($row['server']).'&gn='.urlencode($row['guild']) : '');
	$newCharArray['characterinfo']['character']['lastmodified'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['character']['level'] = $row['level'];
	$newCharArray['characterinfo']['character']['name'] = $row['name'];
	$newCharArray['characterinfo']['character']['prefix'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['character']['race'] = $row['race'];
	$newCharArray['characterinfo']['character']['realm'] = $row['server'];
	$newCharArray['characterinfo']['character']['suffix'] = $xmlArray[$i]; $i++;
	   
	if ($xmlArray[2] == 1) {
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['name'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['ranking'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['rating'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['seasongamesplayed'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['seasongameswon'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['size'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['url'] = 'r='.urlencode($row['server']).'&ts='.$newCharArray['characterinfo']['character']['arenateams']['arenateam']['size'].'&t='.urlencode($newCharArray['characterinfo']['character']['arenateams']['arenateam']['name']).'&select='.urlencode($newCharArray['characterinfo']['character']['arenateams']['arenateam']['name']);
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['background'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['bordercolor'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['borderstyle'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconcolor'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem']['iconstyle'] = $xmlArray[$i]; $i++;
	}
	else if ($xmlArray[2] > 1) {
		for ($x=0;$x<$xmlArray[2];$x++) {   
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['name'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['ranking'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['rating'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['seasongamesplayed'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['seasongameswon'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['size'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['url'] = 'r='.urlencode($row['server']).'&ts='.$newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['size'].'&t='.urlencode($newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['name']).'&select='.urlencode($newCharArray['characterinfo']['character']['arenateams']['arenateam'][$x]['name']);
		}
		for ($x=0;$x<$xmlArray[2];$x++) { 
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$x]['background'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$x]['bordercolor'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$x]['borderstyle'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$x]['iconcolor'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['character']['arenateams']['arenateam']['emblem'][$x]['iconstyle'] = $xmlArray[$i]; $i++;
		}
	}
	   
	if ($xmlArray[0] > 1) {
		for ($x=0;$x<$xmlArray[0];$x++) {   
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['active'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['group'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['prim'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['treeone'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['treethree'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec'][$x]['treetwo'] = $xmlArray[$i]; $i++;
		}   
	}
	else if ($xmlArray[0] == 1) {
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['active'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['group'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['prim'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treeone'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treethree'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['talentspecs']['talentspec']['treetwo'] = $xmlArray[$i]; $i++;
	}
	  
	if ($xmlArray[1] > 1) {
		for ($x=0;$x<$xmlArray[1];$x++) {   
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$x]['id'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$x]['max'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$x]['name'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill'][$x]['value'] = $xmlArray[$i]; $i++;
		}   
	}
	else if ($xmlArray[1] == 1) {
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['id'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['max'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['name'] = $xmlArray[$i]; $i++;
			$newCharArray['characterinfo']['charactertab']['professions']['skill']['value'] = $xmlArray[$i]; $i++;
	}
	   
	$newCharArray['characterinfo']['charactertab']['characterbars']['health']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['casting'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['notcasting'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['characterbars']['secondbar']['type'] = $xmlArray[$i]; $i++;
	   
	$newCharArray['characterinfo']['charactertab']['basestats']['strength']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['basestats']['agility']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['basestats']['stamina']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['basestats']['intellect']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['basestats']['spirit']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['basestats']['armor']['effective'] = $xmlArray[$i]; $i++;
	   
	$newCharArray['characterinfo']['charactertab']['melee']['power']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['melee']['hitrating']['increasedhitpercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['melee']['hitrating']['reducedarmorpercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['melee']['critchance']['percent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['melee']['expertise']['value'] = $xmlArray[$i]; $i++;
	   
	$newCharArray['characterinfo']['charactertab']['ranged']['power']['effective'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['ranged']['speed']['hastepercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['ranged']['hitrating']['increasedhitpercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['ranged']['hitrating']['reducedarmorpercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['ranged']['critchance']['percent'] = $xmlArray[$i]; $i++;
	   
	$newCharArray['characterinfo']['charactertab']['spell']['bonusdamage']['holy']['value'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']['bonushealing']['value'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']['hitrating']['increasedhitpercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']['critchance']['holy']['percent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']['hasterating']['hastepercent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']["manaregen"]["notcasting"] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['spell']["penetration"]["value"] = $xmlArray[$i]; $i++;
	   
	$newCharArray['characterinfo']['charactertab']['defenses']['defense']['value'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['defenses']['dodge']['percent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['defenses']['parry']['percent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['defenses']['block']['percent'] = $xmlArray[$i]; $i++;
	$newCharArray['characterinfo']['charactertab']['defenses']['resilience']['value'] = $xmlArray[$i]; $i++;
	   
	for ($x=0;$xmlArray[$i] !== NULL;$x++) {   
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['gem0id'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['gem1id'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['gem2id'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['id'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['permanentenchant'] = $xmlArray[$i]; $i++;
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['slot'] = $xmlArray[$i]; $i++;
		$query = "SELECT * FROM `items` WHERE `id` = '".mysql_real_escape_string($newCharArray['characterinfo']['charactertab']['items']['item'][$x]['id'])."' LIMIT 1";
		$queryResult = mysql_query($query);
		$item = mysql_fetch_array($queryResult, MYSQL_ASSOC); 
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['icon'] = $item['icon'];
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['level'] = $item['level'];
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['name'] = $item['name'];
		$newCharArray['characterinfo']['charactertab']['items']['item'][$x]['rarity'] = $item['rarity'];
	}
	return $newCharArray;
}

?>