<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');
session_start();

if ($_SESSION['administrator'] != 'yes' && $_SESSION['ipAddress'] != $_SERVER['REMOTE_ADDR']) {
	header("Location: ".WEBSITE_ROOT_URL."/admin/login.php");
	exit;
}
?><?

$query = "SELECT * FROM `lists` WHERE `listType` LIKE 'all_categories' AND `name` LIKE 'categories_list'";
$category_list_result = mysql_query($query);
$row = mysql_fetch_assoc($category_list_result);

$categoryListPostResults = array();
for ($i=0;$_POST['categoryId'.$i]!='';$i++) {
	if ($_POST['categoryName'.$i] != '' && $_POST['categoryId'.$i] != '' && $_POST['categoryDescription'.$i] != '') {
		$categoryListPostResults[$i]['categoryName'] = $_POST['categoryName'.$i];
		$categoryListPostResults[$i]['categoryId'] = $_POST['categoryId'.$i];
		$categoryListPostResults[$i]['categoryDescription'] = $_POST['categoryDescription'.$i];
	}
}

if (sizeof($categoryListPostResults) > 0) {
	if ($row['description'] != '') {
		$query = "UPDATE `".DB_NAME."`.`lists` SET `description` = '".mysql_real_escape_string(serialize($categoryListPostResults))."' WHERE `listType` LIKE 'all_categories' AND `name` LIKE 'categories_list';";
		$result = mysql_query($query);
	}
	else {
		$query = "INSERT INTO `".DB_NAME."`.`lists` (`id`, `name`, `listType`, `description`) VALUES (NULL, 'categories_list', 'all_categories', '".mysql_real_escape_string(serialize($categoryListPostResults))."');";
		$result = mysql_query($query);
	}
}


$query = "SELECT * FROM `lists` WHERE `listType` LIKE 'all_categories' AND `name` LIKE 'categories_list'";
$category_list_result = mysql_query($query);
$row = mysql_fetch_assoc($category_list_result);
$categoryList = array();
if ($row['description'] != '') {
	$categoryList = unserialize($row['description']);
}


?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><? echo WEBSITE_NAME; ?> - Administration</title>
<link href="<? echo WEBSITE_ROOT_URL; ?>/includes/css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<? echo WEBSITE_ROOT_URL; ?>/includes/js/admin.js"></script>
</head>
<body>
<p><a href="lists.php">Refresh Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Manage Products</a></p>
<div id="categories_list_form_wrapper">
<form action="categories.php" method="post" name="categoriesForm">
<?
for ($i=0;$i<sizeof($categoryList);$i++) {
	echo '
  <p>
    <label for="categoryName'.$i.'">Category Name:</label>
    <input type="text" name="categoryName'.$i.'" id="categoryName'.$i.'" class="categoryName" value="'.$categoryList[$i]['categoryName'].'">
    <label for="categoryId'.$i.'">Category Browse Node ID:</label>
    <input type="text" name="categoryId'.$i.'" id="categoryId'.$i.'" class="categoryId" value="'.$categoryList[$i]['categoryId'].'">
    <label for="categoryDescription'.$i.'">Custom Category Description:</label>
    <input type="text" name="categoryDescription'.$i.'" id="categoryDescription'.$i.'" class="categoryDescription" value="'.$categoryList[$i]['categoryDescription'].'">
  </p>';
}

echo '
  <p>
    <label for="categoryName'.$i.'">Category Name:</label>
    <input type="text" name="categoryName'.$i.'" id="categoryName'.$i.'" class="categoryName">
    <label for="categoryId'.$i.'">Category Browse Node ID:</label>
    <input type="text" name="categoryId'.$i.'" id="categoryId'.$i.'" class="categoryId">
    <label for="categoryDescription'.$i.'">Custom Category Description:</label>
    <input type="text" name="categoryDescription'.$i.'" id="categoryDescription'.$i.'" class="categoryDescription">
  </p>';

?>
  <p>
    <input type="submit" name="submitButton" id="submitButton" value="Submit">
  </p>
</form>
</div>
</body>
</html>
