<?php

	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	include '/home/goofology/public_html/phpincludes/memberCheck.php';
	include '/home/goofology/public_html/phpincludes/calcGP.php';
	include '/home/goofology/public_html/phpincludes/goofVars.php';
	include '/home/goofology/public_html/phpincludes/escapeString.php';


	$screenname = isset($_COOKIE['screenname'])? escapeString($_COOKIE['screenname']) : ' ';
	$password = isset($_COOKIE['password'])? escapeString($_COOKIE['password']) : '';
	$vote=isset($_POST['vote'])? escapeString($_POST['vote']) : '';
	$id=isset($_POST['id'])? escapeString($_POST['id']) : '';
	$url = NULL;
	
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
		echo 'Please login.</td></tr></table>';
		return false;
	}
	
	//verify login info
	if (!($screenname==$line['screenname'] && $password==$line['password'] && $_SERVER['REMOTE_ADDR']==$line['ipaddress'])) {
		echo 'Please login.</td></tr></table>';
		return false;
	}
	
	//verify member is allowed to moderate
	$awards = $line['awards'];
	if ($awards[1]!=1) {
		echo 'You are not allowed to moderate.</td></tr></table>';
		return false;
	}
	  
	$result = mysql_query("SELECT *  FROM `reportedlinks` WHERE `id` = '$id'") or die(mysql_error());
	$line = mysql_fetch_array($result);
	if (!$line['name']) {
		//if url not found
		$result = mysql_query("SELECT *  FROM `newlinks` WHERE `url` = '$id'") or die(mysql_error());
		$line = mysql_fetch_array($result);
		if(!$line['name']) {
			//if url not found
			echo 'Invalid url.</td></tr></table>';
			return false;
		}
		else {
			$url = $id;
		}
	}
	
	//reported links
	if($vote=='yes' && !$url) {
		//retrieve ipaddress list and check to see if ip address has already reported this
		$iparray = array();
		$iparray = unserialize($line['yesiplist']);
		$curIP = $_SERVER['REMOTE_ADDR'];
		//search for a match in the array, if there is no match, then insert new IP address
		if (array_search($curIP, $iparray)===false) {
				array_push($iparray, $curIP);
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` + 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);

			}
			
		//search other iparray to see if vote has already been cast
		$otheriparray = array();
		$otheriparray = unserialize($line['noiplist']);
		if (array_search($curIP, $otheriparray)!==false) {
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` - 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);
				//delete ip address from other array
				$key = array_search($id, $otheriparray);
				unset($otheriparray[$key]);
				//generate a new array from old with sequential index
				$newotheriparray=array();
				foreach($otheriparray as $a) {
					array_push($newotheriparray, $a);
				}
				//return the new otherarray to the link record
				$otherstring = serialize($newotheriparray);
				mysql_query("UPDATE `reportedlinks` SET `noiplist` = '$otherstring' 
							WHERE `id` = '$id' LIMIT 1") or die(mysql_error()); 
			}
			
		//if ip list has max number of votes then send link to links table
		if (count($iparray) >= $goofMaxModeratorVotes) {
			//send link to links table and delete record
			$name=$line['name'];
			$url=$line['url'];
			$description=addslashes($line['description']);
			$category=$line['category'];
			$screenname=$line['screenname'];
			$clicked=$line['clicked'];
			$date=$line['date'];
			$yes=$line['yes'];
			$no=$line['no'];
			mysql_query("INSERT INTO `links` (`id`, `name`, `url`, `description`, 
			            `category`, `screenname`, `clicked`, `date`, `yes`, `no`, 
						`reportiplist`) VALUES 
						('$id', '$name', '$url', '$description', '$category', '$screenname', 
						'$clicked', '$date', '$yes', '$no', 'a:0:{}')") or die(mysql_error());
			
			//delete the old entry from the reportedlinks table
			mysql_query("DELETE FROM `reportedlinks` WHERE `id` = '$id' LIMIT 1") or die(mysql_error());
		}
		else {
			//return the new iparray to the link record in reportedlinks table
			$ipstring = serialize($iparray);
			mysql_query("UPDATE `reportedlinks` SET `yesiplist` = '$ipstring' 
						WHERE `id` = '$id' LIMIT 1") or die(mysql_error()); 
		}
		echo 'Link Approved.</td></tr></table>';
		return true;
	}
	
	else if($vote=='no' && !$url) {
		//retrieve ipaddress list and check to see if ip address has already reported this
		$iparray = array();
		$iparray = unserialize($line['noiplist']);
		$curIP = $_SERVER['REMOTE_ADDR'];
		//search for a match in the array, if there is no match, then insert new IP address
		if (array_search($curIP, $iparray)===false) {
				array_push($iparray, $curIP);
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` + 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);
			}

		//search other iparray to see if vote has already been cast
		$otheriparray = array();
		$otheriparray = unserialize($line['yesiplist']);
		if (array_search($curIP, $otheriparray)!==false) {
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` - 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);
				//delete ip address from other array
				$key = array_search($id, $otheriparray);
				unset($otheriparray[$key]);
				//generate a new array from old with sequential index
				$newotheriparray=array();
				foreach($otheriparray as $a) {
					array_push($newotheriparray, $a);
				}
				//return the new otherarray to the link record
				$otherstring = serialize($newotheriparray);
				mysql_query("UPDATE `reportedlinks` SET `yesiplist` = '$otherstring' 
							WHERE `id` = '$id' LIMIT 1") or die(mysql_error()); 
			}
			
		//if ip list has max number of votes then send link to deletedlinks table
		if (count($iparray) >= $goofMaxModeratorVotes) {
			//send link to deletedlinks table and delete record
			$name=$line['name'];
			$url=$line['url'];
			$description=addslashes($line['description']);
			$category=$line['category'];
			$screenname=$line['screenname'];
			$clicked=$line['clicked'];
			$date=$line['date'];
			$yes=$line['yes'];
			$no=$line['no'];
			mysql_query("INSERT INTO `deletedlinks` (`id`, `name`, `url`, `description`, 
			            `category`, `screenname`, `clicked`, `date`, `yes`, `no`) VALUES 
						('$id', '$name', '$url', '$description', '$category', '$screenname', 
						'$clicked', '$date', '$yes', '$no')") or die(mysql_error());
			
			//delete the old entry from the reportedlinks table
			mysql_query("DELETE FROM `reportedlinks` WHERE `id` = '$id' LIMIT 1") or die(mysql_error());
		}
		else {
			//return the new iparray to the link record in reportedlinks table
			$ipstring = serialize($iparray);
			mysql_query("UPDATE `reportedlinks` SET `noiplist` = '$ipstring' 
						WHERE `id` = '$id' LIMIT 1") or die(mysql_error()); 
		}
		echo 'Link Declined.</td></tr></table>';
		return true;
	}
	
	
	
	
	
	
	
	
	
	
	
	//new links
	else if($vote=='yes' && $url) {
		//retrieve ipaddress list and check to see if ip address has already reported this
		$iparray = array();
		$iparray = unserialize($line['yesiplist']);
		$curIP = $_SERVER['REMOTE_ADDR'];
		//search for a match in the array, if there is no match, then insert new IP address
		if (array_search($curIP, $iparray)===false) {
				array_push($iparray, $curIP);
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` + 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);
			}
			
		//search other iparray to see if vote has already been cast
		$otheriparray = array();
		$otheriparray = unserialize($line['noiplist']);
		if (array_search($curIP, $otheriparray)!==false) {
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` - 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//re-calculateGP
				calcGP($screenname);
				//delete ip address from other array
				$key = array_search($id, $otheriparray);
				unset($otheriparray[$key]);
				//generate a new array from old with sequential index
				$newotheriparray=array();
				foreach($otheriparray as $a) {
					array_push($newotheriparray, $a);
				}
				//return the new otherarray to the link record
				$otherstring = serialize($newotheriparray);
				mysql_query("UPDATE `newlinks` SET `noiplist` = '$otherstring' 
							WHERE `url` = '$url' LIMIT 1") or die(mysql_error()); 
			}
			
		//if ip list has max number of votes then send link to links table
		if (count($iparray) >= $goofMaxModeratorVotes) {
			//send link to links table and delete record
			$name=$line['name'];
			$url=$line['url'];
			$description=addslashes($line['description']);
			$category=$line['category'];
			$screenname=$line['screenname'];
			mysql_query("INSERT INTO `links` (`name`, `url`, `description`, 
			            `category`, `screenname`, `reportiplist`) VALUES 
						('$name', '$url', '$description', '$category', '$screenname', 'a:0:{}')") or die(mysql_error());
			
			//delete the old entry from the reportedlinks table
			mysql_query("DELETE FROM `newlinks` WHERE `url` = '$url' LIMIT 1") or die(mysql_error());
		}
		else {
			//return the new iparray to the link record in reportedlinks table
			$ipstring = serialize($iparray);
			mysql_query("UPDATE `newlinks` SET `yesiplist` = '$ipstring' 
						WHERE `url` = '$url' LIMIT 1") or die(mysql_error()); 
		}
		echo 'Link Approved.</td></tr></table>';
		return true;
	}
	
	else if($vote=='no' && $url) {
		//retrieve ipaddress list and check to see if ip address has already reported this
		$iparray = array();
		$iparray = unserialize($line['noiplist']);
		$curIP = $_SERVER['REMOTE_ADDR'];
		//search for a match in the array, if there is no match, then insert new IP address
		if (array_search($curIP, $iparray)===false) {
				array_push($iparray, $curIP);
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` + 1) WHERE `screenname` = '$screenname' LIMIT 1");
			}

		//search other iparray to see if vote has already been cast
		$otheriparray = array();
		$otheriparray = unserialize($line['yesiplist']);
		if (array_search($curIP, $otheriparray)!==false) {
				mysql_query("UPDATE `members` SET `moderated` = (`moderated` - 1) WHERE `screenname` = '$screenname' LIMIT 1");
				//delete ip address from other array
				$key = array_search($id, $otheriparray);
				unset($otheriparray[$key]);
				//generate a new array from old with sequential index
				$newotheriparray=array();
				foreach($otheriparray as $a) {
					array_push($newotheriparray, $a);
				}
				//return the new otherarray to the link record
				$otherstring = serialize($newotheriparray);
				mysql_query("UPDATE `newlinks` SET `yesiplist` = '$otherstring' 
							WHERE `url` = '$url' LIMIT 1") or die(mysql_error()); 
			}
			
		//if ip list has max number of votes then send link to deletedlinks table
		if (count($iparray) >= $goofMaxModeratorVotes) {
			//send link to deletedlinks table and delete record
			$name=$line['name'];
			$url=$line['url'];
			$description=addslashes($line['description']);
			$category=$line['category'];
			$screenname=$line['screenname'];
			mysql_query("INSERT INTO `deletedlinks` (`name`, `url`, `description`, 
			            `category`, `screenname`) VALUES 
						('$name', '$url', '$description', '$category', '$screenname')") or die(mysql_error());
			
			//delete the old entry from the reportedlinks table
			mysql_query("DELETE FROM `newlinks` WHERE `url` = '$url' LIMIT 1") or die(mysql_error());
		}
		else {
			//return the new iparray to the link record in reportedlinks table
			$ipstring = serialize($iparray);
			mysql_query("UPDATE `newlinks` SET `noiplist` = '$ipstring' 
						WHERE `url` = '$url' LIMIT 1") or die(mysql_error()); 
		}
		echo 'Link Declined.</td></tr></table>';
		return true;
	}
	
	
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>
