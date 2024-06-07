<?php
$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $byCharLoadTime = array(); $byCharLoadTime['start'] = $mtime;
require_once("../includes/phparmory/phpArmory.class.php");
require_once("../includes/functions.php");
require_once("../includes/config.php");
require_once("../includes/opendb.php");

//run this script for how many seconds?
$maxQueryTime = isset($maxQueryTime)? $maxQueryTime : 60;
$numOfSqlResults = isset($numOfSqlResults)? $numOfSqlResults : 10;
$regionSearch = isset($regionSearch)? $regionSearch : 'us';
$maxAttempts = isset($maxAttempts)? $maxAttempts : '5';


$query = "SELECT COUNT(DISTINCT `name`) AS num_rows FROM `".mysql_real_escape_string($regionSearch)."Characters`";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$numRows = $row['num_rows'];
$randRow = rand(0,$numRows);
$randRow = max(($randRow-$numOfSqlResults),0);
$query = "SELECT * FROM `".mysql_real_escape_string($regionSearch)."Characters` GROUP BY `name` LIMIT ".$randRow.", ".$numOfSqlResults."";
$result = mysql_query($query);
$randCharArray = array();
while(($randCharArray[] = mysql_fetch_assoc($result)) || array_pop($randCharArray));
shuffle($randCharArray);

$newRecords = 0;
$updatedRecords = 0;
$failedRecords = 0;


for ($j=0;($j<sizeof($randCharArray) && $curTime < $maxQueryTime);$j++) {
	$id = $randCharArray[$j]['id'];
	$name = $randCharArray[$j]['name'];
	$region = $randCharArray[$j]['region'];
	$armory = new phpArmory5();
	$armory->setArea($region);
	
	$armoryResult = $armory->getAnyData('characters',$name,array());
	
	if ($armoryResult) {
		$aResult = $armoryResult['armorysearch']['searchresults']['characters']['character'];
		$aResultCount = $armoryResult['armorysearch']['tabs']['tab']['count'];
		if ($aResultCount > 1) { shuffle($aResult); }
		else { $aResult[0] = $aResult; }
		
		for ($i=0;($i<$aResultCount && $curTime < $maxQueryTime);$i++) {
			$armory2 = new phpArmory5();
			$armory2->setArea($region);
			$character = $armory2->getCharacterData($aResult[$i]['name'], $aResult[$i]['realm']); // returns an associative array of character info to $character
			$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $curTime = ($mtime - $byCharLoadTime['start']);
			if ($character) {
				echo $aResult[$i]['name'].' on '.$aResult[$i]['realm'].'-'.$region.' found on wowarmory after approximately '.(microtime(true) - $byCharLoadTime['start']).' seconds.';
				//calculate characters variables (gearscores, talents, etc)
						$Character = $character["characterinfo"]["character"];
						$curCharGS = getCharGS($character);
						$newHighestGS = max($curCharGS, $highestGS);
						$Talents = $character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"];
						$updateArrays = "";
						if ($Talents["0"]["active"]==1) {
							$updateArrays .= ",`spec0array` = '".mysql_real_escape_string(compressCharArray($character))."'";
						}
						if ($Talents["1"]["active"]==1) {
							$updateArrays .= ",`spec1array` = '".mysql_real_escape_string(compressCharArray($character))."'";
						}
						if ($curCharGS == $newHighestGS) {
							$updateArrays .= ",`maxgsarray` = '".mysql_real_escape_string(compressCharArray($character))."'";
						}
						
						$newCharSpecSQL = "";
						if ($Talents["0"]["active"]==1) $newCharSpecSQL = ", '".mysql_real_escape_string(compressCharArray($character))."', ''";
						else if ($Talents["1"]["active"]==1) $newCharSpecSQL = ", '', '".mysql_real_escape_string(compressCharArray($character))."'";
						else if ($Talents["active"]==1) $newCharSpecSQL = ", '".mysql_real_escape_string(compressCharArray($character))."', ''";
	
				
				
				
				
				//find character in the database
				$query = "SELECT * 
				FROM `".mysql_real_escape_string($regionSearch)."Characters` 
				WHERE `name` LIKE '".mysql_real_escape_string($aResult[$i]['name'])."'
				AND `server` LIKE '".mysql_real_escape_string($aResult[$i]['realm'])."'
				ORDER BY `lastupdate` DESC
				LIMIT 2";
				$result = mysql_query($query);
				//delete the older records if there are any duplicates
				if (mysql_num_rows($result) > 1) {
					echo ' Found more than 1 result.';
					//store the most recent record for use later
					$row = mysql_fetch_assoc($result);
					//delete all entries of this character (some may be duplicates and we don't have a primary key to distinguish)
						$query = "DELETE 
						FROM `".mysql_real_escape_string($regionSearch)."Characters` 
						WHERE `name` LIKE '".mysql_real_escape_string($aResult[$i]['name'])."'
						AND `server` LIKE '".mysql_real_escape_string($aResult[$i]['realm'])."'";
						$result = mysql_query($query);
					//insert a new record containing all of the data from the $row (most recent record of last search)
						$query = "INSERT INTO `gearscor_gsdb`.`".mysql_real_escape_string($regionSearch)."Characters` (`name` ,`server` ,`region` ,`gearscore` ,`highestgs` ,`level` ,`race` ,`class` ,`spec` ,`guild` ,`lastupdate` ,`xmlarray`, `maxgsarray`, `spec0array`, `spec1array` )VALUES ('".mysql_real_escape_string($row['name'])."', '".mysql_real_escape_string($row['server'])."', '".mysql_real_escape_string($row['region'])."', '".mysql_real_escape_string($row['gearscore'])."', '".mysql_real_escape_string($row['highestgs'])."', '".mysql_real_escape_string($row['level'])."', '".mysql_real_escape_string($row['race'])."', '".mysql_real_escape_string($row['class'])."', '".mysql_real_escape_string($row['spec'])."', '".mysql_real_escape_string($row['guild'])."', '".mysql_real_escape_string(($row['lastupdate']+1))."', '".mysql_real_escape_string($row['xmlarray'])."', '".mysql_real_escape_string($row['maxgsarray'])."', '".mysql_real_escape_string($row['spec0array'])."', '".mysql_real_escape_string($row['spec1array'])."');";
						$result = mysql_query($query);
					//repeat query in order to continue on
						$query = "SELECT * 
						FROM `".mysql_real_escape_string($regionSearch)."Characters` 
						WHERE `name` LIKE '".mysql_real_escape_string($aResult[$i]['name'])."'
						AND `server` LIKE '".mysql_real_escape_string($aResult[$i]['realm'])."'
						ORDER BY `lastupdate` DESC
						LIMIT 2";
						$result = mysql_query($query);
				}
				//if character found in database then update
				if (mysql_num_rows($result) > 0) {
						$query = "UPDATE `gearscor_gsdb`.`".mysql_real_escape_string($regionSearch)."Characters` SET `gearscore` = '".mysql_real_escape_string($curCharGS)."',`highestgs` = '".mysql_real_escape_string($newHighestGS)."',`level` = '".mysql_real_escape_string($Character["level"])."',`race` = '".mysql_real_escape_string($Character["race"])."',`class` = '".mysql_real_escape_string($Character["class"])."',`guild` = '".mysql_real_escape_string($Character["guildname"])."',`spec` = '".mysql_real_escape_string(getActiveTalentSpec($Talents))."',`lastupdate` = '".mysql_real_escape_string(time())."',`xmlarray` = '".mysql_real_escape_string(compressCharArray($character))."'".$updateArrays." WHERE `".mysql_real_escape_string($regionSearch)."Characters`.`name` = '".mysql_real_escape_string($Character["name"])."' AND `".mysql_real_escape_string($regionSearch)."Characters`.`server` = '".mysql_real_escape_string($Character["realm"])."' LIMIT 1 ;";
						$result = mysql_query($query);
						$updatedRecords++;
						echo ' Updated.';
				}
				//if not found in database then insert
				else {
						$query = "INSERT INTO `gearscor_gsdb`.`".mysql_real_escape_string($regionSearch)."Characters` (`name` ,`server` ,`region` ,`gearscore` ,`highestgs` ,`level` ,`race` ,`class` ,`spec` ,`guild` ,`lastupdate` ,`xmlarray`, `maxgsarray`, `spec0array`, `spec1array` )VALUES ('".mysql_real_escape_string($Character["name"])."', '".mysql_real_escape_string($Character["realm"])."', '".mysql_real_escape_string($region)."', '".mysql_real_escape_string($curCharGS)."', '".mysql_real_escape_string($curCharGS)."', '".mysql_real_escape_string($Character["level"])."', '".mysql_real_escape_string($Character["race"])."', '".mysql_real_escape_string($Character["class"])."', '".mysql_real_escape_string(getActiveTalentSpec($Talents))."', '".mysql_real_escape_string($Character["guildname"])."', '".mysql_real_escape_string(time())."', '".mysql_real_escape_string(compressCharArray($character))."', '".mysql_real_escape_string(compressCharArray($character))."'".$newCharSpecSQL.");";
						$result = mysql_query($query);
						$newRecords++;
						echo ' Inserted new record.';
				}
				echo '<br />';
			}
			else {
				echo 'Error: '.$aResult[$i]['name'].' on '.$aResult[$i]['realm'].'-'.$region.' NOT FOUND after approximately '.(microtime(true) - $byCharLoadTime['start']).' seconds.<br />';
				$failedRecords++;
			}
			$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $curTime = ($mtime - $byCharLoadTime['start']);
		}
	}
	else {
		echo "No armory results found for \"".$name."\" on".$realm."-".$region.".";
	}
}
	
if ($curTime >= $maxQueryTime) {
	echo 'Query interrupted after '.$curTime.'seconds. '.$newRecords.' new records, '.$updatedRecords.' updated records, and '.$failedRecords.' failed records.<br />';
}
else {
	echo 'Query ended successfully after '.$curTime.'seconds. '.$newRecords.' new records, '.$updatedRecords.' updated records, and '.$failedRecords.' failed records.<br />';
}

?>