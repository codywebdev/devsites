<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');

$loginError = $_COOKIE['login_error'];

setcookie('login_error','',time()+3600,'/','.noroth.com');

?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../includes/css/forms.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="document.login1.username.focus();">
<div id="content">
	<form name="login1" action="processes/processlogin.php" method="post">
	<? if (strlen($loginError)>0) echo $loginError.'<br /><br />'; ?>
	  <label for="username">Username:</label>
	  <input type="text" name="username" id="username" required>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <input name="submit" type="submit" value="Submit">
	</form>
</div>
</body>
</html>