<?php
echo '<script language="javascript">
var xmlHttp

function expandLink(id, loc, prev, length, name)
{
if (id.length==0)
  { 
  document.getElementById(loc).innerHTML="";
  return;
  }
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  return;
  } 
id = escape(id);
var url="/processes/processExpandLink.php";
url=url+"?id="+id;
url=url+"&loc="+loc;
url=url+"&prev="+escape(prev);
url=url+"&length="+length;
url=url+"&name="+escape(name);
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

function contractLink(id, loc, prev, length, name)
{
if (id.length==0)
  { 
  document.getElementById(loc).innerHTML="";
  return;
  }
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  return;
  } 
id = escape(id);
var url="/processes/processContractLink.php";
url=url+"?id="+id;
url=url+"&loc="+loc;
url=url+"&prev="+escape(prev);
url=url+"&length="+length;
url=url+"&name="+escape(name);
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 
</script>';
?>