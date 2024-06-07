<?php 	
	$rawFile = file_get_contents('http://justmytwocopper.blogspot.com/');
	$newFile = htmlspecialchars($rawFile, ENT_QUOTES);
	$newFile = preg_replace('/[^(\x20-\x7F)\_]*/','',$newFile);
	$newFile = htmlspecialchars_decode($newFile, ENT_QUOTES);
	$newFile = preg_replace('/(&nbsp;)/','',$newFile);
	
	// Any of the following characters must be escaped (interpreted literally) with a '\': [\^$.|?*+(){}
	// Note: to escape a backslash, you must type four backslashes '\\\\'
	// For help, visit: http://msdn.microsoft.com/en-us/library/aa833197(VS.80).aspx
	//$beginStr = '<!DOCTYPE ';
	//$endStr = 'Boubouille<\/a>.*<\/cite>';
	//$newFile = preg_replace('/'.$beginStr.'.*'.$endStr.'/iU','',$newFile);
	//echo $newFile;
	
	
	
	$beginLink = "hentry'><a name='" . ".*" . "<a href='";
	$endLink = "'>";
	preg_match('/'.$beginLink.'/iU',$newFile,$fullBeginLink);
	preg_match('/'.$endLink.'/iU',$newFile,$fullEndLink);
	$fullBeginLink = $fullBeginLink[0];
	$fullEndLink = $fullEndLink[0];
	preg_match('/'.$beginLink.'.*'.$endLink.'/iU',$newFile,$link);
	$link[0] = substr($link[0], strlen(preg_replace('/\\\\/','',$fullBeginLink)) - strlen($link[0]), strlen($link[0]) - strlen(preg_replace('/\\\\/','',$fullBeginLink)) - strlen(preg_replace('/\\\\/','',$fullEndLink)));;
	
	
	
	
	$beginTitle = "hentry'><a name='" . ".*" . "<a href='" . ".*" . "'>";
	$endTitle = "<\/a>";
	preg_match('/'.$beginTitle.'/iU',$newFile,$fullBeginTitle);
	preg_match('/'.$endTitle.'/iU',$newFile,$fullEndTitle);
	$fullBeginTitle = $fullBeginTitle[0];
	$fullEndTitle = $fullEndTitle[0];
	preg_match('/'.$beginTitle.'.*'.$endTitle.'/iU',$newFile,$title);
	$title[0] = substr($title[0], strlen(preg_replace('/\\\\/','',$fullBeginTitle)) - strlen($title[0]), strlen($title[0]) - strlen(preg_replace('/\\\\/','',$fullBeginTitle)) - strlen(preg_replace('/\\\\/','',$fullEndTitle)));;
	
	
	
	$beginBody = "<div class='post-body entry-content'>";
	$endBody = "<div style='clear: both;'><\/div>";
	preg_match('/'.$beginBody.'/iU',$newFile,$fullBeginBody);
	preg_match('/'.$endBody.'/iU',$newFile,$fullEndBody);
	$fullBeginBody = $fullBeginBody[0];
	$fullEndBody = $fullEndBody[0];
	preg_match('/'.$beginBody.'.*'.$endBody.'/iU',$newFile,$body);
	$body[0] = substr($body[0], strlen(preg_replace('/\\\\/','',$fullBeginBody)) - strlen($body[0]), strlen($body[0]) - strlen(preg_replace('/\\\\/','',$fullBeginBody)) - strlen(preg_replace('/\\\\/','',$fullEndBody)));;
	
	
	//echo 'Link: ' . $link[0] . '<br />Title: ' . $title[0] . '<br />Body: ' . $body[0]
	
?><?php echo '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\n"; ?>
<rss version="0.92" xml:lang="en-US">
	<channel>
		<title>MMO-Champion - World of Warcraft Guides and Raid Strategies - News</title>
		<link>http://www.mmo-champion.com/index.php</link>
		<description><![CDATA[Live information from MMO-Champion - World of Warcraft Guides and Raid Strategies]]></description>
		<item>
			<title><![CDATA[<?php echo $title[0]; ?>]]></title>
			<link><?php echo $link[0]; ?></link>
			<description>
<![CDATA[<?php echo $body[0]; ?>]]>
			</description>
			<comments><?php echo $link[0]; ?>?action=post</comments>
			<category><![CDATA[News]]></category>
			<pubDate>Thu, 01 Jan 2009 01:01:01 GMT</pubDate>
			<guid><?php echo $link[0]; ?></guid>
		</item>
	</channel>
</rss>