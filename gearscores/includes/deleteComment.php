<?

$id = $_GET['id'];
$character = urldecode(isset($_GET["n"])? $_GET["n"] : "");
$server = urldecode(isset($_GET["s"])? $_GET["s"] : "");
$region = urldecode(isset($_GET["r"])? $_GET["r"] : "us");

$output = '';

$output .= '<form id="form1" name="form1" method="post" action="http://gearscores.com/includes/processDeleteComment.php">
  <p>
    <label>
      Are you sure you wish to delete this comment?<br />
      <br />
    </label>
    <br />
	  <input type="hidden" name="id" value="'.$id.'">
	  <input type="hidden" name="n" value="'.$character.'">
	  <input type="hidden" name="s" value="'.$server.'">
	  <input type="hidden" name="r" value="'.$region.'">
    <label>
      <input type="submit" name="button" id="button" value="Delete" />
    </label>
  </p>
</form>';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<? echo $output; ?>

</body>
</html>
