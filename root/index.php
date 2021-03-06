<?php

header("content-type: application/xhtml+xml");

require("auth/common.php");

<%RWDESC%>
<%VALIDSKINS%>

print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<head>
	<title><?php print $site; ?></title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
	<%LANGFUNC%>
	<?php
		$bnum = <%BUILDNUM%>;
		$skin = "Rainwave";
		#print "<!--\n";
		$lang = getDefaultLanguage();
		if (isset($_COOKIE['r3prefs'])) {
			$cookie = json_decode($_COOKIE['r3prefs'], true);
			if (isset($cookie['edi']['language']['value'])) {
				$lang = $cookie['edi']['language']['value'];
				#print "preference language loaded instead: " . $lang . "\n";
			}
			if (isset($cookie['edi']['theme']['value']) && in_array($cookie['edi']['theme']['value'], $validskins)) { 
				$skin = $cookie['edi']['theme']['value'];
				#print "preference theme loaded: " . $skin . "\n";
			}
		}
		#print "\n-->\n";
		print "<link rel=\"stylesheet\" href='skins_r" . $bnum . "/" . $skin . "/" . $skin . ".css' type='text/css' />\n";
	?>
</head>
<body id="body">
<div style="display: none;">
	<?php 
		if (isset($rwdesc[$lang])) print $rwdesc[$lang][$sid] . "\n";
		else print $rwdesc['en_CA'][$sid] . "\n";
	?>
</div>
<script type="text/javascript">
<?php
	print "\tvar PRELOADED_LANG = '" . $lang . "';\n";
	print "\tvar PRELOADED_APIKEY = '" . newAPIKey(true) . "';\n";
	print "\tvar PRELOADED_USER_ID = " . $user_id . ";\n";
	print "\tvar PRELOADED_SID = " . $sid . ";\n";
	print "\tvar PRELOADED_LYREURL = '';\n";
	print "\tvar BUILDNUM = <%BUILDNUM%>;\n";
	print "\tvar COOKIEDOMAIN = 'rainwave.cc';\n";
?>
</script>
<?php
	print "<div id='oggpixel'></div>\n";
	print "<script src='lang_r" . $bnum . "/" . $lang . ".js' type='text/javascript'></script>\n";
	print "<script src='skins_r" . $bnum . "/" . $skin . "/" . $skin . ".js' type='text/javascript'></script>\n";
?>
<script src='rainwave3_r<%BUILDNUM%>.js' type='text/javascript'></script>
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script> 
<script type="text/javascript">
	pageTracker = _gat._getTracker("UA-3567354-1");
	pageTracker._initData();
	pageTracker._trackPageview();
</script>
</body>
</html>
