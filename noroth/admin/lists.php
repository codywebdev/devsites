<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');
session_start();

if ($_SESSION['administrator'] != 'yes' && $_SESSION['ipAddress'] != $_SERVER['REMOTE_ADDR']) {
	header("Location: ".WEBSITE_ROOT_URL."/admin/login.php");
	exit;
}
?><?

$formName = $_REQUEST['formName'];
$customName = $_REQUEST['customName'];
$description = $_REQUEST['description'];

if ($formName == '<new>' && $customName != '' && $description != '') {
	$query = "INSERT INTO `".DB_NAME."`.`lists` (`id`, `name`, `listType`, `description`) VALUES (NULL, '".mysql_real_escape_string($customName)."', 'product_list', '".mysql_real_escape_string($description)."');";
	$result = mysql_query($query);
}
else if ($formName != '<new>' && $description != '') {
	$query = "UPDATE `".DB_NAME."`.`lists` SET `description` = '".mysql_real_escape_string($description)."' WHERE `name` LIKE '".mysql_real_escape_string($formName)."';";
	$result = mysql_query($query);
}

if ($formName != '<new>' || $customname != '') {
	$query = "SELECT *  FROM `lists` WHERE `name` LIKE '".mysql_real_escape_string($formName)."' LIMIT 1";
	$form_description_result = mysql_query($query);
	$form_description_row = mysql_fetch_assoc($form_description_result);
}

$query = "SELECT * FROM `lists` WHERE `listType` LIKE 'product_list'";
$form_name_result = mysql_query($query);


?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><? echo WEBSITE_NAME; ?> - Administration</title>
<link href="<? echo WEBSITE_ROOT_URL; ?>/includes/css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<? echo WEBSITE_ROOT_URL; ?>/includes/js/admin.js"></script>
</head>
<body onLoad="location.href='#<? echo $asin; ?>';">
<p><a href="lists.php">Refresh Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Manage Products</a></p>
<div id="lists_form_wrapper">
<form action="lists.php" method="post" name="lists_form" id="form_lists_form">
    	<label for="formName">Form Name:</label><br />
   	<select name="formName" id="form_formName" onChange="javascript:changeList();">
            <option value="<new>" <? if ($formName == '<new>') echo 'selected="selected"'; ?>>New (type name below)...</option><?
			while ($form_name_row = mysql_fetch_assoc($form_name_result)) {
				echo '<option value="'.str_replace('"','\"',$form_name_row['name']).'" ';
				if ($formName == $form_name_row['name']) echo 'selected="selected"';
				echo '>'.$form_name_row['name'].'</option>';
			}
			?>
    </select><br /><br />
    	<label for="customName">New List Name:</label><br />
        <input name="customName" type="text" id="form_customName"><br /><br />
   	<label for="description">Description:</label><br />
      <textarea name="description" id="form_description"><? echo $form_description_row['description']; ?></textarea><br /><br />
        <input name="submitButton" id="form_submitButton" type="submit" value="Save List">
    </form>
</div>
<?

echo "<br />\n";

$query = "SELECT * 
		FROM `products` 
		WHERE `deleted` = '0'
		AND `parentNode` = '0'
		ORDER BY `special` DESC";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

echo 'Products: <br />
';
echo '<table width="1000" border="1">';
while ($row) {
	echo '<tr><td style=\'text-align:"center"\'><a name="'.$row['asin'].'" id="'.$row['asin'].'"></a>';
		$imageArray= unserialize($row['image']);
		echo '<img src="'.$imageArray['URL'].'" height="100" />';
		
		echo '</td><td>';
		echo $row['title'].'<br />';
		
		echo '</td><td>';
		echo $row['asin'];
		
		echo '</td><td>';
		echo 'Parent: '.$row['parentNode'];
		
		echo '</td><td>';
		echo '$'.number_format($row['price']/100,2);
		
		echo '</td><td>';
		echo 'Special: '.$row['special'];
		
		echo '</td><td>';
		echo '<a href="javascript:void(0);" onClick="javascript:addToList(\''.$row['asin'].'\');">[Add]</a>';
		
	echo '</td></tr>';
	
	$row = mysql_fetch_assoc($result);
}
echo '</table>';

?>
</body>
</html>
