<script language="javascript">

function updateRealmList(num) {
	var region = 'region'+num;
	var server = 'divServer'+num;
	var curServer = document.getElementById('server'+num).value.replace(/\\/g,'');
	var eurealms = "<? echo '<select name=\"s\" id=\"server'; ?>"+num+"<? echo '\">' . str_replace('\n','',str_replace('\"','\\\"',file_get_contents("includes/eurealms.php"))) . '</select>'; ?>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var usrealms = "<? echo '<select name=\"s\" id=\"server'; ?>"+num+"<? echo '\">' . str_replace('\n','',str_replace('\"','\\\"',file_get_contents("includes/usrealms.php"))) . '</select>'; ?>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var currentRegion = document.getElementById(region).value;
	if (currentRegion == "eu") document.getElementById(server).innerHTML = eurealms;
	else document.getElementById(server).innerHTML = usrealms;
}

function updateSpecList(num) {
	var specList = 'divSpec'+num;
	var className = document.getElementById('class'+num).value;
	switch (className) {
		case 'deathknight':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Blood</option><option value="spec2">Frost</option><option value="spec3">Unholy</option></select>';
			break;
    case 'druid':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Balance</option><option value="spec2">Feral Combat</option><option value="spec3">Restoration</option></select>';
			break;
    case 'hunter':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Beast Mastery</option><option value="spec2">Marksmanship</option><option value="spec3">Survival</option></select>';
			break;
    case 'mage':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Arcane</option><option value="spec2">Fire</option><option value="spec3">Frost</option></select>';
			break;
    case 'paladin':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Holy</option><option value="spec2">Protection</option><option value="spec3">Retribution</option></select>';
			break;
    case 'priest':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Discipline</option><option value="spec2">Holy</option><option value="spec3">Shadow</option></select>';
			break;
    case 'rogue':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Assassination</option><option value="spec2">Combat</option><option value="spec3">Subtlety</option></select>';
			break;
    case 'shaman':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Elemental</option><option value="spec2">Enhancement</option><option value="spec3">Restoration</option></select>';
			break;
    case 'warlock':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Affliction</option><option value="spec2">Demonology</option><option value="spec3">Destruction</option></select>';
			break;
    case 'warrior':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="spec1">Arms</option><option value="spec2">Fury</option><option value="spec3">Protection</option></select>';
			break;
	case 'any':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option></select>';
			break;
		default:
			break;
	}
	return true;
}

function switchMenu(newtab) {
	switch (newtab) {
		case 'home':
			document.getElementById('menuHome').className = 'active';
			document.getElementById('menuSearch').className = 'inactive';
			document.getElementById('menuRankings').className = 'inactive';
			document.getElementById('menuMembers').className = 'inactive';
			document.getElementById('menuMainSub').innerHTML = 'home';
			break;
		case 'search':
			document.getElementById('menuHome').className = 'inactive';
			document.getElementById('menuSearch').className = 'active';
			document.getElementById('menuRankings').className = 'inactive';
			document.getElementById('menuMembers').className = 'inactive';
			document.getElementById('menuMainSub').innerHTML = '<form id="mainCharSearch" name="mainCharSearch" method="post" action="http://gearscores.com/character.php" style="display:inline;"><label>Region:<select name="r" id="region2" onchange="updateRealmList(2);"><option value="us">US</option><option value="eu">EU</option></select>Name:<input type="text" name="n" id="name2" />Realm:<div id="divServer2" style="display:inline;"><select name="s" id="server2"><? echo preg_replace('/\n/','',preg_replace("/\'/","\\\'",file_get_contents("includes/".$region."realms.php"))); ?></select></div><input type="submit" name="submit2" id="submit2" value="Search!" /></label></form>';
			break;
		case 'rankings':
			document.getElementById('menuHome').className = 'inactive';
			document.getElementById('menuSearch').className = 'inactive';
			document.getElementById('menuRankings').className = 'active';
			document.getElementById('menuMembers').className = 'inactive';
			document.getElementById('menuMainSub').innerHTML = '<form id="searchRankings" name="searchRankings" method="post" action="http://gearscores.com/rankings.php" style="display:inline;"><table cellpadding="0" cellspacing="10" ><tr><td>Region:<br /><select name="rre" id="region3" onchange="updateRealmList(3);"><option value="us">US</option><option value="eu">EU</option></select></td><td>Realm:<br /><div id="divServer3" style="display:inline;"><select name="rse" id="server3"><? echo preg_replace('/\n/','',preg_replace("/\'/","\\\'",file_get_contents("includes/".$region."realms.php"))); ?></select></div></td><td>Class:<br /><select name="rcl" id="class3" onchange="updateSpecList(3);"><option value="any" selected="selected">Any</option><option value="deathknight">Death Knight</option><option value="druid">Druid</option><option value="hunter">Hunter</option><option value="mage">Mage</option><option value="paladin">Paladin</option><option value="priest">Priest</option><option value="rogue">Rogue</option><option value="shaman">Shaman</option><option value="warlock">Warlock</option><option value="warrior">Warrior</option></select></td><td>Spec:<br /><div id="divSpec3" style="display:inline;">  <select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="dummy">Dummy</option></select></div></td><td><table><tr><td><label>Highest GS<input name="rgs" type="radio" id="rgs_0" value="highest" checked="checked" /></label></td></tr><tr><td><label>Current GS<input type="radio" name="rgs" value="current" id="rgs_1" /></label></td></tr></table></td><td><input type="submit" name="submit3" id="submit3" value="Search!" /></label></td></tr></table></form>';
			break;
		case 'members':
			document.getElementById('menuHome').className = 'inactive';
			document.getElementById('menuSearch').className = 'inactive';
			document.getElementById('menuRankings').className = 'inactive';
			document.getElementById('menuMembers').className = 'active';
			document.getElementById('menuMainSub').innerHTML = 'members';
			break;
		default:
			document.getElementById('menuHome').className = 'inactive';
			document.getElementById('menuSearch').className = 'active';
			document.getElementById('menuRankings').className = 'inactive';
			document.getElementById('menuMembers').className = 'inactive';
			document.getElementById('menuMainSub').innerHTML = 'search';
			break;
	}
}



function postToURL1(url, params) { 
    var form = document.createElement('form'); 
    form.action = url; 
    form.method = 'POST'; 
 
    for (var i in params) { 
        if (params.hasOwnProperty(i)) { 
            var input = document.createElement('input'); 
            input.type = 'hidden'; 
            input.name = i; 
            input.value = params[i]; 
            form.appendChild(input); 
        } 
    } 
 
    form.submit(); 
} 



function postToURL(url, values) 
{ 
    values = values || {}; 
	
    try {
		var form = document.createElement('form');
		form.setAttribute('id', 'dynamicForm1');
		form.setAttribute('name', 'dynamicForm1');
		form.setAttribute('method', 'post');
		form.setAttribute('action', 'http://gearscores.com/character.php');
	}
	catch (e) {
		var form = document.createElement('<form id="dynamicForm1" name="dynamicForm1" method="post" action="http://gearscores.com/character.php" >');
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



</script>
