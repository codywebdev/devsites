<?php
	
	$pageType = 'randomlinks';
	
	include "/home/goofology/public_html/phpincludes/escapeString.php";
	
	function printError() {
		echo '<h3>Unknown Link.</h3>';
		exit();
	}
	
	if(isset($_GET['id']) && isset($_GET['loc'])) {
		$location = escapeString($_GET['loc']);
		$id = escapeString($_GET['id']);
	}
	else {
		printError();
	}
	$name = ($_GET['name']!='undefined')? escapeString($_GET['name']) : NULL;
	$viewType = isset($name)? 'moderateLink' : 'viewLink';
	$length = isset($_GET['length'])? escapeString($_GET['length']) : 50;
	if ($length<1 || $length>500) { $length=50; }
	$prev = isset($_GET['prev'])? urlencode(escapeString($_GET['prev'])) : NULL;
	
	include '/home/goofology/public_html/phpincludes/config.php';
	include '/home/goofology/public_html/phpincludes/opendb.php';
	
	$newHtml = '<table width="100%" border="0" cellspacing="0" cellpadding="0"'
			  .' class="linkTableBorder"> <tr><td rowspan="2" valign="top">'
			  .'<font class="boldText"><a href="'.$viewType.'.php?link=';
	
	$result = mysql_query("SELECT *  FROM `links` WHERE `id` = $id LIMIT 0, 10");
	if($line = mysql_fetch_array($result)) {
		
		
		$name = $line['name'];
		$url = $line['url'];
		$description = $line['description'];
		$category = $line['category'];
		$screenname = $line['screenname'];	
		
		
		$newHtml .= $url . '&prev='.$prev.'">' 
				   . $name . '</a></font><font class="normalText"> - ' 
				   .$description . '</font>'
				   .'<font class="lightText"><br />' . $url . '<br>Category: ' . $category 
				   .' &nbsp;&nbsp;&nbsp;&nbsp;Submitted By: ' . $screenname
				   .'<br />Views: ' . $line['clicked']
				   .' &nbsp;&nbsp;&nbsp;&nbsp;Rating: ' 
				   . round(($line['yes']*$line['yes']/$line['no']))
				   .'</font></td><td width="50" align="right" valign="top">'
				   .'<font class="boldText"><a href="javascript:contractLink(\'' . $id 
				   .'\',\'' . $location . '\',\''.$prev.'\','.$length.')" class="boldTextSmall">Less [-]</a></font>'
				   .'</td></tr><tr><td align="right" valign="bottom">'
				   .'<font class="boldTextSmall">'
				   .'<span id="report'. $pageType . $id . '"><a href="javascript:reportLink('
				   .$id.','.'\'report'.$pageType.$id.'\')">Report</a></span></font>'
				   .'</td></tr>'
				   .'</table>';
	}
	
	else {
		$result = mysql_query("SELECT *  FROM `newlinks` WHERE `name` = CONVERT(_utf8 '$name' 
						       USING latin1) COLLATE latin1_swedish_ci LIMIT 0, 10");
		if($line = mysql_fetch_array($result)) {
			
			
			$name = $line['name'];
			$url = $line['url'];
			$description = $line['description'];
			$category = $line['category'];
			$screenname = $line['screenname'];	
			
			
			$newHtml .= $url . '&prev='.$prev.'">' 
					   . $name . '</a></font><font class="normalText"> - ' 
					   .$description . '</font>'
					   .'<font class="lightText"><br />' . $url . '<br>Category: ' . $category 
					   .' &nbsp;&nbsp;&nbsp;&nbsp;Submitted By: ' . $screenname
					   .'<br />Views: ' . $line['clicked']
					   .' &nbsp;&nbsp;&nbsp;&nbsp;Rating: ' 
					   . round(($line['yes']*$line['yes']/$line['no']))
					   .'</font></td><td width="50" align="right" valign="top">'
					   .'<font class="boldText"><a href="javascript:contractLink(\'' . $id 
					   .'\',\'' . $location . '\',\''.$prev.'\','.$length.',\''.urlencode($line['name']).'\')" class="boldTextSmall">Less [-]</a></font>'
					   .'</td></tr><tr><td align="right" valign="bottom">'
					   .'<font class="boldTextSmall">'
					   .'</font>'
					   .'</td></tr>'
					   .'</table>';
		}
		else {
			$result = mysql_query("SELECT *  FROM `reportedlinks` WHERE `id` = $id LIMIT 0, 10");
			if($line = mysql_fetch_array($result)) {
				
				
				$name = $line['name'];
				$url = $line['url'];
				$description = $line['description'];
				$category = $line['category'];
				$screenname = $line['screenname'];	
				
				
				$newHtml .= $url . '&prev='.$prev.'">' 
						   . $name . '</a></font><font class="normalText"> - ' 
						   .$description . '</font>'
						   .'<font class="lightText"><br />' . $url . '<br>Category: ' . $category 
						   .' &nbsp;&nbsp;&nbsp;&nbsp;Submitted By: ' . $screenname
						   .'<br />Views: ' . $line['clicked']
						   .' &nbsp;&nbsp;&nbsp;&nbsp;Rating: ' 
						   . round(($line['yes']*$line['yes']/$line['no']))
						   .'</font></td><td width="50" align="right" valign="top">'
						   .'<font class="boldText"><a href="javascript:contractLink(\'' . $id 
						   .'\',\'' . $location . '\',\''.$prev.'\','.$length.',\''.urlencode($line['name']).'\')" class="boldTextSmall">Less [-]</a></font>'
						   .'</td></tr><tr><td align="right" valign="bottom">'
						   .'<font class="boldTextSmall">'
						   .'</font>'
						   .'</td></tr>'
						   .'</table>';
			}
			else {printError();}
		}
	}
	
	echo $newHtml;
	include '/home/goofology/public_html/phpincludes/closedb.php';
?>