<?php
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/calcGP.php';
	include '/home/goofology/public_html/phpincludes/escapeString.php';
	
	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : ' ';
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : '';
	$vote=isset($_POST['vote'])? escapeString($_POST['vote']) : '';
	$id=isset($_POST['id'])? escapeString($_POST['id']) : '';
	  
	 echo '<table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="110" height="55" align="center" valign="middle">';
	
	//fetch the record containing the users 'screenname'
	$result = mysql_query("SELECT *  FROM `members` 
						  WHERE `screenname` LIKE CONVERT(_utf8 '$screenname' 
						  USING latin1) COLLATE latin1_swedish_ci") 
						  or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['screenname']) {
		//if screenname not found (not logged in)
		echo 'Please log in.</td></tr></table>';
		return false;
	}
	
	//verify login info
	if (!($screenname==$line['screenname'] && $password==$line['password'] && $_SERVER['REMOTE_ADDR']==$line['ipaddress'])) {
		echo 'Please log in.</td></tr></table>';
		return false;
	}
	
	// if user has voted in last 60 seconds
	if ($line['lastvote']+60 >= time()) {
		echo 'Thanks for voting!</td></tr></table>';
		return false;
	}
	else {//update time voted and add 1 to vote count for the member
		$timeVoted = time();
		$newVoteCount = $line['voted'] + 1;
		mysql_query("UPDATE `members` SET `lastvote` = '$timeVoted', `voted` = '$newVoteCount' WHERE `screenname` = '$screenname' LIMIT 1") or die(mysql_error());  
		//recalculate goofpoints
		calcGP($screenname);
	}
	  
	$result = mysql_query("SELECT *  FROM `links` WHERE `id` = '$id'") or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['name']) {
		//if url not found
		echo 'Invalid url.</td></tr></table>';
		return false;

	}
	else {
		$submittedBy = ($line['screenname']!=$screenname)? $line['screenname'] : NULL;
	}
	
	if($vote=='yes')
	{	
		$newVote = $line['yes'] + 1;
		mysql_query("UPDATE `links` SET `yes` = '$newVote' WHERE `id` = '$id' LIMIT 1") or die(mysql_error());  
		mysql_query("UPDATE `members` SET `contribution` = (`contribution` + 1) WHERE `screenname` = '$submittedBy' LIMIT 1"); 
		echo "Thanks for voting!</td></tr></table>";
		calcGP($submittedBy);
		return true;
	}
	
	else if($vote=='no')
	{	
		$newVote = $line['no'] + 1;
		mysql_query("UPDATE `links` SET `no` = '$newVote' WHERE `id` = '$id' LIMIT 1") or die(mysql_error());  
		echo "Thanks for voting!</td></tr></table>";
		return true;
	}
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>
