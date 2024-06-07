<?
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');

echo 'Importing Product Categories';
get_aws_category_items('2956501011','Electronics',10);  //Laptops & Tablets
//get_aws_category_items('565108');  //Laptops
//get_aws_category_items('1232597011');  //Tablets
//get_aws_category_items('3269423011');  //Ultrabooks
//get_aws_category_items('2858603011');  //Chromebooks
//get_aws_category_items('133141011');  //Kindles
echo 'Product Categories Successfully Imported.';


?>