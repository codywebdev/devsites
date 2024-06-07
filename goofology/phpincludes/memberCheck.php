<?php
// contains the functions to check member info when signing up

   function checkCharacters($str) 
   {// returns true if all characters are valid, false if not
   		if (preg_match('/[^a-z\d]/i',stripslashes($str)))
   		{
    		return false;
		} 
		else 
		{
    		return true;
		}
   }
   
   function checkCharactersAboutme($str) 
   {// returns true if all characters are valid, false if not
   		if (preg_match('/[^a-z:();"\'\\/@.!? \d]/i',stripslashes($str)))
   		{
    		return false;
		} 
		else 
		{
    		return true;
		}
   }


   function checkCharactersName($str) 
   {// returns true if all characters are valid, false if not
   		if (preg_match('/[^a-z\']/i',stripslashes($str)))
   		{
    		return false;
		} 
		else 
		{
    		return true;
		}
   }
	
   function checkCharactersEmail($str) 
   {// returns true if all characters are valid, false if not
   		$newStr = preg_replace('/\//','', $str);
   		if (preg_match('/[^a-z@!#%`_\/$*?^{}|~.-\d]/i',$newStr))
   		{	
    		return false;
		} 
		else 
		{
    		return true;
		}
   }
   
      function checkCharactersUsername($str) 
   {// returns true if all characters are valid, false if not
   		$newStr = preg_replace('/\//','', $str);
   		if (preg_match('/[^a-z-_\d]/i',$newStr))
   		{	
    		return false;
		} 
		else 
		{
    		return true;
		}
   }

	function isValidEmail($email)
	{
	   $isValid = true;
	   $atIndex = strrpos($email, "@");
	   if (is_bool($atIndex) && !$atIndex)
	   {
		  $isValid = false;
	   }
	   else
	   {
		  $domain = substr($email, $atIndex+1);
		  $local = substr($email, 0, $atIndex);
		  $localLen = strlen($local);
		  $domainLen = strlen($domain);
		  if ($localLen < 1 || $localLen > 64)
		  {
			 // local part length exceeded
			 $isValid = false;
		  }
		  else if ($domainLen < 1 || $domainLen > 255)
		  {
			 // domain part length exceeded
			 $isValid = false;
		  }
		  else if ($local[0] == '.' || $local[$localLen-1] == '.')
		  {
			 // local part starts or ends with '.'
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $local))
		  {
			 // local part has two consecutive dots
			 $isValid = false;
		  }
		  else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
		  {
			 // character not valid in domain part
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $domain))
		  {
			 // domain part has two consecutive dots
			 $isValid = false;
		  }
		  else if
	(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
					 str_replace("\\\\","",$local)))
		  {
			 // character not valid in local part unless 
			 // local part is quoted
			 if (!preg_match('/^"(\\\\"|[^"])+"$/',
				 str_replace("\\\\","",$local)))
			 {
				$isValid = false;
			 }
		  }
		  if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
		  {
			 // domain not found in DNS
			 $isValid = false;
		  }
	   }
	   return $isValid;
	}
   
   function checkPassword($string)
   {
   		if (!checkCharactersUsername($string))
		{
   			echo '<font color="Red" class="errorstyle">Contains illegal characters.</font>';
			return false;
		}
		
		if (strlen($string)<6 || strlen($string)>16)
		{
   			echo '<font color="Red" class="errorstyle">Must be between 6 and 16 characters long.</font>';
			return false;
		}
				
		// if password passes all tests
		echo '<img src="/images/check.png" />';
		return true;
   }
   
      function checkUsername($string)
   {
   		if (!checkCharactersUsername($string))
		{
   			echo '<font color="Red" class="errorstyle">Contains illegal characters.</font>';
			return false;
		}
		
		if (strlen($string)<6 || strlen($string)>16)
		{
   			echo '<font color="Red" class="errorstyle">Must be between 6 and 16 characters long.</font>';
			return false;
		}
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
		$result = mysql_query("SELECT *  FROM `members` 
							  WHERE `username` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{
				echo '<font color="Red" class="errorstyle">Name already used.</font>';
				return false;
			}
		
		$result = mysql_query("SELECT *  FROM `newmembers` 
							  WHERE `username` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{
				echo '<font color="Red" class="errorstyle">Name already used.</font>';
				return false;
			}
		
		include '/home/goofology/public_html/phpincludes/closedb.php';
		
		// if username passes all tests
		echo '<img src="/images/check.png" />';
		return true;
   }
   
      function checkScreenname($string)
   {
   		if (!checkCharactersUsername($string))
		{
   			echo '<font color="Red" class="errorstyle">Contains illegal characters.</font>';
			return false;
		}
		
		if (strlen($string)<6 || strlen($string)>16)
		{
   			echo '<font color="Red" class="errorstyle">Must be between 6 and 16 characters long.</font>';
			return false;
		}
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
		$result = mysql_query("SELECT *  FROM `members` 
							  WHERE `screenname` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{
				echo '<font color="Red" class="errorstyle">Name already used.</font>';
				return false;
			}
			
		$result = mysql_query("SELECT *  FROM `newmembers` 
							  WHERE `screenname` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{
				echo '<font color="Red" class="errorstyle">Name already used.</font>';
				return false;
			}
		
		include '/home/goofology/public_html/phpincludes/closedb.php';
		
		// if screen name passes all tests
		echo '<img src="/images/check.png" />';
		return true;
   }

   
   function checkEmail($string)
   {
   		if (!checkCharactersEmail($string))
		{
   			echo '<font color="Red" class="errorstyle">Contains illegal characters.</font>';
			return false;
		}
		if (!isValidEmail($string))
		{
   			echo '<font color="Red" class="errorstyle">Invalid Email.</font>';
			return false;
		}
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
		$result = mysql_query("SELECT *  FROM `members` 
							  WHERE `email` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{	
				require_once('/home/goofology/public_html/phpincludes/escapeString.php');
				if (isset($_COOKIE['screenname'])) {
					$currentScreenname = escapeString($_COOKIE['screenname']);
					$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$currentScreenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
					if ($line = mysql_fetch_array($result)) {
						if ($string == escapeString($line['email'])) {
							echo '<img src="/images/check.png" />';
							return true;
						}
						else {
						echo '<font color="Red" class="errorstyle">Email already used.</font>';
						return false;
						}
					}
					else {
					echo '<font color="Red" class="errorstyle">Email already used.</font>';
					return false;
					}
				}
				else {
				echo '<font color="Red" class="errorstyle">Email already used.</font>';
				return false;
				}
			}
			
		$result = mysql_query("SELECT *  FROM `newmembers` 
							  WHERE `email` LIKE CONVERT(_utf8 '$string' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
			if($line = mysql_fetch_array($result)) //if name is found
			{
				echo '<font color="Red" class="errorstyle">Email already used.</font>';
				return false;
			}
		
		include '/home/goofology/public_html/phpincludes/closedb.php';


		//if email passes all tests
		echo '<img src="/images/check.png" />';
		return true;
   }
   
   function checkName($string)
   {
   		if (!checkCharactersName($string))
		{
   			echo '<font color="Red" class="errorstyle">Contains illegal characters.</font>';
			return false;
		}
   		
		if (strlen($string)>25)
		{
   			echo '<font color="Red" class="errorstyle">Please use a shorter name.</font>';
			return false;
		}
		
		if (strlen($string)<2)
		{
   			echo '<font color="Red" class="errorstyle">Please enter your name.</font>';
			return false;
		}
		
		//if name passes all tests
		echo '<img src="/images/check.png" />';
		return true;
   }
   
   function checkBmonth($string)
   {
   		if ($string > 0 && $string < 13)
		{return true;}   
		else
		{return false;}
   }
   
   function checkBday($string)
   {
   		if ($string > 0 && $string < 32)
		{return true;}   
		else
		{return false;}
   }
   
   function checkByear($string)
   {
   		if ($string > 1904 && $string <= date('Y'))
		{return true;}   
		else
		{return false;}
   }
   
   function checkDOB($string)
   {
   		$splitDOB = preg_split('/ /', $string);
		$month=$splitDOB[0];
		$day=$splitDOB[1];
		$year=$splitDOB[2];
		if (!checkBmonth($month))
		{ 
			echo '<font color="Red" class="errorstyle">Select Month.</font>';
			return false;
		}		
		if (!checkBday($day))
		{
			echo '<font color="Red" class="errorstyle">Select Day.</font>';
			return false;
		}
		if (!checkByear($year))
		{
			echo '<font color="Red" class="errorstyle">Select Year.</font>';
			return false;
		}
		
		if ($year > (date('Y')-14))
		{
			echo '<font color="Red" class="errorstyle">You must be at least 14 years old'
				.' to use this website.</font>';
			return false;
		}
		
		if ($year == (date('Y')-14))
		{
			if ($month == date('n'))
			{
				if ($day > date('j'))
				{
					echo '<font color="Red" class="errorstyle">You must be at least 14 years old'
						.' to use this website.</font>';
					return false;
				}
			}
			if ($month > date('n'))
			{
				echo '<font color="Red" class="errorstyle">You must be at least 14 years old'
					.' to use this website.</font>';
				return false;
			}
		}
		echo '<img src="/images/check.png" />';
		return true;
   }
   
   function checkGender($string)
   {
   		if ($string == 'male' || $string == 'female')
		{
			echo '<img src="/images/check.png" />';
			return true;
		}
		else
		{
			echo '<font color="Red" class="errorstyle">Please select gender.</font>';
			return false;
		}
   }
   
      function checkLocation($string)
   {
   		if ($string == 'usa' || $string == 'other')
		{
			echo '<img src="/images/check.png" />';
			return true;
		}
		else
		{
			echo '<font color="Red" class="errorstyle">Please select location.</font>';
			return false;
		}
   }
   
   	function confPassword($string) 
	{		
			$newString = explode('*', $string);
   		if ($newString[0] === $newString[1])
		{
			echo '<img src="/images/check.png" />';
			return true;
		}
		else
		{
			echo '<font color="Red" class="errorstyle">Passwords do not match.</font>';
			return false;
		}
	}
	
   	function confEmail($string) 
	{		
			$newString = explode('*goofvar*', $string);
   		if ($newString[0] === $newString[1])
		{
			echo '<img src="/images/check.png" />';
			return true;
		}
		else
		{
			echo '<font color="Red" class="errorstyle">Emails do not match.</font>';
			return false;
		}
	}
	
   function checkAboutme($string)
   {
   		if (checkCharactersAboutme($string)) //string has valid characters
   		{
				if (strlen($string) < 16000000) //string has less than 16000000characters
				{
					//explode string into an array of words
					$explodeString = explode(" ", $string);
					$arrSize = count($explodeString);
					//make sure there are no words longer than 15 chars
					for ($i=0;$i<$arrSize;$i++) { 
						if(strlen($explodeString[$i]) > 25) {
							echo "<font color=\"Red\">Each word must be less "
								."than 25 characters long.</font>";
							return false;
						}
					}
					echo "<img src=\"/images/check.png\" />";
					return true;
				}
				else
				{
				echo "<font color=\"Red\">A maximum of 200 characters are allowed in this field."
					."<br>Total Characters: <b>" . strlen($string) . "</b></font>";
				return false;
				}
		}
		else
		{
		echo "<font color=\"Red\">Illegal character in string.</font>";
		return false;
		}
   }

?>