<? if ($showAd2) { include '/home/gearscores/public_html/includes/media/1.php'; echo '<br />'; } else echo '&nbsp;'; ?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['bottom_showAds2'] = ($mtime-$totalPageLoadTime['start']); $totalPageLoadTime['bottom_showAds2_mem'] = memory_get_usage(); ?>
<table><tr>
  <td class="bottomLinks"><a href="http://gearscores.com/">Home</a> | <a href="http://gearscores.com/character.php">Character Search</a> | <a href="http://gearscores.com/rankings.php">Rankings</a> | <a href="http://gearscores.com/contactUs.php">Contact us</a> | <a href="http://gearscores.com/privacyPolicy.php">Privacy Policy</a></td></tr></table>
          </div>
</td>
      </tr>
    </table></td>
    <td width="28" align="center" valign="middle" class="borderFrameRight"><img src="http://gearscores.com/images/160px-blank.png" width="28" height="1" /></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="middle" class="borderFrameBottom"></td>
    </tr>
</table>
</div>
<div align="center">
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['bottom_midHtml'] = ($mtime-$totalPageLoadTime['start']);?>
<div align="center" class="copyrightInfo">World of Warcraft and Blizzard Entertainment are trademarks or registered trademarks of Blizzard Entertainment, Inc. in the U.S. and/or other countries. These terms and all related materials, logos, and images are copyright &copy; Blizzard Entertainment. This site is in no way associated with or endorsed by Blizzard Entertainment&copy;.
</div></div>

<!-- Histats.com START (standard)--> <script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script> <a href="http://www.histats.com" target="_blank" title="site stats" ><script type="text/javascript" > try {Histats.start(1,1307936,4,0,0,0,"00000000"); Histats.track_hits();} catch(err){}; </script></a> <noscript><a href="http://www.histats.com" target="_blank"><img src="http://sstatic1.histats.com/0.gif?1307936&101" alt="site stats" border="0"></a></noscript> <!-- Histats.com END -->

</body>
</html>

<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['bottom_preCloseDB'] = ($mtime-$totalPageLoadTime['start']); $totalPageLoadTime['bottom_preCloseDB_mem'] = memory_get_usage();?>
<?php 
require_once ("/home/gearscores/public_html/includes/closedb.php");
?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['bottom_closeDB'] = ($mtime-$totalPageLoadTime['start']); ?>
<?php

	//echo '<!--';
	//print_r($character);
	//echo '-->';

?>
<?php 
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['end'] = ($mtime-$totalPageLoadTime['start']); 
      //echo '<!--';
	  //if ($_SERVER['REMOTE_ADDR'] == '74.197.117.176') { print_r($totalPageLoadTime); echo memory_get_peak_usage(); }
	  //if ($name = 'Neyziolol') { if (sizeof($testCharXmlArray) > 1) print_r($testCharXmlArray); else print_r(explode('	',gzuncompress(compressCharArray($character))));  } //print_r($totalPageLoadTime);
	  if ($_SERVER['REMOTE_ADDR'] == '74.197.117.176' || $_SERVER['REMOTE_ADDR'] == '129.118.122.72') { echo '<!--'; print_r($character); print_r($testQuery); print_r($totalPageLoadTime); echo '-->';  }
	 // echo '-->'; 
?>