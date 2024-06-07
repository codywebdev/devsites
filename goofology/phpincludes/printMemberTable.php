<?php

	function printMemberError() {
		echo '<div class="contentBorder3"><div class="contentBorder2"><h1>Not Found</h1><div class="contentBorder"><div class="linkLightBgBegin" id="noresults1"><p class="normalText">No results to display.</p></div></div></div></div>';
		//exit();
	}
	
	function printBigMemberTable($line, $result) {
		global $pageType;
		global $mId;
		global $title;
		
		require_once('escapeString.php');
		$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'screenname';
		$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
		$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
		($num > 50)? $num=50: $num=$num;
		($num < 0)? $num=10: $num=$num;
		
		require_once('jumpMenu.php');
	
		$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="125" align="right"><form name="form" id="form">
      <span class="boldText">Show:</span>
      <select name="jumpMenu" id="jumpMenu" style="width: 50px" onchange="MM_jumpMenu(\'parent\',this,0)">
        <option selected="selected">       &nbsp;&nbsp;</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=5">5</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=10">10</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=20">20</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=30">30</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=40">40</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=50">50</option>
                              </select>
      &nbsp;&nbsp; 
    </form>
    </td>
  </tr>
</table>';
		
		$newHtml .= '<div class="contentBorder3"><div class="contentBorder2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right" class="headingBorder"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder"><tr>
	<td><a href="/browseMembers.php?sort=screenname&amp;dir='
	.(($sort==='screenname'&&$dir==='asc')?'desc':'asc').'&num='.$num.'">Screen Name'
	.(($sort==='screenname'&&$dir==='asc')?'&uarr;':(($sort==='screenname'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="105"><a href="/browseMembers.php?sort=goofpoints&amp;dir='
	.(($sort==='goofpoints'&& $dir==='desc')?'asc':'desc').'&num='.$num.'">Goofpoints (GP)'
	.(($sort==='goofpoints'&&$dir==='asc')?'&uarr;':(($sort==='goofpoints'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="90"><a href="/browseMembers.php?sort=clicked&amp;dir='
	.(($sort==='clicked'&& $dir==='desc')?'asc':'desc').'&num='.$num.'">Links Viewed'
	.(($sort==='clicked'&&$dir==='asc')?'&uarr;':(($sort==='clicked'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="50"><a href="/browseMembers.php?sort=voted&amp;dir='
	.(($sort==='voted'&& $dir==='desc')?'asc':'desc').'&num='.$num.'">Votes'
	.(($sort==='voted'&&$dir==='asc')?'&uarr;':(($sort==='voted'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="85"><a href="/browseMembers.php?sort=date&amp;dir='
	.(($sort==='date'&& $dir==='desc')?'asc':'desc').'&num='.$num.'">Date Joined'
	.(($sort==='date'&&$dir==='asc')?'&uarr;':(($sort==='date'&&$dir==='desc')?'&darr;':'')).'</a></td></tr></table></td></tr><tr><td><div class="contentBorder">';
		
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
	
		do {
		$dateArray = preg_split('/[^a-z\d]/i',$line['date']);
		$date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
		$newHtml .= '<div class="'.$background.'" id="member'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="/memberprofile.php?screenname='.$line['screenname'].'" target="_blank">'.$line['screenname'].'</a></font></td><td width="105" valign="top"><font class="normalText">'.$line['goofpoints'].'&nbsp;GP</font></td><td width="90" valign="top"><font class="normalText">'.$line['clicked'].'</font></td><td width="50" valign="top"><font class="normalText">'.$line['voted'].'</font></td><td width="85" valign="top"><font class="normalText">'.$date.'</font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		$newHtml .= '</div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	function printSmallMemberTable($line, $result) {
		global $pageType;
		global $mId;
		global $title;
		
		$newHtml = '<div class="contentBorder3"><div class="contentBorder2">'
				  .'<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				  .'<tr><td><h1>'.$title.'</h1><div class="contentBorder">';
				  
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
				  
		do {
			$newHtml .= '<div class="'.$background.'" id="member'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="memberprofile.php?screenname='.$line['screenname'].'" target="_blank">'.$line['screenname'].'</a></font><font class="normalText"> - '.$line['goofpoints'].'&nbsp;GP</font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
				   
		$newHtml .= '</div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	
	
	function printBrowseMemberTable($line, $result) {
		global $pageType;
		global $mId;
		global $title;
		
		require_once('escapeString.php');
		$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'screenname';
		$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
		$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
		$page = isset($_GET['page'])? escapeString($_GET['page']) : 1;
		($page >10000 || $page < 0)? $page=1: $page=$page;
		($num > 50)? $num=50: $num=$num;
		($num < 0)? $num=10: $num=$num;
		
		require_once('jumpMenu.php');
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result2 = mysql_query("SELECT *  FROM `members`");
	if($numRows = mysql_num_rows($result2)) { 
		$numPages = ($numRows/$num);
	}
	else {
		$numPages = 0;
	}
	$numPages = ceil($numPages);
		
		include '/home/goofology/public_html/phpincludes/closedb.php';
		
		($page > 4)? $pagedLinks.= '<a href="/browseMembers.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page=1"><< </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/browseMembers.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'">< </a>':'';
		($page > 3)? $pagedLinks.= '<a href="/browseMembers.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-3).'">'.($page-3).' </a>':'';
		($page > 2)? $pagedLinks.= '<a href="/browseMembers.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-2).'">'.($page-2).' </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/browseMembers.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'">'.($page-1).' </a>':'';
					$pagedLinks.= $page.' ';
		($page < $numPages)? $pagedLinks.= '<a href="/browseMembers.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1).'">'.($page+1).' </a>':'';
		($page+1 < $numPages)? $pagedLinks.= '<a href="/browseMembers.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+2).'">'.($page+2).' </a>':'';
		($page+2 < $numPages)? $pagedLinks.= '<a href="/browseMembers.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+3).'">'.($page+3).' </a>':'';
		($page < $numPages)? $pagedLinks.= '<a href="/browseMembers.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1).'">> </a>':'';
		($page+3 < $numPages)? $pagedLinks.= '<a href="/browseMembers.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.$numPages.'">>> </a>':'';
		
	
		$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="boldCenterText">'.$pagedLinks.'</td>
    <td width="125" align="right"><form name="form" id="form">
      <span class="boldText">Show:</span>
      <select name="jumpMenu" id="jumpMenu" style="width: 50px" onchange="MM_jumpMenu(\'parent\',this,0)">
        <option selected="selected">       &nbsp;&nbsp;</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=5&amp;page='.$page.'">5</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=10&amp;page='.$page.'">10</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=20&amp;page='.$page.'">20</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=30&amp;page='.$page.'">30</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=40&amp;page='.$page.'">40</option>
        <option value="/browseMembers.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=50&amp;page='.$page.'">50</option>
                              </select>
      &nbsp;&nbsp; 
    </form>
    </td>
  </tr>
</table>';
		
		$newHtml .= '<div class="contentBorder3"><div class="contentBorder2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right" class="headingBorder"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder"><tr>
	<td><a href="/browseMembers.php?sort=screenname&amp;dir='
	.(($sort==='screenname'&&$dir==='asc')?'desc':'asc').'&num='.$num.'&amp;page='.$page.'">Screen Name'
	.(($sort==='screenname'&&$dir==='asc')?'&uarr;':(($sort==='screenname'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="105"><a href="/browseMembers.php?sort=goofpoints&amp;dir='
	.(($sort==='goofpoints'&& $dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page.'">Goofpoints (GP)'
	.(($sort==='goofpoints'&&$dir==='asc')?'&uarr;':(($sort==='goofpoints'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="90"><a href="/browseMembers.php?sort=clicked&amp;dir='
	.(($sort==='clicked'&& $dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page.'">Links Viewed'
	.(($sort==='clicked'&&$dir==='asc')?'&uarr;':(($sort==='clicked'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="50"><a href="/browseMembers.php?sort=voted&amp;dir='
	.(($sort==='voted'&& $dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page.'">Votes'
	.(($sort==='voted'&&$dir==='asc')?'&uarr;':(($sort==='voted'&&$dir==='desc')?'&darr;':'')).'</a></td>
	<td width="85"><a href="/browseMembers.php?sort=date&amp;dir='
	.(($sort==='date'&& $dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page.'">Date Joined'
	.(($sort==='date'&&$dir==='asc')?'&uarr;':(($sort==='date'&&$dir==='desc')?'&darr;':'')).'</a></td></tr></table></td></tr><tr><td><div class="contentBorder">';
		
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
	
		do {
		$dateArray = preg_split('/[^a-z\d]/i',$line['date']);
		$date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
		$newHtml .= '<div class="'.$background.'" id="member'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="/memberprofile.php?screenname='.$line['screenname'].'" target="_blank">'.$line['screenname'].'</a></font></td><td width="105" valign="top"><font class="normalText">'.$line['goofpoints'].'&nbsp;GP</font></td><td width="90" valign="top"><font class="normalText">'.$line['clicked'].'</font></td><td width="50" valign="top"><font class="normalText">'.$line['voted'].'</font></td><td width="85" valign="top"><font class="normalText">'.$date.'</font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		$newHtml .= '</div></td></tr></table></div></div>';
		echo $newHtml;
	}

	
?>