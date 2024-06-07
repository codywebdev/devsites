<?php
	echo '<script language="javascript">
function popupVoting(value)
{	
	if (value==\'enable\') {
	  date = new Date();
	  document.cookie = \'popupVoting=enabled; expires=Fri, 31 Dec 2099 23:59:59 GMT;path=/;\';
	}
	else if (value==\'disable\') {
	  date = new Date();
	  document.cookie = \'popupVoting=disabled; expires=Fri, 31 Dec 2099 23:59:59 GMT;path=/;\';
  	}
}

function switchPopupVoting(value) {
	if (value=="enable") {newValue="disable";}
	else if (value=="disable") {newValue="enable";}
	newHtml = "<div id=\\"popupVoting\\"><font class=\'boldText\'><a href=\\"javascript:popupVoting(\'"+newValue+"\')\\" onclick=\\"switchPopupVoting(\'"+newValue+"\')\\" style=\\"text-transform:capitalize\\">Popup Vote Frame: "+value+"d</a></font></div>";
  with (document) if (getElementById && ((obj=getElementById(\'popupVoting\'))!=null))
    with (obj) innerHTML = unescape(newHtml);
}
</script>';
?>