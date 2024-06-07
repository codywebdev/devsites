<?php

   function checkCharacters($str) // returns true if all characters are valid, false if not
   {
   		if (preg_match('/[^a-z!.?"\', \d]/i',stripslashes($str)))
   		{
    		return false;
		} 
		else 
		{
    		return true;
		}
   }
   
   function checkCharactersUrl($str) // returns true if all characters are valid, false if not
   {
   		$newStr = preg_replace('/\//','', $str);
   		if (preg_match('/[^a-z:.?&#= \d]/i',$newStr))
   		{	
    		return false;
		} 
		else 
		{
    		return true;
		}
   }
   
   function checkDescription($string)
   {
   		if (checkCharacters($string)) //string has valid characters
   		{
			if (strlen($string) > 29) //string has at least 30 characters
			{
				if (strlen($string) < 201) //string has less than 200 characters
				{
					//explode string into an array of words
					$explodeString = explode(" ", $string);
					$arrSize = count($explodeString);
					//make sure there are no words longer than 15 chars
					for ($i=0;$i<$arrSize;$i++) { 
						if(strlen($explodeString[$i]) > 25) {
							echo "<font color=\"Red\" class=\"errorstyle\">Each word must be less "
								."than 25 characters long.</font>";
							return false;
						}
					}
					echo "<img src=\"/images/check.png\" />";
					return true;
				}
				else
				{
				echo "<font color=\"Red\" class=\"errorstyle\">A maximum of 200 characters are allowed in this field."
					."<br>Total Characters: <b>" . strlen($string) . "</b></font>";
				return false;
				}
			}
			else
			{
			echo "<font color=\"Red\" class=\"errorstyle\">Please be more descriptive.</font>";
			return false;
			}
		}
		else
		{
		echo "<font color=\"Red\" class=\"errorstyle\">Illegal character in string.</font>";
		return false;
		}
   }
   
      function checkCategory($string)
   {
   		if ($string=='Fun Stuff'||
			$string=='Humor'||
			$string=='Games'||
			$string=='Quizzes & Trivia'||
			$string=='Weird'||
			$string=='Music & Sound'||
			$string=='Love & Romance') //string has valid selection
   		{
			echo "<img src=\"/images/check.png\" />";
			return true;
		}
		else
		{
			echo "<font color=\"Red\" class=\"errorstyle\">Please select a category.</font>";
			return false;
		}
   }

   function checkName($string)
   {
   		if (checkCharacters($string)) //string has valid characters
   		{
			if (strlen($string) > 4) //string has at least 5 characters
			{
				if (strlen($string) < 41) //string has less than 50 characters
				{
				   include '/home/goofology/public_html/phpincludes/config.php';
				   include '/home/goofology/public_html/phpincludes/opendb.php';
				   
				   $result = mysql_query("SELECT *  FROM `links` WHERE `name` LIKE 
										  CONVERT(_utf8 '$string' USING latin1) COLLATE 
										  latin1_swedish_ci") or die(mysql_error());
				   if(!$line = mysql_fetch_array($result)) //if name is not found
				   {
						$result = mysql_query("SELECT *  FROM `newlinks` WHERE `name` LIKE 
											   CONVERT(_utf8 '$string' USING latin1) COLLATE 
											   latin1_swedish_ci") or die(mysql_error());
						if(!$line = mysql_fetch_array($result)) //if name is not found
						{	
							$result = mysql_query("SELECT *  FROM `reportedlinks` WHERE `name` LIKE 
												   CONVERT(_utf8 '$string' USING latin1) COLLATE 
												   latin1_swedish_ci") or die(mysql_error());
							if(!$line = mysql_fetch_array($result)) //if name is not found
							{	
								//explode string into an array of words
								$explodeString = explode(" ", $string);
								$arrSize = count($explodeString);
								//make sure there are no words longer than 15 chars
								for ($i=0;$i<$arrSize;$i++) { 
									if(strlen($explodeString[$i]) > 15) {
										echo "<font color=\"Red\" class=\"errorstyle\">Each word must be less "
											."than 15 characters long.</font>";
										return false;
									}
								}
								echo "<img src=\"/images/check.png\" />";	
								return true;
							}
							else //if name is found
							{
								echo "<font color=\"Red\" class=\"errorstyle\">Name already used.</font>";
								return false;
							}
						}
						else //if name is found
						{
							echo "<font color=\"Red\" class=\"errorstyle\">Name already used.</font>";
							return false;
						}
				   }
				   else  //if name is found
				   {
						echo "<font color=\"Red\" class=\"errorstyle\">Name already used.</font>";
						return false;
				   }
			
				   
				   include '/home/goofology/public_html/phpincludes/closedb.php';
				}
				else
				{
					echo "<font color=\"Red\" class=\"errorstyle\">A maximum of 40 "
						."characters are allowed in this field."
						."<br>Total Characters: <b>" . strlen($string) . "</b></font>";
					return false;
				}
			}
			else
			{
				echo "<font color=\"Red\" class=\"errorstyle\">A minimum of 5 characters "
					."are allowed in this field.</font>";
				return false;
			}
		}
		else
		{
			echo "<font color=\"Red\" class=\"errorstyle\">Illegal character in string.</font>";
			return false;
		}

   }
   
   function checkUrl($string)
   {
		$url=$string;
		$newUrl=parse_url($url);
		
		if (!checkCharactersUrl($url))
		{
			echo '<font color="Red" class="errorstyle">Invalid character in URL.</font>';
			return false;
		}
		
		if (count($newUrl) < 1)
		{
			echo '<font color="Red" class="errorstyle">Please enter URL.</font>';
			return false;
		}
		
		if ($url == 'http://' || $url == 'https://')
		{
			echo '<font color="Red" class="errorstyle">Please enter URL.</font>';
			return false;
		}
		
		if (!($newUrl['scheme']=='http'||$newUrl['scheme']=='https')) 
		{	//if not == http or https
			echo '<font color="Red" class="errorstyle">Must begin with http://</font>';
			return false;
		}
		
		if (!preg_match("/^((\w+\.){1,})\w{2,}$/i", $newUrl['host'])) 
		{	//if not www.hostname.xxx format
			echo '<font color="Red" class="errorstyle">Invalid URL.</font>';
			return false;
		}
		
		$splitHost = preg_split('/[.]/i', $newUrl['host']);
		$host = $splitHost[(count($splitHost)-1)];
				
		if (!($host=='com'||$host=='net'||$host=='org'||$host=='edu'||$host=='gov'))
		{	//if not .com .net .org .edu .gov
			echo '<font color="Red" class="errorstyle">Invalid URL.</font>';
			return false;
		}
		
		if (strlen($newUrl['path']) < 2) 
		{	//if path is blank or '/'
			if (checkdnsrr($newUrl['host'], 'MX'))
			{
				echo '<img src="/images/check.png" />';
				return true;
			}
			else
			{
				echo '<font color="Red" class="errorstyle">Invalid URL.</font>';
				return false;
			}
		}
		
		$splitPath = preg_split('/[.]/i', $newUrl['path']);
		$path = $splitPath[(count($splitPath)-1)];
		
		if ($path=='exe') //if executable file
		{
			echo '<font color="Red" class="errorstyle">Invalid URL.</font>';
			return false;
		}
				
		if (!checkdnsrr($newUrl['host'], 'MX'))
		{
			echo '<font color="Red" class="errorstyle">Invalid URL.</font>';
			return false;
		}

		
		//if URL passes all the tests
		echo '<img src="/images/check.png" />';
		return true;
   }


?>