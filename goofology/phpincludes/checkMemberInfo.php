<?php
	require_once('/home/goofology/public_html/phpincludes/escapeString.php');
	
   $type=isset($_GET['type'])? escapeString($_GET['type']) : '';
   $string=isset($_GET['string'])? escapeString($_GET['string']) : '';
            	
	include "/home/goofology/public_html/phpincludes/memberCheck.php";
   
   switch ($type)
   {
   		case 'username':
			checkUsername($string);
			break;
		case 'password':
			checkPassword($string);
			break;
		case 'screenname':
			checkScreenname($string);
			break;
		case 'email':
			checkEmail($string);
			break;
		case 'firstname':
			checkName($string);		
			break;	
		case 'lastname':
			checkName($string);		
			break;	
		case 'gender':
			checkGender($string);
			break;
		case 'dob':
			checkDOB($string);
			break;
		case 'location':
			checkLocation($string);
			break;
		case 'confpassword':
			confPassword($string);
			break;
		case 'confemail':
			confEmail($string);
			break;
		case 'aboutme':
			checkAboutme($string);
			break;
		default:
			break;
   }
?>