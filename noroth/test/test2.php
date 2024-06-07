<?php
require_once('../includes/dbconnect/config.php');
require_once('../includes/functions.php');

//$item = get_aws_item_info('B0013FRNKG,B001FA1O0O','Large');
//$item = get_aws_item_info('B0051VVOB2','Large'); //kindle fire
//$item = get_aws_item_info('B0062XB0YO','Large'); //child
//$item = get_aws_item_info('B0062XAHFM','Large'); //parent
//$item = get_aws_item_info('B0018OLTAC','Large'); //many variations
//$item = get_aws_item_info('B0013FRNKG,B0083PWAPW');
//update_product($item);
//print_r($item);


//$item = get_aws_item_info('B0013FRNKG');//1 good
//$item = get_aws_item_info('B0013FRNKG,B0083PWAPW');//2 good
//$item = get_aws_item_info('B001FA1O0O');//1 bad
//$item = get_aws_item_info('B001FA1O0O,B001FA1O18');//2 bad
$item = get_aws_item_info('B009OVJK4I');
//print_r(update_product($item));
print_r($item);


//$arrayTest = array(array('blue','10'),array('blue','11'),array('blue','12'),array('blue','13'),array('blue','14'),array('green','12'),array('green','13'),array('green','14'),array('green','15'),array('green','16'),array('green','17'));

//$arrayTest = array_multisort($arrayTest[0],SORT_ASC,SORT_REGULAR,
//							 $arrayTest[1],SORT_ASC,SORT_REGULAR);

//echo '<pre>';
//print_r($arrayTest);
//echo '</pre>';





?>
