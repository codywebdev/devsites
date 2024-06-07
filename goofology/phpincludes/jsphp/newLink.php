<script language="javascript">
var xmlHttp

function checkNewLinkValue(str,type,loc)
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
str = escape(str);
var url="/phpincludes/checkNewLink.php";
url=url+"?string="+str;
url=url+"&type="+type;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 
</script>