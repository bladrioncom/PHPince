<!DOCTYPE HTML>
<html>
<head>
<?php
	bl_metaheader($PHPINCE_system, $PHPince_logon);
?>
</head>
<body>
<ul>
<?php
	bl_temp_nav(1, $PHPince_logon);
?>
</ul>
<?php
	bl_temp_content(array(), $PHPince_logon, $PHPINCE_system, $PHPINCE_LANG);
?>
</body>
</html>