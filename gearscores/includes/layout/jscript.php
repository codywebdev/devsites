<script language="javascript">
function updateRealmList(num,fieldName,anyOption) {
	var region = 'region'+num;
	var server = 'divServer'+num;
	fieldName = fieldName || 's';
	anyOption = anyOption || false;
	var anyOptionField = '';
	if (anyOption) { anyOptionField = '<option value="any">Any</option>'; }
	var curServer = document.getElementById('server'+num).value.replace(/\\/g,'');
	var eurealms = "<? echo '<select name=\""+fieldName+"\" id=\"server'; ?>"+num+"<? echo '\">"+anyOptionField+"' . preg_replace('/\n/','',preg_replace('/\"/','\\\"',file_get_contents("/home/gearscores/public_html/includes/eurealms.php"))) . '</select>'; ?>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var usrealms = "<? echo '<select name=\""+fieldName+"\" id=\"server'; ?>"+num+"<? echo '\">"+anyOptionField+"' . preg_replace('/\n/','',preg_replace('/\"/','\\\"',file_get_contents("/home/gearscores/public_html/includes/usrealms.php"))) . '</select>'; ?>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var currentRegion = document.getElementById(region).value;
	if (currentRegion == "eu") document.getElementById(server).innerHTML = eurealms;
	else document.getElementById(server).innerHTML = usrealms;
}

function updateSpecList(num) {
	var specList = 'divSpec'+num;
	var className = document.getElementById('class'+num).value;
	switch (className) {
		case 'deathknight':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Blood">Blood</option><option value="Frost">Frost</option><option value="Unholy">Unholy</option></select>';
			break;
    case 'druid':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Balance">Balance</option><option value="Feral Combat">Feral Combat</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'hunter':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Beast Mastery">Beast Mastery</option><option value="Marksmanship">Marksmanship</option><option value="Survival">Survival</option></select>';
			break;
    case 'mage':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arcane">Arcane</option><option value="Fire">Fire</option><option value="Frost">Frost</option></select>';
			break;
    case 'paladin':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Holy">Holy</option><option value="Protection">Protection</option><option value="Retribution">Retribution</option></select>';
			break;
    case 'priest':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Discipline">Discipline</option><option value="Holy">Holy</option><option value="Shadow">Shadow</option></select>';
			break;
    case 'rogue':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Assassination">Assassination</option><option value="Combat">Combat</option><option value="Subtlety">Subtlety</option></select>';
			break;
    case 'shaman':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Elemental">Elemental</option><option value="Enhancement">Enhancement</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'warlock':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Affliction">Affliction</option><option value="Demonology">Demonology</option><option value="Destruction">Destruction</option></select>';
			break;
    case 'warrior':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arms">Arms</option><option value="Fury">Fury</option><option value="Protection">Protection</option></select>';
			break;
	case 'any':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option></select>';
			break;
		default:
			break;
	}
	return true;
}


function postToURL(url, values) 
{ 
    values = values || {}; 
	
    try {
		var form = document.createElement('form');
		form.setAttribute('id', 'dynamicForm1');
		form.setAttribute('name', 'dynamicForm1');
		form.setAttribute('method', 'post');
		form.setAttribute('action', url);
	}
	catch (e) {
		var form = document.createElement('<form id="dynamicForm1" name="dynamicForm1" method="post" action="'+url+'" >');
	}
	var i=0;
    for (var property in values) 
    { 
		var value = values[property]; 
		try { 
			form.appendChild(document.createElement('input')); 
			form.childNodes[i].setAttribute('type', 'hidden');
			form.childNodes[i].setAttribute('name', property);
			form.childNodes[i].setAttribute('value', value);
		}
		catch (e) {
			form.appendChild(document.createElement('<input type="hidden" name="'+property+'" value="'+value+'">')); 
		}
		i++;
    }
    document.body.appendChild(form); 
    form.submit(); 
    document.body.removeChild(form); 
}

function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		document.getElementById(limitCount).innerHTML =  limitField.value.length;
	}
}


function stateChanged(loc) {
	if (xmlHttp.readyState==4)	{ 
		document.getElementById(loc).innerHTML=xmlHttp.responseText;
	}
}
 
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	}
	catch (e) {
	  // Internet Explorer
	  try {
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  }
	  catch (e) {
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	}
	return xmlHttp;
}


function voteComment(id, type, loc) {
	if (id.length==0) { 
	  document.getElementById(loc).innerHTML="";
	  return;
	}
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
	  return;
	} 
	var url="id="+id;
	url=url+"&type="+type;
	xmlHttp.onreadystatechange= function() {stateChanged(loc);};
	xmlHttp.open("POST","/includes/voteComment.php",true);
	xmlHttp.setRequestHeader('Content-type',
		   'application/x-www-form-urlencoded;charset=UTF-8;');
	xmlHttp.send(url);
}

function insertChar(loc, char) {
	document.getElementById(loc).value = document.getElementById(loc).value + char;
}

function getRaidExp(loc) 
{ 
    loc = loc || 'charExp1';
	document.getElementById(loc).innerHTML='<table border="0" cellspacing="0" cellpadding="0" class="charInfo"><tr><td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0"><tr><td><div class="dropshadow"><table border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2" align="center" valign="middle" class="busyText">Retrieving raid experience <img src="images/busy.gif" width="18" height="18" align="texttop" /></td></tr></table></div></td></tr></table></td></tr></table>';
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
	  return;
	} 
	var url="n=<? echo urlencode($name); ?>";
	url=url+"&s=<? echo urlencode($server); ?>";
	url=url+"&r=<? echo urlencode($region); ?>";
	xmlHttp.onreadystatechange= function() {stateChanged(loc);};
	xmlHttp.open("POST","includes/getCharExp<? //if ($_SERVER['REMOTE_ADDR'] == '74.197.117.176') echo 'Test'; ?>.php",true);
	xmlHttp.setRequestHeader('Content-type',
		   'application/x-www-form-urlencoded;charset=UTF-8;');
	xmlHttp.send(url);
}
 
</script>
