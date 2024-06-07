<?php
//escapes a string so that it can be safely used in a mysql expression
//prevents various types of sql injection

	function escapeString($str) {
		if(get_magic_quotes_gpc()) {
			if(ini_get('magic_quotes_sybase')) {
				$newStr        = str_replace("''", "'", $str);
			} else {
				$newStr        = stripslashes($str);
			}
		} else {
			$newStr        = $str;
		}
		return $newStr;
	}

?>