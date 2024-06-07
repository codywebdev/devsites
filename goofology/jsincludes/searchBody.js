<script type="text/javascript">
<!--
function encodeHtml(string) {
 encodedHtml = escape(string);
 encodedHtml = encodedHtml.replace(/\//g,"%2F");
 encodedHtml = encodedHtml.replace(/\?/g,"%3F");
 encodedHtml = encodedHtml.replace(/=/g,"%3D");
 encodedHtml = encodedHtml.replace(/&/g,"%26");
 encodedHtml = encodedHtml.replace(/@/g,"%40");
 return encodedHtml;
}

function doInnerHTML(elementId, stringHTML) {
 
   try {
      var elem = document.getElementById(elementId);
      var children = elem.childNodes;
 
      for (var i = 0; i < children.length; i++) {
         elem.removeChild(children[i]);
      }
 
      var nodes = new DOMParser().parseFromString(
         stringHTML, 'text/xml');
      var range = document.createRange();
      range.selectNodeContents(
         document.getElementById(elementId));
      range.deleteContents();
 
      for (var i = 0; i < nodes.childNodes.length; i++) {
         document.getElementById(elementId).appendChild(
            nodes.childNodes[i]);
      }
      return true;
      } catch (e) {
         try {
            document.getElementById(elementId).innerHTML =
               stringHTML;
            return true;
         }
      catch(ee) {
         return false;
      }
   }
}

function linksSearch(str,type,loc) {
	
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
var url="processChangeSearch.php";
url=url+"?string="+str;
url=url+"&type="+type;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
	
	
	
	
	/*
	var newhtml = '<tr>            <td width="13%" class="searchHeadTextSelected"><a href="javascript:linksSearch()" style="text-decoration:none; color:#000000">Links</a></td>            <td width="3%" class="searchHeadText">&nbsp;</td>            <td width="15%" class="searchHeadTextUnselected"><a href="javascript:membersSearch()">Members</a></td>            <td width="69%" class="searchHeadText">&nbsp;</td>          </tr>          <tr>            <td colspan="4"><div class="searchBottom"><form id="form1" name="form1" method="post" action="search.php">              <label>                <input name="s" type="text" class="searchField" id="s" size="50" />                </label>              <label>              <input name="Search" type="submit" class="submitButton" id="Search" value="Search" onmouseover="this.className=\'submitButtonHover\'" onmouseout="this.className=\'submitButton\'"  />              </label>            </form></div>            </td>            </tr>';
	var encodedHtml = encodeHtml(newhtml);
  with (document) if (getElementById && ((obj=getElementById("searchBody"))!=null))
    with (obj) innerHTML = unescape(encodedHtml);
	*/
}

function membersSearch(str,type,loc) {
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
var url="processChangeSearch.php";
url=url+"?string="+str;
url=url+"&type="+type;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange= function() {stateChanged(loc);};
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
	
	
	
	
	
	/*var newhtml = '<tr>            <td width="13%" class="searchHeadTextUnselected"><a href="javascript:linksSearch()">Links</a></td>            <td width="3%" class="searchHeadText">&nbsp;</td>            <td width="15%" class="searchHeadTextSelected"><a href="javascript:membersSearch()" style="text-decoration:none; color:#000000">Members</a></td>            <td width="69%" class="searchHeadText">&nbsp;</td>          </tr>          <tr>            <td colspan="4"><div class="searchBottom"><form id="form1" name="form1" method="post" action="search.php?type=member">              <label>                <input name="s" type="text" class="searchField" id="s" size="50" />                </label>              <label>              <input name="Search" type="submit" class="submitButton" id="Search" value="Search" onmouseover="this.className=\'submitButtonHover\'" onmouseout="this.className=\'submitButton\'"  />              </label>            </form></div>            </td>            </tr>';
	var newhtml = '<div>Hello</div>';
	var encodedHtml = encodeHtml(newhtml);
doInnerHTML('searchBody', '<div>Hello</div>');	document.getElementById("searchBody").innerHTML = unescape(encodedHtml);
  with (document) if (getElementById && ((obj=getElementById("searchBody"))!=null))
    with (obj) innerHTML = unescape(encodedHtml);*/
}
//-->
</script>
