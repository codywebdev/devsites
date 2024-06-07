<?php

	$redirect = 'http://www.goofology.com/index.php?sid='.rand(0,1000);

	if (setcookie("screenname","",time() - 3600,"/",".goofology.com") && 
	    setcookie("password","",time() - 3600,"/",".goofology.com")) {
	echo '<HTML><HEAD>'
		.'<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$redirect.'">'
		.'</HEAD><BODY>You have successfully logged out. Redirecting to <a href="'
		.$redirect.'">'.$redirect.'</a>.</BODY></HTML>';
	}
	else{
	echo '<HTML><HEAD>'
		.'<META HTTP-EQUIV="refresh" CONTENT="3;URL='.$redirect.'">'
		.'</HEAD><BODY>An error occured with your request. Redirecting to <a href="'
		.$redirect.'">'.$redirect.'</a>.</BODY></HTML>';
	}

?>