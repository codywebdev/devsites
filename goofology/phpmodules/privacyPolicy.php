<?php
	
	$pp1 = array('General',
				 'Goofology.com has a strict policy in keeping your personal information private.  Goofology.com will not give or sell any personal information to third parties for any purposes including but not limited to marketing, advertising, or promotion.  If you chose to, you are able to use our website without revealing any personal information about yourself.  Any personal information that you choose to reveal will be kept secure and only accessible by Goofology.com.'
				  );
				  
	$pp2 = array('Cookies',
				  'Goofology.com uses cookies in order to provide a personalized experience to our users.  When you log into your account at Goofology.com, a cookie will be placed on your computer containing your screen name, time of login, and encrypted information about your login.  It is impossible for someone to reverse engineer your cookie information in order to access your private information.'
				  );
	$pp3 = array('IP Addresses',
				  'Your computer uses IP addresses every time you connect to the Internet. Computers on the network use your IP address to identify your computer so that data, such as the Web pages you request, can be sent to you.  Every time you log into our website, we will record your IP Address on our server.  For your security, the IP Address is compared to anyone trying to access your account.  If user tries to log in on a different computer, then the user will be asked to log in again, even if the cookie data is correct.',
				  );
	$pp4 = array('Screen name versus Username',
				  'A username is used to log into your account on our website.  For your security, after the log in process is complete, your username is no longer used.  Instead all information tied to your computer is through a public “Screen name” determined by you when you signed up.  A cookie is stored on your computer with your screen name.  This is designed to prevent malicious users from acquiring your cookie information, and reverse engineering it to gain access to your account.',
				  );
				  
	$pp5 = array('Security',
				  'While no system can provide guaranteed security, we take reasonable efforts to keep information you provide to us secure, including encryption technology, and physical security at the location of the server where information is stored.  Your password is stored in a 40 character hexadecimal encryption string on our server, and is nearly impossible to decrypt, even with the fastest computers in the world.  For your security we require a username and password to be supplied before any personal information about you can be revealed.',
				  );
				  
	$ppArray = array ($pp1, $pp2, $pp3, $pp4, $pp5);

	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Privacy Policy<a name="top" id="top"></a></h1><div class="contentBorder"><div class="linkLightBgBegin" id="link1">';
	
	for ($i=0; $i<count($ppArray); $i++) {
		$newHtml .= '<p class="comicText"><a name="'.($i+1).'" id="'.($i+1).'"></a>'.$ppArray[$i][0].'</p>';
		for ($ii=1, $c=1; $ii<count($ppArray[$i]); $ii++, $c++)	{
		$newHtml .= '<a name="'.($i+1).'-'.($c).'" id="'.($i+1).'-'.($c).'"></a><p class="normalText">'.$ppArray[$i][$ii].'</p><p>&nbsp;</p>';
		if ($ii>100) {exit();}
		}
		if ($i>100) {exit();}
	}
		  
	$newHtml .= '</div></div></div></div>';
	  
	echo $newHtml;
?>