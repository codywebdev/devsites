<?php 
function getItemGS($Item = array()) {
	
	$charSlot = array();
	$charSlot["0"] = 1 ; //head
	$charSlot["1"] = 0.5625 ; //neck
	$charSlot["2"] = 0.75 ; //shoulder
	$charSlot["3"] = 0 ; //shirt
	$charSlot["4"] = 1 ; //chest
	$charSlot["5"] = 0.75 ; //waist
	$charSlot["6"] = 1 ; //legs
	$charSlot["7"] = 0.75 ; //feet
	$charSlot["8"] = 0.5625 ; //wrist
	$charSlot["9"] = 0.75 ; //hands
	$charSlot["10"] = 0.5625 ; //finger1
	$charSlot["11"] = 0.5625 ; //finger2
	$charSlot["12"] = 0.5625 ; //trinket1
	$charSlot["13"] = 0.5625 ; //trinket2
	$charSlot["14"] = 0.5625 ; //back
	$charSlot["15"] = 2 ; //main-hand
	$charSlot["16"] = 1 ; //off-hand
	$charSlot["17"] = 0.3164 ; //ranged
	$charSlot["18"] = 0 ; //tabard
	
	$gsFormula = array();
	$gsFormula["A"]["4"]["A"] = 91.45;
	$gsFormula["A"]["4"]["B"] = 0.65;
	$gsFormula["A"]["3"]["A"] = 81.375;
	$gsFormula["A"]["3"]["B"] = 0.8125;
	$gsFormula["A"]["2"]["A"] = 73;
	$gsFormula["A"]["2"]["B"] = 1;
	$gsFormula["B"]["4"]["A"] = 26;
	$gsFormula["B"]["4"]["B"] = 1.2;
	$gsFormula["B"]["3"]["A"] = 0.75;
	$gsFormula["B"]["3"]["B"] = 1.8;
	$gsFormula["B"]["2"]["A"] = 8;
	$gsFormula["B"]["2"]["B"] = 2;
	$gsFormula["B"]["1"]["A"] = 0;
	$gsFormula["B"]["1"]["B"] = 2.25;
	
	//get item's level
	$itemLevel = $Item["level"];
	
	//quality scale, legendary = 1.3, junk or common = .005 (moved to ilvl dependent if clauses)
	$qualityScale = 1;
	if ($Item["rarity"] == "5") $qualityScale = 1.3;
	
	//adjust gear quality to uncommon, rare, epic for calculation purposes
	$gsTable = "A";
	$adjQuality = $Item["rarity"];
	if ($adjQuality == "5") $adjQuality = "4";
	else if ($adjQuality == "7" || $adjQuality == "6") { $adjQuality = "3"; $itemLevel = "187.05"; } //heirloom items are ilvl 187.05
	
	//use the second table if ilvl is less than or equal to 120
	if ($itemLevel <= 120) {
		$gsTable = "B";
		if ($adjQuality == "0") { $adjQuality = "1"; $qualityScale = 0.005; }
		else if ($adjQuality != "1" && $adjQuality != "2" && $adjQuality != "3" && $adjQuality != "4") $adjQuality = "4"; //prevent division by zero error when no item is present
	}
	
	//use the first table if ilvl is greater than 120
	else {
		if ($adjQuality == "0" || $adjQuality == "1") { $adjQuality = "2"; $qualityScale = 0.005; }
		else if ($adjQuality != "2" && $adjQuality != "3" && $adjQuality != "4") $adjQuality = "4"; //prevent division by zero error when no item is present
	}
	
	
	$gearscore = 0;
	$gearscore = floor((($itemLevel - $gsFormula[$gsTable][$adjQuality]["A"]) / $gsFormula[$gsTable][$adjQuality]["B"]) * $charSlot[$Item["slot"]] * 1.8618 * $qualityScale);
	
	return max(0, $gearscore);

}

function getCharGS ($Character = array()) {
	
	$Items = $Character["characterinfo"]["charactertab"]["items"]["item"];
	$Item = array();
	$charGearscore = 0;
	$i=0;
	$mainHand = 0;
	$offHand = 0;
	$ranged = 0;
	$dualWield = false;
	
	//find out if this is a hunter
	$hunter = false;
	if ($Character["characterinfo"]["character"]["class"] == "Hunter") $hunter = true;
		
	for ($i=0; $i<19; $i++) {
		if ($Items[$i]["slot"] == "15") $mainHand = getItemGS($Items[$i]);
		else if ($Items[$i]["slot"] == "16") $offHand = getItemGS($Items[$i]);
		else if ($Items[$i]["slot"] == "17") $ranged = getItemGS($Items[$i]);
		else $charGearscore += getItemGS($Items[$i]);
	}
	
	//find out if this person dual wields
	if ($offHand > "0") {$dualWield = true; $mainHand = floor($mainHand / 2);}
	
	//
	$weaponGS = $mainHand + $offHand + $ranged;
	//if it's a hunter then apply the weapon weight scales
	if ($hunter) {
		$weaponGS = floor(($mainHand * 0.3164)+($offHand * 0.3164)+($ranged * 5.3224));
		$mainHand = floor($mainHand * 0.3164);
		$offHand = floor($offHand * 0.3164);
		$ranged = floor($ranged * 5.3224);
	}
	
	$charGearscore += $weaponGS;
	return $charGearscore;
}
?>