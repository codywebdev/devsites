
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>

<SCRIPT language="JavaScript">
<!--
function startclock()
{
var thetime=new Date();
var nhours=thetime.getHours();
var nmins=thetime.getMinutes();
var nsecn=thetime.getSeconds();
var AorP=" ";
if (nhours>=12)
    AorP="P.M.";
else
    AorP="A.M.";
if (nhours>=13)
    nhours-=12;
if (nhours==0)
 nhours=12;
if (nsecn<10)
 nsecn="0"+nsecn;
if (nmins<10)
 nmins="0"+nmins;
document.clockform.clockspot.value=document.getElementById('image1').style.left + nsecn;
setTimeout('startclock()',1000);
} 
//-->
</SCRIPT>


<script type="text/javascript">
	function setProperty()
	{
		var prop = setTimout("document.getElementByName('property1').value=document.getElementByName('image1').name",1000);
	}
</script>


</head>

<body>
	<script type="text/javascript" src="testincludes/wz_dragdrop.js"></script>
<img src="/home/goofology/public_html/testsite/koala.jpg" style="position:absolute;left:537;top:243;width:75;height:100;" name="image1" alt="koala" id="image1">
    <label></label>
    <label>
    <FORM name="clockform">
Name:<INPUT TYPE="text" name="clockspot" size="15">
</FORM>
</label>




<SCRIPT language="JavaScript">
<!--
startclock();
//-->
</SCRIPT>

<script type="text/javascript">
	<!--
	
	SET_DHTML(CURSOR_MOVE, RESIZABLE, NO_ALT, SCROLL, "image1");
	
	//-->
    </script>
</body>
</html>
