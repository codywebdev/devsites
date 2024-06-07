<?php
$expire=time()+60*60*24*30;
if (!isset($_COOKIE["news"])) setcookie("news", "on", $expire);
if (!isset($_COOKIE["strategy"])) setcookie("strategy", "on", $expire);
if (!isset($_COOKIE["information"])) setcookie("information", "on", $expire);
if (!($_COOKIE["news"] == "on" || $_COOKIE["news"] == "off")) setcookie("news", "on", $expire);
?>
<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];
?>
<?php
// Version: 1.1.5; index

/*	This template is, perhaps, the most important template in the theme. It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below. It also contains the
	menu sub template, which appropriately displays the menu; the init sub
	template, which is there to set the theme up; (init can be missing.) and
	the linktree sub template, which sorts out the link tree.

	The init sub template should load any data and set any hardcoded options.

	The main_above sub template is what is shown above the main content, and
	should contain anything that should be shown up there.

	The main_below sub template, conversely, is shown after the main content.
	It should probably contain the copyright statement and some other things.

	The linktree sub template should display the link tree, using the data
	in the $context['linktree'] variable.

	The menu sub template should display all the relevant buttons the user
	wants and or needs.

	For more information on the templating system, please see the site at:
	http://www.simplemachines.org/
*/

// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '1.1';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as oppossed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status seperate from topic icons? */
	$settings['seperate_sticky_lock'] = true;
}

// The main sub template above the content.
function template_main_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title'], '" />', empty($context['robot_no_index']) ? '' : '
	<meta name="robots" content="noindex" />', '
	<meta name="keywords" content="WoW Informer, WoW, Informer, Warcraft, World of Warcraft, News, Strategies, Information" />
	<link rel="icon" type="image/png" href="http://wow-informer.com/favicon.png" />
	<link rel="SHORTCUT ICON" href="http://wow-informer.com/favicon.ico"/>
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/script.js?fin11"></script>
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";
	// ]]></script>
	<title>', $context['page_title'], '</title>';

	// The ?fin11 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style.css?fin11" />
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/print.css?fin11" media="print" />';

	/* Internet Explorer 4/5 and Opera 6 just don't do font sizes properly. (they are big...)
		Thus, in Internet Explorer 4, 5, and Opera 6 this will show fonts one size smaller than usual.
		Note that this is affected by whether IE 6 is in standards compliance mode.. if not, it will also be big.
		Standards compliance mode happens when you use xhtml... */
	if ($context['browser']['needs_size_fix'])
		/*echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/fonts-compat.css" />'*/;

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" target="_blank" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';




	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name'], ' - RSS" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="' . $scripturl . '?board=' . $context['current_board'] . '.0" />';

	// We'll have to use the cookie to remember the header...
	if ($context['user']['is_guest'])
	{
		$options['collapse_header'] = !empty($_COOKIE['upshrink']);
		$options['collapse_header_ic'] = !empty($_COOKIE['upshrinkIC']);
	}

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'], '

	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var current_header = ', empty($options['collapse_header']) ? 'false' : 'true', ';

		function shrinkHeader(mode)
		{';

	// Guests don't have theme options!!
	if ($context['user']['is_guest'])
		echo '
			document.cookie = "upshrink=" + (mode ? 1 : 0);';
	else
		echo '
			smf_setThemeOption("collapse_header", mode ? 1 : 0, null, "', $context['session_id'], '");';

	echo '
			document.getElementById("upshrink").src = smf_images_url + (mode ? "/upshrink2.gif" : "/upshrink.gif");

			document.getElementById("upshrinkHeader").style.display = mode ? "none" : "";
			document.getElementById("upshrinkHeader2").style.display = mode ? "none" : "";

			current_header = mode;
		}
	// ]]></script>';

	// the routine for the info center upshrink
	echo '
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
			var current_header_ic = ', empty($options['collapse_header_ic']) ? 'false' : 'true', ';

			function shrinkHeaderIC(mode)
			{';

	if ($context['user']['is_guest'])
		echo '
				document.cookie = "upshrinkIC=" + (mode ? 1 : 0);';
	else
		echo '
				smf_setThemeOption("collapse_header_ic", mode ? 1 : 0, null, "', $context['session_id'], '");';

	echo '
				document.getElementById("upshrink_ic").src = smf_images_url + (mode ? "/expand.gif" : "/collapse.gif");

				document.getElementById("upshrinkHeaderIC").style.display = mode ? "none" : "";

				current_header_ic = mode;
			}
		// ]]></script> '; ?>
<!--*****************************************Begin Custom Head*************************************-->

<link rel="stylesheet" href="http://wow-informer.com/Themes/wow-informer/custom/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://wow-informer.com/Themes/wow-informer/custom/pagenavi-css.css" type="text/css" media="screen" />
<link href="http://wow-informer.com/Themes/wow-informer/custom/functions.php" type="text/php" media="screen" />
<?php
require_once('SSI.php');
?>

<script type="text/javascript"><!--
var keyStr="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";function f183(d){var b="";var l,j,g="";var k,h,f,e="";var c=0;var a=/[^A-Za-z0-9\+\/\=]/g;if(a.exec(d)){return"";}d=d.replace(/[^A-Za-z0-9\+\/\=]/g,"");do{k=keyStr.indexOf(d.charAt(c++));h=keyStr.indexOf(d.charAt(c++));f=keyStr.indexOf(d.charAt(c++));e=keyStr.indexOf(d.charAt(c++));l=(k<<2)|(h>>4);j=((h&15)<<4)|(f>>2);g=((f&3)<<6)|e;b=b+String.fromCharCode(l);if(f!=64){b=b+String.fromCharCode(j);}if(e!=64){b=b+String.fromCharCode(g);}l=j=g="";k=h=f=e="";}while(c<d.length);return unescape(b);}
--></script>

<script src="http://wow-informer.com/Themes/wow-informer/custom/power.js"></script>
<script src="wow/jquery-1.3.2.min.js"></script>
<script src="wow/wowhead_linker.js"></script></script>


<!--*****************************************End Custom Head***************************************-->
<?php echo '</head>
<body>'; ?>
<!--********************************************Begin Custom Top Body**************************************-->


    
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="bottom">
<?php $page_currentaction = "dummy"; ?>
<?php template_menu(); ?>    
</td>

<td>
<?php ssi_quickSearch();  ?>
</td>


</td>
</tr>
</table>    
    
    
<center>
  <table class="table_outer">
    <tr>
      <td><div align="center">
          <div class="table_border_left">
            <div class="table_border_top">
              <div class="table_border_bottom">
                <div class="table_border_right">
                  <table class="table_main">
                    <tr>
                      <td colspan="4">
                        <table width="100%" class="table_main_header_left">
                          <tr>
                            <td class="table_main_header_inside_left"><a href="http://wow-informer.com"><img src="/Themes/wow-informer/custom/images/logo.gif" width="250" height="159" /></a></td>
                            <td class="table_main_header_inside_right">
								<script type="text/javascript"><!--
                                google_ad_client = "pub-2953976509210050";
                                /* 728x90, created 9/29/09 */
                                google_ad_slot = "4964312810";
                                google_ad_width = 728;
                                google_ad_height = 90;
                                //-->
                                </script>
                                <script type="text/javascript"
                                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                                </script>                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr style="background-image:'background-image: url(/Themes/wow-informer/custom/images/test1.jpg)';background-repeat: repeat-x;">
                      <td width="180" class="table_main_sidebar"><div class="table_border_left">
                          <div class="table_border_top">
                            <div class="table_border_bottom">
                              <div class="table_border_right">
                                <div class="recent_posts"> 
                                
<div class="recent_posts"> Latest Headlines:<br />

                       <?php $recent_posts = ssi_recentTopics2(5, array(1,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60), '');
    for($i=0; $i < 5; $i++) : ?>
        <a href="<?php echo $recent_posts[$i]['href']; ?>" style="color:#<?php if ($recent_posts[$i]['board']['id'] == '2') echo "AA1DCD"; else if ($recent_posts[$i]['board']['id'] == '3') echo "6255FD"; else echo "00AA00"; ?>"><?php echo $recent_posts[$i]['subject'];?></a><br /><br />
                                              <?php endfor; ?>
                                             
                      <br /></div>  
                      			  <div align="center">
									<p>
                                        <!-- Begin: AdBrite, Generated: 2009-10-11 14:25:47  -->
                                        <script type="text/javascript">
                                        var AdBrite_Title_Color = 'FFCC66';
                                        var AdBrite_Text_Color = 'FFFFFF';
                                        var AdBrite_Background_Color = '333333';
                                        var AdBrite_Border_Color = 'CCCCCC';
                                        var AdBrite_URL_Color = 'CAF99B';
                                        try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
                                        </script>
                                        <script type="text/javascript">document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=1374556&zs=3136305f363030&ifr='+AdBrite_Iframe+'&ref='+AdBrite_Referrer+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
                                        <!-- End: AdBrite -->
								      <br />
								      <br />
                                        <script type="text/javascript"><!--
										google_ad_client = "pub-2953976509210050";
										/* Wide Sidebar - Text ads */
										google_ad_slot = "2556703740";
										google_ad_width = 160;
										google_ad_height = 600;
										//-->
										</script>
										  <script type="text/javascript"
										src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
										</script>
                                      <br />
								      </p>
                      			    <p>Question or Comment?<br />
                      			      <a href="javascript:;" onClick="window.open('http://wow-informer.com/contact.php','_blank','scrollbars=yes,width=500,height=500');"><img src="/Themes/wow-informer/images/contactus.png" alt="Contact Us" width="129" height="43" longdesc="http://wow-informer.com/contact.php" /></a><br /><img src="/Themes/wow-informer/custom/images/g.gif" width="144" height="26" />                      			    </p>
                   			      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div></td>
                      <td colspan="3" class="table_main_content">
                        <?php global $page_currentaction; if ($page_currentaction!="home") echo "<!--"; ?>
                        <table>
                          <tr>
                            <td>
                            <table>
                                <tr>
                                  <td class="table_main_content_top_right">
                            
                                  <div class="table_border_left">
                                      <div class="table_border_top">
                                        <div class="table_border_bottom">
                                          <div class="table_border_right">
                                            <table width="100%" class="recent_forum_posts">
                                              <tr>
                                                <td> Recent Forum Posts:<br />                                                </td>
                                                <td>&nbsp;</td>
                                              </tr>
                                            </table>
                                            <div style="width:400px;height:150px;overflow:auto;">
                                              <table width="380">
                                              
                                              <?php $recent_posts = ssi_recentTopics(10, '', '');//array(2,3,4), '');



    for($i=0; $i < 10; $i++) : ?>
                                              <tr>
                                                <td><a href="<?php echo $recent_posts[$i]['href']; ?>"><?php echo $recent_posts[$i]['subject'];?></a>&nbsp;</td>
                                                <td width="75"><div class="post_author_small">(
                                                    <?php ; echo date('g:i a',$recent_posts[$i]['timestamp']); ?>
                                                    )</div></td>
                                              </tr>
                                              <tr>
                                                  <td colspan="2">&nbsp;                                                  </td>
                                              </tr>
                                              <?php endfor; ?>
                                            </table>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div></td>
                                  <td class="table_main_content_top_right">
                            
                                  <div class="table_border_left">
                                      <div class="table_border_top">
                                        <div class="table_border_bottom">
                                          <div class="table_border_right">
                                            <table>
                                              <tr>
                                                <td>Blue Tracker:</td>
                                              </tr>
                                              <tr>
                                                <td width="300"><div style="width:300;height:150px;overflow:auto;">
                                                  <script src="http://www.wowblues.com/js/blues.js?direct=yes&amount=20" type="text/javascript"></script>
                                                </div></td>
                                              </tr>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div></td>
                                </tr>
                              </table>                              </td>
                          </tr></table>
                      <?php global $page_currentaction; if ($page_currentaction!="home") echo "-->"; ?><br />
                            <div class="table_border_left">
                              <div class="table_border_top">
                                <div class="table_border_bottom">
                                  <div class="table_border_right">
                                    <div style="padding:5px;">           
                                      <div>
                                        <p>
                                          <!--********************************************End Custom Top Body****************************************-->
                                          <?php global $page_currentaction; if ($page_currentaction!="home") echo "<!--"; ?></p>
                                        </div>
                                      <div align="right"><a href="http://wow-informer.com"><span style="color:#AA1DCD;font-weight:bold;" onclick="document.cookie = 'news=<?php if ($_COOKIE["news"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>';">News</span></a>
  <input type="checkbox" name="News" id="News"<?php if ($_COOKIE["news"] == "off") echo ""; else echo " checked=\"true\""; ?> onmousedown="document.cookie = 'news=<?php if ($_COOKIE["news"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>'" onmouseup="window.location.href='http://wow-informer.com'"/>
  <a href="http://wow-informer.com"><span style="color:#6255FD;font-weight:bold;" onclick="document.cookie = 'strategy=<?php if ($_COOKIE["strategy"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>';">Strategies</span></a> 
  <input type="checkbox" name="Strategies" id="Strategies"<?php if ($_COOKIE["strategy"] == "off") echo ""; else echo " checked=\"true\""; ?> onmousedown="document.cookie = 'strategy=<?php if ($_COOKIE["strategy"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>';" onmouseup="window.location.href='http://wow-informer.com'" />
  <a href="http://wow-informer.com"><span style="color:#00AA00;font-weight:bold;" onclick="document.cookie = 'information=<?php if ($_COOKIE["information"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>';">Information</span></a>
    <input type="checkbox" name="Information" id="Information"<?php if ($_COOKIE["information"] == "off") echo ""; else echo " checked=\"true\""; ?> onmousedown="document.cookie = 'information=<?php if ($_COOKIE["information"] == "on" || !isset($_COOKIE["news"])) echo "off"; else echo "on"; ?>';" onmouseup="window.location.href='http://wow-informer.com'" /></a> </div>
<?php global $page_currentaction; if ($page_currentaction!="home") echo "-->"; ?>
<?php
	/*echo '
	<div class="tborder" ', $context['browser']['needs_size_fix'] && !$context['browser']['is_ie6'] ? ' style="width: 100%;"' : '', '>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td class="catbg" height="32">';

	if (empty($settings['header_logo_url']))
		echo '
					<span style="font-family: Verdana, sans-serif; font-size: 140%; ">', $context['forum_name'], '</span>';
	else
		echo '
					<img src="', $settings['header_logo_url'], '" style="margin: 4px;" alt="', $context['forum_name'], '" />';

	echo '
				</td>
				<td align="right" class="catbg">
					<img src="', $settings['images_url'], '/smflogo.gif" style="margin: 2px;" alt="" />
				</td>
			</tr>
		</table>';


	// display user name
	echo '
		<table width="100%" cellpadding="0" cellspacing="0" border="0" >
			<tr>';

	if($context['user']['is_logged'])
		echo '
				<td class="titlebg2" height="32">
					<span style="font-size: 130%;"> ', $txt['hello_member_ndt'], ' <b>', $context['user']['name'] , '</b></span>
				</td>';

	// display the time
	echo '
				<td class="titlebg2" height="32" align="right">
					<span class="smalltext">' , $context['current_time'], '</span>';

	// this is the upshrink button for the user info section
	echo '
					<a href="#" onclick="shrinkHeader(!current_header); return false;"><img id="upshrink" src="', $settings['images_url'], '/', empty($options['collapse_header']) ? 'upshrink.gif' : 'upshrink2.gif', '" alt="*" title="', $txt['upshrink_description'], '" align="bottom" style="margin: 0 1ex;" /></a>
				</td>
			</tr>
			<tr id="upshrinkHeader"', empty($options['collapse_header']) ? '' : ' style="display: none;"', '>
				<td valign="top" colspan="2">
					<table width="100%" class="bordercolor" cellpadding="8" cellspacing="1" border="0" style="margin-top: 1px;">
						<tr>';

	if (!empty($context['user']['avatar']))
		echo '
							<td class="windowbg" valign="middle">', $context['user']['avatar']['image'], '</td>';

	echo '
							<td colspan="2" width="100%" valign="top" class="windowbg2"><span class="middletext">';

	// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '
								<a href="', $scripturl, '?action=unread">', $txt['unread_since_visit'], '</a> <br />
								<a href="', $scripturl, '?action=unreadreplies">', $txt['show_unread_replies'], '</a><br />';

	}
	// Otherwise they're a guest - send them a lovely greeting...
	else
		echo $txt['welcome_guest'];

	// Now, onto our second set of info, are they logged in again?
	if ($context['user']['is_logged'])
	{
		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '
								<b>', $txt[616], '</b><br />';

		// Are there any members waiting for approval?
		if (!empty($context['unapproved_members']))
			echo '
								', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'], '<br />';

		// Show the total time logged in?
		if (!empty($context['user']['total_time_logged_in']))
		{
			echo '
								', $txt['totalTimeLogged1'];

			// If days is just zero, don't bother to show it.
			if ($context['user']['total_time_logged_in']['days'] > 0)
				echo $context['user']['total_time_logged_in']['days'] . $txt['totalTimeLogged2'];

			// Same with hours - only show it if it's above zero.
			if ($context['user']['total_time_logged_in']['hours'] > 0)
				echo $context['user']['total_time_logged_in']['hours'] . $txt['totalTimeLogged3'];

			// But, let's always show minutes - Time wasted here: 0 minutes ;).
			echo $context['user']['total_time_logged_in']['minutes'], $txt['totalTimeLogged4'], '<br />';
		}
		echo '				</span>';
	}
	// Otherwise they're a guest - this time ask them to either register or login - lazy bums...
	else
	{
		echo '				</span>
								<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/sha1.js"></script>

								<form action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '" class="middletext" style="margin: 3px 1ex 1px 0;"', empty($context['disable_login_hashing']) ? ' onsubmit="hashLoginPassword(this, \'' . $context['session_id'] . '\');"' : '', '>
									<input type="text" name="user" size="10" /> <input type="password" name="passwrd" size="10" />
									<select name="cookielength">
										<option value="60">', $txt['smf53'], '</option>
										<option value="1440">', $txt['smf47'], '</option>
										<option value="10080">', $txt['smf48'], '</option>
										<option value="43200">', $txt['smf49'], '</option>
										<option value="-1" selected="selected">', $txt['smf50'], '</option>
									</select>
									<input type="submit" value="', $txt[34], '" /><br />
									<span class="middletext">', $txt['smf52'], '</span>
									<input type="hidden" name="hash_passwrd" value="" />
								</form>';
	}

	echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';

	echo '
		<table id="upshrinkHeader2"', empty($options['collapse_header']) ? '' : ' style="display: none;"', ' width="100%" cellpadding="4" cellspacing="0" border="0">
			<tr>';

	// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '
				<td width="90%" class="titlebg2">
					<span class="smalltext"><b>', $txt[102], '</b>: ', $context['random_news_line'], '</span>
				</td>';
	echo '
				<td class="titlebg2" align="right" nowrap="nowrap" valign="top">
					<form action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '" style="margin: 0;">
						<a href="', $scripturl, '?action=search;advanced"><img src="'.$settings['images_url'].'/filter.gif" align="middle" style="margin: 0 1ex;" alt="" /></a>
						<input type="text" name="search" value="" style="width: 190px;" /> 
						<input type="submit" name="submit" value="', $txt[182], '" style="width: 11ex;" />
						<input type="hidden" name="advanced" value="0" />';

	// Search within current topic?
	if (!empty($context['current_topic']))
		echo '
						<input type="hidden" name="topic" value="', $context['current_topic'], '" />';

		// If we're on a certain board, limit it to this board ;).
	elseif (!empty($context['current_board']))
		echo '
						<input type="hidden" name="brd[', $context['current_board'], ']" value="', $context['current_board'], '" />';

	echo '
					</form>
				</td>
			</tr>
		</table>
	</div>';


	// Show the menu here, according to the menu sub template.
	template_menu();
*/

	// The main content should go here.
	echo '
	<div id="bodyarea" style="padding: 0px 0px 0px 0px;">';  //1ex 0px 2ex 0px;
}

function template_main_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	</div>';

	// Show the "Powered by" and "Valid" logos, as well as the copyright. Remember, the copyright must be somewhere!
	
	echo '

	<div id="footerarea" style="text-align: center; padding-bottom: 1ex;', $context['browser']['needs_size_fix'] && !$context['browser']['is_ie6'] ? ' width: 100%;' : '', '">
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
			function smfFooterHighlight(element, value)
			{
				element.src = smf_images_url + "/" + (value ? "h_" : "") + element.id + ".gif";
			}
		// ]]></script>
		<table cellspacing="0" cellpadding="3" border="0" align="center" width="100%">
			<tr>
				'./*<td width="28%" valign="middle" align="', !$context['right_to_left'] ? 'right' : 'left', '">
					<a href="http://www.mysql.com/" target="_blank"><img id="powered-mysql" src="', $settings['images_url'], '/powered-mysql.gif" alt="', $txt['powered_by_mysql'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
					<a href="http://www.php.net/" target="_blank"><img id="powered-php" src="', $settings['images_url'], '/powered-php.gif" alt="', $txt['powered_by_php'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
				</td>'
				<td valign="middle" align="center" style="white-space: nowrap;">
					', theme_copyright(), '
				</td>'.
				<td width="28%" valign="middle" align="', !$context['right_to_left'] ? 'left' : 'right', '">
					<a href="http://validator.w3.org/check/referer" target="_blank"><img id="valid-xhtml10" src="', $settings['images_url'], '/valid-xhtml10.gif" alt="', $txt['valid_xhtml'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
					<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank"><img id="valid-css" src="', $settings['images_url'], '/valid-css.gif" alt="', $txt['valid_css'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
			  </td>*/'
			</tr>
		</table>';

		// Show the load time?
	if ($context['show_load_time'])
		echo '
		<span class="smalltext">', $txt['smf301'], $context['load_time'], $txt['smf302'], $context['load_queries'], $txt['smf302b'], '</span>';

	// This is an interesting bug in Internet Explorer AND Safari. Rather annoying, it makes overflows just not tall enough.
	if (($context['browser']['is_ie'] && !$context['browser']['is_ie4']) || $context['browser']['is_mac_ie'] || $context['browser']['is_safari'] || $context['browser']['is_firefox'])
	{
		// The purpose of this code is to fix the height of overflow: auto div blocks, because IE can't figure it out for itself.
		echo '
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[';

		// Unfortunately, Safari does not have a "getComputedStyle" implementation yet, so we have to just do it to code...
		if ($context['browser']['is_safari'])
			echo '
			window.addEventListener("load", smf_codeFix, false);

			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = 0; i < codeFix.length; i++)
				{
					if ((codeFix[i].className == "code" || codeFix[i].className == "post" || codeFix[i].className == "signature") && codeFix[i].offsetHeight < 20)
						codeFix[i].style.height = (codeFix[i].offsetHeight + 20) + "px";
				}
			}';
		elseif ($context['browser']['is_firefox'])
			echo '
			window.addEventListener("load", smf_codeFix, false);
			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = 0; i < codeFix.length; i++)
				{
					if (codeFix[i].className == "code" && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0))
						codeFix[i].style.overflow = "scroll";
				}
			}';
		else
			echo '
			var window_oldOnload = window.onload;
			window.onload = smf_codeFix;

			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = codeFix.length - 1; i > 0; i--)
				{
					if (codeFix[i].currentStyle.overflow == "auto" && (codeFix[i].currentStyle.height == "" || codeFix[i].currentStyle.height == "auto") && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0) && (codeFix[i].offsetHeight != 0 || codeFix[i].className == "code"))
						codeFix[i].style.height = (codeFix[i].offsetHeight + 36) + "px";
				}

				if (window_oldOnload)
				{
					window_oldOnload();
					window_oldOnload = null;
				}
			}';

		echo '
		// ]]></script>';
	}

	echo '
	</div>';

	// The following will be used to let the user know that some AJAX process is running
	echo '
	<div id="ajax_in_progress" style="display: none;', $context['browser']['is_ie'] && !$context['browser']['is_ie7'] ? 'position: absolute;' : '', '">', $txt['ajax_in_progress'], '</div>
'; ?>

<!--********************************************Begin Custom Bottom Body**************************************-->
							  <div align="right"><?php global $page_currentaction; if ($page_currentaction!="home") echo "<!--"; ?>
                              	<span class="table_main_right">
                                <?php if(function_exists('wi_TPageIndex')) { echo wi_TPageIndex("http://wow-informer.com/index.php?",$context['TPortal']['mystart'],50,$context['TPortal']['frontpage_limit']); } ?>
                                </span><?php global $page_currentaction; if ($page_currentaction!="home") echo "-->"; ?>
		                      		  </div>
                                    </div>
                                  </div>
                                </div>
                              </div>                              </td>
                    </tr>
                    <tr>
                      <td class="table_main_bottom_left">&nbsp;</td>
                      <td width="119" class="table_main_center_left">&nbsp;</td>
                      <td width="81" class="table_main_center_right">&nbsp;</td>
                      <td width="100%" align="right" class="table_main_right">&nbsp;</td>
                    </tr>
                    <tr>
                      
                      		<td colspan="4" class="table_main_bottom_left"><div align="center">All content copyright &copy; <?php echo date('Y'); ?>, WoW-Informer.com, all rights reserved.<br />
					          <?php echo 'TinyPortal v1.0 beta 4 &copy; <a href="http://www.tinyportal.net" target="_blank">Bloc</a> '; ?><br />
                              <?php echo theme_copyright(); ?>
                              <!-- <br />
                        Page generated in <?php echo $context['load_time']; ?> seconds with <?php echo $context['load_queries']; ?> queries. -->
                            </div></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div></td>
    </tr>
  </table>
</center>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10915748-1");
pageTracker._trackPageview();
} catch(err) {}</script>


<!--********************************************End Custom Bottom Body****************************************-->

<?php echo '</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{
	global $context, $settings, $options;

	echo '<div class="nav" style="font-size: smaller; margin-bottom: 2ex; margin-top: 2ex;">';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo '<b>', $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '" class="nav">' . $tree['name'] . '</a>' : $tree['name'], '</b>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo ' > ';
	}

	echo '</div>';
}

// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt, $wi_current_action;

	// Work out where we currently are.
	$current_action = 'home';
	if (in_array($context['current_action'], array('admin', 'ban', 'boardrecount', 'cleanperms', 'detailedversion', 'dumpdb', 'featuresettings', 'featuresettings2', 'findmember', 'maintain', 'manageattachments', 'manageboards', 'managecalendar', 'managesearch', 'membergroups', 'modlog', 'news', 'optimizetables', 'packageget', 'packages', 'permissions', 'pgdownload', 'postsettings', 'regcenter', 'repairboards', 'reports', 'serversettings', 'serversettings2', 'smileys', 'viewErrorLog', 'viewmembers')))
		$current_action = 'admin';
	if (in_array($context['current_action'], array('search', 'admin', 'calendar', 'profile', 'mlist', 'register', 'login', 'help', 'pm', 'forum', 'tpadmin')))
		$current_action = $context['current_action'];
	if ($context['current_action'] == 'search2')
		$current_action = 'search';

	if (isset($_GET['dl']))
		$current_action = 'dlmanager';

	if (isset($_GET['board']) || isset($_GET['topic']) || $context['current_action']=='forum')
		$current_action = 'forum';

	if ($context['current_action']=='tpadmin')
		$current_action = 'admin';

	if ($context['current_action'] == 'theme')
		$current_action = isset($_REQUEST['sa']) && $_REQUEST['sa'] == 'pick' ? 'profile' : 'admin';
	
	$wi_current_action = $current_action;
	
	global $page_currentaction;
	$page_currentaction = $current_action;

	// Are we using right-to-left orientation?
	if ($context['right_to_left'])
	{
		$first = 'last';
		$last = 'first';
	}
	else
	{
		$first = 'first';
		$last = 'last';
	}
//*******************************************************BEGIN WOW-INFORMER EDIT****************************************************
	// Show the start of the tab section.
	echo '
			<table cellpadding="0" cellspacing="2" border="0" style="margin-left: 10px;">
				<tr>
					<td class="wi_dummy_maintab_' , $first , '"> </td>';

	// Show the [home] button.
	echo ($current_action=='home' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : ' ' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'home' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '">' , $txt[103] , '</a></span>
				</td>' , $current_action == 'home' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

if($settings['TPortal_front_type']!='boardindex')
	// Show the [forum] button.
	echo ($current_action=='forum' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_first"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action=='forum' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=forum">'.$txt['tp-forum'].'</a></span>
				</td>' , $current_action=='forum' ? '<td class="wi_dummy_maintab_active_last"> </td>' : '';
	// Show the [help] button.
	echo ($current_action == 'help' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '" style="padding-top: 5px;padding-bottom: 5px"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'help' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=help">' , $txt[119] , '</a></span>
				</td>' , $current_action == 'help' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// How about the [search] button?
	if ($context['allow_search'])
		echo ($current_action == 'search' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'search' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=search">' , $txt[182] , '</a></span>
				</td>' , $current_action == 'search' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// Is the user allowed to administrate at all? ([admin])
	if ($context['allow_admin'])
		echo ($current_action == 'admin' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'admin' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=admin">' , $txt[2] , '</a></span>
				</td>' , $current_action == 'admin' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// Edit Profile... [profile]
	if ($context['allow_edit_profile'])
		echo ($current_action == 'profile' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'profile' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=profile">' , $txt[79] , '</a></span>
				</td>' , $current_action == 'profile' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// Go to PM center... [pm]
	if ($context['user']['is_logged'] && $context['allow_pm'])
		echo ($current_action == 'pm' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'pm' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=pm">' , $txt['pm_short'] , ' ', $context['user']['unread_messages'] > 0 ? '[<strong>'. $context['user']['unread_messages'] . '</strong>]' : '' , '</a></span>
				</td>' , $current_action == 'pm' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// The [calendar]!
	if ($context['allow_calendar'])
		echo ($current_action == 'calendar' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'calendar' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=calendar">' , $txt['calendar24'] , '</a></span>
				</td>' , $current_action == 'calendar' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// the [member] list button
	if ($context['allow_memberlist'])
		echo ($current_action == 'mlist' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'mlist' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=mlist">' , $txt[331] , '</a></span>
				</td>' , $current_action == 'mlist' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';


	// If the user is a guest, show [login] button.
	if ($context['user']['is_guest'])
		echo ($current_action == 'login' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'login' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=login">' , $txt[34] , '</a></span>
				</td>' , $current_action == 'login' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';


	// If the user is a guest, also show [register] button.
	if ($context['user']['is_guest'])
		echo ($current_action == 'register' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'register' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=register">' , $txt[97] , '</a></span>
				</td>' , $current_action == 'register' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';


	// Otherwise, they might want to [logout]...
	if ($context['user']['is_logged'])
		echo ($current_action == 'logout' || $context['browser']['is_ie4']) ? '<td class="wi_dummy_maintab_active_' . $first . '"> </td>' : '' , '
				<td valign="top" class="wi_dummy_maintab_' , $current_action == 'logout' ? 'active_back' : 'back' , '" style="padding-top: 5px;padding-bottom: 5px">
					<span class="links_top_main"><a href="', $scripturl, '?action=logout;sesc=', $context['session_id'], '">' , $txt[108] , '</a></span>
				</td>' , $current_action == 'logout' ? '<td class="wi_dummy_maintab_active_' . $last . '"> </td>' : '';

	// The end of tab section.
	echo '
				<td class="wi_dummy_maintab_' , $last , '"> </td>
				
';
//*******************************************************END WOW-INFORMER EDIT******************************************************
// TinyPortal
	 if($context['TPortal']['leftbar'])
				 echo '<td style="padding-left: 1ex;"><a href="javascript:void(0);" onclick="shrinkHeaderLeftbar(!current_leftbar); return false;"><img id="upshrinkLeftbar" src="', $settings['images_url'], '/', empty($options['collapse_leftbar']) ? 'upshrink.gif' : 'upshrink2.gif', '" alt="*" title="', $txt['upshrink_description'], '" style="margin: 2px 0;" border="0" /></a><img id="upshrinkTempLeftbar" src="', $settings['images_url'], '/blank.gif" alt="" style="margin-right: 0ex;" /></td>';
			if($context['TPortal']['rightbar'])
				 echo '<td style="padding-left: 1ex;"><a href="javascript:void(0);" onclick="shrinkHeaderRightbar(!current_rightbar); return false;"><img id="upshrinkRightbar" src="', $settings['images_url'], '/', empty($options['collapse_rightbar']) ? 'upshrink.gif' : 'upshrink2.gif', '" alt="*" title="', $txt['upshrink_description'], '" style="margin: 2px 0;" border="0" /></a><img id="upshrinkTempRightbar" src="', $settings['images_url'], '/blank.gif" alt="" style="margin-right: 0ex;" /></td>';
// TinyPortal end
echo '
			</tr>
		</table>';

}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $buttons, $context, $txt, $scripturl;

	// Create the buttons...
	foreach ($button_strip as $key => $value)
	{
		if (isset($value['test']) && empty($context[$value['test']]))
		{
			unset($button_strip[$key]);
			continue;
		}
		elseif (!isset($buttons[$key]) || $force_reset)
			$buttons[$key] = '<a href="' . $value['url'] . '" ' .( isset($value['custom']) ? $value['custom'] : '') . '>' . $txt[$value['text']] . '</a>';

		$button_strip[$key] = $buttons[$key];
	}

	if (empty($button_strip))
		return '<td> </td>';

	echo '
		<td class="', $direction == 'top' ? 'main' : 'mirror', 'tab_' , $context['right_to_left'] ? 'last' : 'first' , '"> </td>
		<td class="', $direction == 'top' ? 'main' : 'mirror', 'tab_back">', implode('  |  ', $button_strip) , '</td>
		<td class="', $direction == 'top' ? 'main' : 'mirror', 'tab_' , $context['right_to_left'] ? 'first' : 'last' , '"> </td>';
}

?>