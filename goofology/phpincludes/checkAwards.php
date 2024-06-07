<?php
//Checks to see if the member has earned any new awards

	function checkAwards($screenname, $randomNumber) {
		//fetch the record containing the users 'screenname'
		$result = mysql_query("SELECT *  FROM `members` 
							  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
							  USING latin1) COLLATE latin1_swedish_ci") 
							  or die(mysql_error());
		$line = mysql_fetch_array($result);
		if (!$line['screenname']) {
			//if screenname not found (not logged in)
			return false;
		}
		else {
			include '/home/goofology/public_html/phpincludes/goofVars.php';
			$awards = $line['awards'];
			$goofpoints = $line['goofpoints'];
			$clicked = $line['clicked'];
			$voted = $line['voted'];
			$contribution = $line['contribution'];
			$moderated = $line['moderated'];
			if ($awards[0]==0 && $goofpoints>=$goofLevel2) { 
				$awards[0] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Rank 1"!\');</script>'; 
			}
			if ($awards[1]==0 && $goofpoints>=$goofLevel3) { 
				$awards[1] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Rank 2"!\');</script>'; 
			}
			if ($awards[2]==0 && $moderated>=$goofEliteModerator) { 
				$awards[2] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Elite Moderator"!\');</script>'; 
			}
			if ($awards[3]==0 && $clicked>=$goofExpertGoof) { 
				$awards[3] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Expert Goof"!\');</script>'; 
			}
			if ($awards[4]==0 && $voted>=$goofFantasticVoter) { 
				$awards[4] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Fantastic Voter"!\');</script>'; 
			}
			if ($awards[5]==0 && $contribution>=$goofSupremeGoofologist) { 
				$awards[5] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Supreme Goofologist"!\');</script>'; 
			}
			if ($awards[6]==0 && $randomNumber==$goofRareLinkFinder) { 
				$awards[6] = 1; 
				echo '<script language="JavaScript">'
					.'alert (\'You have earned a new award: "Rare Link Finder"!\');</script>'; 
			}
			mysql_query("UPDATE `members` SET `awards` = '$awards' 
			   			WHERE `screenname` = '$screenname' LIMIT 1");  
		}
		return $awards;
	}
?>