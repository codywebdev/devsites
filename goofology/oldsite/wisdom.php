<html>
<head>
        
 <title>testphp.php</title>

</head>
<body>

<?php
   include '/phpfiles/config.php';
   include '/phpfiles/opendb.php';

   $query   = "SELECT DISTINCT * FROM wisdom ORDER BY rand()"; 
   $result  = mysql_query($query) or die('Error, query failed');


   if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   {
    echo "<div align=\"center\"><font><strong><i>{$line['wisdom']}" .
         "</i></strong></font></div>\n"; 
   }


    include '/phpfiles/closedb.php';
?>

</body>
</html>



