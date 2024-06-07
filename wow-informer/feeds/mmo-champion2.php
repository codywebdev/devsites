<?php 	
	$rawFile = file_get_contents('http://www.mmo-champion.com/index.php?type=rss;action=.xml;board=2.0;sa=news;limit=1');
	$newFile = htmlspecialchars($rawFile, ENT_QUOTES);
	$newFile = preg_replace('/[^(\x20-\x7F)\n\t\_]*/','',$newFile);
	$newFile = htmlspecialchars_decode($newFile, ENT_QUOTES);
	$newFile = preg_replace('/(&nbsp;)/','',$newFile);
	
	// Any of the following characters must be escaped (interpreted literally) with a '\': [\^$.|?*+(){}
	// Note: to escape a backslash, you must type four backslashes '\\\\'
	// For help, visit: http://msdn.microsoft.com/en-us/library/aa833197(VS.80).aspx
	//$beginStr = '<!DOCTYPE ';
	//$endStr = 'Boubouille<\/a>.*<\/cite>';
	//$newFile = preg_replace('/'.$beginStr.'.*'.$endStr.'/iU','',$newFile);
	echo $newFile;
	
	
	
?>