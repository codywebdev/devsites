<?
$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime = array(); $totalPageLoadTime['start'] = $mtime;
	if (isset($_POST['n'])) $name = urldecode($_POST['n']);
	if (isset($_POST['s'])) $server = urldecode($_POST['s']);
	if (isset($_POST['r'])) $region = urldecode($_POST['r']);
	if ($region == "eu") $region = "EU-";
	else $region = '';
	
	
	$topOutput = '<table border="0" cellspacing="0" cellpadding="0" class="charInfo">
              <tr>
                <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td><div class="dropshadow">';
	$bottomOutput = '</div></td>
					  </tr>
					</table></td>
              </tr>
            </table>';
			
		//$name = "Smásher";
		//$server = "Nazjatar";
		//$region = "EU-";

	include 'proxylist.php';
//	if ($useProxyListQuickarmory) {
		$proxyAddress = $proxylist[array_rand($proxylist)];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_PROXY, $proxyAddress);
		curl_setopt ( $ch, CURLOPT_URL, 'http://quickarmory.com/?n='.urlencode($name).'&r='.$region.urlencode($server).'' );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 0 );
		curl_setopt ( $ch, CURLOPT_RANGE, '60000-110000');
		$rawFile = '';//curl_exec ( $ch );
//	}
//	else*/ 
	
//	$rawFile = file_get_contents('http://quickarmory.com/?n='.urlencode($name).'&r='.$region.urlencode($server).'',NULL,NULL,NULL,110000);  //only get the first 110000 bytes
$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['pageLoaded'] = ($mtime-$totalPageLoadTime['start']); 


$startOfString = strrpos($rawFile,'elitistarmory') - 93;
$endOfString = strrpos($rawFile,'cursor: pointer;') + 96;
switch (substr($rawFile,$endOfString-1,1)) {
	case 'b':
		$endOfString += 3;
		break;
	case 'l':
		$endOfString += 2;
		break;
	case 'e':
		$endOfString += 1;
		break;
}

$rawFile = substr($rawFile,$startOfString,($endOfString-$startOfString));

//	$newFile = htmlspecialchars($rawFile, ENT_QUOTES);
//	$newFile = preg_replace('/[^(\x20-\x7F)\n\t\_]*/','',$newFile);
//	$newFile = htmlspecialchars_decode($newFile, ENT_QUOTES);
//	$newFile = preg_replace('/(&nbsp;)/','',$newFile);
//	$newFile = preg_replace('/[\n\t]*/','',$newFile);


	// Any of the following characters must be escaped (interpreted literally) with a '\': [\^$.|?*+(){}
	// Note: to escape a backslash, you must type four backslashes '\\\\'
	// For help, visit: http://msdn.microsoft.com/en-us/library/aa833197(VS.80).aspx
//	$beginStr = '<!DOCTYPE HTML';
//	$endStr = 'The lowest expected item level for this character is (.*)<\/a><\/td><\/tr><\/table><\/td><\/tr><\/table>';
//	$newFile = preg_replace('/'.$beginStr.'.*'.$endStr.'/iU','',$newFile);
	
	//$beginStr = '<table border="0" cellspacing="0" cellpadding="0" style="float';
	//$newFile = preg_replace('/('.$beginStr.').*/i','',$newFile);
	
//	$beginStr = '<\/td><\/tr><\/table>';
//	$newFile = preg_replace('/('.$beginStr.').*/i','',$newFile);
//	if (substr($newFile,(strlen($newFile)-3),3)=='td>') {
//		$newFile .= '</td></tr></table>';
//	}

$searchArray = array(
'cursor: pointer; border: 1px solid #',
' class="bordered"',
'<th>',
'style="text-align: right; min-width: 3em"',
'<td>',
'<td class="raidName"><',
' background-color: #322"',
' background-color: #232"',
' background-color: #332"',
'<a href="http://elitistarmory.com/experience" class="bufflink" onmousemove="$WowheadPower.moveTooltip(event)" onmouseout="$WowheadPower.hideTooltip();" onmouseover="$WowheadPower.showTooltip(event,\'Scores based off of Elitist Armory\\\'s Experience Allocation\',\'\');">',
'Raid Experience</a>',
'location.',
'quickarmory',
'onload'
);
$replaceArray = array(
'',
'',
'<th class="raidExp">',
'class="raidExpTitle"',
'<td class="raidName">',
'<td><',
'" class="redRaidExp"',
'" class="greenRaidExp"',
'" class="orangeRaidExp"',
'',
'Raid Experience',
'',
'',
'gsurl'
);

$newFile = str_replace($searchArray,$replaceArray,$rawFile);

//	$newFile = preg_replace('/cursor\: pointer; border\: 1px solid #[0-9]{3};/','',$newFile);
//	$newFile = preg_replace('/ class="bordered"/','',$newFile);
//	$newFile = preg_replace('/<th>/','<th class="raidExp">',$newFile);
//	$newFile = preg_replace('/style="text-align\: right; min-width\: 3em"/','class="raidExpTitle"',$newFile);
//	$newFile = preg_replace('/<td>/','<td class="raidName">',$newFile);
//	$newFile = preg_replace('/<td class="raidName"></','<td><',$newFile);
//	$newFile = preg_replace('/ background-color\: #322"/','" class="redRaidExp"',$newFile);
//	$newFile = preg_replace('/ background-color\: #232"/','" class="greenRaidExp"',$newFile);
//	$newFile = preg_replace('/ background-color\: #[0-9]{3,6}"/','" class="orangeRaidExp"',$newFile);
//	$newFile = preg_replace('/<a href="http\:\/\/elitistarmory.*>/iU','',$newFile);
//	$newFile = preg_replace('/Raid Experience<\/a>/','Raid Experience',$newFile);

//	$newFile = preg_replace('/images\/skull\.png/','http://gearscores.com/images/skull.png',$newFile);
	
$mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['end'] = ($mtime-$totalPageLoadTime['start']); 
$totalPageLoadTime['executionTime'] = $totalPageLoadTime['end']-$totalPageLoadTime['pageLoaded'];

	if (substr($newFile,0,6)=='<table' && substr($newFile,-6,6)=='table>') {
		echo $topOutput.$newFile.$bottomOutput;
	}
	else {
		echo $topOutput.'<table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td colspan="2" align="center" valign="middle" class="busyText">Unable to retrieve character raid experience.</td>
                                                </tr>
                                                </table>'.$bottomOutput;
	}

?>