<?php 
function encrypt($string) {
	$newstring = urldecode(base64_decode($string));
	return $newstring;
}	
	
?>