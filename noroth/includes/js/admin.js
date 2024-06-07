function addToList(asinString) {
	if (document.getElementById('form_description').innerHTML == '') {
		document.getElementById('form_description').innerHTML = '\''+asinString+'\'';
	}
	else {
		document.getElementById('form_description').innerHTML = document.getElementById('form_description').innerHTML + ', ' + '\''+asinString+'\'';
	}
}

function changeList() {
	document.getElementById('form_customName').innerHTML = '';
	document.getElementById('form_description').innerHTML = '';
	document.getElementById('form_lists_form').submit();
}