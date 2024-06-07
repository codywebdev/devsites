<?php
	
	include "/home/goofology/public_html/phpincludes/escapeString.php";
	
	function printError() {
		echo '<h3>Unknown Link.</h3>';
		exit();
	}
	
	$location = isset($_GET['loc'])? escapeString($_GET['loc']) : NULL;
	$id = isset($_GET['id'])? escapeString($_GET['id']) : NULL;
	$name = ($_GET['name']!='undefined')? escapeString($_GET['name']) : NULL;
	$viewType = isset($name)? 'moderateLink' : 'viewLink';
	$length = isset($_GET['length'])? escapeString($_GET['length']) : 50;
	if ($length<1 || $length>500) { $length=50; }
	$prev = isset($_GET['prev'])? urlencode(escapeString($_GET['prev'])) : NULL;
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0"'
			  .' class="linkTableBorder"><tr><td valign="top"><font class="boldText">'
			  .'<a href="'.$viewType.'.php?link=';
	
	$result = mysql_query("SELECT *  FROM `links` WHERE `id` = $id LIMIT 0, 10");
	if(!$line = mysql_fetch_array($result)) {
		$result = mysql_query("SELECT *  FROM `newlinks` WHERE `name` = CONVERT(_utf8 '$name' 
						       USING latin1) COLLATE latin1_swedish_ci LIMIT 0, 10");
		if(!$line = mysql_fetch_array($result)) {
			$result = mysql_query("SELECT *  FROM `reportedlinks` WHERE `id` = $id LIMIT 0, 10");
			if(!$line = mysql_fetch_array($result)) {
				echo $name;
				exit();
				printError();
			}
		}
	}
	
	$name = $line['name'];
	$url = $line['url'];
	$description = $line['description'];
	$category = $line['category'];
	$username = $line['username'];	
	$addName = isset($name)? ',\''.urlencode($name).'\'' : NULL;
	
	//truncate description length
	$description = substr($description, 0, ($length-strlen($name)));
	if (strlen($description)==($length-strlen($name))) {$description .= '...';}
	
	
	$newHtml .= $url . '&prev='.$prev.'">' . $name . '</a></font><font class="normalText"> - ' 
			   .$description . '</font></td><td width="50" align="right" valign="top">'
			   .'<font class="boldText"><a href="javascript:expandLink(\'' . $id
			   .'\',\'' . $location . '\',\''.$prev.'\','.$length.''.$addName.')" '
			   .'class="boldTextSmall">More[+]</a>'
			   .'</font></td></tr></table>';
	
	echo $newHtml;
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>