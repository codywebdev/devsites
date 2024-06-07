<?php
/*
RSS Feed Poster
Version 1.0.0
by:vbgamer45
http://www.smfhacks.com
*//*
ini_set("display_errors",1);
// SSI needed to get SMF functions
require('SSI.php');

// For the rss functions
if (isset($smcFunc))
	require_once($sourcedir . '/Subs-RSS2.php');
else
	require_once($sourcedir . '/Subs-RSS.php');

UpdateRSSFeedBots();
die($txt['smfrssposter_admin']);*/echo "test";
?>