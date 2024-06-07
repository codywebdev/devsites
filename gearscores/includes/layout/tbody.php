<?php require_once('headphp.php'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo ($Character["name"]!='' && $Character["realm"]!='' )? $Character["name"].' on '.$Character["realm"].' - GearScores.com'  : "GearScores.com - WoW Armory Profiles"; ?></title>
<meta name="keywords" content="gearscore, gearscores, wow, warcraft, gear score, gear scores, gear, score, scores, armory, games, gaming, game, mmo, mmorpg, rpg, role playing game, role playing">
<meta name="description" content="GearScore calculator, compare your gearscore to other players in the world, easily view raid experience, 3D character models, character comments, and much more!">
<meta name="google-site-verification" content="DH9kofgezUIysYNf9XIuXIlTUFsPEMOVAeGWAW48DkQ" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="http://static.wowhead.com/widgets/power.js"></script>

<link rel="stylesheet" type="text/css" href="http://gearscores.com/style.css" />

<?php require_once('jscript.php'); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10915748-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function openInNewWindow()
{
	<?  if(strtoupper($region) == "US") echo 'window.open("http://us.battle.net/wow/en/character/'.str_replace(" ","-", ereg_replace("[^A-Za-z0-9 ]", "", $server)).'/'.$name.'/advanced")';
		else echo 'window.open("http://eu.battle.net/wow/en/character/'.str_replace(" ","-", ereg_replace("[^A-Za-z0-9 ]", "", $server)).'/'.$name.'/advanced")'; ?>

}

</script>
</head>
<body<? if ($_SERVER['PHP_SELF']=='/character.php' && false) echo ' onload="getRaidExp();"'; ?>><div align="center">

<table width="996" align="center" border="0" cellspacing="0" cellpadding="0" class="borderFrame">
<? //checkBrowserVersion(); ?>
  <tr>
    <td width="20" align="center" valign="middle"></td>
    <td colspan="3" align="center" valign="middle" class="topSearchFrame">
    	<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<td align="left"><a href="<? 
				echo 'http://gearscores.com'; 
				if ($_SERVER['PHP_SELF']=='/character.php') {
					echo '/character.php?';
					if (isset($name)) echo 'n='.urlencode($name).'&amp;';
					if (isset($server)) echo 's='.urlencode($server).'&amp;';
					if (isset($region)) echo 'r='.urlencode($region);
				}
				else if ($_SERVER['PHP_SELF']=='/rankings.php') {
					echo '/rankings.php?';
					if (isset($rRegion)) echo 'rre='.urlencode($rRegion).'&amp;';
					if (isset($rRealm)) echo 'rse='.urlencode($rRealm).'&amp;';
					if (isset($rClass)) echo 'rcl='.urlencode($rClass).'&amp;';
					if (isset($rSpec)) echo 'rsp='.urlencode($rSpec).'&amp;';
					if (isset($rGearscore)) echo 'rgs='.urlencode($rGearscore).'&amp;';
					if (isset($rSort)) echo 'sort='.urlencode($rSort).'&amp;';
					if (isset($rSortDir)) echo 'dir='.urlencode($rSortDir).'&amp;';
					if (isset($rStart)) echo 'rst='.urlencode($rStart).'&amp;';
					if (isset($rPerPage)) echo 'rpp='.urlencode($rPerPage);
				}
				else echo $_SERVER['PHP_SELF'];
				?>">Permanent Link</a></td>
        		<td align="right"><? if (isset($_COOKIE['loginA']) && $_SERVER['PHP_SELF']!='/logout.php') { echo 'Welcome '.$_COOKIE['loginA'].'! &nbsp;&nbsp;<a href="http://gearscores.com/logout.php">[Log Out]</a>'; } else { echo '<form id="topLogin" name="topLogin" method="post" action="http://gearscores.com/login.php">Email: <input name="loginE" type="text" id="topLoginE" size="15" maxlength="100"/> Password: <input name="loginP" type="password" id="topLoginP" size="15" maxlength="32"/>
        <input type="submit" name="submit" id="submit" value="Log In" />
    </form>'; } ?></td>
    		</tr>
        </table>
    </td>
    <td width="20" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td width="180" rowspan="3" align="left" valign="top" class="borderFrameLeftShadow"><? echo '<img src="http://gearscores.com/images/160px-blank.png" width="120" height="400" />'; if ($showAd4) include '/home/gearscores/public_html/includes/media/4.php'; else if ($showAd3||($showAd6 && $randomAdPlacement == 3)) echo ''; else if ($showAd6 && $randomAdPlacement == 2) include '/home/gearscores/public_html/includes/media/111-2.php'; ?></td>
    <td colspan="3" align="center" valign="middle" class="borderFrameTop"></td>
    <td width="180" rowspan="3" align="right" valign="top" class="borderFrameRightShadow"><? echo '<img src="http://gearscores.com/images/160px-blank.png" width="120" height="400" />'; if ($showAd3) include '/home/gearscores/public_html/includes/media/4.php'; else if ($showAd4||($showAd6 && $randomAdPlacement == 2)) echo ''; else if ($showAd6 && $randomAdPlacement == 3) include '/home/gearscores/public_html/includes/media/111-3.php'; ?></td>
  </tr>
  <tr>
    <td width="28" align="center" valign="middle" class="borderFrameLeft"><img src="http://gearscores.com/images/160px-blank.png" width="28" height="1" /></td>
    <td align="center" valign="middle" class="borderFrameMainTable"><table border="0" align="center" cellpadding="0" cellspacing="0" class="mainContent">
      <tr>
        <td colspan="2" class="mainContentTopSearch"></td>
      </tr>
                <tr>
                	<td colspan="5" style="vertical-align:bottom;text-align:center;background-color:black;"><? if ($showAd6 && $randomAdPlacement == 1) include '/home/gearscores/public_html/includes/media/111.php'; ?>
                    </td>
                </tr>
      <tr>
        <td colspan="2" class="mainContentBannerTop"></td>
      </tr>
      <tr>
      	<td>
            <table align="center" cellpadding="0" cellspacing="0" class="mainContentTopBanner">
            	<tr>
                	<td width="250" class="mainContentLogo" align="left" valign="middle">
                        <a href="http://gearscores.com"><img src="http://gearscores.com/images/logo.png" class="logoImage" /></a>
            		</td>
            		<td width="750"><? if ($showAd5) include '/home/gearscores/public_html/includes/media/7.php'; else echo '&nbsp;'; ?></td>
            	</tr>
            </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentBannerBottom"></td>
      </tr>
      <!--<tr>
        <td colspan="2" class="mainContentMenuFrameTop"></td>
      </tr>-->
      <tr>
        <td colspan="2" align="center" valign="middle" class="mainContentMenuFrame">
        	<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="50" align="center" valign="middle" class="<? echo ($_SERVER['PHP_SELF']=='/index.php')? 'active' : 'inactive'; ?>" id="menuHome"><a href="http://gearscores.com">Home</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="145" align="center" valign="middle" class="<? echo ($_SERVER['PHP_SELF']=='/character.php')? 'active' : 'inactive'; ?>" id="menuSearch"><a href="http://gearscores.com/character.php">Character Search</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="75" align="center" valign="middle" class="<? echo ($_SERVER['PHP_SELF']=='/rankings.php')? 'active' : 'inactive'; ?>" id="menuRankings"><a href="http://gearscores.com/rankings.php">Rankings</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="50" align="center" valign="middle" class="<? echo ($_SERVER['PHP_SELF']=='/login.php')? 'active' : 'inactive'; ?>" id="menuRankings"><a href="http://gearscores.com/login.php">Log In</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
              </tr>
              </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameBottom"></td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameSubTop"></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle" class="mainContentMenuFrameSub"><div id="menuMainSub">
		<? 
		if ($_SERVER['PHP_SELF']=='/index.php') echo 'Welcome to GearScores.com!';
		else if ($_SERVER['PHP_SELF']=='/character.php') { echo '<form id="mainCharSearch" name="mainCharSearch" method="post" action="http://gearscores.com/character.php" style="display:inline;">Region:&nbsp;<select name="r" id="region2" onchange="updateRealmList(2);">'; echo selectServer('<option value="us">US</option>
          <option value="eu">EU</option>', strtoupper($region));  echo '</select>&nbsp;Name:&nbsp;<select onchange="javascript:insertChar(\'name2\',this.options[this.selectedIndex].value);this.selectedIndex=0;"><option SELECTED="true" /><option>ß</option><option>à</option><option>á</option><option>â</option><option>ã</option><option>ä</option><option>å</option><option>æ</option><option>ç</option><option>è</option><option>é</option><option>ê</option><option>ë</option><option>ì</option><option>í</option><option>î</option><option>ï</option><option>ð</option><option>ñ</option><option>ò</option><option>ó</option><option>ô</option><option>õ</option><option>ö</option><option>ø</option><option>ù</option><option>ú</option><option>û</option><option>ü</option><option>ý</option><option>ÿ</option></select>&nbsp;<input type="text" name="n" id="name2" />&nbsp;Realm:&nbsp;<div id="divServer2" style="display:inline;"><select name="s" id="server2">'.selectServer(file_get_contents("/home/gearscores/public_html/includes/".$region."realms.php"),$server).'</select></div>&nbsp;<input type="submit" name="submit2" id="submit2" value="Search!" /></form>'; }
		else if ($_SERVER['PHP_SELF']=='/rankings.php') { echo '<form id="searchRankings" name="searchRankings" method="post" action="http://gearscores.com/rankings.php" style="display:inline;"><table cellpadding="0" cellspacing="10" ><tr><td>Region:<br /><select name="rre" id="region3" onchange="updateRealmList(3,\'rse\',true);">'.selectServer('<option value="us">US</option><option value="eu">EU</option>',strtoupper($rRegion)).'</select></td><td>Realm:<br /><div id="divServer3" style="display:inline;"><select name="rse" id="server3"><option value="any">Any</option>'.selectServer(file_get_contents("/home/gearscores/public_html/includes/".$rRegion."realms.php"),$rRealm).'</select></div></td><td>Class:<br /><select name="rcl" id="class3" onchange="updateSpecList(3);">'.selectServer('<option value="any" selected="selected">Any</option><option value="deathknight">Death Knight</option><option value="druid">Druid</option><option value="hunter">Hunter</option><option value="mage">Mage</option><option value="paladin">Paladin</option><option value="priest">Priest</option><option value="rogue">Rogue</option><option value="shaman">Shaman</option><option value="warlock">Warlock</option><option value="warrior">Warrior</option>',ucwords($rClass)).'</select></td><td>Spec:<br /><div id="divSpec3" style="display:inline;">'.selectServer(getSpecList($rClass),$rSpec).'</div></td><td><table><tr><td><label>Highest GS<input name="rgs" type="radio" id="rgs_0" value="highest" ';
			if ($rGearscore!='current') echo 'checked="checked" ';
			echo '/></label></td></tr><tr><td><label>Current GS<input type="radio" name="rgs" value="current" id="rgs_1" ';
			if ($rGearscore=='current') echo 'checked="checked" ';
			echo '/></label></td></tr></table></td><td><input type="submit" name="submit3" id="submit3" value="Search!" /></label></td></tr></table></form>';
		}
		else if ($_SERVER['PHP_SELF']=='/login.php') echo 'Log in to GearScores.com';
?></div></td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameSubBottom"></td>
      </tr>
      <? echo '		<tr>
        <td colspan="2" align="center" valign="middle">';
		//cached mode frame
		if ($cachedModeSuccess) echo '<table width="300" border="0" cellspacing="0" cellpadding="0" class="errorTable">
          <tr>
            <td align="center" valign="middle" width="20"><img src="http://gearscores.com/images/warn.png" /></td><td align="center" valign="middle"><a href="javascript:postToURL(\'http://gearscores.com/character.php\', {\'n\':\''.$Character["name"].'\',\'s\':\''.addslashes($Character["realm"]).'\',\'r\':\''.$region.'\'});">'; 
		 if ($cachedModeSuccess) { echo 'You are viewing an outdated (cached) profile.  <br />Click here to view the live profile.'; } 
		 if ($cachedModeSuccess) echo '</a></td>
          </tr>
        </table>';
		//invalid character frame
		if ($charNotFoundError) echo '<table width="600" border="0" cellspacing="0" cellpadding="0" class="errorTable">
          <tr>
            <td align="center" valign="middle" width="20"><img src="http://gearscores.com/images/warn.png" /></td><td align="center" valign="middle" onclick="openInNewWindow();">'; 
		 if ($charNotFoundError) { echo 'WoWArmory has been decommissioned.  Click here to go directly to '.$name.'-'.$server.' on Battle.net.'; } 
		 if ($charNotFoundError) echo '</td>
          </tr>
        </table>';
		if (!($charNotFoundError || $cachedModeSuccess)) echo '&nbsp;';
		echo '</td>
      </tr>'; 
?>
		<? if ($showAd1) { echo '<tr><td colspan="2">'; include '/home/gearscores/public_html/includes/media/1.php'; echo '</td></tr>'; } ?>
      <tr>
        <td colspan="2" class="mainContentMainTable">
          <div align="center">