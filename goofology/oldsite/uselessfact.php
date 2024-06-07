<html>
<head>
        
 <title>testphp.php</title>

</head>
<body>

<?php
   include '/home/goofology/public_html/oldsite/phpfiles/config.php';
   include '/home/goofology/public_html/oldsite/phpfiles/opendb.php';

   $query   = "SELECT DISTINCT * FROM facts ORDER BY rand()"; 
   $result  = mysql_query($query) or die('Error, query failed');


   if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   {
    echo "<div align=\"center\"><font><strong><i>{$line['fact']}" .
         "</i></strong></font></div>\n"; 
   }


    include '/home/goofology/public_html/oldsite/phpfiles/closedb.php';
?>

</body>
</html>



