<? 
require_once("/home/gearscores/public_html/includes/functions.php");
require_once ("/home/gearscores/public_html/includes/config.php");
require_once ("/home/gearscores/public_html/includes/opendb.php");

$name = urldecode($_GET['name']);
$server = urldecode($_GET['server']);
$region = urldecode($_GET['region']);
$imageBg = urldecode($_GET['img']);

$query = "SELECT * 
FROM `".mysql_real_escape_string($region)."Characters` 
WHERE `name` LIKE '".mysql_real_escape_string($name)."'
AND `server` LIKE '".mysql_real_escape_string($server)."'
LIMIT 1";
$result = mysql_query($query);


if (mysql_num_rows($result) < 1) {
	$query = "SELECT * 
	FROM `".mysql_real_escape_string($region)."Characters` 
	WHERE `name` LIKE '".mysql_real_escape_string(mb_convert_case($name,MB_CASE_TITLE,"UTF-8"))."'
	AND `server` LIKE '".mysql_real_escape_string($server)."'
	LIMIT 1";
	$result = mysql_query($query);
	
	
	if (mysql_num_rows($result) < 1) {
		header('HTTP/1.0 404 Not Found'); 
		echo "<h1>404 Not Found</h1>"; 
		echo "The page that you have requested could not be found.";
		exit();
	}
}

$char = mysql_fetch_assoc($result);

//check if file exists

if (file_exists('/home/gearscores/public_html/images/sigs/generated/'.$region.$char['id'].'.jpg')) {
	//show file
	header("Content-Type: image/jpeg");
	$image = imagecreatefromjpeg('/home/gearscores/public_html/images/sigs/generated/'.$region.$char['id'].'.jpg');
	imagejpeg($image,NULL,96);
	imagedestroy($image);
	exit();
}

//if file doesn't exist then create the file

$Character = uncompressCharArray($char, $char['xmlarray']);

function imagettftextkern($im,$size,$angle,$x,$y,$col,$font,$text,$x_pad = 0) {
	$letters = preg_split('//',$text,-1,PREG_SPLIT_NO_EMPTY);
	foreach ($letters as $var) {
		$char_width = imagettfbbox($size,$angle,$font,$var);
		imagettftext($im,$size,$angle,$x,$y,$col,$font,$var);
		$x = $x + ($char_width[2] - $char_width[0]) + $x_pad;
	}
}

function imageTTFBboxkern($fontSize,$fontRotation,$font,$str,$x_pad = 0) {
	$letters = preg_split('//',$str,-1,PREG_SPLIT_NO_EMPTY);
	$str_width = array();
	foreach ($letters as $var) {
		$char_width = imagettfbbox($fontSize,$fontRotation,$font,$var);
		$str_width[0] += $char_width[0];
		$str_width[1] += $char_width[1];
		$str_width[2] += $char_width[2];
		$str_width[3] += $char_width[3];
		$str_width[4] += $char_width[4];
		$str_width[5] += $char_width[5];
		$str_width[6] += $char_width[6];
		$str_width[7] += $char_width[7];
	}
		$str_width[2] = $str_width[2] + (strlen($str)-1) * $x_pad;
		$str_width[4] = $str_width[4] + (strlen($str)-1) * $x_pad;
	return $str_width;
}


$classColorHTML = getCharClassColor($Character, true);
$classColorR = hexdec(substr($classColorHTML,1,2));
$classColorG = hexdec(substr($classColorHTML,3,2));
$classColorB = hexdec(substr($classColorHTML,5,2));


$image = ImageCreateFromPNG("/home/gearscores/public_html/images/sigs/bg1-1.png");
$raceIconName = printRaceIcon($Character["characterinfo"]["character"]);
$raceIconName = substr($raceIconName,40);
$raceIcon = imagecreatefrompng('/home/gearscores/public_html/images/icons/race/'.$raceIconName);
$classIconName = printClassIcon($Character["characterinfo"]["character"]);
$classIconName = substr($classIconName,41);
$classIcon = imagecreatefrompng('/home/gearscores/public_html/images/icons/class/'.$classIconName);
//$image = imagecreatetruecolor(800,36);
$color = imagecolorallocate($image, 0x66, 0x66, 0xFF);
$colorClass = imagecolorallocate($image, $classColorR, $classColorG, $classColorB);
$colorShadow = imagecolorallocate($image, 0x66, 0x66, 0x66);
$colorBlack = imagecolorallocate($image, 0x00, 0x00, 0x00);
$fontRotation = "0";


imagecopy($image, $raceIcon, 0, 0, 0, 0, 64, 64);
imagecopy($image, $classIcon, 386, 0, 0, 0, 64, 56);

if (strlen($Character["characterinfo"]["character"]["prefix"]) > 0) {
	$str = $Character["characterinfo"]["character"]["prefix"]; 
	$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
	if (strlen($str) > 22) $fontSize = "8" ; else $fontSize = "10";
	$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
	imagettftextkern($image, $fontSize, $fontRotation, 69, 15, $color, $font, $str);
	
	$str = $char['name']; 
	$fontSize = "18";
	if (strlen($char['name'])>10) $fontSize = "16";
	$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
	imagettftextkern($image, $fontSize, $fontRotation, 70, 37, $colorShadow, $font, $str,1);
	imagettftextkern($image, $fontSize, $fontRotation, 69, 36, $colorClass, $font, $str,1);
}
else if (strlen($Character["characterinfo"]["character"]["suffix"]) > 0) {
	$str = $Character["characterinfo"]["character"]["suffix"]; 
	$str = ltrim($str," ,");
	$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
	if (strlen($str) > 22) $fontSize = "8" ; else $fontSize = "10";
	$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
	imagettftextkern($image, $fontSize, $fontRotation, 69, 36, $color, $font, $str);
	
	$str = $char['name']; 
	$fontSize = "18";
	if (strlen($char['name'])>10) $fontSize = "16";
	$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
	imagettftextkern($image, $fontSize, $fontRotation, 70, 24, $colorShadow, $font, $str,1);
	imagettftextkern($image, $fontSize, $fontRotation, 69, 23, $colorClass, $font, $str,1);
}
else {
	$str = $char['name']; 
	$fontSize = "18";
	if (strlen($char['name'])>10) $fontSize = "16";
	$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
	imagettftextkern($image, $fontSize, $fontRotation, 70, 30, $colorShadow, $font, $str,1);
	imagettftextkern($image, $fontSize, $fontRotation, 69, 29, $colorClass, $font, $str,1);
}





if (strlen($char['guild']) > 0) $str = '<'.$char['guild'].'>'; 
else $str = '';
$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
$fontSize = "8";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
imagettftextkern($image, $fontSize, $fontRotation, 69, 47, $color, $font, $str);

$str = $char['level']; 
$color = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$fontSize = "9";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
imagettftext($image, $fontSize, $fontRotation, 69, 60, $color, $font, $str);


$bbox1 = imageTTFBboxkern($fontSize, $fontRotation, $font, $str);
$str = $char['race']; 
$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
$fontSize = "8";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
imagettftextkern($image, $fontSize, $fontRotation, $bbox1[4]-$bbox1[0]+73, 60, $color, $font, $str);

$bbox2 = imageTTFBboxkern($fontSize, $fontRotation, $font, $str);
$str = $char['class']; 
$fontSize = "8";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
if ($str != 'Shaman') imagettftextkern($image, $fontSize, $fontRotation, $bbox1[4]-$bbox1[0]+$bbox2[4]-$bbox2[0]+73+2+1, 60+1, $colorShadow, $font, $str);
imagettftextkern($image, $fontSize, $fontRotation, $bbox1[4]-$bbox1[0]+$bbox2[4]-$bbox2[0]+73+2, 60, $colorClass, $font, $str);

$bbox3 = imageTTFBboxkern($fontSize, $fontRotation, $font, $str);
$str = ' - '.$char['server']; 
$color = imagecolorallocate($image, 0x00, 0x00, 0xFF);
$fontSize = "8";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
imagettftextkern($image, $fontSize, $fontRotation, $bbox1[4]-$bbox1[0]+$bbox2[4]-$bbox2[0]+$bbox3[4]-$bbox3[0]+73+1, 60, $color, $font, $str);

/*
$bbox4 = imagettfbbox($fontSize, $fontRotation, $font, $str);
$str = '  GearScores.com'; 
$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
$colorBlack = imagecolorallocate($image, 0x33, 0x33, 0x33);
$fontSize = "8";
$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
//imagettftextkern($image, $fontSize, $fontRotation, $bbox1[2]+$bbox2[2]+$bbox3[2]+$bbox4[2]+69+17, 61, $colorBlack, $font, $str);
imagettftextkern($image, $fontSize, $fontRotation, $bbox1[2]+$bbox2[2]+$bbox3[2]+$bbox4[2]+69+16, 60, $color, $font, $str);
*/

$primTalentSpec = getActiveTalentSpec($Character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"]);
$secTalentSpec = getAltTalentSpec($Character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"]);

if ($primTalentSpec != 'No Talents' && $primTalentSpec != '') $primTalentSpecDist = getActiveTalentDist($Character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"]);
if ($secTalentSpec != '') $secTalentSpecDist = getAltTalentDist($Character["characterinfo"]["charactertab"]["talentspecs"]["talentspec"]);


if ($primTalentSpec != 'No Talents' && $primTalentSpec != '' && $primTalentSpecDist != '//'  && $primTalentSpecDist != '') {
	$str = $primTalentSpec; 
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 11;
	if ($char['class'] != 'Shaman') imagettftextkern($image, $fontSize, $fontRotation, $xcord+1, $ycord+1, $colorShadow, $font, $str);
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $colorClass, $font, $str);
	$quickIcon = imagecreatefrompng('/home/gearscores/public_html/images/talents/8x8/png/'.$char['class'].' - '.$primTalentSpec.'.png');
	imagecopy($image, $quickIcon, $xcord-9, $ycord-8, 0, 0, 8, 8);
	
	$str = $primTalentSpecDist; 
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 21;
	if ($char['class'] != 'Shaman') imagettftextkern($image, $fontSize, $fontRotation, $xcord+1, $ycord+1, $colorShadow, $font, $str);
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $colorClass, $font, $str);
}

if ($secTalentSpec != 'No Talents' && $secTalentSpec != '' && $secTalentSpecDist != '//'  && $secTalentSpecDist != '') {
	$str = $secTalentSpec; 
	$color = imagecolorallocate($image, 0x77, 0x77, 0x77);
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 31;
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $color, $font, $str);
	$quickIcon = imagecreatefrompng('/home/gearscores/public_html/images/talents/8x8/png/'.$char['class'].' - '.$secTalentSpec.'.png');
	imagecopy($image, $quickIcon, $xcord-9, $ycord-8, 0, 0, 8, 8);
	
	
	$str = $secTalentSpecDist; 
	$color = imagecolorallocate($image, 0x77, 0x77, 0x77);
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 41;
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $color, $font, $str);
}


if ($Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["name"] != "") {
	if (strlen($Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["name"]) <= strlen($Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["name"])) {
		$profName = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["name"];
		$profValue = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["value"]; 
	}
	else {
		$profName = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["name"];
		$profValue = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["value"]; 
	}
	$str = $profName.'  -  '.$profValue; 
	$color = imagecolorallocate($image, 0x00, 0x99, 0x00);
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	if (strlen($str) > 6) $kerning = -1;
	else $kerning = 0;
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str, $kerning);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 51;
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $color, $font, $str, $kerning);
	$quickIcon = imagecreatefrompng('/home/gearscores/public_html/images/professions/8x8/png/'.$profName.'.png');
	imagecopy($image, $quickIcon, $xcord-9, $ycord-8, 0, 0, 8, 8);
	
	if (strlen($Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["name"]) <= strlen($Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["name"])) {
		$profName = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["name"];
		$profValue = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["1"]["value"]; 
	}
	else {
		$profName = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["name"];
		$profValue = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["0"]["value"]; 
	}
	$str = $profName.'  -  '.$profValue; 
	$color = imagecolorallocate($image, 0x00, 0x99, 0x00);
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	if (strlen($str) > 6) $kerning = -1;
	else $kerning = 0;
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str, $kerning);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 61;
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $color, $font, $str, $kerning);
	$quickIcon = imagecreatefrompng('/home/gearscores/public_html/images/professions/8x8/png/'.$profName.'.png');
	imagecopy($image, $quickIcon, $xcord-9, $ycord-8, 0, 0, 8, 8);
}
else if ($Character["characterinfo"]["charactertab"]["professions"]["skill"]["name"] != "") {
	$profName = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["name"];
	$profValue = $Character["characterinfo"]["charactertab"]["professions"]["skill"]["value"]; 
	$str = $profName.'  -  '.$profValue; 
	$color = imagecolorallocate($image, 0x00, 0x99, 0x00);
	$fontSize = "8";
	$font = '/home/gearscores/public_html/includes/fonts/calibrib.ttf';
	if (strlen($str) > 6) $kerning = -1;
	else $kerning = 0;
	$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str, $kerning);
	$textwidth = abs($box[4] - $box[0]);
	$textheight = abs($box[5] - $box[1]);
	$xcord = 381 - ($textwidth)+3;
	$ycord = 51;
	imagettftextkern($image, $fontSize, $fontRotation, $xcord, $ycord, $color, $font, $str, $kerning);
	$quickIcon = imagecreatefrompng('/home/gearscores/public_html/images/professions/8x8/png/Alchemy.png');
	imagecopy($image, $quickIcon, $xcord-9, $ycord-8, 0, 0, 8, 8);
}


$str = 'GearScore'; 
$color = imagecolorallocate($image, 0x00, 0x00, 0x00);
$fontSize = "10";
$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
imagettftextkern($image, $fontSize, $fontRotation, 220, 19, $colorShadow, $font, $str);
imagettftextkern($image, $fontSize, $fontRotation, 219, 18, $color, $font, $str);

$gsColorString = getGSColorStyle($char['highestgs']);
$gsColorR = hexdec(substr($gsColorString,7,2));
$gsColorG = hexdec(substr($gsColorString,9,2));
$gsColorB = hexdec(substr($gsColorString,11,2));
$str = $char['highestgs']; 
$color = imagecolorallocate($image, $gsColorR, $gsColorG, $gsColorB);
$fontSize = "18";
$font = '/home/gearscores/public_html/includes/fonts/arial.ttf';
$box = @imageTTFBboxkern($fontSize,$fontRotation,$font,$str, 1);
$textwidth = abs($box[4] - $box[0]);
$xcord = 252 - ($textwidth/2);
imagettftextkern($image, $fontSize, $fontRotation, $xcord+1, 43, $colorShadow, $font, $str,1);
imagettftextkern($image, $fontSize, $fontRotation, $xcord, 42, $color, $font, $str,1);




header("Content-Type: image/jpeg");
imagejpeg($image,'/home/gearscores/public_html/images/sigs/generated/'.$region.$char['id'].'.jpg',96);
imagejpeg($image,NULL,96);
imagedestroy($image);
imagedestroy($raceIcon);
imagedestroy($classIcon);
imagedestroy($quickIcon);

require_once ("/home/gearscores/public_html/includes/closedb.php");
?>