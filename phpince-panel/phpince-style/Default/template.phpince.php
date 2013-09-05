<!DOCTYPE HTML>
<html>
<head>
<?php
	bl_metaheader($PHPINCE_system);
?>
</head>
<body>
<ul>
<?php
	bl_temp_nav(1, $PHPince_logon);
?>
</ul>
<?php
	if(bl_index()){
		echo "INDEX !";
	} else {
		echo "NO INDEX SUCKS !<br>";
	}
	bl_temp_content(array(
		"topic_limit" => 2,
		"topic_cat" => 9,
		"topic_style" => "<h1>C- {PHPINCE_TITLE} {PHPINCE_DATE_D} x {PHPINCE_DATE} - {PHPINCE_TIME} x {PHPINCE_TIME_H}:{PHPINCE_TIME_M} <a href=\"/topic/{PHPINCE_ID}\">View</a></h1><p>{PHPINCE_TEXT}</p><hr>",
		"topic_style_active" => "<h1>C- {PHPINCE_TITLE}</h1><p>{PHPINCE_TEXT}</p>",
		"topic_error" => "Žiadne topici niesu napísané ;(",
		"topic_notfound" => "Tento topic neexistuje ;(",
		"page_style" => "<h1>CP- {PHPINCE_TITLE}</h1><p>{PHPINCE_TEXT}</p>",
		"page_notfound" => "Táto stránka neexistuje ;(",
	), $PHPince_logon, $PHPINCE_system, $PHPINCE_LANG);
?>

<img src="<?php bl_temp_link($PHPINCE_system); ?>image.jpg" alt="Image" width="100"><br>
</body>
</html>
