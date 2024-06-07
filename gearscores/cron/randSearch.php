<?

require_once("../includes/phparmory/phpArmory.class.php");
require_once("../includes/functions.php");
require_once("../includes/config.php");
require_once("../includes/opendb.php");

$charChance = 10;
$guildChance = 90;
$maxQueryTime = 280;
$numOfSqlResults = 10;

	//find out how many characters are in US and EU
	$query = "SELECT COUNT(*) AS rand_row FROM `euCharacters`"; 
	$result = mysql_query($query);
	$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
	$numRecordsEu = $row['rand_row'];

	$query = "SELECT COUNT(*) AS rand_row FROM `usCharacters`"; 
	$result = mysql_query($query);
	$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
	$numRecordsUs = $row['rand_row'];

	$regionSearch = 'eu';
if ($numRecordsEu > $numRecordsUs) { //($randomNum >= $numRecordsEu) {
	$regionSearch = 'us';
}
echo 'US: '.$numRecordsUs.' EU: '.$numRecordsEu.'<br />';
	


//based on the chances defined above, calculate which search to do, character or guild
$randomNum = rand(0,($charChance+$guildChance));
if ($randomNum >= $charChance) {
	//include 'byGuild.php';
}
else {
	//include 'byChar.php';
}

?>