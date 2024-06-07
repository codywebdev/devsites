<?php
//Calculates the Goofpoints for the specified screenname and returns the value if successful

	function calcGP($screenname) {
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
			$newGP = $line['clicked'] * $goofClickedWeight;
			$newGP += $line['voted'] * $goofVotedWeight;
			$newGP += $line['contribution'] * $goofContributionWeight;
			$newGP += $line['moderated'] * $goofModeratedWeight;
			mysql_query("UPDATE `members` SET `goofpoints` = '$newGP' 
			   			WHERE `screenname` = '$screenname' LIMIT 1") or die(mysql_error());  
		}
		return $newGP;
	}


?>