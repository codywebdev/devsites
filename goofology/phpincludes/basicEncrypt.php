<?php 
// basic url-safe encoding/decoding method, not to be used with sensitive data (easily cracked)

function encrypt($string) {
	$newstring = urlencode(base64_encode($string));
	return $newstring;
}

function decrypt($string) {
	$newstring = urldecode(base64_decode($string));
	return $newstring;
}	
	
?>