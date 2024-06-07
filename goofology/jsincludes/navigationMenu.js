var xmlHttp

function changeMenu(name, action)
{
	if (name=="account") {
		if (action=='expand') {
			document.getElementById("menutitle2").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="30" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;contract&quot;)">My Account</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/signup.php" class="boldText"> - Sign up</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/login.php" class="boldText"> - Log In</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/myaccount.php" class="boldText"> - Edit Personal Info</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/myaccount.php" class="boldText"> - Edit Favorite Links</a></td></tr></table>';
		}
		else if (action=='contract') {
			document.getElementById("menutitle2").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)">My Account</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;account&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>';
		}
	}
	
	else if (name=="browse") {
		if (action=='expand') {
			document.getElementById("menutitle3").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="30" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;contract&quot;)">Browse Links</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/browseLinks.php?sort=name" class="boldText"> - By Name</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/browseLinks.php?sort=category" class="boldText"> - By Category</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/browseLinks.php?sort=screenname" class="boldText"> - By User Submitted</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/browseLinks.php?sort=clicked" class="boldText"> - By View</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/browseLinks.php?sort=rating" class="boldText"> - By Rating</a></td></tr></table>';
		}
		else if (action=='contract') {
			document.getElementById("menutitle3").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)">Browse Links</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;browse&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>';
		}
	}
	
	else if (name=="support") {
		if (action=='expand') {
			document.getElementById("menutitle4").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="30" align="left" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;contract&quot;)">Support</a></span></td><td align="right" valign="top"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;contract&quot;)" class="normalText">[-]</a></span></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/faq.php" class="boldText"> - FAQ\'s</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/tos.php" class="boldText"> - Terms of Use</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/privacy.php" class="boldText"> - Privacy Policy</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/lostpassword.php" class="boldText"> - Lost Password</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/lostusername.php" class="boldText"> - Lost Username</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/lostvalidation.php" class="boldText"> - Lost Validation</a></td></tr><tr><td height="25" colspan="2"><a href="/home/goofology/public_html/contact.php" class="boldText"> - Contact Us</a></td></tr></table>';
		}
		else if (action=='contract') {
			document.getElementById("menutitle4").innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)">Support</a></span></td><td align="right"><span class="menuTitle"><a href="javascript:changeMenu(&quot;support&quot;, &quot;expand&quot;)" class="normalText">[+]</a></span></td></tr></table>';
		}
	}
} 