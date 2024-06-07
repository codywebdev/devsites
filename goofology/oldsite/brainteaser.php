<html>
<head>
        
 <title>testphp.php</title>

</head>
<body>

<?php
   include '/phpfiles/config.php';
   include '/phpfiles/opendb.php';

   $query   = "SELECT DISTINCT * FROM tease ORDER BY rand()"; 
   $result  = mysql_query($query) or die('Error, query failed');


   if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   {
    echo "<div align=\"center\">{$line['question']}" .
         "</div>\n"; 
   }


    include '/phpfiles/closedb.php';
?>

</body>
</html>



