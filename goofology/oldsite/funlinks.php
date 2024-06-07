<html>
<head>
        
 <title>todayslink.php</title>

</head>
<body>

<?php
   include '/phpfiles/config.php';
   include '/phpfiles/opendb.php';
   include '/phpfiles/pagelinks.php';
   
   // set page type
   $PAGE_TYPE = 'Fun';


   // default page is 1 
   $pageNum = 1; 

   // if $_GET['page'] defined, use it as page number 
   if(isset($_GET['page']))
   { 
      $pageNum = $_GET['page']; 
   }

   // count the offset 
   $offset = ($pageNum - 1) * $linksPerPage;








// how many rows we have in database 
$query   = "SELECT COUNT(name) AS numrows FROM links WHERE category LIKE '$PAGE_TYPE'"; 
$result  = mysql_query($query) or die('Error, query failed'); 
$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
$numrows = $row['numrows'];

// max number of pages 
$maxPage = ceil($numrows/$linksPerPage);

echo "<center>\n";

// print the link to access each page 
$self = $_SERVER['PHP_SELF']; 
$nav = ''; 
for($page = 1; $page <= $maxPage; $page++) 
{ 
    if ($page == $pageNum) 
    { 
        $nav .= " $page ";   // no need to create a link to current page 
    } 
    else 
    { 
        $nav .= " <a href=\"$self?page=$page\">$page</a> "; 
    }         
}

// creating previous and next link 
// plus the link to go straight to 
// the first and last page 

if ($pageNum > 1) 
{ 
    $page = $pageNum - 1; 
    $prev = " <a href=\"$self?page=$page\"><img src=\"images/previcon.gif\" alt=\"Previous Page\" width=\"25\" height=\"25\"></a> "; 
}  
else 
{ 
    // we're on page one, black-out previous link
    $prev  = '<img src="images/previcon2.gif" alt="Previous Page" width="25" height="25">';  
} 

if ($pageNum < $maxPage) 
{ 
    $page = $pageNum + 1; 
    $next = " <a href=\"$self?page=$page\"><img src=\"images/nexticon.gif\" alt=\"Next Page\" width=\"25\" height=\"25\" border=\"0\"></a> "; 
}  
else 
{ 
    // we're on the last page, black-out next link
    $next = '<img src="images/nexticon2.gif" alt="Next Page" width="25" height="25" border="0">'; 
} 

// print the navigation link 
echo $prev . $nav . $next;


echo "</center>\n";










   $query   = "SELECT * FROM links WHERE category LIKE '$PAGE_TYPE' LIMIT $offset, $linksPerPage"; 
   $result  = mysql_query($query) or die('Error, query failed');

   echo "<ul>";

   while($row = mysql_fetch_array($result)) 
   { 
      echo "<li>\n" . 
           "<p><a href=\"javascript:loadFrames('popup.htm','" .
           "{$row['url']}')\" >{$row['name']}\n" .
           "</a> &#8211; {$row['description']}</p>\n" . 
           "</li>"; 
   } 
echo '<br>';


echo "<center>\n";

// print the link to access each page 
$self = $_SERVER['PHP_SELF']; 
$nav = ''; 
for($page = 1; $page <= $maxPage; $page++) 
{ 
    if ($page == $pageNum) 
    { 
        $nav .= " $page ";   // no need to create a link to current page 
    } 
    else 
    { 
        $nav .= " <a href=\"$self?page=$page\">$page</a> "; 
    }         
}

// creating previous and next link 
// plus the link to go straight to 
// the first and last page 

if ($pageNum > 1) 
{ 
    $page = $pageNum - 1; 
    $prev = " <a href=\"$self?page=$page\"><img src=\"images/previcon.gif\" alt=\"Previous Page\" width=\"25\" height=\"25\"></a> "; 
}  
else 
{ 
    // we're on page one, black-out previous link
    $prev  = '<img src="images/previcon2.gif" alt="Previous Page" width="25" height="25">';  
} 

if ($pageNum < $maxPage) 
{ 
    $page = $pageNum + 1; 
    $next = " <a href=\"$self?page=$page\"><img src=\"images/nexticon.gif\" alt=\"Next Page\" width=\"25\" height=\"25\" border=\"0\"></a> "; 
}  
else 
{ 
    // we're on the last page, black-out next link
    $next = '<img src="images/nexticon2.gif" alt="Next Page" width="25" height="25" border="0">'; 
} 

// print the navigation link 
echo $prev . $nav . $next;


echo "</center>\n";


    include '/phpfiles/closedb.php';
?>

</body>
</html>



