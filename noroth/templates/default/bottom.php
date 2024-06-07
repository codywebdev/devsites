        </div>
    </div>
</div>

<div id="footerWrapper">
<? echo WEBSITE_NAME; ?> is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program <br />designed to provide a means for sites to earn advertising fees by advertising and linking to amazon.com.<br />
Certain content that appears on this site comes from Amazon Services LLC. This content <br />is provided 'as is' and is subject to change or removal at any time.  <br />All other content on this site is copyright of <? echo WEBSITE_NAME; ?>.<br />
<a href="<? echo WEBSITE_ROOT_URL; ?>/privacy.php">Privacy Policy</a><img src="<? echo WEBSITE_ROOT_URL; ?>/includes/images/transparent_90.png" width="2" height="2" /></div>
<?
$rand = rand(1,100);
if ($rand<=50) {
	echo '<script type="text/javascript">
  var vglnk = { api_url: \'//api.viglink.com/api\',
                key: \'e0537f57d3136890c0499953b08ff388\' };

  (function(d, t) {
    var s = d.createElement(t); s.type = \'text/javascript\'; s.async = true;
    s.src = (\'https:\' == document.location.protocol ? vglnk.api_url :
             \'//cdn.viglink.com/api\') + \'/vglnk.js\';
    var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
  }(document, \'script\'));
</script>';
}
?>
</body>
</html>