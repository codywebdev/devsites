<?php

	function printError($message) {
		$message = isset($message)? $message : 'Not Found';
		echo '<div class="contentBorder3"><div class="contentBorder2"><h1>'.$message.'</h1><div class="contentBorder"><div class="linkLightBgBegin" id="noresults1"><p class="normalText">No results to display.</p></div></div></div></div>';
		//exit();
	}

	function printBigLinkTable($line, $result) {
		global $pageType;
		global $mId;
		global $title;
		$newHtml = '<div class="contentBorder3"><div class="contentBorder2">';
		$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				   .'<tr><td><h1>'.$title.'</h1><div class="contentBorder">';
				   
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
		
		do {
			//truncate description length
			$description = substr($line['description'], 0, (50-strlen($line['name'])));
			if (strlen($description)==(50-strlen($line['name']))) {$description .= '...';}
					   
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font><font class="normalText"> - '.$description.'</font></td><td width="50" align="right" valign="top"><font class="boldText"><a href="javascript:expandLink(\''.$line['id'].'\',\'link'.$mId.$pageType.$line['id'].'\',\''.urlencode($_SERVER["REQUEST_URI"]).'\')" class="boldTextSmall">More[+]</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		
		$newHtml .='</div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	function printSmallLinkTable($line, $result) {
		global $pageType;
		global $mId;
		global $title;
		
		$newHtml = '<div class="contentBorder3"><div class="contentBorder2">';
		$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				   .'<tr><td><h1>'.$title.'</h1><div class="contentBorder">';
				   
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
		
		do {
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$id.'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		$newHtml .='</div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	function printBrowseLinkTable($line, $result) {
	
		global $pageType;
		global $mId;
		global $title;
		
		require_once('escapeString.php');
		$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'name';
		$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
		$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
		$page = isset($_GET['page'])? escapeString($_GET['page']) : 1;
		$browse = isset($_GET['browse'])? escapeString($_GET['browse']) : '';
		($page >10000 || $page < 0)? $page=1: $page=$page;
		($num > 50)? $num=50: $num=$num;
		($num < 0)? $num=10: $num=$num;
		
		require_once('jumpMenu.php');
		
		$pagedLinks = '';
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
	$result2 = mysql_query("SELECT *  FROM `links` WHERE `category` LIKE CONVERT(_utf8 '%$browse%' USING latin1) COLLATE latin1_swedish_ci");
	if($numRows = mysql_num_rows($result2)) { 
		$numPages = ($numRows/$num);
	}
	else {
		$numPages = 0;
	}
	$numPages = ceil($numPages);
		
		include '/home/goofology/public_html/phpincludes/closedb.php';
		
		($page > 4)? $pagedLinks.= '<a href="/browseLinks.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page=1&amp;browse='.$browse
					.'"><< </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/browseLinks.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'&amp;browse='.$browse
					.'">< </a>':'';
		($page > 3)? $pagedLinks.= '<a href="/browseLinks.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-3).'&amp;browse='.$browse
					.'">'.($page-3).' </a>':'';
		($page > 2)? $pagedLinks.= '<a href="/browseLinks.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-2).'&amp;browse='.$browse
					.'">'.($page-2).' </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/browseLinks.php?sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'&amp;browse='.$browse
					.'">'.($page-1).' </a>':'';
					$pagedLinks.= $page.' ';
		($page < $numPages)? $pagedLinks.= '<a href="/browseLinks.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1)
					.'&amp;browse='.$browse.'">'.($page+1).' </a>':'';
		($page+1 < $numPages)? $pagedLinks.= '<a href="/browseLinks.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+2)
					.'&amp;browse='.$browse.'">'.($page+2).' </a>':'';
		($page+2 < $numPages)? $pagedLinks.= '<a href="/browseLinks.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+3)
					.'&amp;browse='.$browse.'">'.($page+3).' </a>':'';
		($page < $numPages)? $pagedLinks.= '<a href="/browseLinks.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1)
					.'&amp;browse='.$browse.'">> </a>':'';
		($page+3 < $numPages)? $pagedLinks.= '<a href="/browseLinks.php?sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.$numPages
					.'&amp;browse='.$browse.'">>> </a>':'';
								
		
		$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="boldCenterText">'.$pagedLinks.'</td>
    <td width="125" align="right"><form name="form" id="form">
      <span class="boldText">Show:</span>
      <select name="jumpMenu" id="jumpMenu" style="width: 50px" onchange="MM_jumpMenu(\'parent\',this,0)">
        <option selected="selected">       &nbsp;&nbsp;</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=5&amp;page='.$page.'&amp;browse='.$browse.'">5</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=10&amp;page='.$page.'&amp;browse='.$browse.'">10</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=20&amp;page='.$page.'&amp;browse='.$browse.'">20</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=30&amp;page='.$page.'&amp;browse='.$browse.'">30</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=40&amp;page='.$page.'&amp;browse='.$browse.'">40</option>
        <option value="/browseLinks.php?sort='.$sort.'&amp;dir='.$dir.'&amp;num=50&amp;page='.$page.'&amp;browse='.$browse.'">50</option>
                              </select>
      &nbsp;&nbsp; 
    </form>
    </td>
  </tr>
</table>';
		
		$newHtml .= '<div class="contentBorder3"><div class="contentBorder2">';
		$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				   .'<tr><td align="right" class="headingBorder"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder">
  <tr>
    <td><a href="/browseLinks.php?sort=name&amp;dir='
	.(($sort==='name'&&$dir==='asc')?'desc':'asc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Link Name'
	.(($sort==='name'&&$dir==='asc')?'&uarr;':(($sort==='name'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="80"><a href="/browseLinks.php?sort=category&amp;dir='
	.(($sort==='category'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Category'
	.(($sort==='category'&&$dir==='asc')?'&uarr;':(($sort==='category'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="100"><a href="/browseLinks.php?sort=screenname&amp;dir='
	.(($sort==='screenname'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='
	.$page.'&amp;browse='.$browse.'">Submitted By'
	.(($sort==='screenname'&&$dir==='asc')?'&uarr;':(($sort==='screenname'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="75"><a href="/browseLinks.php?sort=clicked&amp;dir='
	.(($sort==='clicked'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Views'
	.(($sort==='clicked'&&$dir==='asc')?'&uarr;':(($sort==='clicked'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="75"><a href="/browseLinks.php?sort=rating&amp;dir='
	.(($sort==='rating'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Rating'
	.(($sort==='rating'&&$dir==='asc')?'&uarr;':(($sort==='rating'&&$dir==='desc')?'&darr;':'')).'</a></td>
  </tr>
</table>
     
    </td>
    </tr>
  <tr>
    <td><div class="contentBorder">';
				   
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
		
		do {
			//truncate description length
			$description = substr($line['description'], 0, (50-strlen($line['name'])));
			if (strlen($description)==(50-strlen($line['name']))) {$description .= '...';}
					   
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font><font class="normalText"> - '.$description.'</font></td><td width="50" align="right" valign="top"><font class="boldText"><a href="javascript:expandLink(\''.$line['id'].'\',\'link'.$mId.$pageType.$line['id'].'\',\''.urlencode($_SERVER["REQUEST_URI"]).'\')" class="boldTextSmall">More[+]</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		
		$newHtml .='</div></div></td></tr></table></div></div>';
		echo $newHtml;
	}

	function printModerateLinkTable($line, $result) { 
		global $pageType;
		global $mId;
		global $title;
		$newHtml = '<div class="contentBorder3"><div class="contentBorder2">';
		$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				   .'<tr><td><h1>'.$title.'</h1><div class="contentBorder">';
				   
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
		$i = 1;
		
		do {
			//truncate description length
			$description = substr($line['description'], 0, (50-strlen($line['name'])));
			if (strlen($description)==(50-strlen($line['name']))) {$description .= '...';}
			$newId = isset($line['id'])? NULL : $i;
			$linkId = isset($line['id'])? $line['id'] : 0;
			$i++;
					   
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$line['id'].$newId.'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="moderateLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font><font class="normalText"> - '.$description.'</font></td><td width="50" align="right" valign="top"><font class="boldText"><a href="javascript:expandLink(\''.$linkId.'\',\'link'.$mId.$pageType.$line['id'].$newId.'\',\''.urlencode($_SERVER["REQUEST_URI"]).'\',50,\''.urlencode($line['name']).'\')" class="boldTextSmall">More[+]</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		
		$newHtml .='</div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	
	function printSearchLinkTable($line, $result) {
	
		global $pageType;
		global $mId;
		global $title;
		
		require_once('escapeString.php');
		$sort = isset($_GET['sort'])? escapeString($_GET['sort']) : 'name';
		$dir = isset($_GET['dir'])? escapeString($_GET['dir']) : 'asc';
		$num = isset($_GET['num'])? escapeString($_GET['num']) : 10;
		$page = isset($_GET['page'])? escapeString($_GET['page']) : 1;
		$browse = isset($_GET['browse'])? escapeString($_GET['browse']) : '';
		($page >10000 || $page < 0)? $page=1: $page=$page;
		($num > 50)? $num=50: $num=$num;
		($num < 0)? $num=10: $num=$num;
		
		require_once('jumpMenu.php');
		
		$pagedLinks = '';
		
		include '/home/goofology/public_html/phpincludes/config.php';
		include '/home/goofology/public_html/phpincludes/opendb.php';
		
	//validate search string
	if (isset($_REQUEST['s'])) {
        if(get_magic_quotes_gpc()) {
            $search = stripslashes($_REQUEST['s']);
        } else {
            $search = $_REQUEST['s'];
        }
	}
	$s = $search;
	$search = mysql_real_escape_string($search);
	
	$result2 = mysql_query("SELECT *, MATCH(name,description,screenname) 
					 	  AGAINST ('$search' IN BOOLEAN MODE) 
						  AS relevance FROM links WHERE MATCH(name,description,screenname) 
						  AGAINST ('$search' IN BOOLEAN MODE) 
						  ORDER BY relevance DESC, clicked DESC LIMIT 30") or die(mysql_error());
	if($numRows = mysql_num_rows($result2)) { 
		$numPages = ($numRows/$num);
	}
	else {
		$numPages = 0;
	}
	$numPages = ceil($numPages);
		
		include '/home/goofology/public_html/phpincludes/closedb.php';
		
		($page > 4)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page=1&amp;browse='.$browse
					.'"><< </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'&amp;browse='.$browse
					.'">< </a>':'';
		($page > 3)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-3).'&amp;browse='.$browse
					.'">'.($page-3).' </a>':'';
		($page > 2)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-2).'&amp;browse='.$browse
					.'">'.($page-2).' </a>':'';
		($page > 1)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='.$sort.'&amp;dir='
					.$dir.'&amp;num='.$num.'&amp;page='.($page-1).'&amp;browse='.$browse
					.'">'.($page-1).' </a>':'';
					$pagedLinks.= $page.' ';
		($page < $numPages)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1)
					.'&amp;browse='.$browse.'">'.($page+1).' </a>':'';
		($page+1 < $numPages)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+2)
					.'&amp;browse='.$browse.'">'.($page+2).' </a>':'';
		($page+2 < $numPages)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+3)
					.'&amp;browse='.$browse.'">'.($page+3).' </a>':'';
		($page < $numPages)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.($page+1)
					.'&amp;browse='.$browse.'">> </a>':'';
		($page+3 < $numPages)? $pagedLinks.= '<a href="/search.php?s='.$s
			        .'&sort='
					.$sort.'&amp;dir='.$dir.'&amp;num='.$num.'&amp;page='.$numPages
					.'&amp;browse='.$browse.'">>> </a>':'';
								
		$firstResult = (($page-1)*$num+1);
		$lastResult = (($page*$num)>$numRows)? $numRows : ($page*$num);
		$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="boldCenterText">'.$pagedLinks.'&nbsp;&nbsp;Showing <b>'
	.$firstResult.'-'.$lastResult.'</b> of about <b>'.$numRows.'</b></td>
    <td width="125" align="right"><form name="form" id="form">
      <span class="boldText">Show:</span>
      <select name="jumpMenu" id="jumpMenu" style="width: 50px" onchange="MM_jumpMenu(\'parent\',this,0)">
        <option selected="selected">       &nbsp;&nbsp;</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=5&amp;page='.$page.'&amp;browse='.$browse.'">5</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=10&amp;page='.$page.'&amp;browse='.$browse.'">10</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=20&amp;page='.$page.'&amp;browse='.$browse.'">20</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=30&amp;page='.$page.'&amp;browse='.$browse.'">30</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=40&amp;page='.$page.'&amp;browse='.$browse.'">40</option>
        <option value="/search.php?s='.$s.'&sort='.$sort.'&amp;dir='.$dir.'&amp;num=50&amp;page='.$page.'&amp;browse='.$browse.'">50</option>
                              </select>
      &nbsp;&nbsp; 
    </form>
    </td>
  </tr>
</table>';
		
		$newHtml .= '<div class="contentBorder3"><div class="contentBorder2">';
		$newHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
				   .'<tr><td align="right" class="headingBorder"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="linkTableBorder">
  <tr>
    <td><a href="/search.php?s='.$s.'&sort=name&amp;dir='
	.(($sort==='name'&&$dir==='asc')?'desc':'asc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Link Name'
	.(($sort==='name'&&$dir==='asc')?'&uarr;':(($sort==='name'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="80"><a href="/search.php?s='.$s.'&sort=category&amp;dir='
	.(($sort==='category'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Category'
	.(($sort==='category'&&$dir==='asc')?'&uarr;':(($sort==='category'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="100"><a href="/search.php?s='.$s.'&sort=screenname&amp;dir='
	.(($sort==='screenname'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='
	.$page.'&amp;browse='.$browse.'">Submitted By'
	.(($sort==='screenname'&&$dir==='asc')?'&uarr;':(($sort==='screenname'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="75"><a href="/search.php?s='.$s.'&sort=clicked&amp;dir='
	.(($sort==='clicked'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Views'
	.(($sort==='clicked'&&$dir==='asc')?'&uarr;':(($sort==='clicked'&&$dir==='desc')?'&darr;':'')).'</a></td>
    <td width="75"><a href="/search.php?s='.$s.'&sort=rating&amp;dir='
	.(($sort==='rating'&&$dir==='desc')?'asc':'desc').'&num='.$num.'&amp;page='.$page
	.'&amp;browse='.$browse.'">Rating'
	.(($sort==='rating'&&$dir==='asc')?'&uarr;':(($sort==='rating'&&$dir==='desc')?'&darr;':'')).'</a></td>
  </tr>
</table>
     
    </td>
    </tr>
  <tr>
    <td><div class="contentBorder">';
				   
		$background = 'linkLightBgBegin';
		$highlight = 'linkHighlightBgBegin';
		
		do {
			//truncate description length
			$description = substr($line['description'], 0, (50-strlen($line['name'])));
			if (strlen($description)==(50-strlen($line['name']))) {$description .= '...';}
					   
			$newHtml .= '<div class="'.$background.'" id="link'.$mId.$pageType.$line['id'].'" onmouseover="this.className=\''.$highlight.'\'" onmouseout="this.className=\''.$background.'\'"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="linkTableBorder"><tr><td valign="top"><font class="boldText"><a href="viewLink.php?link='.$line['url'].'&prev='.urlencode($_SERVER["REQUEST_URI"]).'">'.$line['name'].'</a></font><font class="normalText"> - '.$description.'</font></td><td width="50" align="right" valign="top"><font class="boldText"><a href="javascript:expandLink(\''.$line['id'].'\',\'link'.$mId.$pageType.$line['id'].'\',\''.urlencode($_SERVER["REQUEST_URI"]).'\')" class="boldTextSmall">More[+]</a></font></td></tr></table></div>';
			$background = $background==='linkDarkBg'? 'linkLightBg' : 'linkDarkBg';
			$highlight = 'linkHighlightBg';
		} while($line = mysql_fetch_array($result));
		
		
		$newHtml .='</div></div></td></tr></table></div></div>';
		echo $newHtml;
	}
	
	
?>