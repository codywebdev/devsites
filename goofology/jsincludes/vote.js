function voteLink(str,num,loc)
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
document.getElementById(loc).innerHTML='<table border="0" cellspacing="0" cellpadding="0"><tr><td width="110" height="55" align="center" valign="middle">Voting...</td></tr></table>';
var url="vote="+str;
url=url+"&id="+num;
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("POST","/phpincludes/processVote.php",true);
xmlHttp.setRequestHeader('Content-type',
	   'application/x-www-form-urlencoded;charset=UTF-8;');
xmlHttp.send(url);
} 

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
document.getElementById(loc).innerHTML='<table border="0" cellspacing="0" cellpadding="0"><tr><td width="110" height="55" align="center" valign="middle">Moderating...</td></tr></table>';
var url="vote="+str;
url=url+"&id="+num;
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("POST","/phpincludes/processModerateLink.php",true);
xmlHttp.setRequestHeader('Content-type',
	   'application/x-www-form-urlencoded;charset=UTF-8;');
xmlHttp.send(url);
} 

function stateChanged(loc) 
	{ 
		if (xmlHttp.readyState==4)
		{ 
			document.getElementById(loc).innerHTML=xmlHttp.responseText;
		}
	}

function GetXmlHttpObject()
	{
		var xmlHttp=null;
		try
		  {
			  // Firefox, Opera 8.0+, Safari
			  xmlHttp=new XMLHttpRequest();
		  }
		catch (e)
		  {
			  // Internet Explorer
			  try
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
			  catch (e)
				{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
		  }
		return xmlHttp;
	}
