<?php

	echo '<script language="javascript">
	function moderateLink(str,num,loc)
{
if (str.length==0)
  { 
  document.getElementById(loc).innerHTML="";
  return;
  }
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  return;
  } 
var url="vote="+str;
url=url+"&id="+num;
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("POST","/phpincludes/processModerateLink.php",true);
xmlHttp.setRequestHeader(\'Content-type\',
	   \'application/x-www-form-urlencoded;charset=UTF-8;\');
xmlHttp.send(url);
} 
</script>';

?>