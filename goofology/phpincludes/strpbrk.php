<?php
//Search a string for any of a set of characters

	function my_strpbrk($haystack, $char_list) 
	{
		$pos = strcspn($haystack, $char_list);
		
		if ($pos == strlen($haystack))
		  return FALSE;
	
		return substr($haystack, $pos);
	}

?>