<?php
   include '/home/goofology/public_html/oldsite/phpfiles/config.php';
   include '/home/goofology/public_html/oldsite/phpfiles/opendb.php';
   include '/home/goofology/public_html/oldsite/phpfiles/randlinks.php';

   $query   = "SELECT DISTINCT * FROM links ORDER BY rand()"; 
   $result  = mysql_query($query) or die('Error, query failed');


   if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   {
   for ($i=0; $i < $number_of_links; $i++)
   {
    echo "<div align=\"center\"><div align=\"left\"><br><font size=\"2\">" .
         "<a href=javascript:loadFrames('popup.htm','" .
         "{$line['url']}') >{$line['name']}</a> - " .
         "{$line['description']}</font></div></div>\n"; 
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
   }
   }

   echo "</font></div>";

    include '/home/goofology/public_html/oldsite/phpfiles/closedb.php';
?>



