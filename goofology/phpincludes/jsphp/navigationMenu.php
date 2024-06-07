<?php

	echo '<script language="javascript">

function changeMenu(name, action)
{
	var isRank2 = '.($isRank2?'\'yes\'':'\'no\'').';

	if (name=="account") {
		if (action==\'expand\') {
			document.getElementById("menutitle2").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="20" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;contract&quot;)">My Account</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/signup.php" class="boldText">&nbsp;-&nbsp;Sign up</a></td></tr><tr><td height="25" colspan="2"><a href="/login.php" class="boldText">&nbsp;-&nbsp;Log In</a></td></tr><tr><td height="25" colspan="2"><a href="/myaccount.php" class="boldText">&nbsp;-&nbsp;Edit Personal Info</a></td></tr><tr><td height="25" colspan="2"><a href="/myaccount.php" class="boldText">&nbsp;-&nbsp;Edit Favorite Links</a></td></tr></table>\';
		}
		else if (action==\'contract\') {
			document.getElementById("menutitle2").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)">My Account</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>\';
		}
	}
	
	else if (name=="members") {
		if (action==\'expand\') {
			document.getElementById("menutitle3").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="20" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;contract&quot;)">Members Only</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/newsite.php" class="boldText">&nbsp;-&nbsp;Submit New Site</a></td></tr>\'+((isRank2=="yes")?\'<tr><td height="25" colspan="2"><a href="/moderate.php" class="boldText">&nbsp;-&nbsp;Moderate Sites</a></td></tr></table>\':\'\');
		}
		else if (action==\'contract\') {
			document.getElementById("menutitle3").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;expand&quot;)">Members Only</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;members&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>\';
		}
	}
	
	else if (name=="browse") {
		if (action==\'expand\') {
			document.getElementById("menutitle4").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="20" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;contract&quot;)">Browse Links</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/browseLinks.php?sort=name" class="boldText">&nbsp;-&nbsp;By Name</a></td></tr><tr><td height="25" colspan="2"><a href="/browseLinks.php?sort=category" class="boldText">&nbsp;-&nbsp;By Category</a></td></tr><tr><td height="25" colspan="2"><a href="/browseLinks.php?sort=screenname" class="boldText">&nbsp;-&nbsp;By User Submitted</a></td></tr><tr><td height="25" colspan="2"><a href="/browseLinks.php?sort=clicked" class="boldText">&nbsp;-&nbsp;By View</a></td></tr><tr><td height="25" colspan="2"><a href="/browseLinks.php?sort=rating" class="boldText">&nbsp;-&nbsp;By Rating</a></td></tr></table>\';
		}
		else if (action==\'contract\') {
			document.getElementById("menutitle4").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)">Browse Links</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>\';
		}
	}
	
	else if (name=="support") {
		if (action==\'expand\') {
			document.getElementById("menutitle5").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="20" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;contract&quot;)">Support</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/faq.php" class="boldText">&nbsp;-&nbsp;FAQ\\\'s</a></td></tr><tr><td height="25" colspan="2"><a href="/tos.php" class="boldText">&nbsp;-&nbsp;Terms of Use</a></td></tr><tr><td height="25" colspan="2"><a href="/privacy.php" class="boldText">&nbsp;-&nbsp;Privacy Policy</a></td></tr><tr><td height="25" colspan="2"><a href="/lostpassword.php" class="boldText">&nbsp;-&nbsp;Lost Password</a></td></tr><tr><td height="25" colspan="2"><a href="/lostusername.php" class="boldText">&nbsp;-&nbsp;Lost Username</a></td></tr><tr><td height="25" colspan="2"><a href="/lostvalidation.php" class="boldText">&nbsp;-&nbsp;Lost Validation</a></td></tr><tr><td height="25" colspan="2"><a href="/contact.php" class="boldText">&nbsp;-&nbsp;Contact Us</a></td></tr></table>\';
		}
		else if (action==\'contract\') {
			document.getElementById("menutitle5").innerHTML=\'<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)">Support</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>\';
		}
	}
} 
</script>';

?>