<?php /*
	$rawFile = file_get_contents('http://www.wowblues.com/feed-xml.php');
	$modifiedFile = str_replace(array("<![CDATA[", "]]>", "<div id=\\\"lol"), "", $rawFile);
	$modifiedFile = strip_tags($modifiedFile, "<root><topic><title><link><forum><area><replies><author><type><comments><comment><text><time><author>");
	$modifiedFile = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . $modifiedFile;
	$modifiedFile = str_replace("\\\">", "", $modifiedFile);
	//$modifiedFile = str_replace("\\\"", "", $modifiedFile);
	//$modifiedFile = str_replace("\\'", "", $modifiedFile);

	//$modifiedFile = preg_replace('/<div[^>]*>/i', "", $modifiedFile);///\[QUOTE - [^\]]*\]/i
	
	
	
	
	//print_r($modifiedFile);
	$xml = simplexml_load_string($modifiedFile);
	print_r($xml);
  */
?><!--
Powered by <a href="http://www.wowblues.com">WoW Blues</a>.
-->
<br />
<script src="http://www.wowblues.com/js/blues.js?direct=yes&amount=20" type="text/javascript"></script>
