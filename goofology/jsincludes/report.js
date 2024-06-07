function reportLink(id, loc)
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
  var answer = confirm('Report this link as inappropriate content?')
  	if(answer) {
		document.getElementById(loc).innerHTML='Reporting...';
		var url="id="+id;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange= function() {stateChanged(loc);};
		xmlHttp.open("POST","/phpincludes/processReport.php",true);
		xmlHttp.setRequestHeader('Content-type',
			   'application/x-www-form-urlencoded;charset=UTF-8;');
		xmlHttp.send(url);
	}
}