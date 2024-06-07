<?
require_once('../../includes/dbconnect/config.php');
require_once('../../includes/functions.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM `".DB_NAME."`.`users` WHERE `username` = '".mysql_real_escape_string($username)."' AND `password` ='".mysql_real_escape_string(hash('sha256',hash('sha256','g!149xP/517[ 2>6+|v6{q|S2%/[V4'.$password.'r_wnNcyHF"hBF+HTNGIzYfCM5nMl"Z')))."' LIMIT 1";
$result = mysql_query($query);

$numOfResults = mysql_num_rows($result);

$data = mysql_fetch_assoc($result);


if ($numOfResults != 1) {
	setcookie('login_error','Invalid username or password.',time()+3600,'/','.noroth.com');
	header("Location: http://www.noroth.com/admin/login.php");
	exit;
}
else {
	session_start();
	$_SESSION['administrator'] = 'yes';
	$_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	header("Location: http://www.noroth.com/admin/index.php");
}

?>