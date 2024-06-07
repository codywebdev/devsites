<?php

	$newHtml = '<div class="contentBorder3"><div class="contentBorder2"><h1>Contact Us</h1><div class="contentBorder"><div class="linkLightBgBegin" id="contact1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="normalText"><p>Our staff at Goofology.com would love to hear  from you. If you have a question, or a comment about the website, or would like  to make a suggestion, please feel free to use this form to contact our staff.</p>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="post" action="/processes/processContact.php">
      <p class="boldText">Name: (optional)</p>
      <p>
        <label>
        <input name="name" type="text" class="longTextField" id="name" />
        </label>
      </p>
      <p class="boldText">Type:</p>
      <p>
        <label>
        <select name="type" class="longTextField" id="type">
          <option selected="selected"> </option>
          <option value="question">Question</option>
          <option value="comment">Comment</option>
          <option value="suggestion">Suggestion</option>
          <option value="report">Report an Error/Bug</option>
          <option value="other">Other</option>
        </select>
        </label>
      </p>
      <p class="boldText">Description:</p>
      <p>
        <label>
        <textarea name="description" cols="50" rows="5" class="longDescriptionField" id="description"></textarea>
        </label>
      </p>
      <p>&nbsp;</p>
      <p>
        <label>
        <input type="submit" name="Submit" id="Submit" value="Submit" />
        </label>
        <label>
        <input type="reset" name="Reset" id="Reset" value="Reset" />
        </label>
      </p>
    </form>    
    <p>&nbsp;</p></td>
  </tr>
</table></div></div></div></div>';

	echo $newHtml;

?>