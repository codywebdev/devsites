<?

$url = rawurldecode($_GET['url']);
$v1 = rawurldecode($_GET['v1']);
/*
1 = Product Link Clicked!
2 = Shopping Cart Clicked!
3 = Special Link Clicked!
*/
$v2 = rawurldecode($_GET['v2']);
/*
Describes the link in v1 (asin)
*/
$v3 = rawurldecode($_GET['v3']);
/*
Additional description on v2 (name)
*/

//header("Location: ".$url);



 $to = "analytics@noroth.com";
 if ($v1 == '1') {
	 $subject = "Product Link Clicked!";
 }
 elseif ($v1 == '2') {
	 $subject = "Shopping Cart Clicked!";
 }
 elseif ($v1 == '3') {
	 $subject = "Special Link Clicked!";
 }
 else {
	 $subject = "Unknown Link Clicked!";
 }
 $body = $_SERVER['REMOTE_ADDR']."\n".$v2."\n".$v3."\n".$url."\n".date('m/d/Y h:i:s a', time()+(60*60*2));
 
 $body = str_replace(".\n","..\n",$body);
 //mail($to, $subject, $body);


?>