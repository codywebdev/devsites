var xmlHttp

function expandLink(id, loc)
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
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

function contractLink(id, loc)
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
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

// JavaScript Document