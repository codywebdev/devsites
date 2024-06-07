<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email Form </title>
</head>
<body>

<form method="post" action="sendemail.php">

  <p>
  <!-- DO NOT change ANY of the php sections -->
  <?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>
    
  <input type="hidden" name="ip" value="<?php echo $ipi ?>" />
  <input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
  <input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />
    
    
    Your Name (optional): <br />
  <input type="text" name="visitor" size="35" />
  <br />
    Your Email (optional):<br />
  <input type="text" name="visitormail" size="35" />
  <br />
  <br />
    Category:<br />
  <select name="attn" size="1">
    <option value=" Comment or Suggestion about the Site ">Comment or Suggestion about the Site </option> 
    <option value=" Report a Gold Seller Advertisement ">Report a Gold Seller Advertisement </option> 
    <option value=" Report a problem ">Report a problem </option> 
    <option value=" Question ">Question </option> 
    <option value=" Other ">Other </option> 
  </select>
  <br />
  </p>
  <p>    Mail Message:
    <br />
    <textarea name="notes" rows="4" cols="40"></textarea>
    <br />
    <input type="submit" value="Send Mail" />
    </p>
  <p>**Note: When reporting gold selling advertisement, please give as much detail as possible, and most importantly, give the link address (URL) of the advertisement.<br />
      </p>
</form>

</body>
</html>
