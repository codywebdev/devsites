<?

$customCode = $_POST['customCode'];

//$masterFile = fopen('/home/goofology/public_html/testsite/test.txt', 'w');
//fwrite($masterFile,$customCode);
//fclose($masterFile);






?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script language="javascript">

String.prototype.regexLastIndexOf = function(regex, startpos) {     regex = (regex.global) ? regex : new RegExp(regex.source, "g" + (regex.ignoreCase ? "i" : "") + (regex.multiLine ? "m" : ""));     if(typeof (startpos) == "undefined") {         startpos = this.length;     } else if(startpos < 0) {         startpos = 0;     }     var stringToWorkWith = this.substring(0, startpos + 1);     var lastIndexOf = -1;     var nextStop = 0;     while((result = regex.exec(stringToWorkWith)) != null) {         lastIndexOf = result.index;         regex.lastIndex = ++nextStop;     }     return lastIndexOf; } 




function onloadMessage() {
	//var test = document.getElementById("customCode").getAttribute("cols");  //find the value of a specific tag
	//var test = document.getElementById("customCode").tagName; //find the immediate tag name (type)
	//alert(test);	
	
	//<img border="0" src="http://www.w3schools.com/images/pulpit.jpg" alt="Pulpit rock" width="[[resizeX,304]]" height="[[resizeY,228]]" />
	
	
	
	var elementLocation = document.getElementById("customCode").value.search(RegExp(/\[\[[\sa-z0-9\,_-]*\]\]/i));
	var elementTag = document.getElementById("customCode").value.regexLastIndexOf(RegExp(/<[a-z]*/i), elementLocation)
	document.getElementById("modifyFrame").value = elementLocation + ' ' + elementTag;
	
}

</script>


</head>

<body>
<form id="form1" name="form1" method="post" action="http://www.goofology.com/testsite/test5.php">
  <p>
    <textarea name="customCode" id="customCode" cols="100" rows="20" myCustomTag="23" ><? echo $customCode; ?></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="button" onclick="javascript:onloadMessage()" value="Do it!" />
  </p>
</form>
<p>&nbsp;</p>
<p>
  <label for="modifyFrame"></label>
  <textarea name="modifyFrame" id="modifyFrame" cols="100" rows="20"></textarea>
</p>
</body>
</html>