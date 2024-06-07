<?
/*
if ($handle = opendir('/home/gearscores/public_html/images/sigs/generated')) {

	$output = '';
    // This is the correct way to loop over the directory. 
    while (false !== ($file = readdir($handle))) {
		$modTime = filemtime('/home/gearscores/public_html/images/sigs/generated/'.$file);
		if ($modTime <= (time()-(60*60*6)) && (substr($file,0,2) == 'us' || substr($file,0,2) == 'eu') ) { 
			unlink('/home/gearscores/public_html/images/sigs/generated/'.$file);
			$output .= $file.' :'.$modTime.' - '.time().' = '.($modTime-(time()-(60*60*6))).' : deleted. '."<br />\n";
		}
    }
	
	if ($output != '') echo $output;
	else echo 'No files deleted.';

    closedir($handle);
}

*/
?>