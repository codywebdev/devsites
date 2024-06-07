<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>



<script language="javascript">



var imageCount = 0;

var textCount = 1;

var randImage = 1;



//##############################################################

var zOrderArray = new Array ( "object1", "object2", "text1", "image_bear_1" );

//##############################################################

function rewriteList(selected) {
	var revZOrderArray = zOrderArray.slice();
	revZOrderArray.reverse();
	var outputHtml = '<select multiple name="zOrderFrame" id="zOrderFrame">';
	for (i=0; i < revZOrderArray.length; i++) {
		outputHtml += '<option value="'+revZOrderArray[i]+'" ';
		if (selected == revZOrderArray[i]) outputHtml += 'selected="selected"';
		outputHtml += '>'+revZOrderArray[i]+'</option>';
	}
	outputHtml += '</select>';
	
	document.getElementById("zOrderFrameSpan").innerHTML = outputHtml;	
}

function adjustZindex(dir)

{
	if (dir != "up") dir == "down";
	
	var objValue = document.getElementById("zOrderFrame").value;
	var objListLoc = zOrderArray.indexOf(objValue);
	
	if (objListLoc < 0 || objListLoc > zOrderArray.length-1 ) return;
	else if (objListLoc == 0 && dir == "down") return;
	else if (objListLoc == zOrderArray.length-1 && dir == "up") return;
	
	if (dir == "up") {
		document.getElementById(zOrderArray[objListLoc]).style.zIndex = ((objListLoc+1)*2)+2
		document.getElementById(zOrderArray[objListLoc]+"_holder").style.zIndex = ((objListLoc+1)*2)+3
		document.getElementById(zOrderArray[objListLoc+1]).style.zIndex = ((objListLoc+1)*2)
		document.getElementById(zOrderArray[objListLoc+1]+"_holder").style.zIndex = ((objListLoc+1)*2)+1
		var temp = zOrderArray[objListLoc+1];
		zOrderArray[objListLoc+1] = zOrderArray[objListLoc];
		zOrderArray[objListLoc] = temp;
	}
	
	else if (dir == "down") {
		document.getElementById(zOrderArray[objListLoc]).style.zIndex = ((objListLoc+1)*2)-2
		document.getElementById(zOrderArray[objListLoc]+"_holder").style.zIndex = ((objListLoc+1)*2)-1
		document.getElementById(zOrderArray[objListLoc-1]).style.zIndex = ((objListLoc+1)*2)
		document.getElementById(zOrderArray[objListLoc-1]+"_holder").style.zIndex = ((objListLoc+1)*2)+1
		var temp = zOrderArray[objListLoc-1];
		zOrderArray[objListLoc-1] = zOrderArray[objListLoc];
		zOrderArray[objListLoc] = temp;
	}
	
	rewriteList(objValue);
}



function randomColor (){

      var array = new Array (   "f", "e", "d", "c", "b", "a", "9", "8", "7", "6", "5", "4", "3" );  // array of possible hex values.

      var endHex = "#";  // this is the hex color that will be returned

      for (   var i = 0; i < 6; i++   )   {  // loop 6 times...

            endHex += array[Math.floor (   Math.random (   ) * array.length   )];  // and each time add a new character to the returned color.

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

  newImage.innerHTML = '<img src="/testsite/' + imageName + '" style="position:absolute;left:120;top:100;width:75;height:100;border-style:dotted;border-width:1px;z-index:'+((zOrderArray.length+1)*2)+';" id="image' + imageCount + '" class="drag" onMouseDown=selectObject()>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newImage); 
  
  
  
  
  
  newImage = document.createElement("image"+imageCount+"_holder");

  newImage.innerHTML = '<img src="/testsite/invis.gif" style="position:absolute;left:120;top:100;width:75;height:100;z-index:'+(((zOrderArray.length+1)*2)+1)+';" id="image' + imageCount + '_holder" class="drag" onMouseDown=selectObject()>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newImage);
  
  
  
  
  
  zOrderArray.push('image'+imageCount);
  rewriteList('image'+imageCount);
  
  
  

  randImage++;

  return false;

}



function createNewText()

{  

  var color = randomColor();
  

  textCount++;

  newText = document.createElement("text"+textCount);

  newText.innerHTML = '<div style="position:absolute;left:120;top:120;width:139;height:108;background-color:' + color + ';overflow:hidden;border-style:dotted;border-width:1px;z-index:'+((zOrderArray.length+1)*2)+';" id="text' + textCount + '" class="drag" onMouseDown=selectObject()>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis non libero. Quisque rhoncus malesuada massa. Aliquam a ligula. Fusce interdum enim et neque. Aenean at pede eu libero rhoncus suscipit. Curabitur ut felis. Phasellus suscipit egestas turpis. Ut nulla ante, pharetra fringilla, elementum a, egestas congue, nulla. Nunc pulvinar, purus sed tempus mattis, leo tortor sollicitudin massa, blandit lacinia tortor ante a diam. Nullam bibendum mi tempor massa malesuada varius. Morbi condimentum nisl vel dui. Quisque mauris pede, feugiat eget, convallis eget, dapibus et, justo. Nullam sapien ipsum, tempus sit amet, pharetra quis, porttitor at, diam. Vivamus eros elit, pulvinar.       </div>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newText);





  newText = document.createElement("text"+textCount+"_holder");

  newText.innerHTML = '<img src="/testsite/invis.gif" style="position:absolute;left:120;top:120;width:139;height:108;z-index:'+(((zOrderArray.length+1)*2)+1)+';" id="text' + textCount + '_holder" class="drag" onMouseDown=selectObject()>';

  var theBody = document.getElementsByTagName('body')[0];

  theBody.appendChild(newText);

  



  zOrderArray.push('text'+textCount);
  rewriteList('text'+textCount);



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





function detectKey(e) 

{

if (nn6 ? e.which==16 : event.shiftKey)

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

  updateObjectInfo();

  return false; 

}



function resizeObject(e)

{

  minWidth = 10;

  minHeight = 10;



  if (isdrag)

  { 

    dobj.style.width = (nn6 ? tx + e.clientX - x : tx + event.clientX - x) > minWidth ? (nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px") : minWidth + "px";

    dobj.style.height = (nn6 ? ty + e.clientY - y : ty + event.clientY - y) > minHeight ? (nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px") : minHeight + "px";

  }



  if (isHolder) 

  { 

    document.getElementById(holderId).style.width = (nn6 ? tx + e.clientX - x : tx + event.clientX - x) > minWidth ? (nn6 ? tx + e.clientX - x + "px" : tx + event.clientX - x + "px") : minWidth + "px";

    document.getElementById(holderId).style.height = (nn6 ? ty + e.clientY - y : ty + event.clientY - y) > minHeight ? (nn6 ? ty + e.clientY - y + "px" : ty + event.clientY - y + "px") : minHeight + "px";

  }

    updateObjectInfo();

    return false;

}



//-------------------------------------------

function selectObject(e)

{ 

  var fobj = nn6 ? e.target : event.srcElement;

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

    x = nn6 ? e.clientX: event.clientX;

    y = nn6 ? e.clientY: event.clientY;

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

    x = nn6 ? e.clientX: event.clientX;

    y = nn6 ? e.clientY: event.clientY;

    document.onmousemove=moveObject;

    return false;

  }

  }

  

}



function updateObjectInfo(e)

{

     if (holderId) {

document.getElementById('activeObjectName').value = document.getElementById(holderId).id;

document.getElementById('activeObjectHeight').value = document.getElementById(holderId).style.height;

document.getElementById('activeObjectWidth').value = document.getElementById(holderId).style.width;

document.getElementById('activeObjectTop').value = document.getElementById(holderId).style.top;

document.getElementById('activeObjectLeft').value = document.getElementById(holderId).style.left;

rewriteList(document.getElementById(holderId).id);

     }



}



function keyPressDown(e)

{

detectKey(e);

}



function keyPressUp(e)

{

shiftPressed=false;

}



function mouseButtonUp(e)

{

releaseObject(e);

updateObjectInfo(e);

}



document.onkeydown = keyPressDown;

document.onkeyup = keyPressUp;

document.onmouseup= mouseButtonUp;

//***************************************************************************

document.onmousedown=selectObject;


//cross-browser support of array.indexof
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}

</script>







</head>



<body>





<div style="position:absolute;left:800;top:20">

Name: <input type="text" size="20" name="activeObjectName" id="activeObjectName">

<br>

Height: <input type="text" size="20" name="activeObjectHeight" id="activeObjectHeight">

<br>

Width: <input type="text" size="20" name="activeObjectWidth" id="activeObjectWidth">

<br>

Y: <input type="text" size="20" name="activeObjectTop" id="activeObjectTop">

<br>

X: <input type="text" size="20" name="activeObjectLeft" id="activeObjectLeft">

</div>



<div style="position:absolute;left:400;top:20">

<table>

<tr>

<td>

<span name="zOrderFrameSpan" id="zOrderFrameSpan"><select multiple name="zOrderFrame" id="zOrderFrame">  

 <option value="text1">text1</option>

 <option value="object2">object2</option>

 <option value="object1">object1</option>

</select></span>

</td>

<td valign=middle>

<a href="javascript:adjustZindex('up')">Up</a>

<br><br>

<a href="javascript:adjustZindex('down')">Down</a>

</td>

</tr>

</table>

</div>





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





<style>.NewsHeadlines A:link {color:#0066FF} A:visited {color:#0066FF}</style><div style="position:absolute;left:503;top:568;width:200;height:108; font:10pt Arial; color: #000000; background:#CCFF99; border:1px #000000 solid; padding:0px;overflow:hidden;z-index:6;" id="text1" class="drag" onMouseDown=selectObject()><script type='text/javascript' src='http://www.newstoolkit.com/news/supply.aspx?cat=4'></script></div>



<img src="/testsite/invis.gif" style="position:absolute;left:503;top:568;width:200;height:108;border:1;z-index:7;" id="text1_holder" class="drag" onMouseDown=selectObject()>







<div><object><param name="movie" value="http://www.youtube.com/v/WF_1Pk_4UZk&hl=en&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/WF_1Pk_4UZk&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" style="position:absolute;left:203;top:268;width:300;height:208; font:10pt Arial; color: #000000; background:#CCFF99; border:1px #000000 solid; padding:2px;overflow:hidden;z-index:2;" id="object1" class="drag" onMouseDown=selectObject()></embed></object></div>



<img src="/testsite/invis.gif" style="position:absolute;left:203;top:268;width:300;height:208;z-index:3;border-style:dotted;border-width:1;" id="object1_holder" class="drag" onMouseDown=selectObject()></div>









<img src="/testsite/invis.gif" style="position:absolute;left:303;top:368;width:300;height:208;z-index:5;border-style:dotted;border-width:1;" id="object2_holder" class="drag" onMouseDown=selectObject()></div>





<object><param name="movie" value="http://www.youtube.com/v/WF_1Pk_4UZk&hl=en&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/WF_1Pk_4UZk&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" style="position:absolute;left:303;top:368;width:300;height:208; font:10pt Arial; color: #000000; background:#CCFF99; border:1px #000000 solid; padding:2px;overflow:hidden;z-index:4" id="object2" class="drag" onMouseDown=selectObject()></embed></object>




<img src="/testsite/bear.jpg" style="position:absolute;left:150;top:200;width:75;height:100;border-style:dotted;border-width:1px;z-index:8;" id="image_bear_1" class="drag" onMouseDown=selectObject()>

<img src="/testsite/invis.gif" style="position:absolute;left:150;top:200;width:75;height:100;z-index:9;border-style:dotted;border-width:1;" id="image_bear_1_holder" class="drag" onMouseDown=selectObject()></div>







</body>

</html>

