<?
if (opendir('/home/noroth/public_html/includes/dbconnect/')) {
	require_once('/home/noroth/public_html/includes/dbconnect/config.php');
	require_once('/home/noroth/public_html/includes/functions.php');
	echo "Updating Categories.<br />\n";
	
	$query = "SELECT * FROM `".DB_NAME."`.`products` WHERE `priceupdated` > ".(time()-(60*60*24))." AND `deleted` = '0' GROUP BY `manufacturer`";
	$result = mysql_query($query);
	
	$returnValue = '            <div id="sideBarMain">
				<ul>
					<li><a href="http://www.noroth.com">Home</a></li>
				</ul>
                <img src="http://www.noroth.com/includes/images/popular.png" width="148" height="30" />
                <ul>
                ';
				
	$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('blackberry').'/'.rawurlencode('Blackberry').'">'.htmlentities('Blackberry').'</a></li>';
	$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('ipad').'/'.rawurlencode('iPads').'">'.htmlentities('iPad').'</a></li>';
	$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('kindle').'/'.rawurlencode('Kindles').'">'.htmlentities('Kindle').'</a></li>';
	$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('samsung').'/'.rawurlencode('Samsung').'">'.htmlentities('Samsung').'</a></li>';
	
	$returnValue .= '</ul>';
	
	$returnValue .= '<img src="http://www.noroth.com/includes/images/manufacturer.png" width="148" height="30" />
                <ul>';
	
	
	while ($row = mysql_fetch_assoc($result)) {
		if ($row['manufacturer'] != '' && $row['manufacturer'] != '????'&& $row['manufacturer'] != 'Logitech') {
			if ($row['manufacturer'] == 'Amazon Digital Services, Inc') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Amazon').'/'.rawurlencode('Amazon').'">'.htmlentities('Amazon').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Apple Computer') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Apple').'/'.rawurlencode('Apple').'">'.htmlentities('Apple').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Blind Man Sound') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Blind Man Sound').'/'.rawurlencode('Blind Man Sound').'">'.htmlentities('Blackberry').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Chromo Inc.®') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Chromo').'/'.rawurlencode('Chromo').'">'.htmlentities('Chromo').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Fast-touch(TM)') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Fast-touch').'/'.rawurlencode('Fast-touch').'">'.htmlentities('Fast-touch').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Proexpress Distributor, LLC') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Proexpress').'/'.rawurlencode('Proexpress').'">'.htmlentities('Proexpress').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Sony IT') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Sony').'/'.rawurlencode('Sony').'">'.htmlentities('Sony').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'Worryfree Gadgets LLC') {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode('Worryfree Gadgets').'/'.rawurlencode('Worryfree Gadgets').'">'.htmlentities('Worryfree Gadgets').'</a></li>';
			}
			elseif ($row['manufacturer'] == 'ASUS Computers') {
			}
			else {
				$returnValue .= '<li><a href="http://www.noroth.com/category/s/'.rawurlencode($row['manufacturer']).'/'.rawurlencode($row['manufacturer']).'">'.htmlentities($row['manufacturer']).'</a></li>';
			}
		}
	}
	
	$returnValue .= '</ul></div>';		
	
	$filePath = fopen("/home/noroth/public_html/includes/php/sidebar_categories.php", "w");
	fwrite($filePath, $returnValue);
	fclose($filePath);
	
	echo "Categories updated.<br />\n";
}
?>