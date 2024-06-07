<script language="javascript">
var xmlHttp

function checkValue(str,type,loc)
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
var url="/phpincludes/checkMemberInfo.php";
url=url+"?string="+str;
url=url+"&type="+type;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 


function checkPassword()
{
	if (signup1<?php global $mId; echo $mId; ?>.password<?php global $mId; echo $mId; ?>.value == signup1<?php global $mId; echo $mId; ?>.confpassword<?php global $mId; echo $mId; ?>.value)
	{
		document.getElementById('password2<?php global $mId; echo $mId; ?>').innerHTML=
		'<img src="/images/check.png" />';
	}
	else
	{
		document.getElementById('password2<?php global $mId; echo $mId; ?>').innerHTML=
		'<font color="Red" class="errorstyle">Passwords do not match.</font>';
	}
}

function checkEmail()
{
	if (signup1<?php global $mId; echo $mId; ?>.email<?php global $mId; echo $mId; ?>.value == signup1<?php global $mId; echo $mId; ?>.confemail<?php global $mId; echo $mId; ?>.value)
	{
		document.getElementById('email2<?php global $mId; echo $mId; ?>').innerHTML=
		'<img src="/images/check.png" />';
	}
	else
	{
		document.getElementById('email2<?php global $mId; echo $mId; ?>').innerHTML=
		'<font color="Red" class="errorstyle">Emails do not match.</font>';
	}
}
</script>
