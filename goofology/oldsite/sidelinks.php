<html>
<head>
        
 <title>testphp.php</title>

</head>
<body>

<?php
   include '/home/goofology/public_html/oldsite/phpfiles/config.php';
   include '/home/goofology/public_html/oldsite/phpfiles/opendb.php';
   include '/home/goofology/public_html/oldsite/phpfiles/randlinks.php';

   $query   = "SELECT DISTINCT * FROM links ORDER BY rand()"; 
   $result  = mysql_query($query) or die('Error, query failed');

   echo "<div align=\"left\"><font size=\"2\">";

   if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   {
   for ($i=0; $i < $number_of_links; $i++)
   {
    echo "<a href=javascript:loadFrames('popup.htm','{$line['url']}" .
         "') >{$line['name']}</a><br><br>\n"; 
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
   }
   }

   echo "</font></div>";

    include '/home/goofology/public_html/oldsite/phpfiles/closedb.php';
?>

</body>
</html>



