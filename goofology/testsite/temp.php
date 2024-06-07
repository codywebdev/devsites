<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script language="javascript">
var ie=document.all;
var nn6=document.getElementById&&!document.all;
var isdrag=false;
var x,y;
var dobj;

function movemouse(e)
{
  if (isdrag)
  {
    dobj.style.left = nn6 ? tx + e.clientX - x + "px": tx + event.clientX - x+ "px";
    dobj.style.top  = nn6 ? ty + e.clientY - y + "px": ty + event.clientY - y+ "px";
    return false;
  }
}

function selectmouse(e)
{ 
  var fobj       = nn6 ? e.target : event.srcElement;
  var topelement = nn6 ? "HTML" : "BODY";
  while (fobj.tagName != topelement && fobj.className != "dragme")
  {
    fobj = nn6 ? fobj.parentNode : fobj.parentElement;
  }
  if (fobj.className=="dragme")
  {
    isdrag = true;
    dobj = fobj;
    tx = parseInt(dobj.style.left+0,10);
    ty = parseInt(dobj.style.top+0,10);
    x = nn6 ? e.clientX : event.clientX;
    y = nn6 ? e.clientY : event.clientY;
    document.onmousemove=movemouse;
    return false;
  }
}
document.onmousedown=selectmouse;
document.onmouseup=new Function("isdrag=false");
</script>

<style>
.dragme{position:relative;}
</style>

</head>
<body>

<?php
echo "<xmp> ";

print_r( gd_info() );

echo "</xmp> ";
?>

</body>




