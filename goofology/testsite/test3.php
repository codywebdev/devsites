<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>



<script language="javascript">



var imageCount = 0;

var textCount = 1;

var randImage = 1;



function randomColor (){

      var array = new Array (   "f", "e", "d", "c", "b", "a", "9", "8", "7", "6", "5", "4", "3" );  // array of possible hex values.

      var endHex = "#";  // this is the hex color that will be returned

      for (   var i = 0; i < 6; i++   )   {  // loop 6 times...

            endHex += array[Math.round (   Math.random (   ) * array.length   )];  // and each time add a new character to the returned color.

      }

      return endHex;

}





function createNewImage()

{

  imageName = "";

  if (randImage >= 6) {randImage = 1;}

  switch (randImage)

  {case 1:

     imageName = "bear.jpg";

     break;

   case 2:

     imageName = "eagle.jpg";

     break;

   case 3:

     imageName = "koala.jpg";

     break;

   case 4:

     imageName = "tiger.jpg";

     break;

   case 5:

     imageName = "whale.jpg";

     break;

   default:

     imageName = "koala.jpg";

     break;

  }



  imageCount++;

  newImage = document.createElement("image"+imageCount);

  newImage.innerHTML = '<img src="/testsite/' + imageName + '" style="position:absolute;left:120;top:100;width:75;height:100;" id="image' + imageCount + '" class="drag" onMouseDown=selectObject()>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newImage); 

  randImage++;

  return false;

}



function createNewText()

{  

  var color = randomColor();

  textCount++;

  newText = document.createElement("text"+textCount);

  newText.innerHTML = '<div style="position:absolute;left:120;top:120;width:139;height:108;background-color=' + color + ';overflow:hidden;" id="text' + textCount + '" class="drag" onMouseDown=selectObject()>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis non libero. Quisque rhoncus malesuada massa. Aliquam a ligula. Fusce interdum enim et neque. Aenean at pede eu libero rhoncus suscipit. Curabitur ut felis. Phasellus suscipit egestas turpis. Ut nulla ante, pharetra fringilla, elementum a, egestas congue, nulla. Nunc pulvinar, purus sed tempus mattis, leo tortor sollicitudin massa, blandit lacinia tortor ante a diam. Nullam bibendum mi tempor massa malesuada varius. Morbi condimentum nisl vel dui. Quisque mauris pede, feugiat eget, convallis eget, dapibus et, justo. Nullam sapien ipsum, tempus sit amet, pharetra quis, porttitor at, diam. Vivamus eros elit, pulvinar.       </div>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newText);





  newText = document.createElement("text"+textCount+"_holder");

  newText.innerHTML = '<img src="/testsite/invis.gif" style="position:absolute;left:120;top:120;width:139;height:108;" id="text' + textCount + '_holder" class="drag" onMouseDown=selectObject()>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newText);

  





  return false;





}





//***************************************************************************



var ie=document.all;

var nn6=document.getElementById&&!document.all;

var isdrag=false;

var x,y;

var dobj;

var shiftPressed = false;

var isHolder = false;

var holderId = "";





function detectKey() 

{



if (event.shiftKey)

{

shiftPressed = true;

}

else

{

shiftPressed = false;

}

}





function releaseObject(e)

{



  if (isHolder)

  {

    dobj.style.width = document.getElementById(holderId).style.width;        

    dobj.style.height = document.getElementById(holderId).style.height;

  }



/*document.imageForm.imageX.value=document.getElementById("text1").style.left;

document.imageForm.imageY.value=document.getElementById("text1").style.top;

document.imageForm.imageW.value=document.getElementById("text1").style.width;

document.imageForm.imageH.value=document.getElementById("text1").style.height;*/

isdrag=false;

isHolder=false;

}



function moveObject(e)

{



  if (isHolder) 

  {

    document.getElementById(holderId).style.left = nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px";

    document.getElementById(holderId).style.top = nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px";

  }







  if (isdrag)

  {

    dobj.style.left = nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px";

    dobj.style.top = nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px";

  }

  return false; 

}



function resizeObject(e)

{

  if (isdrag)

  {

    dobj.style.width = nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px";

    dobj.style.height = nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px";

  }



  if (isHolder) 

  {

    document.getElementById(holderId).style.width = nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px";

    document.getElementById(holderId).style.height = nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px";

  }

    return false;

}





function selectObject(e)

{

  var fobj       = nn6 ? e.target : event.srcElement;

  var topelement = nn6 ? "HTML" : "BODY";



  if (fobj.id.indexOf("_holder") > 0)

  { 

    holderId = fobj.id.substr(0,fobj.id.indexOf("_holder"));

    isHolder = true;

  }



  

  if (shiftPressed)

  {

//--------------

while (fobj.tagName != topelement && fobj.className != "drag")

  {

    fobj = nn6 ? fobj.parentNode : fobj.parentElement;

  }



  if (fobj.className=="drag")

  {

    isdrag = true;

    dobj = fobj;

    tx = parseInt(dobj.style.width+0,10);

    ty = parseInt(dobj.style.height+0,10);

    x = nn6 ? e.clientX : event.clientX;

    y = nn6 ? e.clientY : event.clientY;

    document.onmousemove=resizeObject;

    return false;

  }

//-------------

  }

  

  else {

  while (fobj.tagName != topelement && fobj.className != "drag")

  {

    fobj = nn6 ? fobj.parentNode : fobj.parentElement;

  }





  if (fobj.className=="drag")

  {

    isdrag = true;

    dobj = fobj;

    tx = parseInt(dobj.style.left+0,10);

    ty = parseInt(dobj.style.top+0,10);

    x = nn6 ? e.clientX : event.clientX;

    y = nn6 ? e.clientY : event.clientY;

    document.onmousemove=moveObject;

    return false;

  }

  }

}

document.onkeydown = detectKey;

document.onkeyup = detectKey;

document.onmouseup=releaseObject;

//***************************************************************************



</script>







</head>



<body>





<!--





<form name="Show">



</form>



<form name="imageForm">

<input type="text" name="imageX" id="imageX"value="0" size="4"> X<br>

<input type="text" name="imageY" id="imagey" value="0" size="4"> Y<br>

<input type="text" name="imageW" id="imageW"value="0" size="4"> W<br>

<input type="text" name="imageH" id="imageH" value="0" size="4"> H<br>

</form>









<img src="/testsite/koala.jpg" style="position:absolute;left:537;top:243;width:75;height:100;" id="image1" class="drag" onMouseDown=selectObject()>



      <div style="position:absolute;left:503;top:568;width:139;height:108;background-color=#CCCCFF;overflow:hidden;" id="text1" class="drag" onMouseDown=selectObject()>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis non libero. Quisque rhoncus malesuada massa. Aliquam a ligula. Fusce interdum enim et neque. Aenean at pede eu libero rhoncus suscipit. Curabitur ut felis. Phasellus suscipit egestas turpis. Ut nulla ante, pharetra fringilla, elementum a, egestas congue, nulla. Nunc pulvinar, purus sed tempus mattis, leo tortor sollicitudin massa, blandit lacinia tortor ante a diam. Nullam bibendum mi tempor massa malesuada varius. Morbi condimentum nisl vel dui. Quisque mauris pede, feugiat eget, convallis eget, dapibus et, justo. Nullam sapien ipsum, tempus sit amet, pharetra quis, porttitor at, diam. Vivamus eros elit, pulvinar. 

      </div>



<img src="/testsite/invis.gif" style="position:absolute;left:503;top:568;width:139;height:108;" id="text1_holder" class="drag" onMouseDown=selectObject()>



-->



<FORM>

<INPUT TYPE="button"

VALUE="New Image"

onClick=createNewImage()>

</FORM>



<FORM>

<INPUT TYPE="button"

VALUE="New Text"

onClick=createNewText()>

</FORM>





<style>.NewsHeadlines A:link {color:#0066FF} A:visited {color:#0066FF}</style><div style="position:absolute;left:503;top:568;width:200;height:108; font:10pt Arial; color: #000000; background:#CCFF99; border:1px #000000 solid; padding:2px;overflow:hidden;" id="text1" class="drag" onMouseDown=selectObject()><script type='text/javascript' src='http://www.newstoolkit.com/news/supply.aspx?cat=4'></script></div>



<img src="/home/goofology/public_html/testsite/invis.gif" style="position:absolute;left:503;top:568;width:200;height:108;" id="text1_holder" class="drag" onMouseDown=selectObject()>











</body>

</html>

