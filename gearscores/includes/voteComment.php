<? 
include("functions.php");
include ("config.php");
include ("opendb.php");

$id = $_POST['id'];
$type = $_POST['type'];

	$query = "SELECT * 
	FROM `comments` 
	WHERE `id` LIKE '".mysql_real_escape_string($id)."'
	LIMIT 1";
	$result = mysql_query($query);
	
if (mysql_num_rows($result) > 0) {
	$row = mysql_fetch_assoc($result);
	$character = $row['Character'];
	$realm = $row['realm'];
	$region = $row['region'];
	if (unserialize($row['yes'])) $yes = unserialize($row['yes']); else $yes = array();
	if (unserialize($row['no'])) $no = unserialize($row['no']); else $no = array();
	if (unserialize($row['reported'])) $report = unserialize($row['reported']); else $report = array();
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	
	if ($type == 'yes') {
		//delete ipaddress from $no
		$key = array_search($ipaddress,$no);
		if ($no[$key] == $ipaddress) {
			unset($no[$key]); // remove key from array
		}
		//delete ipaddress from $report
		$key = array_search($ipaddress,$report);
		if ($report[$key] == $ipaddress) {
			unset($report[$key]); // remove key from array
		}
		//add ip address to $yes 
		$key = array_search($ipaddress,$yes);
		if ($yes[$key] != $ipaddress) {
			array_push($yes,$ipaddress);
		}
	}
	
	if ($type == 'no') {
		//delete ipaddress from $yes
		$key = array_search($ipaddress,$yes);
		if ($yes[$key] == $ipaddress) {
			unset($yes[$key]); // remove key from array
		}
		//add ip address to $no 
		$key = array_search($ipaddress,$no);
		if ($no[$key] != $ipaddress) {
			array_push($no,$ipaddress);
		}
	}
	
	if ($type == 'report') {
		//delete ipaddress from $yes
		$key = array_search($ipaddress,$yes);
		if ($yes[$key] == $ipaddress) {
			unset($yes[$key]); // remove key from array
		}
		//add ip address to $no 
		$key = array_search($ipaddress,$no);
		if ($no[$key] != $ipaddress) {
			array_push($no,$ipaddress);
		}
		//add ip address to $report 
		$key = array_search($ipaddress,$report);
		if ($report[$key] != $ipaddress) {
			array_push($report,$ipaddress);
		}
	}
	
			$query = "UPDATE `gearscor_gsdb`.`comments` SET `yes` = '".mysql_real_escape_string(serialize($yes))."',`no` = '".mysql_real_escape_string(serialize($no))."',`reported` = '".mysql_real_escape_string(serialize($report))."' WHERE `comments`.`id` = '".mysql_real_escape_string($id)."' LIMIT 1 ;";
			$result = mysql_query($query);

}

echo 'Thanks!';
?>