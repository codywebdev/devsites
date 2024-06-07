<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Goofology.com - Unraveling the Internet</title>
<link rel="shortcut icon" href="http://www.goofology.com/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="icon" href="http://www.goofology.com/favicon.ico" type="image/vnd.microsoft.icon" />
<link href="cssincludes/goof.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="10" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3"><div class="contentBorder3"><div class="contentBorder2"><table width="100%" border="0" cellspacing="10" cellpadding="0" class="headingTable">
      <tr>
        <td rowspan="2" width="100%"><div align="center">
          <table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><a href="http://www.goofology.com"><img src="images/gooflogo.png" alt="Goofology.com" name="goofLogo" width="350" height="150" border="0" id="goofLogo" longdesc="http://www.goofology.com"/></a></td>
            </tr>
          </table>
          </div></td>
        <td align="right" class="headingTopRight"><div align="right">
          <table border="0" cellpadding="0" cellspacing="3" class="headingTopRightTable">
          <tr>
            <td align="right">
            <?php if (isset($_COOKIE['screenname'])) {
					 require_once('/home/goofology/public_html/phpincludes/escapeString.php');
					 $screenname = escapeString($_COOKIE['screenname']);
					 echo '<font class=\'comicText\'>Welcome, '
					 	 .'<a href="/memberprofile.php?screenname='
					 	 .$screenname.'">'.$screenname.'</a><br />'
						 .'<a href="/logout.php?sid='.rand().'">Logout</a></font>';
				  }
				  else {
					 echo '<font class=\'comicText\'><a href="/login.php">Login</a> | '
						  .'<a href="/signup.php">Signup</a></font>';
				  } ?>
            </td>
          </tr>
        </table>
        </div>          </td>
      </tr>
      <tr>
        <td align="center" valign="bottom"><table width="470" border="0" align="left" cellpadding="0" cellspacing="0" class="searchBottom">
  <tr>
    <td height="40" align="center" valign="middle"><form id="form1" name="form1" method="get" action="search.php">
      <label>
      <input name="s" type="text" class="searchField" id="s" size="50" />
      </label>
            <label>
            <input name="Search" type="submit" class="submitButton" id="Search" value="Search" onmouseover="this.className='submitButtonHover'" onmouseout="this.className='submitButton'" />
        </label>
    </form>    </td>
  </tr>
</table>
          </td>
      </tr>
    </table></div></div></td>
    </tr>
  <tr>
    <td width="20%" class="column1"><p>
      <?php include 'phpmodules/navigationMenu.php'; ?>
    </p>
      <p><br />
        </p>
      <?php $colType='small'; include 'phpmodules/randomLinks.php'; ?></td>
    <td width="55%" class="column2"><p>
    	<?php $numberOfLinks=5; include 'phpmodules/signup.php'; ?>
        </p>
      <p><br />
      </p>
      </td>
    <td width="25%" class="column3">
      <p>
        <?php $colType='small'; include 'phpmodules/memberStats.php'; ?>
        </p>
      <p>&nbsp;</p>
      <p>
        <?php $colType='small'; include 'phpmodules/highestGP.php'; ?>
        </p>
      <p>&nbsp;</p>
      <p>
        <?php $colType='small'; include 'phpmodules/newestMembers.php'; ?>
        <br />
      </p></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="contentBorder3"><div class="contentBorder2"><h1>&nbsp;</h1>
        <div class="contentBorder"></div></div></div>        </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="center" valign="middle"><?php include '/home/goofology/public_html/phpmodules/bottomBar.php'; ?></td>
      </tr>
      
      <tr>
        <td><div align="center" class="lightText2">Copyright &copy; <?php echo date('Y'); ?> Goofology.com - All Rights Reserved</div></td>
      </tr>
    </table></td>
    </tr>
</table>
</div>
</body>
</html>
