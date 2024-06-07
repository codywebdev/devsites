<?php require_once('includes/layout/tbody.php'); ?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_includes'] = ($mtime-$totalPageLoadTime['start']); ?>
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table class="rankingsMainTable dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" valign="top">
                      					<table><tr><td>
                      					<div class="dropshadow"><? 
										
										
										
	
					  
	if ($rStart >= (5*$rPerPage)) $pageCountStart = floor($rStart/$rPerPage)-3;
	else $pageCountStart = '1';
	if (!$rSearchResultFound) $rCurPage = ceil($rStart/$rPerPage)+1;
	$rMaxPage = ceil($rNumResults/$rPerPage);
	echo '<table border="0" cellspacing="0" cellpadding="0" class="pageNavigation"><tr><td align="left" valign="middle" class="rowA" colspan="2">Showing '
			.($rStart+1)
			.'-'
			.(min(($rStart+$rPerPage),$rNumResults))
			.' of '
			.number_format($rNumResults)
			.' results.</td></tr><tr><td colspan="2" class="rowB" align="center" valign="middle">';
	if ($rNumResults <= 0) { echo '<span class="rowC">Sorry, no results found.</span>'; }
	if ($rStart > 0) echo '<a href="javascript:postToURL(\'http://gearscores.com/rankings.php\', {\'rre\':\''.$rRegion.'\',\'rse\':\''.addslashes($rRealm).'\',\'rcl\':\''.$rClass.'\',\'rsp\':\''.$rSpec.'\',\'rgs\':\''.$rGearscore.'\',\'sort\':\''.$rSort.'\',\'dir\':\''.$rSortDir.'\',\'rst\':\''.'0'.'\',\'rpp\':\''.$rPerPage.'\'});"><img src="http://gearscores.com/images/first.png" align="middle" /></a> <a href="javascript:postToURL(\'http://gearscores.com/rankings.php\', {\'rre\':\''.$rRegion.'\',\'rse\':\''.addslashes($rRealm).'\',\'rcl\':\''.$rClass.'\',\'rsp\':\''.$rSpec.'\',\'rgs\':\''.$rGearscore.'\',\'sort\':\''.$rSort.'\',\'dir\':\''.$rSortDir.'\',\'rst\':\''.(($rCurPage-2)*$rPerPage).'\',\'rpp\':\''.$rPerPage.'\'});"><img src="http://gearscores.com/images/previous.png" align="middle" /></a> ';
	for ($i=$pageCountStart;$i<=($pageCountStart+9);$i++) {
		if ($i > $rMaxPage) break;
		echo '<span class="border">';
		if ($i != $rCurPage) echo '<a href="javascript:postToURL(\'http://gearscores.com/rankings.php\', {\'rre\':\''.$rRegion.'\',\'rse\':\''.addslashes($rRealm).'\',\'rcl\':\''.$rClass.'\',\'rsp\':\''.$rSpec.'\',\'rgs\':\''.$rGearscore.'\',\'sort\':\''.$rSort.'\',\'dir\':\''.$rSortDir.'\',\'rst\':\''.(($i-1)*$rPerPage).'\',\'rpp\':\''.$rPerPage.'\'});">';
		echo $i;
		if ($i != $rCurPage) echo '</a>';
		echo '</span> ';
	}
	if ($rNumResults > ($rStart + $rPerPage)) echo '<a href="javascript:postToURL(\'http://gearscores.com/rankings.php\', {\'rre\':\''.$rRegion.'\',\'rse\':\''.addslashes($rRealm).'\',\'rcl\':\''.$rClass.'\',\'rsp\':\''.$rSpec.'\',\'rgs\':\''.$rGearscore.'\',\'sort\':\''.$rSort.'\',\'dir\':\''.$rSortDir.'\',\'rst\':\''.($rCurPage*$rPerPage).'\',\'rpp\':\''.$rPerPage.'\'});"><img src="http://gearscores.com/images/next.png" align="middle" /></a> <a href="javascript:postToURL(\'http://gearscores.com/rankings.php\', {\'rre\':\''.$rRegion.'\',\'rse\':\''.addslashes($rRealm).'\',\'rcl\':\''.$rClass.'\',\'rsp\':\''.$rSpec.'\',\'rgs\':\''.$rGearscore.'\',\'sort\':\''.$rSort.'\',\'dir\':\''.$rSortDir.'\',\'rst\':\''.(($rMaxPage-1)*$rPerPage).'\',\'rpp\':\''.$rPerPage.'\'});"><img src="http://gearscores.com/images/last.png" align="middle" /></a>';
	echo '</td></tr><tr><td align="left" valign="middle" class="rowC">Go to ';
		//Go to ________ (fill in the blank)
		switch ($rSort) {
			case 'name':
				echo 'Name';
				break;
			case 'realm':
				echo 'Realm';
				break;
			case 'class':
				echo 'Class';
				break;
			case 'spec':
				echo 'Spec';
				break;
			case 'guild':
				echo 'Guild';
				break;
			case 'gs':
				echo 'GearScore';
				break;
			default:
				echo 'GearScore';
				break;
		}
	echo ':<br />';
		//jump to sort filter form
		echo '<form id="form5" name="form5" method="post" action="http://gearscores.com/rankings.php">
				  <input type="text" name="rsrch" id="rsrch5" size="15" maxlength="50" />';
		echo	'<input type="hidden" name="rre" value="'.$rRegion.'">
				 <input type="hidden" name="rse" value="'.$rRealm.'">
				 <input type="hidden" name="rcl" value="'.$rClass.'">
				 <input type="hidden" name="rsp" value="'.$rSpec.'">
				 <input type="hidden" name="rgs" value="'.$rGearscore.'">
				 <input type="hidden" name="sort" value="'.$rSort.'">
				 <input type="hidden" name="dir" value="'.$rSortDir.'">
				 <input type="hidden" name="rpp" value="'.$rPerPage.'">';
		echo 	'<input type="submit" name="button" id="button5" value="Go!" />
					</form>';
	echo '</td><td align="right" valign="middle" class="rowC">Jump to page:<br />';
		// jump to page form
		echo '<form id="form4" name="form4" method="post" action="http://gearscores.com/rankings.php">
				<select name="rst" id="start4">
				  <option select="selected"></option>';
						for ($i=max(1,($rCurPage-500));$i<=(min($rMaxPage,($rCurPage+500)));$i++) {
							if ($i > $rMaxPage) break;
							echo '<option value="'.(($i-1)*$rPerPage).'">';
							echo $i;
							echo '</option>';
						}
		echo 	'</select>';
		echo	'<input type="hidden" name="rre" value="'.$rRegion.'">
				 <input type="hidden" name="rse" value="'.$rRealm.'">
				 <input type="hidden" name="rcl" value="'.$rClass.'">
				 <input type="hidden" name="rsp" value="'.$rSpec.'">
				 <input type="hidden" name="rgs" value="'.$rGearscore.'">
				 <input type="hidden" name="sort" value="'.$rSort.'">
				 <input type="hidden" name="dir" value="'.$rSortDir.'">
				 <input type="hidden" name="rpp" value="'.$rPerPage.'">';
		echo 	'<input type="submit" name="button" id="button4" value="Go!" />
					</form>';
	echo '</td></tr></table>'; 



?>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_pageNavi'] = ($mtime-$totalPageLoadTime['start']); ?>

										</td></tr></table>
                      					</div>
                      <table border="0" cellspacing="0" cellpadding="0" class="rankingsTable">
                      <tr class="rowA">
                        <td align="center" valign="middle" class="headRank">Rank</td>
                        <td align="center" valign="middle" class="headName"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'name','dir':'<? if ($rSort=='name'&&$rSortDir=='asc')echo 'desc'; else echo 'asc'; ?>'})">Name</a></td>
                        <td align="center" valign="middle" class="headRealm"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'realm','dir':'<? if ($rSort=='realm'&&$rSortDir=='asc')echo 'desc'; else echo 'asc'; ?>'})">Realm</a></td>
                        <td align="center" valign="middle" class="headClass"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'class','dir':'<? if ($rSort=='class'&&$rSortDir=='asc')echo 'desc'; else echo 'asc'; ?>'})">Class</a></td>
                        <td align="center" valign="middle" class="headSpec"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'spec','dir':'<? if ($rSort=='spec'&&$rSortDir=='asc')echo 'desc'; else echo 'asc'; ?>'})">Spec</a></td>
                        <td align="center" valign="middle" class="headGuild"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'guild','dir':'<? if ($rSort=='guild'&&$rSortDir=='asc')echo 'desc'; else echo 'asc'; ?>'})">Guild</a></td>
                        <td align="center" valign="middle" class="headGearscore"><a href="javascript:postToURL('http://gearscores.com/rankings.php',{'rre':'<? echo addslashes((isset($_REQUEST["rre"])? $_REQUEST["rre"] : 'us')); ?>','rse':'<? echo addslashes((isset($_REQUEST["rse"])? $_REQUEST["rse"] : 'any')); ?>','rcl':'<? echo addslashes((isset($_REQUEST["rcl"])? $_REQUEST["rcl"] : 'any')); ?>','rsp':'<? echo addslashes((isset($_REQUEST["rsp"])? $_REQUEST["rsp"] : 'any')); ?>','rgs':'<? echo addslashes((isset($_REQUEST["rgs"])? $_REQUEST["rgs"] : 'highest')); ?>','sort':'gs','dir':'<? if ($rSort=='gs'&&$rSortDir=='desc')echo 'asc'; else if (!isset($_REQUEST["sort"])) echo 'asc'; else echo 'desc'; ?>'})">GearScore</a></td>
                      </tr>
<?											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_headings'] = ($mtime-$totalPageLoadTime['start']); ?>
                      <? 
					  $rowClass = 'rowB';
					  $rowClassAlt = 'rowC';
					  $sizeofQueryResult = sizeof($queryResult);
					  for ($i=0,$a=$rStart;$a<($sizeofQueryResult+$rStart);$i++,$a++) {
											  $mtime = microtime(); $mtime = explode(' ', $mtime); $mtime = $mtime[1] + $mtime[0]; $totalPageLoadTime['rank_rowresults'][] = ($mtime-$totalPageLoadTime['start']);
						  if ($rGearscore=='current') $rowCharGS = $queryResult[$i]['gearscore'];
						  else $rowCharGS = $queryResult[$i]['highestgs'];
						  $rowCharUrl = 'http://gearscores.com/character.php?n='.urlencode($queryResult[$i]['name']).'&amp;s='.urlencode($queryResult[$i]['server']).'&amp;r='.$queryResult[$i]['region'];
                      	echo '<a href="'.$rowCharUrl.'"><tr class="'.$rowClass.'" onMouseOver="this.className=\''.$rowClassAlt.'\'" onMouseOut="this.className=\''.$rowClass.'\'">
                        <td align="center" valign="middle" class="rank"><a href="'.$rowCharUrl.'">'.($a+1).'</a></td>
                        <td align="center" valign="middle" style="color:'.getCharClassColor(array(),true,$queryResult[$i]['class']).';" class="name"><a href="'.$rowCharUrl.'">'.$queryResult[$i]['name'].'</a></td>
                        <td align="center" valign="middle" style="color:'.getCharClassColor(array(),true,$queryResult[$i]['class']).';" class="realm"><a href="'.$rowCharUrl.'">'.$queryResult[$i]['server'].'</a></td>
                        <td align="center" valign="middle" style="color:'.getCharClassColor(array(),true,$queryResult[$i]['class']).';" class="class"><a href="'.$rowCharUrl.'">'.$queryResult[$i]['class'].'</a></td>
                        <td align="center" valign="middle" style="color:'.getCharClassColor(array(),true,$queryResult[$i]['class']).';" class="spec"><a href="'.$rowCharUrl.'">'.$queryResult[$i]['spec'].'</a></td>
                        <td align="center" valign="middle" style="color:'.getCharClassColor(array(),true,$queryResult[$i]['class']).';" class="guild"><a href="'.$rowCharUrl.'">'.$queryResult[$i]['guild'].'</a></td>
                        <td align="center" valign="middle" style="'.getGSColorStyle($rowCharGS,14,0).'" class="gearscore"><a href="'.$rowCharUrl.'">'.$rowCharGS.'</a></td>
                      </tr></a>';
					  }
					  ?>

                    </table>
</td>
                    </tr>
                  </table>
                </div></td>
              </tr>
            </table>
<?php require_once('includes/layout/bbody.php'); ?>