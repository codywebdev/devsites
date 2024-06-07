<script language="javascript">
function addFavorite(num,loc)
{
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  return;
  } 
document.getElementById(loc).innerHTML='<table border="0" cellspacing="0" cellpadding="0"><tr><td width="110" height="55" align="center" valign="middle">Adding...</td></tr></table>';
var url="action=add";
url=url+"&id="+num;
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("POST","/processes/processFavorite.php",true);
xmlHttp.setRequestHeader('Content-type',
	   'application/x-www-form-urlencoded;charset=UTF-8;');
xmlHttp.send(url);
} 

function deleteFavorite(num,loc)
{
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  return;
  } 
document.getElementById(loc).innerHTML='Deleting...';
var url="action=delete";
url=url+"&id="+num;
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("POST","/processes/processFavorite.php",true);
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
</script>
