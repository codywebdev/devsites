<?php
   $type=$_GET['type'];
   $string=$_GET['string'];
            
	include '/home/goofology/public_html/phpincludes/linkCheck.php';
   
   switch ($type)
   {
   		case 'description':
			checkDescription($string);
			break;
		case 'category':
			checkCategory($string);
			break;
		case 'name':
			checkName($string);
			break;
		case 'url':
			checkUrl($string);
			break;
		default:
			break;
   }
?>