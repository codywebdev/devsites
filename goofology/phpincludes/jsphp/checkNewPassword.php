<script language="javascript">
function checkNewPassword()
{
	if (form1.password.value == form1.confpassword.value)
	{
		document.getElementById('password2').innerHTML=
		'<img src="/images/check.png" />';
	}
	else
	{
		document.getElementById('password2').innerHTML=
		'<font color="Red" class="errorstyle">Passwords do not match.</font>';
	}
}
</script>
