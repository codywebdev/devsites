<?php 
$maintenanceMode = false;
if ($maintenanceMode && $_SERVER['REMOTE_ADDR'] != '74.197.117.176') { echo file_get_contents('/home/gearscores/public_html/includes/maintenance.php'); exit(); }
      $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime = array(); $totalPageLoadTime['start'] = $mtime; 

require_once("/home/gearscores/public_html/includes/phparmory/phpArmory.class.php");
require_once("/home/gearscores/public_html/includes/functions.php");
require_once ("/home/gearscores/public_html/includes/config.php");
require_once ("/home/gearscores/public_html/includes/opendb.php");

	if (isset($_GET['r'])) $region = $_GET['r'];
		else if (isset($_POST['r'])) $region = $_POST['r'];
		else if (isset($_COOKIE['r'])) $region = $_COOKIE['r'];
		else $region = 'us';
$emptyCharSearch = false;
$randomAdPlacement = rand(1,3);

//best looking ads
$showAd2 = true;  //bottom google - large images
$showAd6 = true;  //top google - above logo
$showAd3 = false;  //side google - right side
$showAd1 = false;  //top google - large top of conent (below search frame)
//not as good looking ads
$showAd5 = false;  //top google - small next to logo
$showAd4 = false;  //side google - left side

											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['includes'] = ($mtime-$totalPageLoadTime['start']); 
if ($_SERVER['PHP_SELF']=='/character.php') {
	$armory = new phpArmory5();
	if (isset($_GET['n'])) $name = mb_convert_case($_GET['n'],MB_CASE_TITLE,"UTF-8");
		else if (isset($_POST['n'])) $name = mb_convert_case($_POST['n'],MB_CASE_TITLE,"UTF-8");
		else if (isset($_COOKIE['n'])) $name = mb_convert_case($_COOKIE['n'],MB_CASE_TITLE,"UTF-8");
		else $name = '';
	if (isset($_GET['s'])) $server = $_GET['s'];
		else if (isset($_POST['s'])) $server = $_POST['s'];
		else if (isset($_COOKIE['s'])) $server = $_COOKIE['s'];
		else $server = '';
	if ($region != "us" && $region != "eu") $region = "us";
	$cachedMode = urldecode(isset($_REQUEST["cm"])? $_REQUEST["cm"] : "none");
	if ($cachedMode != "gs" && $cachedMode != "0" && $cachedMode != "1") $cachedMode = "none";
	
	if ($name == '' || $server == '') $emptyCharSearch = true;
	$cachedModeSuccess = false;
	$charFound = false;
	$charFoundInDatabase = false;
	$updateTime = 0;
	$charNotFoundError = false;
	
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_varcheck'] = ($mtime-$totalPageLoadTime['start']);
	
	if (!$emptyCharSearch) {
		//check to see if the character has been downloaded recently
		$query = "SELECT * 
		FROM `".mysql_real_escape_string($region)."Characters` 
		WHERE `name` LIKE '".mysql_real_escape_string($name)."'
		AND `server` LIKE '".mysql_real_escape_string($server)."'
		ORDER BY `lastupdate` DESC
		LIMIT 2";
		$result = mysql_query($query);
		
			//delete the older records if there are any duplicates
			if (mysql_num_rows($result) > 1) {
				//store the most recent record for use later
				$row = mysql_fetch_assoc($result);
				//delete all entries of this character (some may be duplicates and we don't have a primary key to distinguish)
					$query = "DELETE 
					FROM `".mysql_real_escape_string($region)."Characters` 
					WHERE `name` LIKE '".mysql_real_escape_string($name)."'
					AND `server` LIKE '".mysql_real_escape_string($server)."'";
					$result = mysql_query($query);
				//insert a new record containing all of the data from the $row (most recent record of last search)
					$query = "INSERT INTO `gearscor_gsdb`.`".mysql_real_escape_string($region)."Characters` (`name` ,`server` ,`region` ,`gearscore` ,`highestgs` ,`level` ,`race` ,`class` ,`spec` ,`guild` ,`lastupdate` ,`xmlarray`, `maxgsarray`, `spec0array`, `spec1array` )VALUES ('".mysql_real_escape_string($row['name'])."', '".mysql_real_escape_string($row['server'])."', '".mysql_real_escape_string($row['region'])."', '".mysql_real_escape_string($row['gearscore'])."', '".mysql_real_escape_string($row['highestgs'])."', '".mysql_real_escape_string($row['level'])."', '".mysql_real_escape_string($row['race'])."', '".mysql_real_escape_string($row['class'])."', '".mysql_real_escape_string($row['spec'])."', '".mysql_real_escape_string($row['guild'])."', '".mysql_real_escape_string(($row['lastupdate']+1))."', '".mysql_real_escape_string($row['xmlarray'])."', '".mysql_real_escape_string($row['maxgsarray'])."', '".mysql_real_escape_string($row['spec0array'])."', '".mysql_real_escape_string($row['spec1array'])."');";
					$result = mysql_query($query);
				//repeat last query to continue on
				$query = "SELECT * 
				FROM `".mysql_real_escape_string($region)."Characters` 
				WHERE `name` LIKE '".mysql_real_escape_string($name)."'
				AND `server` LIKE '".mysql_real_escape_string($server)."'
				LIMIT 2";
				$result = mysql_query($query);
			}
			
		$row = mysql_fetch_assoc($result);
		
		if ($cachedMode=="gs" && $row['maxgsarray']) {
			$character = uncompressCharArray($row, $row['maxgsarray']);
			if ($character) $cachedModeSuccess = true;
		}
		else if ($cachedMode=="0" && $row['spec0array']) {
			$character = uncompressCharArray($row, $row['spec0array']);
			if ($character) $cachedModeSuccess = true;
		}
		else if ($cachedMode=="1" && $row['spec1array']) {
			$character = uncompressCharArray($row, $row['spec1array']);
			if ($character) $cachedModeSuccess = true;
		}
		
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_cm_check'] = ($mtime-$totalPageLoadTime['start']); 
		
		
		if (!$cachedModeSuccess) {
			//update cookie data
			setcookie('r',$region,(time()+60*60*24*30),'/','.gearscores.com');
			setcookie('s',$server,(time()+60*60*24*30),'/','.gearscores.com');
			setcookie('n',$name,(time()+60*60*24*30),'/','.gearscores.com');
			//if character found, then check to see the last time it was updated
			if ($row) { 
				$currentTime = time();
				$minUpdateDelay = 15; //(15*60); //character must be at least 15 minutes old to receive and update
				if (($currentTime - $minUpdateDelay) <= $row['lastupdate']) { //if character has been downloaded recently then use the database
					$character = uncompressCharArray($row, $row['xmlarray']);
				}
				else {
					//if chracter data is out of date, then use the phparmory to query
					$armory->setArea($region);
					$character = $armory->getCharacterData($name, $server); // returns an associative array of character info to $character
					//if character not found, then use the database record (wowarmory could be down)
					if (!$character) { 		$character = uncompressCharArray($row, $row['xmlarray']); }
				}
				
				$highestGS = $row['highestgs'];
				$updateTime = $row['lastupdate'];
				$charFound = true;
				$charFoundInDatabase = true;
			}
			else { 
				//if character hasn't been downloaded at all, then use the phparmory to query
				$armory->setArea($region);
				$character = $armory->getCharacterData($name, $server); // returns an associative array of character info to $character
				//if character not found, then redirect
				if (!$character) { 
					setcookie('n','',(time()-3600),'/','.gearscores.com');
					$charNotFoundError = true; 
				}
				else {
					$charFound = true;
				}
			}
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_armorysearch'] = ($mtime-$totalPageLoadTime['start']); 
		}
		else {
			$charFoundInDatabase = true;
		}
		
		
	if ($cachedModeSuccess || $charFound) {
			$armoryLink = ($region == "eu")? "http://eu.battle.net/wow/en/" : "http://us.battle.net/wow/en/";
			$Items = $character["characterinfo"]["charactertab"]["items"]["item"];
			$Character = $character["characterinfo"]["character"];
			$Talents = $character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"];
			$Professions = $character["characterinfo"]["charactertab"]["professions"]["skill"];
			$Bars = $character["characterinfo"]["charactertab"]["characterbars"];
			$Stats = $character["characterinfo"]["charactertab"]["basestats"];
			$Melee = $character["characterinfo"]["charactertab"]["melee"];
			$Ranged = $character["characterinfo"]["charactertab"]["ranged"];
			$Spell = $character["characterinfo"]["charactertab"]["spell"];
			$Defenses = $character["characterinfo"]["charactertab"]["defenses"];
			$Glyphs = $character["characterinfo"]["charactertab"]["glyphs"];
			$sponsorRank = $row['sponsorRank'];
			
			$gsArrayCached = (!$cachedModeSuccess && $row['maxgsarray'])? true : false ;
			$spec0ArrayCached = (!$cachedModeSuccess && $row['spec0array'])? true : false ;
			$spec1ArrayCached = (!$cachedModeSuccess && $row['spec1array'])? true : false ;
			
			$Items = getItemsArray($Items);
			
			if (($currentTime - $minUpdateDelay) > $updateTime) $updateTime = time();
			$curCharGS = getCharGS($character);
			$newHighestGS = max($curCharGS, $highestGS);
			
			//prepare for new character
			$newCharSpecSQL = "";
			if ($Talents["0"]["active"]==1) $newCharSpecSQL = ", '".mysql_real_escape_string(compressCharArray($character))."', ''";
			else if ($Talents["1"]["active"]==1) $newCharSpecSQL = ", '', '".mysql_real_escape_string(compressCharArray($character))."'";
			else if ($Talents["active"]==1) $newCharSpecSQL = ", '".mysql_real_escape_string(compressCharArray($character))."', ''";
			
			
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_prepareinsert'] = ($mtime-$totalPageLoadTime['start']); 
			//insert character into database
			if ($character) { 
				//if a character is found then UPDATE the database
				if ($charFoundInDatabase && !$cachedModeSuccess) {
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
					$query = "UPDATE `gearscor_gsdb`.`".mysql_real_escape_string($region)."Characters` SET `gearscore` = '".mysql_real_escape_string($curCharGS)."',`highestgs` = '".mysql_real_escape_string($newHighestGS)."',`level` = '".mysql_real_escape_string($Character["level"])."',`race` = '".mysql_real_escape_string($Character["race"])."',`class` = '".mysql_real_escape_string($Character["class"])."',`guild` = '".mysql_real_escape_string($Character["guildname"])."',`spec` = '".mysql_real_escape_string(getActiveTalentSpec($Talents))."',`lastupdate` = '".mysql_real_escape_string($updateTime)."',`xmlarray` = '".mysql_real_escape_string(compressCharArray($character))."'".$updateArrays." WHERE `".mysql_real_escape_string($region)."Characters`.`name` = '".mysql_real_escape_string($Character["name"])."' AND `".mysql_real_escape_string($region)."Characters`.`server` = '".mysql_real_escape_string($Character["realm"])."' LIMIT 1 ;";
					$result = mysql_query($query);
				}
				//if a character is not found then INSERT a new record into the database
				else if (!$cachedModeSuccess) {
					$query = "INSERT INTO `gearscor_gsdb`.`".mysql_real_escape_string($region)."Characters` (`name` ,`server` ,`region` ,`gearscore` ,`highestgs` ,`level` ,`race` ,`class` ,`spec` ,`guild` ,`lastupdate` ,`xmlarray`, `maxgsarray`, `spec0array`, `spec1array` )VALUES ('".mysql_real_escape_string($Character["name"])."', '".mysql_real_escape_string($Character["realm"])."', '".mysql_real_escape_string($region)."', '".mysql_real_escape_string($curCharGS)."', '".mysql_real_escape_string($curCharGS)."', '".mysql_real_escape_string($Character["level"])."', '".mysql_real_escape_string($Character["race"])."', '".mysql_real_escape_string($Character["class"])."', '".mysql_real_escape_string(getActiveTalentSpec($Talents))."', '".mysql_real_escape_string($Character["guildname"])."', '".mysql_real_escape_string(time())."', '".mysql_real_escape_string(compressCharArray($character))."', '".mysql_real_escape_string(compressCharArray($character))."'".$newCharSpecSQL.");";
					$result = mysql_query($query);
				}
			}
			
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_charinsert'] = ($mtime-$totalPageLoadTime['start']); 
			
			//gather comments and put them in an array called $Comments
			$Comments = array();
			$query = "SELECT * FROM `comments` WHERE `region` LIKE '".mysql_real_escape_string($region)."' AND `character` LIKE '".mysql_real_escape_string($name)."' AND `realm` LIKE '".mysql_real_escape_string($server)."' ORDER BY `time` DESC LIMIT 0 , 100";
			$result = mysql_query($query);
			while(($Comments[] = mysql_fetch_assoc($result)) || array_pop($Comments));
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['char_getcomments'] = ($mtime-$totalPageLoadTime['start']); 
		}
	}
}
else if ($_SERVER['PHP_SELF']=='/rankings.php') {
	
	$rRegion = urldecode(isset($_REQUEST["rre"])? $_REQUEST["rre"] : "us");
	$rRealm = urldecode(isset($_REQUEST["rse"])? $_REQUEST["rse"] : "any");
	$rClass = urldecode(isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : "any");
	$rSpec = urldecode(isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : "any");
	$rGearscore = urldecode(isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : "highest");
	$rSort = urldecode(isset($_REQUEST["sort"])? $_REQUEST["sort"] : "");
	$rSortDir = urldecode(isset($_REQUEST["dir"])? $_REQUEST["dir"] : "");
	$rStart = urldecode(isset($_REQUEST["rst"])? $_REQUEST["rst"] : "0");
	$rPerPage = urldecode(isset($_REQUEST["rpp"])? $_REQUEST["rpp"] : "25");
	$rSearchValue = urldecode(isset($_REQUEST["rsrch"])? $_REQUEST["rsrch"] : "");
	if ($rSort == 'name') $rSearchValue = mb_convert_case($rSearchValue,MB_CASE_TITLE,"UTF-8");
	
	//check variables
	if ($rRegion != "us" && $rRegion != "eu") $rRegion = "us";
	if ($rSortDir != "asc" && $rSortDir != "desc") { 
		if ($rSort == '' || $rSort == 'gs') {
			$rSortDir = 'desc'; 
		}
		else {
			$rSortDir = 'asc'; 
		}
	}
	if ($rSort != "name" && $rSort != "realm" && $rSort != "class" && $rSort != "spec" && $rSort != "guild") $rSort = 'gs';
	if ($rGearscore != "current") $rGearscore = "highest";
	$rSortSqlName = 'highestgs';
		switch ($rSort) {
			case 'name':
				$rSortSqlName = 'name';
				break;
			case 'realm':
				$rSortSqlName = 'server';
				break;
			case 'class':
				$rSortSqlName = 'class';
				break;
			case 'spec':
				$rSortSqlName = 'spec';
				break;
			case 'guild':
				$rSortSqlName = 'guild';
				break;
			default:
				$rSortSqlName = 'highestgs';
				break;
		}
	if ($rGearscore == 'current') $rSortSqlName = 'gearscore';
	
	$filterQuery = '';
	if ($rRealm!='any' && $rRealm!='') $filterQuery .= 'AND `server` LIKE \''.mysql_real_escape_string($rRealm).'\' ';
	if ($rClass!='any' && $rClass!='') $filterQuery .= 'AND `class` LIKE \''.mysql_real_escape_string($rClass).'\' ';
	if ($rSpec!='any' && $rSpec!='') $filterQuery .= 'AND `spec` LIKE \''.mysql_real_escape_string($rSpec).'\' ';
	$filterQuery = ltrim($filterQuery,'AND');
	
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_getvars'] = ($mtime-$totalPageLoadTime['start']); 
	
	//sort the array
	$sortSql = "ORDER BY `gearscore`";
	if ($rSort=='name') $sortSql = "ORDER BY `name`";
	else if ($rSort=='realm') $sortSql = "ORDER BY `server`";
	else if ($rSort=='class') $sortSql = "ORDER BY `class`";
	else if ($rSort=='spec') $sortSql = "ORDER BY `spec`";
	else if ($rSort=='guild') $sortSql = "ORDER BY `guild`";
	else if ($rGearscore=='highest') $sortSql = "ORDER BY `highestgs`";
	
	if ($rSortDir=='desc') $sortSql .= " DESC";
	else if ($rSortDir!='asc' && $rSort!='name' && $rSort!='realm' && $rSort!='class' && $rSort!='spec' && $rSort!='guild') $sortSql .= " DESC";
	else $sortSql .= " ASC";
	
	$query = "SELECT COUNT(name) AS numrows FROM `".mysql_real_escape_string($rRegion)."Characters` ";
	if (strlen($filterQuery) > 0) $query .= "WHERE ".$filterQuery;
	$result = mysql_query($query);
	$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
	$rNumResults = $row['numrows'];
	
	if ($rStart < 0 || $rStart > $rNumResults) $rStart = 0;
	if ($rPerPage < 5 || $rPerPage > 50) $rPerPage = 25;
	
	//$rPerPage = 2;
	
	
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_countall'] = ($mtime-$totalPageLoadTime['start']); 
	
	//find the page that $rSearchValue would be on if $rSearchValue exists
	$rSearchResultFound = false;
	$rSearchResultRows = 0;
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_begin'] = ($mtime-$totalPageLoadTime['start']); 
	if ($rSearchValue != '') {
		if ($rSortDir == 'asc') {
			$query = "SELECT COUNT(name) AS 'num_rows' FROM `".mysql_real_escape_string($rRegion)."Characters` WHERE ";
			if (strlen($filterQuery) > 0) $query .=  $filterQuery."  AND ";
			$query .= "`".mysql_real_escape_string($rSortSqlName)."` <= '".mysql_real_escape_string($rSearchValue)."'"." ".$sortSql;
			$result = mysql_query($query);
			$rSearchResultRows = mysql_result($result,0);
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_searchRowFound'] = ($mtime-$totalPageLoadTime['start']); 			
		}
		else if ($rSortDir == 'desc') {
			$query = "SELECT COUNT(name) AS 'num_rows' FROM `".mysql_real_escape_string($rRegion)."Characters` WHERE ";
			if (strlen($filterQuery) > 0) $query .=  $filterQuery."  AND ";
			$query .= "`".mysql_real_escape_string($rSortSqlName)."` >= '".mysql_real_escape_string($rSearchValue)."'"." ".$sortSql;
			$result = mysql_query($query);
			$rSearchResultRows = mysql_result($result,0);
			$testQuery = $query;
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_searchRowFound2'] = ($mtime-$totalPageLoadTime['start']); 			
		}
			
		if ($rNumResults > $rSearchResultRows) $rSearchResultFound = true;
		if ($rSearchResultFound) {
			$rCurPage = ceil(($rSearchResultRows)/$rPerPage);
			$rStart = (($rCurPage-1)*$rPerPage);
			$query = "SELECT `name` , `server` , `region` , `guild` , `gearscore` , `highestgs` , `race` , `class` , `spec` FROM `".mysql_real_escape_string($rRegion)."Characters` ";
			if (strlen($filterQuery) > 0) $query .= "WHERE ".$filterQuery;
			$query .= " ".$sortSql." LIMIT ".mysql_real_escape_string($rStart).", ".mysql_real_escape_string($rPerPage);
			$result = mysql_query($query);
			while(($queryResult[] = mysql_fetch_assoc($result)) || array_pop($queryResult));
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_searchResults'] = ($mtime-$totalPageLoadTime['start']); 			
		}
		else {
			$query = "SELECT `name` , `server` , `region` , `guild` , `gearscore` , `highestgs` , `race` , `class` , `spec` FROM `".mysql_real_escape_string($rRegion)."Characters` ";
			if (strlen($filterQuery) > 0) $query .= "WHERE ".$filterQuery;
			$query .= " ".$sortSql." LIMIT ".mysql_real_escape_string($rStart).", ".mysql_real_escape_string($rPerPage);
			$result = mysql_query($query);
			while(($queryResult[] = mysql_fetch_assoc($result)) || array_pop($queryResult));
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_searchResults2'] = ($mtime-$totalPageLoadTime['start']); 			
		}
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_findsearchvalue'] = ($mtime-$totalPageLoadTime['start']); 
	}
	else {
		$query = "SELECT `name` , `server` , `region` , `guild` , `gearscore` , `highestgs` , `race` , `class` , `spec` FROM `".mysql_real_escape_string($rRegion)."Characters` ";
		if (strlen($filterQuery) > 0) $query .= "WHERE ".$filterQuery;
		$query .= " ".$sortSql." LIMIT ".mysql_real_escape_string($rStart).", ".mysql_real_escape_string($rPerPage);
		$result = mysql_query($query);
		while(($queryResult[] = mysql_fetch_assoc($result)) || array_pop($queryResult));
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_getresults'] = ($mtime-$totalPageLoadTime['start']); 
	}
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['search_end'] = ($mtime-$totalPageLoadTime['start']); 	
}
else if ($_SERVER['PHP_SELF']=='/index.php') {
	$name = urldecode(isset($_REQUEST["n"])? $_REQUEST["n"] : "");
	$server = urldecode(isset($_REQUEST["s"])? $_REQUEST["s"] : "");
	if ($region != "us" && $region != "eu") $region = "us";
}
else if ($_SERVER['PHP_SELF']=='/gs/managegs.php') {
	$sponsorN = urldecode(isset($_POST["sponsorN"])? mb_convert_case($_POST["sponsorN"],MB_CASE_TITLE,"UTF-8") : "");
	$sponsorS = urldecode(isset($_POST["sponsorS"])? $_POST["sponsorS"] : "");
	$sponsorR = urldecode(isset($_POST["sponsorR"])? $_POST["sponsorR"] : "");	
	$sponsorAction = urldecode(isset($_POST["sponsorAction"])? $_POST["sponsorAction"] : "");	
	$sponsorRemove = urldecode(isset($_POST["sponsorRemove"])? $_POST["sponsorRemove"] : "");	
	if ($sponsorR != "us" && $sponsorR != "eu") $sponsorR = "us";
	
	if ($_COOKIE['sponsorCookiePW'] == '5997a3321045ce9e938f271d46fab50c') {
		if ($sponsorAction == 'remove') {
			$removeSponsorTemp = explode('|',$sponsorRemove);
			$sponsorN = urldecode($removeSponsorTemp[0]);
			$sponsorS = stripslashes(urldecode($removeSponsorTemp[1]));
			$sponsorR = $removeSponsorTemp[2];
		}
		
		$sponsorAddedSuccess = '';
		$sponsorRemovedSuccess = '';
		
		if ($sponsorAction == 'add') {
			$query = "SELECT * 
			FROM `".mysql_real_escape_string($sponsorR)."Characters` 
			WHERE `name` LIKE '".mysql_real_escape_string($sponsorN)."'
			AND `server` LIKE '".mysql_real_escape_string($sponsorS)."'
			LIMIT 2";
			$result = mysql_query($query);
			
			if (mysql_num_rows($result) == 1) {	
				$query = "UPDATE `gearscor_gsdb`.`".mysql_real_escape_string($sponsorR)."Characters` 
				SET `sponsorRank` = '1' 
				WHERE `".mysql_real_escape_string($sponsorR)."Characters`.`name` LIKE '".mysql_real_escape_string($sponsorN)."'
				AND `".mysql_real_escape_string($sponsorR)."Characters`.`server` LIKE '".mysql_real_escape_string($sponsorS)."' 
				LIMIT 1";
				$result = mysql_query($query);
				if ($result) {
					$sponsorAddedSuccess = 'success';
				}
				else {
					$sponsorAddedSuccess = 'error';
				}
			}
			else {
				$sponsorAddedSuccess = 'error';
			}
		}
		else if ($sponsorAction == 'remove') {
			$query = "SELECT * 
			FROM `".mysql_real_escape_string($sponsorR)."Characters` 
			WHERE `name` LIKE '".mysql_real_escape_string($sponsorN)."'
			AND `server` LIKE '".mysql_real_escape_string($sponsorS)."'
			LIMIT 2";
			$result = mysql_query($query);
			
			if (mysql_num_rows($result) == 1) {	
				$query = "UPDATE `gearscor_gsdb`.`".mysql_real_escape_string($sponsorR)."Characters` 
				SET `sponsorRank` = '0' 
				WHERE `".mysql_real_escape_string($sponsorR)."Characters`.`name` LIKE '".mysql_real_escape_string($sponsorN)."'
				AND `".mysql_real_escape_string($sponsorR)."Characters`.`server` LIKE '".mysql_real_escape_string($sponsorS)."' 
				LIMIT 1";
				$result = mysql_query($query);
				if ($result) {
					$sponsorRemovedSuccess = 'success';
				}
				else {
					$sponsorRemovedSuccess = 'error';
				}
			}
			else {
				$sponsorRemovedSuccess = 'error';
			}
		}
		
		$removeSponsorList = array();
	
		$query = "SELECT `id`,`name`,`server`,`region`,`class`,`sponsorRank`
					FROM `usCharacters` 
					WHERE `sponsorRank` =1";
		$result = mysql_query($query);
		while(($removeSponsorList[] = mysql_fetch_assoc($result)) || array_pop($removeSponsorList));
		$query = "SELECT `id`,`name`,`server`,`region`,`class`,`sponsorRank`
					FROM `euCharacters` 
					WHERE `sponsorRank` =1";
		$result = mysql_query($query);
		while(($removeSponsorList[] = mysql_fetch_assoc($result)) || array_pop($removeSponsorList));
	}
	
	//Arxkanite
	//abs284jb
	setcookie('sponsorCookiePW','5997a3321045ce9e938f271d46fab50c',(time()+60*60*24*30),'/','.gearscores.com');

}

else if ($_SERVER['PHP_SELF']=='/signature.php') {
	$sigName = mb_convert_case(urldecode(isset($_GET["n"])? $_GET["n"] : ""),MB_CASE_TITLE,"UTF-8");
	$sigServer = urldecode(isset($_GET["s"])? $_GET["s"] : "");
	$sigRegion = urldecode(isset($_GET["r"])? $_GET["r"] : "");	
	$sigCharNotFound = false;
	
	$query = "SELECT * 
	FROM `".mysql_real_escape_string($sigRegion)."Characters` 
	WHERE `name` LIKE '".mysql_real_escape_string($sigName)."'
	AND `server` LIKE '".mysql_real_escape_string($sigServer)."'
	LIMIT 2";
	$result = mysql_query($query);
	
	if (mysql_num_rows($result) == 1) {	
		$char = mysql_fetch_assoc($result);
	}
	else {
		$sigCharNotFound = true;
	}
}



?>